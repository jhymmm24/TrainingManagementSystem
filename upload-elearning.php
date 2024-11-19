<?php
if (isset($_POST["submit"])) {
    // Check if file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $fileName = $_FILES["file"]["tmp_name"];

        // Load the PHPExcel library (assuming you've installed it via Composer)
        require 'vendor/autoload.php';

        // Load the Excel file
        $reader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($fileName);

        // Get the first worksheet
        $worksheet = $spreadsheet->getActiveSheet();

        // Output the table
        echo "<table border='1'>";
        foreach ($worksheet->getRowIterator() as $row) {
            echo "<tr>";
            foreach ($row->getCellIterator() as $cell) {
                echo "<td>" . $cell->getValue() . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";

        // Provide option to upload to database
        echo "<form action='upload_to_database.php' method='post'>";
        echo "<input type='submit' name='submit' value='Upload to Database'>";
        echo "</form>";
    } else {
        echo "Error: No file uploaded.";
    }
}
?>
