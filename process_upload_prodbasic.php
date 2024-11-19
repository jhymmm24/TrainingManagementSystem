
  

  <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>



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
            echo "  <table id='example23' class='display' style='width:100%; overflow-x: auto;  white-space: nowrap;   display: block;'>";
            echo " 
            <thead>
            <tr>
            <th scope='col'  style='text-align:left; border: 1px solid #ddd;'>No.</th>
            <th scope='col'  style='text-align:left; border: 1px solid #ddd;'>Employee Number</th>
            <th scope='col' style='text-align:left;border: 1px solid #ddd;'>Employee Name</th>
            <th scope='col'  style='text-align:left; border: 1px solid #ddd;'>Section</th>
          

            </tr>
            </thead>";

            echo "<tbody>"; // Start tbody

           
            // Initialize a flag to track whether it's the first row
            $firstRow = true;
            
            // Loop through each row of the worksheet
            foreach ($sheet->getRowIterator() as $row) {
                // If it's not the first row, proceed
                if (!$firstRow) {
                    $rowData = []; // Initialize an array to store row data
                    echo "<tr>";
            
                    // Loop through each cell of the row
                    foreach ($row->getCellIterator() as $cell) {
                        echo "<td style='text-align:left; border: 1px solid #ddd;'>" . $cell->getValue() . "</td>";
                    }
            
                    echo "</tr>";
                } else {
                    // If it's the first row, set the flag to false
                    $firstRow = false;
                }
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
                this.api()
                    .columns([1,2])
                    .every(function () {
                        let column = this;
        
                        // Create select element
                        let select = document.createElement('select');
                        select.add(new Option(''));
                        column.header().replaceChildren(select);
        
                        // Apply listener for user change in value
                        select.addEventListener('change', function () {
                            var val = DataTable.util.escapeRegex(select.value);
        
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
        
                        // Add list of options
                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d, j) {
                                select.add(new Option(d));
                            });
                    });
            },
            columnDefs: [
        { orderable: false, targets: [0,1,2] }
        ]
        });


  </script>


