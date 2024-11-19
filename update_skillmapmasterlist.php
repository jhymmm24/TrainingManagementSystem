

<?php

include 'Connection/connection.php';
// Assuming $conn is your SQL Server connection object

// Get JSON data sent from the client
$data = json_decode(file_get_contents("php://input"), true);

// Loop through the data and update the database
foreach ($data as $employeeNumber => $scores) {
    $trainingAttended = json_encode($scores); // Convert scores array to JSON string
    // Update the database with the new scores
    $updateQuery = "UPDATE [dbo].[tbl_masterlist] SET Training_Attendeed = ? WHERE Employee_Number = ?";
    $params = array($trainingAttended, $employeeNumber);
    $stmt = sqlsrv_query($conn, $updateQuery, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true)); // Handle SQL error
    }
}

// Send a response (if needed)
echo "Scores updated successfully!";
?>
