<?php 

include 'Connection/connection.php';


// Check if the topic is passed via GET
if (isset($_GET['topic'])) {
    $topic = $_GET['topic'];

    // Query to fetch distinct start_enlist and end_enlist based on the selected topic
    $query = "
        SELECT DISTINCT start_enlist, end_enlist
        FROM tbl_question
        WHERE Title = ?
        ORDER BY start_enlist ASC
    ";
    
    // Prepare the SQL statement
    $params = array($topic);
    $stmt = sqlsrv_query($conn, $query, $params);

    // Check if the query was successful
    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => 'Error fetching start and end enlist dates.']);
        exit;
    }

    // Fetch the results
    $start_enlist_dates = [];
    $end_enlist_dates = [];
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $start_enlist_dates[] = $row['start_enlist'];
        $end_enlist_dates[] = $row['end_enlist'];
    }

    // Return the result as JSON
    echo json_encode(['success' => true, 'start_enlist_dates' => $start_enlist_dates, 'end_enlist_dates' => $end_enlist_dates]);
} else {
    echo json_encode(['success' => false, 'message' => 'Topic not provided.']);
}

?>