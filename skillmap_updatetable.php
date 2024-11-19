<?php
include 'Connection/connection.php';
require 'PHPExcel/Classes/PHPExcel.php';


//
// Check if action parameter exists and is set to 'update'
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    try {
     

        // Get the updated data from the POST request
        $updatedData = $_POST;

        // Example of how to process the updated data and perform database update
        foreach ($updatedData as $column => $value) {
            // Prepare SQL statement to update each column
            $sql = "UPDATE tbl_topic_LIST_qualityanalysis SET $column = ? WHERE id = ?"; // Assuming id is the primary key
            $params = array($value, $id); // $id should contain the unique identifier for the record being updated

            // Execute the SQL statement
            $stmt = sqlsrv_query($conn, $sql, $params);

            if ($stmt === false) {
                // Handle SQL query execution error
                throw new Exception("Error updating data: " . print_r(sqlsrv_errors(), true));
            }
        }

        // Send a success response
        http_response_code(200);
        echo "Data updated successfully!";
    } catch (Exception $e) {
        // Handle any errors
        http_response_code(500);
        echo "Error: " . $e->getMessage();
    }
} else {
    // If action parameter is missing or not set to 'update', send a bad request response
    http_response_code(400);
    echo "Bad request!";
}
?>





