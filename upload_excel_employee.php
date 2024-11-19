<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['excel_file'])) {
        $file = $_FILES['excel_file']['tmp_name'];

        // Check for errors during upload
        if ($_FILES['excel_file']['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(["error" => "File upload error: " . $_FILES['excel_file']['error']]);
            exit();
        }

        // Load the spreadsheet
        try {
            $objPHPExcel = PHPExcel_IOFactory::load($file);
        } catch (Exception $e) {
            echo json_encode(["error" => "Failed to load spreadsheet: " . $e->getMessage()]);
            exit();
        }

        $sheet = $objPHPExcel->getActiveSheet();
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();

        if ($lastRow > 1) { // Ensure there are rows beyond the header
            $results = [];
            for ($row = 2; $row <= $lastRow; $row++) {
                // Check if the row is visible
                if ($sheet->getRowDimension($row)->getVisible()) {
                    $rowRange = $sheet->rangeToArray("A{$row}:{$lastColumn}{$row}", null, true, true, true);
                    if (!empty($rowRange) && isset($rowRange[$row])) {
                        $data = $rowRange[$row];
                        $currentRowResult = [
                            'Employee Number' => $data['A'] ?? null,
                            'Employee Name' => $data['B'] ?? null,
                            'Section' => $data['C'] ?? null,
                            'Position' => $data['D'] ?? null,
                        ];
                        if (!empty($currentRowResult['Employee Number'])) {
                            $results[] = $currentRowResult; // Add to results if the Employee Number is not empty
                        }
                    }
                }
            }
            echo json_encode($results);
        } else {
            echo json_encode(["error" => "No data found beyond the header row."]);
        }
    } else {
        echo json_encode(["error" => "No file uploaded."]);
    }
} else {
    echo json_encode(["error" => "Invalid request method."]);
}
