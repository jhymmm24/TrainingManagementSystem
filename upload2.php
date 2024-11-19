<?php
include 'Connection/connection.php';

require 'PHPExcel/Classes/PHPExcel.php';



if (isset($_POST['submit'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["excel_file"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is an Excel file
    if ($fileType != "xls" && $fileType != "xlsx") {
        echo "Sorry, only Excel files are allowed.";
        $uploadOk = 0;
    }

    // Check if file was uploaded successfully
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["excel_file"]["tmp_name"], $target_file)) {
            // Load the Excel file
            $objPHPExcel = PHPExcel_IOFactory::load($target_file);
            
            // Get the first worksheet
            $worksheet = $objPHPExcel->getActiveSheet();
            
            // Start table
            echo '<table border="1">';
            
            // Loop through each row
            foreach ($worksheet->getRowIterator() as $row) {
                echo '<tr>';
                // Loop through each cell in the row
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false); // This loops through all cells,
                foreach ($cellIterator as $cell) {
                    echo '<td>' . $cell->getValue() . '</td>';
                }
                echo '</tr>';
            }
            
            // End table
            echo '</table>';
            
            // Delete the uploaded file
            unlink($target_file);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
