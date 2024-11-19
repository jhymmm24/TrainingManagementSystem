<?php
include 'Connection/connection.php';

// Retrieve selected common training from AJAX request
$selectedOption = $_POST['option']; // Assuming this comes from AJAX
$userfullname = $_GET['fullname'];
$userposition = $_GET['position'];

// Perform database query based on the selected option
if ($selectedOption === 'July 2024') {
    // Query to fetch available topics
    $sqlTopics = "SELECT available_topic FROM tbl_topicsetting WHERE month ='July 2024'";
    $stmtTopics = sqlsrv_query($conn, $sqlTopics);
    if ($stmtTopics === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch available topics
    $topics = [];
    while ($row = sqlsrv_fetch_array($stmtTopics, SQLSRV_FETCH_ASSOC)) {
        $topics[] = $row['available_topic'];
    }

    // Build the SQL query dynamically to pivot topics
    $sqlEmployees = "
        SELECT Employee_Number, Employee_Name, " . implode(", ", array_map(function($topic) {
            return "MAX(CASE WHEN Topic = '" . str_replace("'", "''", $topic) . "' THEN '" . str_replace("'", "''", $topic) . "' ELSE NULL END) AS [" . str_replace("'", "''", $topic) . "]";
        }, $topics)) . "
        FROM (
            SELECT Employee_Number, Employee_Name, Topic
            FROM [dbo].[tbl_topic_LIST_qualityanalysis_MAINREQUEST]
            UNION ALL
            SELECT Employee_Number, Employee_Name, Topic
            FROM [dbo].[tbl_topic_LIST_commontraining_MAINREQUEST]
        ) AS CombinedTopics
        GROUP BY Employee_Number, Employee_Name;
    ";
    $stmtEmployees = sqlsrv_query($conn, $sqlEmployees);
    if ($stmtEmployees === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Build the table rows
    $tbody = "<tbody>";
    while ($row = sqlsrv_fetch_array($stmtEmployees, SQLSRV_FETCH_ASSOC)) {
        $tbody .= "<tr>";
        $tbody .= "<td>" . htmlspecialchars($row['Employee_Number']) . "</td>";
        $tbody .= "<td>" . htmlspecialchars($row['Employee_Name']) . "</td>";

        // Display designated topics for each employee
        foreach ($topics as $topic) {
            $topicValue = isset($row[$topic]) && !empty($row[$topic]) ? "Target" : "N/A";


          
            $tbody .= "<td>" . $topicValue . "</td>";
        }

        $tbody .= "</tr>";
    }
    $tbody .= "</tbody>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Table Example</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>
<body>

<table id="example24" class="display" style="width:100%; overflow-x:auto; white-space:nowrap; display:block;">
    <thead>
        <tr>
            <th>Employee Number</th>
            <th>Employee Name</th>
            <?php
            foreach ($topics as $topic) {
                echo "<th>" . htmlspecialchars($topic) . "</th>";
            }
            ?>
        </tr>
    </thead>
    <?php echo $tbody; ?>
</table>

<script>
    $(document).ready(function() {
        $('#example24').DataTable({
            paging: true, // Enable pagination
            searching: true, // Enable search box
            ordering: true, // Enable sorting
            // Add more options as needed
        });
    });
</script>

</body>
</html>

<?php
} else if ($selectedOption === 'August 2024') {
    // Add code for August 2024 if needed
}
?>
