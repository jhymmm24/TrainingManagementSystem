<?php

include 'Connection/connection.php';
require 'PHPExcel/Classes/PHPExcel.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
        // Get the uploaded file details
        $fileTmpName = $_FILES["file"]["tmp_name"];

        // Get the selected training name and section
        $trainingType = $_POST["trainingtype"] ?? '';
        $section = $_POST["section"] ?? '';

        // Read data from Excel file
        try {
            $objPHPExcel = PHPExcel_IOFactory::load($fileTmpName);
        } catch (Exception $e) {
            die("Error loading file: " . $e->getMessage());
        }
        
        $worksheet = $objPHPExcel->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($worksheet->getHighestColumn());

        // Initialize arrays to store employee numbers and column names
        $employeeNumbers = [];
        $columnNames = [];

        // Define table name based on training type
        $tableNames = [
            "QualityAnalysis" => "[dbo].[tbl_topic_LIST_qualityanalysis]",
            "WorkStandard" => "[dbo].[tbl_topic_LIST_workstandard]",
            "MgtGroupRegulation" => "[dbo].[tbl_topic_LIST_mgtgroupregulation]",
            "CommonTraining" => "[dbo].[tbl_topic_LIST_commontraining]",
            "ProdHashira" => "[dbo].[tbl_topic_LIST_hashira]",
            "TechnicalStandard" => "[dbo].[tbl_topic_LIST_technicalstandard]",
            "CommonBusinessSkills" => "[dbo].[tbl_topic_LIST_commonbusinesskill]",
            "CompanyFundamentals" => "[dbo].[tbl_topic_LIST_companyfundamentals]"
        ];

        $tableName = $tableNames[$trainingType] ?? '';

        // Fetch Employee_Number from the Excel file
        for ($row = 2; $row <= $highestRow; $row++) {
            $employeeNumber = $worksheet->getCellByColumnAndRow(0, $row)->getValue(); // Column 1 (index 0) for Employee_Number
            if (!empty($employeeNumber)) {
                $employeeNumbers[] = (string) $employeeNumber;
            }
        }

        // Fetch Full_Name, Section, and Email from tbl_ems using the employee numbers
        $fullNames = [];
        $emails = [];
        $sections = [];
        $positions = [];
        if (!empty($employeeNumbers)) {
            $placeholders = implode(',', array_fill(0, count($employeeNumbers), '?'));
            $query = "SELECT EmpNo, Full_Name, Section, Email, Position FROM tbl_ems WHERE EmpNo IN ($placeholders)";
            $stmt = sqlsrv_prepare($conn, $query, $employeeNumbers);
            if ($stmt && sqlsrv_execute($stmt)) {
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    $fullNames[$row['EmpNo']] = $row['Full_Name'];
                    $sections[$row['EmpNo']] = $row['Section']; // Fetch Section
                    $emails[$row['EmpNo']] = $row['Email'];
                    $positions[$row['EmpNo']] = $row['Position'];
                }
            }
            sqlsrv_free_stmt($stmt);
        }

        // Define the full list of column names
        $columnNames = [
            '[Employee_Number]', // From Excel
            '[Employee_Name]',   // From database
            '[Section]',         // From database
            '[Position]',         // From database
        ];

        // Fetch additional column names from the first row of the Excel file
        for ($col = 1; $col < $highestColumnIndex; $col++) { // Start from index 1
            $columnName = $worksheet->getCellByColumnAndRow($col, 1)->getValue();
            if (!empty($columnName)) {
                $columnNames[] = '[' . $columnName . ']'; // Wrap column names in brackets for SQL
            }
        }

        // Debug output for column names
        echo "Column Names: " . implode(', ', $columnNames) . "<br>";

        // Reset the row cursor to read the data for insertion
        for ($row = 2; $row <= $highestRow; $row++) {
            $rowData = [];
            
            // Read Employee_Number from the first column
            $employeeNumber = (string) $worksheet->getCellByColumnAndRow(0, $row)->getValue();
            echo "Row: $row - Employee_Number: $employeeNumber<br>"; // Debug output
        
            // Fetch Full Name, Section, and Email using the Employee_Number
            $fullName = $fullNames[$employeeNumber] ?? null;
            $section = $sections[$employeeNumber] ?? null; // Ensure you fetch Section too
            $email = $emails[$employeeNumber] ?? null;
            $position = $positions[$employeeNumber] ?? null;
        
            // Build the rowData array
            $rowData[] = $employeeNumber ?: 0; // Employee_Number
            $rowData[] = $fullName ?: 0;       // Employee_Name from DB
            $rowData[] = $section ?: 0;        // Section from DB
            $rowData[] = $position ?: 0;        // Section from DB
        
            // Loop through the remaining columns from the Excel file
            for ($col = 1; $col < $highestColumnIndex; $col++) { // Starts from the second column (index 1)
                $columnName = $worksheet->getCellByColumnAndRow($col, 1)->getValue(); // Get column name from the first row
                
                // Skip if the column name is empty or null
                if (empty($columnName)) {
                    continue; // Skip this iteration if the column name is empty
                }
        
                $cellValue = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                $rowData[] = !empty($cellValue) ? $cellValue : 0; // Use 0 if cell is empty
                // echo "Column: $columnName - Value: " . ($cellValue ?: '0') . "<br>";
            }

            
        
            // Add the email to the last column in rowData
            $rowData[] = $email ?: 0; // Email from DB
            // Ensure Email is included in columnNames
            if (!in_array('[Email]', $columnNames)) {
                $columnNames[] = '[Email]';
            }
        
            // Check if the Employee_Number already exists in the target table
            $checkQuery = "SELECT COUNT(*) as count FROM $tableName WHERE [Employee_Number] = ?";
            $checkStmt = sqlsrv_prepare($conn, $checkQuery, [$employeeNumber]);
        
            if ($checkStmt && sqlsrv_execute($checkStmt)) {
                $rowCount = sqlsrv_fetch_array($checkStmt, SQLSRV_FETCH_ASSOC)['count'];
        
                // If the employee number exists, skip this row
                if ($rowCount > 0) {
                    // echo "Employee_Number $employeeNumber already exists. Skipping this row.<br>";
                    continue; // Skip to the next row
                }
            } else {
                die(print_r(sqlsrv_errors(), true)); // Handle errors in the check query
            }
        
            // Prepare the SQL insert statement
            $placeholders = rtrim(str_repeat('?,', count($columnNames)), ',');
            $sql = "INSERT INTO $tableName (" . implode(', ', $columnNames) . ") VALUES ($placeholders)";
        
            // // Debug output for Row Data Content
            // echo "Row Data Content: " . implode(', ', $rowData) . "<br>";
        
            // Ensure the correct number of columns for insertion
            if (!empty($tableName) && count($rowData) === count($columnNames)) {
                // Debugging the SQL and data before execution
                // echo "SQL: $sql<br>";
                // echo "Row Data: " . implode(', ', $rowData) . "<br>";
        
                $stmt = sqlsrv_prepare($conn, $sql, $rowData);
                if (!$stmt || !sqlsrv_execute($stmt)) {
                    die(print_r(sqlsrv_errors(), true));
                }
            } else {
                // echo "Column count: " . count($columnNames) . " - Row data count: " . count($rowData) . "<br>";
                die("Mismatch between number of columns and values.");
            }
        }
        
        // Close the connection
        sqlsrv_close($conn);
        // Provide feedback after successful insertion
     echo "<script>alert('Data insertion completed.');</script>";
     echo "<script>window.location.href = 'skillmap_upload.php';</script>";
    } else {
        echo "Error: " . ($_FILES["file"]["error"] ?? "No file uploaded");
    }
}
?>
