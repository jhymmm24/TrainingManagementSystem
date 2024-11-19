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
            $trainingName = $_POST["selectedComboType"];

      

            // Read data from Excel file and insert into database
            $objPHPExcel = PHPExcel_IOFactory::load($fileTmpName);
            $worksheet = $objPHPExcel->getActiveSheet();
            $highestRow = $worksheet->getHighestRow();

            // Determine the table based on the selected training name
            $tableName = '';
            switch ($trainingName) {
                case 'Prod. HASHIRA':
                    $tableName = '[dbo].[tbl_topic_hashira]';
                    break;
                case 'Common Training':
                    $tableName = '[dbo].[commontraining]';
                    break;
                // Add additional cases for other training names if needed
                default:
                    echo "Invalid training name.";
                    exit(); // Stop execution if training name is invalid
            }

                    // Insert data into the appropriate table
            for ($row = 2; $row <= $highestRow; $row++) {
                $data_topic = $worksheet->getCellByColumnAndRow(0, $row)->getValue(); // Assuming data is in the first column
                $data_topic_code = $worksheet->getCellByColumnAndRow(1, $row)->getValue(); // Assuming data is in the second column
                
                // Check if topic and topic code exist in the database
                $sql_check = "SELECT COUNT(*) AS topic_count FROM $tableName WHERE Topic = ? AND Topic_Code = ?";
                $params_check = array($data_topic, $data_topic_code);
                $stmt_check = sqlsrv_query($conn, $sql_check, $params_check);
                if ($stmt_check === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
                $row_check = sqlsrv_fetch_array($stmt_check, SQLSRV_FETCH_ASSOC);
                $topic_count = $row_check['topic_count'];
                
                if ($topic_count == 0) { // If topic and topic code do not exist, insert into the database
                    // Insert data into database
                    $sql_insert = "INSERT INTO $tableName (Topic, Topic_Code) VALUES (?, ?)";
                    $params_insert = array($data_topic, $data_topic_code);
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
