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

    $sqlInsert = "INSERT INTO [dbo].[tbl_question] (Title, Questions, ChoicesA, ChoicesB, ChoicesC, Answers, start_date, end_date, start_enlist, end_enlist) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $sqlUpdate = "UPDATE [dbo].[tbl_question] 
                  SET Questions = ?, ChoicesA = ?, ChoicesB = ?, ChoicesC = ?, Answers = ?, start_date = ?, end_date = ?, start_enlist = ?, end_enlist = ?
                  WHERE Title = ? AND Questions = ?";

    for ($row = 1; $row <= $highestRow; $row++) {
        $question = $sheet->getCellByColumnAndRow(0, $row)->getValue();
        $choiceA = $sheet->getCellByColumnAndRow(1, $row)->getValue();
        $choiceB = $sheet->getCellByColumnAndRow(2, $row)->getValue();
        $choiceC = $sheet->getCellByColumnAndRow(3, $row)->getValue();
        $answer = $sheet->getCellByColumnAndRow(4, $row)->getValue();

        // Convert TRUE/FALSE to strings
        $choiceA = ($choiceA === true) ? 'TRUE' : (($choiceA === false) ? 'FALSE' : $choiceA);
        $choiceB = ($choiceB === true) ? 'TRUE' : (($choiceB === false) ? 'FALSE' : $choiceB);
        $choiceC = ($choiceC === true) ? 'TRUE' : (($choiceC === false) ? 'FALSE' : $choiceC);
        $answer = ($answer === true) ? 'TRUE' : (($answer === false) ? 'FALSE' : $answer);

        $startdateStr = (string)$startdate;
        $enddateStr = (string)$enddate;
        $startenlistStr = (string)$startenlist;
        $endenlistStr = (string)$endenlist;

        if (!empty($question) || !empty($choiceA) || !empty($choiceB) || !empty($choiceC) || !empty($answer)) {
            // Check if the question with the given title already exists in the database
            $checkExistenceSql = "SELECT COUNT(*) FROM [dbo].[tbl_question] WHERE Title = ? AND Questions = ?";
            $params = array($title, $question);
            $checkExistenceStmt = sqlsrv_query($conn, $checkExistenceSql, $params);
            
            if (!$checkExistenceStmt) {
                echo "Error checking question existence: " . print_r(sqlsrv_errors(), true);
                exit;
            }

            $rowCount = sqlsrv_fetch_array($checkExistenceStmt, SQLSRV_FETCH_ASSOC)[''];

            if ($rowCount > 0) {
                // If the question exists, update it
                $updateParams = array($question, $choiceA, $choiceB, $choiceC, $answer, $startdateStr, $enddateStr, $startenlistStr, $endenlistStr, $title, $question);
                $updateResult = sqlsrv_query($conn, $sqlUpdate, $updateParams);
                if (!$updateResult) {
                    echo "Error updating data for row $row: " . print_r(sqlsrv_errors(), true);
                    exit;
                }
            } else {
                // If the question does not exist, insert it
                $insertParams = array($title, $question, $choiceA, $choiceB, $choiceC, $answer, $startdateStr, $enddateStr, $startenlistStr, $endenlistStr);
                $insertResult = sqlsrv_query($conn, $sqlInsert, $insertParams);
                if (!$insertResult) {
                    echo "Error inserting data for row $row: " . print_r(sqlsrv_errors(), true);
                    exit;
                }
            }
        }
    }

    include 'email/questionairenotif.php';
    ?>
    <script>
        alert('Successfully submitted or updated the questions.');
        window.location = "questionnaire.php";
    </script>
    <?php
} else {
    echo 'Error uploading file.';
}
?>
