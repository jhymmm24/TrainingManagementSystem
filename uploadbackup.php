<?php
include 'Connection/connection.php';
require 'PHPExcel/Classes/PHPExcel.php';

if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $title = $_POST['selectedtitle'];

    $currentDate = date('Y-m-d');
    $endDate = date('Y-m-30');
    $currentDateENLIST = date('Y-m-d', strtotime('tomorrow'));

    $weekdaysCount = 0;
    $endDateOfEnlistment = $currentDateENLIST;

    while ($weekdaysCount < 7) {
        $dayOfWeek = date('N', strtotime($endDateOfEnlistment));
        if ($dayOfWeek < 6) {
            $weekdaysCount++;
        }
        $endDateOfEnlistment = date('Y-m-d', strtotime($endDateOfEnlistment . ' +1 day'));
    }
    $finalEndDateOfEnlistment = date('Y-m-d', strtotime($endDateOfEnlistment . ' -1 day'));

    $startdate = $currentDate;
    $enddate = $endDate;
    $startenlist = $startdate;
    $endenlist = $finalEndDateOfEnlistment;

    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileExtension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));

    if ($fileExtension !== 'xlsx' && $fileExtension !== 'xls') {
        die('Invalid file type. Please upload an Excel file.');
    }

    $excelReader = PHPExcel_IOFactory::createReaderForFile($fileTmpPath);
    $excelObj = $excelReader->load($fileTmpPath);
    $sheet = $excelObj->getSheet(0);
    $highestRow = $sheet->getHighestRow();

    $sql = "INSERT INTO [dbo].[tbl_question] (Title, Questions, ChoicesA, ChoicesB, ChoicesC, Answers, start_date, end_date, start_enlist, end_enlist) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    for ($row = 2; $row <= $highestRow; $row++) {
        $question = $sheet->getCellByColumnAndRow(0, $row)->getValue();
        $choiceA = $sheet->getCellByColumnAndRow(1, $row)->getValue();
        $choiceB = $sheet->getCellByColumnAndRow(2, $row)->getValue();
        $choiceC = $sheet->getCellByColumnAndRow(3, $row)->getValue();
        $answer = $sheet->getCellByColumnAndRow(4, $row)->getValue();

        // Convert TRUE/FALSE to strings
        if ($choiceA === true) {
            $choiceA = 'TRUE';
        } elseif ($choiceA === false) {
            $choiceA = 'FALSE';
        }

        if ($choiceB === true) {
            $choiceB = 'TRUE';
        } elseif ($choiceB === false) {
            $choiceB = 'FALSE';
        }

        if ($choiceC === true) {
            $choiceC = 'TRUE';
        } elseif ($choiceC === false) {
            $choiceC = 'FALSE';
        }

        if ($answer === true) {
            $answer = 'TRUE';
        } elseif ($answer === false) {
            $answer = 'FALSE';
        }

        $startdateStr = (string)$startdate;
        $enddateStr = (string)$enddate;
        $startenlistStr = (string)$startenlist;
        $endenlistStr = (string)$endenlist;

        if (!empty($question) || !empty($choiceA) || !empty($choiceB) || !empty($choiceC) || !empty($answer)) {
            $params = array($title, $question, $choiceA, $choiceB, $choiceC, $answer, $startdateStr, $enddateStr, $startenlistStr, $endenlistStr);
            $result = sqlsrv_query($conn, $sql, $params);

            if (!$result) {
                echo "Error inserting data for row $row: " . print_r(sqlsrv_errors(), true);
                exit;
            }
        }
    }

    include 'email/questionairenotif.php';
    ?>
    <script>
        alert('Successfully submitted');
        window.location = "questionnaire.php";
    </script>
    <?php
} else {
    echo 'Error uploading file.';
}
?>
