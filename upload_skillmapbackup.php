<?php

include 'Connection/connection.php';
require 'PHPExcel/Classes/PHPExcel.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded
    if (isset($_FILES["file"])) {
        // Check for errors in file upload
        if ($_FILES["file"]["error"] > 0) {
            echo "Error: " . $_FILES["file"]["error"];
        } else {
            // Get the uploaded file details
            $fileName = $_FILES["file"]["name"];
            $fileTmpName = $_FILES["file"]["tmp_name"];


             // Get the selected training name
             $trainingType = isset($_POST["trainingtype"]) ? $_POST["trainingtype"] : '';
            // Get the selected training name
            $section = isset($_POST["section"]) ? $_POST["section"] : '';

            // Read data from Excel file and insert into database
            $objPHPExcel = PHPExcel_IOFactory::load($fileTmpName);
            $worksheet = $objPHPExcel->getActiveSheet();

            // Get the highest row and column numbers
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

            // Get the column names dynamically
            $columnNames = [];
            for ($col = 0; $col < $highestColumnIndex; $col++) {
                $columnName = $worksheet->getCellByColumnAndRow($col, 1)->getValue(); // Assuming the column names are in the first row
                if (!empty($columnName)) {
                    $columnNames[] = '[' . $columnName . ']'; // Wrap column name in square brackets
                }
            }

            
            
            // Define table name based on training type
            $tableName = "";
            if ($trainingType == "QualityAnalysis") {
                $tableName = "[dbo].[tbl_topic_LIST_qualityanalysis]";
            } elseif ($trainingType == "WorkStandard") {
                $tableName = "[dbo].[tbl_topic_LIST_workstandard]";
            } elseif ($trainingType == "MgtGroupRegulation") {
                $tableName = "[dbo].[tbl_topic_LIST_mgtgroupregulation]";
            } elseif ($trainingType == "CommonTraining") {
                $tableName = "[dbo].[tbl_topic_LIST_commontraining]";
            } elseif ($trainingType == "ProdHashira") {
                $tableName = "[dbo].[tbl_topic_LIST_hashira]";
            } elseif ($trainingType == "TechinicalStandard") {
                $tableName = "[dbo].[tbl_topic_LIST_technicalstandard]";
            } elseif ($trainingType == "CommonBusinessSkills") {
                $tableName = "[dbo].[tbl_topic_LIST_commonbusinesskill]";
            }elseif ($trainingType == "CompanyFundamentals") {
                $tableName = "[dbo].[tbl_topic_LIST_companyfundamentals]";
            }
            

                                        // Check if a valid table name was determined
                          // Check if a valid table name was determined
if (!empty($tableName)) {
    // Flag to track successful insertion
    $dataInserted = false;

    // Insert data into the appropriate table
    // Your insertion logic here...

    // Skip the first row (header row) when iterating through the rows
    for ($row = 2; $row <= $highestRow; $row++) { // Start from 2 to skip the header row
        $rowData = [];
        // Loop through each column of the row
        for ($col = 0; $col < $highestColumnIndex; $col++) {
            // Get the value of the cell
            $cellValue = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
            // If cell value is empty, set it to 0
            $cellValue = empty($cellValue) ? 0 : $cellValue;
            // Add the cell value to the row data array
            $rowData[] = $cellValue;
        }
        // Now $rowData contains all the values for this row

        // Check if employee number and employee name exist in the database
        $employeeNumber = $rowData[0]; // Assuming employee number is in the first column
     

            // Convert the employee number to string if it needs to be treated as such
    if (is_numeric($employeeNumber)) {
        $employeeNumber = (string) $employeeNumber; // Convert to string if necessary
    }


        // Perform a query to check if the combination of employee number and employee name exists
        $query = "SELECT COUNT(*) AS count FROM $tableName WHERE [Employee_Number] = ?";
        $params = array($employeeNumber);
        $stmt = sqlsrv_query($conn, $query, $params);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $rowExists = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)['count'] > 0;
        sqlsrv_free_stmt($stmt);

        // If the row does not already exist, insert it into the database
        if (!$rowExists) {
            // Insert $rowData into your database
            if (!empty($columnNames)) {
                // Remove the ID column from the column names
                $filteredColumnNames = array_filter($columnNames, function ($colName) {
                    return $colName !== '[ID]'; // Change 'ID' to match your actual ID column name
                });

                $placeholders = rtrim(str_repeat('?,', count($filteredColumnNames)), ','); // Create placeholders for the prepared statement
                $sql = "INSERT INTO $tableName (" . implode(', ', $filteredColumnNames) . ") VALUES ($placeholders)";
                $stmt = sqlsrv_prepare($conn, $sql, $rowData);
                if (!$stmt) {
                    die(print_r(sqlsrv_errors(), true));
                }
                if (!sqlsrv_execute($stmt)) {
                    die(print_r(sqlsrv_errors(), true));
                } else {
                    // Set flag indicating successful insertion
                    $dataInserted = true;
                }
            }
        } else {
            // If row already exists, add it to conflicts array
            $rowConflicts[] = "Employee Number: $employeeNumber, Employee Name: $employeeName";
        }
    }

    // Check if any data was inserted successfully and display alert
    if ($dataInserted) {
    ?>
    
    <script>
    
    
    alert('Data inserted successfully');

    </script>
    
    <?php


    } else {

        ?>
        <script>
        alert('No new data inserted');
        </script>;

        <?php
    }

    // echo "<script>alert('Data insertion completed.');</script>";
    sqlsrv_close($conn); // Close the connection
} else {
    echo "Invalid training type selected.";
}

// Redirect after the process

?>
<script>window.location.href = 'skillmap_upload.php';</script>
<?php
                                    }
    }
}

?>
