
  



<?php


require_once 'PHPExcel\Classes\PHPExcel\IOFactory.php';


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
            // Adjust the path accordingly
            $objPHPExcel = PHPExcel_IOFactory::load($targetFilePath);
            $sheet = $objPHPExcel->getActiveSheet();

            // Start table
            echo " <div class = 'table-responsive'> <table id='example23' class='display' style='width:100%; font-size: 12px;'>";
            echo " 
            <thead>
            <tr>
      
            <th scope='col'  style='text-align:left; border: 1px solid #ddd;'>Question</th>
            <th scope='col' style='text-align:left;border: 1px solid #ddd;'>Choices A</th>
            <th scope='col' style='text-align:left;border: 1px solid #ddd;'>Choices B</th>
            <th scope='col' style='text-align:left;border: 1px solid #ddd;'>Choices C</th>
            <th scope='col' style='text-align:left;border: 1px solid #ddd;'>Correct Answers</th>
           
            </tr>
            </thead>";

            echo "<tbody>"; // Start tbody

            // Loop through each row of the worksheet
            foreach ($sheet->getRowIterator() as $row) {
                $rowData = []; // Initialize an array to store row data
                foreach ($row->getCellIterator() as $cell) {
                    $rowData[] = $cell->getValue(); // Store each cell value in the row data array
                }
                echo "<tr>";
             

                // Loop through each cell of the row
                foreach ($row->getCellIterator() as $cell) {
                    echo "<td style='text-align:left; border: 1px solid #ddd;'>" . $cell->getValue() . "</td>";
                }

                echo "</tr>";
            }

            echo "</tbody>"; // End tbody

            // End table
            echo "</table></div>";

            // Delete uploaded file from server
            unlink($targetFilePath);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo 'Sorry, only Excel files are allowed to upload.';
    }
}





?>


  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>



<link rel="stylesheet" type="text/css" href="/jquery.datetimepicker.css">
<script src="/jquery.js"></script>
<script src="/build/jquery.datetimepicker.full.min.js"></script>

<script>
        new DataTable('#example23', {
            initComplete: function () {
              
            },
            columnDefs: [
        { orderable: false, targets: [0,1,2,3,4,5] }
        ]
        });



  </script>





