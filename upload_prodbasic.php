<?php
include 'Connection/connection.php';

require 'PHPExcel/Classes/PHPExcel.php';


// Query to get the last request number
$sql_reqid = "SELECT MAX(PBS_Number) as lastReqID FROM [dbo].[tbl_prodbasic_list]";
$stmt_reqid = sqlsrv_query($conn, $sql_reqid);

if ($stmt_reqid === false) {
    die(print_r(sqlsrv_errors(), true)); // Handle error if query fails
}

// Fetch the last request number
if ($row4 = sqlsrv_fetch_array($stmt_reqid, SQLSRV_FETCH_ASSOC)) {
    $reqlastID = $row4['lastReqID'];

    // Extract numeric part
    if ($reqlastID) {
        $parts = explode('-', $reqlastID);
        $lastNumber = (int) end($parts);
    } else {
        $lastNumber = 0;
    }

    // Generate the new request number
    $nextNumber = $lastNumber + 1;
    $reqlastIDno = "PBS-2023-" . sprintf("%04d", $nextNumber);
}


if(isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $requestorname = $_POST['requestorname'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
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

     // Get highest row number and column letter
     $highestRow = $sheet->getHighestRow();

     
    
 
     // Loop through each row of the worksheet
     for ($row = 2; $row <= $highestRow; $row++) {
         // Get cell values
         $employeenumber = $sheet->getCellByColumnAndRow(1, $row)->getValue();
         $employeename = $sheet->getCellByColumnAndRow(2, $row)->getValue();
       
 
         // Insert into database
         $sql = "INSERT INTO [dbo].[tbl_prodbasic_list] (PBS_Number,Employee_Number,Employee_Name,Start_Date,End_Date,Requestor_Name) VALUES (?,?,?,?,?,?)";
         $params = array($reqlastIDno,$employeenumber, $employeename,$startdate, $enddate,$requestorname);
       
         $stmt = sqlsrv_query($conn, $sql, $params);


         
         // Insert into databasegreasing
         $sql_greasing = "INSERT INTO  [dbo].[tbl_prodbasic_greasing] (PBS_Number,Employee_Number,Employee_Name,Start_Date,End_Date,Requestor_Name) VALUES (?,?,?,?,?,?)";
         $params_greasing = array($reqlastIDno,$employeenumber, $employeename,$startdate, $enddate,$requestorname);
         $stmt_greasing = sqlsrv_query($conn, $sql_greasing, $params_greasing);


         
         // Insert into database all
         $sql_ALL= "INSERT INTO [dbo].[tbl_prodbasic_alllist]  (PBS_Number,Employee_Number,Employee_Name,Start_Date,End_Date,Requestor_Name) VALUES (?,?,?,?,?,?)";
         $params_all = array($reqlastIDno,$employeenumber, $employeename,$startdate, $enddate,$requestorname);
         $stmt_all = sqlsrv_query($conn, $sql_ALL, $params_all);
     }


    ?>
   
    <script>                 
    alert('Successfully submmitted');
   window.location="trainingresult-prodbasic.php";
</script>
    <?php
} else {
    echo 'Error uploading file.';
}
?>
