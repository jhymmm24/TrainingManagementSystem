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
            $section = $_POST["section"];

      

            // Read data from Excel file and insert into database
            $objPHPExcel = PHPExcel_IOFactory::load($fileTmpName);
            $worksheet = $objPHPExcel->getActiveSheet();
            $highestRow = $worksheet->getHighestRow();

         
// Insert data into the appropriate table
for ($row = 2; $row <= $highestRow; $row++) {
    $data_emp_no = $worksheet->getCellByColumnAndRow(0, $row)->getValue(); // Assuming data is in the first column
    $data_emp_name= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
    $data_emp_position= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
    $data_emp_adid= $worksheet->getCellByColumnAndRow(3, $row)->getValue();
    $data_emp_section= $worksheet->getCellByColumnAndRow(4, $row)->getValue();  // Assuming data is in the second column
    
    // Skip row if Topic or Topic_Code is null or blank
    if ($data_emp_no === null || $data_emp_no === '' || $data_emp_name === null || $data_emp_name === '' || $data_emp_position === null || $data_emp_position === ''
    || $data_emp_adid === null || $data_emp_adid === '' || $data_emp_section === null || $data_emp_section === '') {
        continue;
    }

    // Check if topic and topic code exist in the database
    $sql_check = "SELECT COUNT(*) AS emp_count FROM [dbo].[tbl_masterlist] WHERE Employee_Number = ? AND Employee_Name= ?";
    $params_check = array($data_emp_no, $data_emp_name);
    $stmt_check = sqlsrv_query($conn, $sql_check, $params_check);
    if ($stmt_check === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row_check = sqlsrv_fetch_array($stmt_check, SQLSRV_FETCH_ASSOC);
    $emp_count = $row_check['emp_count'];
    
    if ($emp_count == 0) { // If topic and topic code do not exist, insert into the database
        // Insert data into database
        $sql_insert = "INSERT INTO [dbo].[tbl_masterlist] (Employee_Number, Employee_Name, Position, ADID, Section) VALUES (?,?,?,?,?)";
        $params_insert = array($data_emp_no, $data_emp_name,$data_emp_position,$data_emp_adid,$data_emp_section);
        $stmt_insert = sqlsrv_query($conn, $sql_insert, $params_insert);
        if ($stmt_insert === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    }
}
            // Close the connection
            sqlsrv_close($conn);

            echo '<script>alert("Data inserted successfully!");</script>';
        }
    } else {
        echo "No file uploaded.";
    }
}
?>
    <script>                 
 
   window.location="admin.php";
</script>
