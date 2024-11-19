<?php
// Start output buffering to prevent any accidental output before headers
ob_start();

// Load PhpSpreadsheet autoload file
require 'vendor/autoload.php';

// Include PhpSpreadsheet classes
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Connect to the database (assuming connection settings are defined in $conn)
include 'Connection/connection.php';

// Get the selected title from the query parameter
$title = isset($_GET['title']) ? $_GET['title'] : '';

if (empty($title)) {
    die('No E-Learning title selected.');
}

// Get the current date without time, formatted as Y-m-d
$currentDate = date('Y-m-d');

// Set the filename as "SelectedTitle-CurrentDate.xlsx"
$filename = $title . '-' . $currentDate . '.xlsx';

// Set correct headers for XLSX file download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Fetch data from the database based on the selected title
$sql_excel = "SELECT EmployeeNumber, Target_Employee, Section 
              FROM [dbo].[tbl_elearningstatus] 
              WHERE [Title] = ? AND TotalNumber_Finished IS NULL";

$params = array($title);
$stmt = sqlsrv_query($conn, $sql_excel, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set the selected title as the first row (cell A1)
$sheet->setCellValue('A1', $title);

// Merge the title cell across the columns
$sheet->mergeCells('A1:C1'); // Adjust the range according to the number of columns

// Set the Excel sheet column headers in the second row (A2, B2, C2)
$sheet->setCellValue('A2', 'Employee Number');
$sheet->setCellValue('B2', 'Employee Name');
$sheet->setCellValue('C2', 'Section');

// Populate the data rows starting from row 3
$rowIndex = 3;
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $sheet->setCellValue('A' . $rowIndex, $row['EmployeeNumber']);
    $sheet->setCellValue('B' . $rowIndex, $row['Target_Employee']);
    $sheet->setCellValue('C' . $rowIndex, $row['Section']);
    $rowIndex++;
}

// Free the SQL statement resource
sqlsrv_free_stmt($stmt);

// Write the file to output
$writer = new Xlsx($spreadsheet);

// Clean (erase) the output buffer and turn off output buffering
ob_end_clean(); 

// Write the file directly to the output stream
$writer->save('php://output');

// Close the database connection
sqlsrv_close($conn);

// Ensure no more output is sent
exit;
?>
