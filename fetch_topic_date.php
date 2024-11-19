<?php
include 'Connection/connection.php'; // Adjust path as per your file structure

// Retrieve POST data
$topic = $_POST['topic'];

// Example query (replace with your actual database query)
$query = "SELECT start_date, end_date FROM [dbo].[tbl_question] WHERE Title = ? AND PDF IS NOT NULL";
$stmt = sqlsrv_prepare($conn, $query, array(&$topic));

if (!$stmt) {
    die(print_r(sqlsrv_errors(), true));
}

sqlsrv_execute($stmt);

$data = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $data[] = $row;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($data);
?>
