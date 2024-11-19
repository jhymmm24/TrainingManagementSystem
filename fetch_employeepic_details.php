<?php 
include 'Connection/connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selectedItemId'])) {
    $selectedItemId = $_POST['selectedItemId'];

 
    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // SQL query to fetch employee details
    $sql = "SELECT Full_Name, ADID, Email,Category, Section FROM [dbo].[tbl_accounts] WHERE Full_Name = '$selectedItemId'";
    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $employeeDetails = [];
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $employeeDetails[] = $row;
    }

    // Close the connection
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

    echo json_encode($employeeDetails[0]); // Assuming only one employee is selected
}


?>