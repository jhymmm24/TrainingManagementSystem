
<?php

require_once 'PHPExcel\Classes\PHPExcel.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // File upload path
  $targetDir = "uploaded_elearning/";
  $fileName = basename($_FILES["file"]["name"]);
  $targetFilePath = $targetDir . $fileName;
  $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

  // Allow certain file formats
  $allowTypes = array('xls', 'xlsx');
  if (in_array($fileType, $allowTypes)) {
      // Upload file to server
      if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
          // Load Excel file
          $objPHPExcel = PHPExcel_IOFactory::load($targetFilePath);
          $sheet = $objPHPExcel->getActiveSheet();

          // Start building table content
          $table = "<table id='example23' class='display' style='width:100%; font-size: 12px;'>";
          $table .= "<thead>
                      <tr>
                          <th scope='col' style='text-align:left;'>Select</th>
                          <th scope='col' style='text-align:left;'>Question</th>
                          <th scope='col' style='text-align:left;'>Choices A</th>
                          <th scope='col' style='text-align:left;'>Choices B</th>
                          <th scope='col' style='text-align:left;'>Choices C</th>
                          <th scope='col' style='text-align:left;'>Correct Answers</th>
                      </tr>
                  </thead>";
          $table .= "<tbody>"; // Start tbody

          // Loop through each row of the worksheet
          foreach ($sheet->getRowIterator() as $row) {
              $rowData = []; // Initialize an array to store row data
              foreach ($row->getCellIterator() as $cell) {
                  $rowData[] = $cell->getValue(); // Store each cell value in the row data array
              }
              $table .= "<tr>";
              $table .= "<td style='width: 5px; text-align:left;'><input type='checkbox' style='width: 50px;' name='selected[]' class='form-check-input' id='selected' value='$rowData[0]'></td>";

              // Loop through each cell of the row
              foreach ($row->getCellIterator() as $cell) {
                  $table .= "<td style='text-align:left;'>" . $cell->getValue() . "</td>";
              }

              $table .= "</tr>";
          }

          $table .= "</tbody>"; // End tbody

          // End table
          $table .= "</table>";

          // Delete uploaded file from server
          unlink($targetFilePath);

          // Return table content as JSON response
          echo json_encode(array('table' => $table));
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
  } else {
      echo 'Sorry, only Excel files are allowed to upload.';
  }
}
    ?>
                