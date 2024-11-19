<?php 

include 'Connection/connection.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted form data
    $employeeNumber = $_POST["employee_number"];
    $topic = $_POST["topic"];

    // Perform any necessary validation/sanitization

    // Assume you have a database connection named $conn

    // Prepare the SQL query to update the training_attended column for the specified employee
    $sql = "UPDATE tbl_masterlist SET training_attended = ? WHERE Employee_Number = ?";
    
    // Prepare and execute the statement
    $stmt = sqlsrv_prepare($conn, $sql, array($topic, $employeeNumber));
    if (sqlsrv_execute($stmt)) {
        // Update successful
        echo json_encode(array("success" => true, "message" => "Training attended updated successfully."));
    } else {
        // Update failed
        echo json_encode(array("success" => false, "message" => "Error occurred while updating training attended."));
    }
} else {
    // If the request method is not POST, return an error
    echo json_encode(array("success" => false, "message" => "Invalid request method."));
}
?>


