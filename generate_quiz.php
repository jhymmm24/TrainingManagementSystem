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

        // Get data from Excel file
        $worksheet = $excelObj->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();

        // Initialize quiz data
        session_start();
        $_SESSION['questions'] = array();
        $_SESSION['answers'] = array();
        for ($row = 1; $row <= $highestRow; $row++) {
            $rowData = $worksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, false);
       
            $_SESSION['questions'][] = $rowData[0][0];
            $_SESSION['answers'][] = array_slice($rowData[0], 1);
        }


      

        // Display first question
        echo "<h2>Question 1</h2>";
        echo "<p>{$_SESSION['questions'][0]}</p>";
        echo "<form id='quizForm'><input type='hidden' name='questionIndex' value='0'>";
        foreach ($_SESSION['answers'][0] as $index => $answer) {
            echo "<label><input type='radio' name='answer' value='{$answer}'> {$answer}</label><br>";
        }
        echo "<input type='submit' value='Submit Answer'></form>";
    } else {
        echo 'Invalid file type. Please upload an Excel file.';
    }
} else {
    echo 'Error uploading file.';
}
?>
