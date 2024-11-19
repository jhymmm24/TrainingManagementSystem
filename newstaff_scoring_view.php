<?php
include 'Connection/connection.php';
// Include PhpSpreadsheet autoload
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

// Input parameters from the URL (GET request)
$requestnumber = isset($_GET['TrainingrequestID']) ? $_GET['TrainingrequestID'] : '';
$topic = isset($_GET['TrainingTopic']) ? $_GET['TrainingTopic'] : '';
$targetemployee = isset($_GET['TargetEmployee']) ? $_GET['TargetEmployee'] : '';

var_dump($requestnumber, $topic, $targetemployee);
// Validate the request number (to ensure it's not empty)
if (empty($requestnumber)) {
    die("Request number is required.");
}

// SQL query to fetch data from the database
$sql = "SELECT * FROM tbl_newstaff_records WHERE RequestNumber = ?";
$params = array($requestnumber);

// Execute the query
$stmt = sqlsrv_query($conn, $sql, $params);

// Check if the query was successful
if (!$stmt) {
    die(print_r(sqlsrv_errors(), true));
}

// Load the existing template file (template.xlsx)
$templateFile = '\\\\apbiphsh07\21_ProdDept\99_COMMON\Temporary\03_Training Management System\NewStaff-Template.xlsx';
$spreadsheet = IOFactory::load($templateFile);
$sheet = $spreadsheet->getActiveSheet();


$rowNum = 13;  // Start at row 13 for Training PIC and the corresponding data
// Start populating the template with data from the database
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {


    if (empty($targetEmployeeName)) {
        $targetEmployeeName = $row['Target_EmployeeName'];
    }



    // Assuming the template has placeholders like 'D4', 'D10', 'D11', etc.
    $sheet->setCellValue('D4', $row['RequestNumber']);
    $sheet->setCellValue('D10', $row['Target_EmployeeName']);  // Target Employee Name
    $sheet->setCellValue('D11', $row['Target_EmployeeNumber']); // Target Employee Number


    $sheet->setCellValue('F' . $rowNum, $row['TrainingPIC']);  // Training PIC in column F, row 13, 14, 15, etc.
    $sheet->setCellValue('G' . $rowNum, $row['ScheduledDate']);  // Training PIC in column F, row 13, 14, 15, etc.
    $sheet->setCellValue('H' . $rowNum, $row['ImplementedOn']);  // Training PIC in column F, row 13, 14, 15, etc.
    $sheet->setCellValue('I' . $rowNum, $row['Recorder']);  // Training PIC in column F, row 13, 14, 15, etc.

    $sheet->setCellValue('L' . $rowNum, $row['ExaminationScore']);  // Training PIC in column F, row 13, 14, 15, etc.
    $sheet->setCellValue('M' . $rowNum, $row['EvaluationResult']);  // Training PIC in column F, row 13, 14, 15, etc.


    $rowNum++;
}

// Close the connection
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

// Set response headers to prompt for file download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

// Modify filename to include RequestNumber and Target Employee Name
$filename = "New Staff Training - " . $requestnumber . " - " . $targetEmployeeName . ".xlsx";
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Flush any previous output (to avoid issues with Excel file generation)
ob_clean();
flush();

// Create an Xlsx writer and save the file to the output stream
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

// Terminate the script after sending the file
exit;
?>
