<?php
include 'Connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $month = $_POST['month'];
    $data = json_decode($_POST['data'], true);

    foreach ($data as $item) {
        $category = $item['category'];
        $available_topic = $item['available_topic'];

        // Check if the topic already exists for the given month and category
        $checkQuery = "SELECT COUNT(*) as count FROM [dbo].[tbl_topicsetting] WHERE month = ? AND available_topic = ? AND category = ?";
        $checkParams = array($month, $available_topic, $category);
        $checkStmt = sqlsrv_query($conn, $checkQuery, $checkParams);
        $row = sqlsrv_fetch_array($checkStmt, SQLSRV_FETCH_ASSOC);

        if ($row['count'] == 0) {
            // If not exists, insert the new topic
            $query = "INSERT INTO [dbo].[tbl_topicsetting] (month, available_topic, category) VALUES (?, ?, ?)";
            $params = array($month, $available_topic, $category);
            $stmt = sqlsrv_query($conn, $query, $params);

            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }
    }

    echo "Data saved successfully!";
} else {
    echo "Invalid request.";
}
?>
