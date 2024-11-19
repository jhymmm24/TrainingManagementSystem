<?php
include 'Connection/connection.php';
require 'PHPExcel/Classes/PHPExcel.php';

if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $title = $_POST['selectedtitle'];

    $currentDate = date('Y-m-d');

    $endDate = date('Y-m-30');

    // Calculate the date 7 days from the current date
    $currentDateENLIST = date('Y-m-d', strtotime('tomorrow')); // October 18, 2024

    // Initialize the counter for weekdays
    $weekdaysCount = 0;
    $endDateOfEnlistment = $currentDateENLIST;
    
    // Loop until we count 7 weekdays
    while ($weekdaysCount < 7) {
        // Get the day of the week (1 = Monday, 7 = Sunday)
        $dayOfWeek = date('N', strtotime($endDateOfEnlistment));
        
        // If it's a weekday (Monday to Friday), increment the count
        if ($dayOfWeek < 6) { // 1 to 5 are weekdays
            $weekdaysCount++;
        }
    
        // Increment the date by one day regardless of whether it's a weekday
        $endDateOfEnlistment = date('Y-m-d', strtotime($endDateOfEnlistment . ' +1 day'));
    }
    
    // The loop will stop when we've counted 7 weekdays
    // The last increment is unnecessary; we need to go back one day
    $finalEndDateOfEnlistment = date('Y-m-d', strtotime($endDateOfEnlistment . ' -1 day'));



    $startdate = $currentDate;
    $enddate = $endDate;


    $startenlist = $startdate;
    $endenlist = $finalEndDateOfEnlistment;

    
    // $startdate = $_POST['startdate'];
    // $enddate = $_POST['enddate'];
    // $startenlist = $_POST['startenlist'];
    // $endenlist = $_POST['endenlist'];


    

    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileExtension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));

    // Validate file type
    if ($fileExtension !== 'xlsx' && $fileExtension !== 'xls') {
        die('Invalid file type. Please upload an Excel file.');
    }

    // Load Excel file
    $excelReader = PHPExcel_IOFactory::createReaderForFile($fileTmpPath);
    $excelObj = $excelReader->load($fileTmpPath);

    // Get the first worksheet
    $sheet = $excelObj->getSheet(0);

    // Get highest row number
    $highestRow = $sheet->getHighestRow();

    // Prepare SQL statement
    $sql = "INSERT INTO [dbo].[tbl_question] (Title, Questions, ChoicesA, ChoicesB, ChoicesC, Answers, start_date, end_date, start_enlist, end_enlist) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Loop through each row of the worksheet
    for ($row = 2; $row <= $highestRow; $row++) { // Assuming first row is header
        // Get cell values
        $question = $sheet->getCellByColumnAndRow(0, $row)->getValue();
        $choiceA = $sheet->getCellByColumnAndRow(1, $row)->getValue();
        $choiceB = $sheet->getCellByColumnAndRow(2, $row)->getValue();
        $choiceC = $sheet->getCellByColumnAndRow(3, $row)->getValue();
        $answer = $sheet->getCellByColumnAndRow(4, $row)->getValue();

        // Format dates as strings
        $startdateStr = (string)$startdate;
        $enddateStr = (string)$enddate;
        $startenlistStr = (string)$startenlist;
        $endenlistStr = (string)$endenlist;

        // Print cell values for debugging
        echo "Row $row: Title = $title, Question = $question, ChoiceA = $choiceA, ChoiceB = $choiceB, ChoiceC = $choiceC, Answer = $answer, StartDate = $startdateStr, EndDate = $enddateStr, StartEnlist = $startenlistStr, EndEnlist = $endenlistStr<br>";

        // Check if row is not empty
        if (!empty($question) || !empty($choiceA) || !empty($choiceB) || !empty($choiceC) || !empty($answer)) {
            // Bind parameters
            $params = array($title, $question, $choiceA, $choiceB, $choiceC, $answer, $startdateStr, $enddateStr, $startenlistStr, $endenlistStr);

            // Directly execute the SQL statement
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
