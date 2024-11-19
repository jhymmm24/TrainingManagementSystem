<?php
include 'Connection/connection.php';


// Get RFID from POST request
$rfid = isset($_POST['rfid2']) ? $_POST['rfid2'] : '';

$response = array('success' => false, 'data' => array());

if ($rfid) {
    $sql = "SELECT * FROM [dbo].[tbl_ems] WHERE RFID_AMS = ?";
    $params = array($rfid);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    if ($result) {
        $response['success'] = true;
        $response['data'] = array(
            'position' => $result['Position'],
            'empno' => $result['EmpNo'],
            'section' => $result['Section'],
            'fullname' => $result['Full_Name'],
            'department' => $result['Department']
        );
    }
}

sqlsrv_close($conn);

echo json_encode($response);
?>

