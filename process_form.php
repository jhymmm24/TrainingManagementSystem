<?php
// Include the PHPExcel library
require 'PHPExcel/Classes/PHPExcel.php';

// Check if file is uploaded
if(isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];

    // Validate file type
    $allowedExtensions = array("xlsx", "xls");
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (in_array($fileExtension, $allowedExtensions)) {
        // Load Excel file
        $excelReader = PHPExcel_IOFactory::createReaderForFile($fileTmpPath);
        $excelReader->setReadDataOnly(true);
        $excelObj = $excelReader->load($fileTmpPath);
        
        // Get data from first sheet (questions)
        $worksheet = $excelObj->getSheet(0);
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        $questions = array();
        for ($row = 1; $row <= $highestRow; $row++) {
            $rowData = $worksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, false);
            $questions[] = $rowData[0][0];
        }
        
        // Generate form with questions
        include 'question_form.php';
    } else {
        echo 'Invalid file type. Please upload an Excel file.';
    }
} else {
    echo 'Error uploading file.';
}
?>
