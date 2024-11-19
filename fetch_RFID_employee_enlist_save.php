<?php 
include 'Connection/connection.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start output buffering
ob_start();

header('Content-Type: application/json');

$response = [
    'status' => 'error',
    'message' => 'Failed to save data.',
];

$data = json_decode(file_get_contents('php://input'), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    $response['message'] = 'JSON decode error: ' . json_last_error_msg();
    echo json_encode($response);
    exit;
}

$tableNames = []; // Initialize the array
$titles = []; // Initialize an empty array to store field headers

if (isset($data['rows']) && is_array($data['rows'])) {
    $conn = sqlsrv_connect($server_name, $connection);
    if ($conn === false) {
        $response['message'] = 'Database connection failed: ' . print_r(sqlsrv_errors(), true);
        echo json_encode($response);
        exit;
    }

    sqlsrv_begin_transaction($conn);
    $employeeNumber = $data['empno'] ?? null;


      // Check if record exists in tbl_elearningstatus
      $checkQuery = "SELECT * FROM [dbo].[tbl_elearningstatus] WHERE EmployeeNumber = ?";
      $checkStmt = sqlsrv_query($conn, $checkQuery, [$employeeNumber]);
      
      if ($checkStmt === false) {
          sqlsrv_rollback($conn);
          $response['message'] = 'Check query failed: ' . print_r(sqlsrv_errors(), true);
          echo json_encode($response);
          exit;
      }
      


    $tableNames = [];
    while ($checkRow = sqlsrv_fetch_array($checkStmt, SQLSRV_FETCH_ASSOC)) {
        // Store each table_name in the array
        $tableNames[] = $checkRow['table_name'];
    }
    
    // Implode the array of table names
    $implodedTableNames = implode(", ", $tableNames); // This creates a string from the arra

    // Log the table names to the error log
error_log("Table Names: " . print_r($tableNames, true));


// Iterate through each table name
foreach ($tableNames as $tableName) {
  
    foreach ($data['rows'] as $rowIndex => $row) {
        foreach ($row as $fieldHeader => $status) { 
            // Check if the status is 'PASSED'
            if ($status === 'PASSED') {
                $titles[] = $fieldHeader; // Add the field header to the array
            }
        }
    }
    
    // Check if titles were found
    if (empty($titles)) {
        $response['message'] = 'No titles found with status PASSED.';
        echo json_encode($response);
        exit;
    }
    
  


    // Iterate through each title
    foreach ($titles as $title) {
        // Update Elearning_Status for each title
        $query = "UPDATE [dbo].[tbl_elearningstatus] SET Elearning_Status = ? WHERE EmployeeNumber = ? AND Title = ?";
        $stmt = sqlsrv_query($conn, $query, ['PASSED', $employeeNumber, $title]);
    
        if ($stmt === false) {
            sqlsrv_rollback($conn);
            $response['message'] = 'Update query failed: ' . print_r(sqlsrv_errors(), true);
            echo json_encode($response);
            exit;
        }
    
        // Fetch the skillmap data for each title
        foreach ($tableNames as $tableName) {
            // $table_skillmap = $tableName; // Default value
    
            // Determine the skill map table name
            switch ($tableName) {
                case 'tbl_topic_workstandard':
                    $table_skillmap = "tbl_topic_LIST_workstandard";
                    break;
                case 'tbl_topic_qualityanalysis':
                    $table_skillmap = "tbl_topic_LIST_qualityanalysis";
                    break;
                case 'tbl_topic_mgtgroupregulation':
                    $table_skillmap = "tbl_topic_LIST_mgtgroupregulation";
                    break;
                case 'tbl_topic_technicalstandard':
                    $table_skillmap = "tbl_topic_LIST_technicalstandard";
                    break;
                case 'tbl_topic_hashira':
                    $table_skillmap = "tbl_topic_LIST_hashira";
                    break;
                case 'tbl_topic_companyfundamentals':
                    $table_skillmap = "tbl_topic_LIST_companyfundamentals";
                    break;
                case 'tbl_topic_commontraining':
                    $table_skillmap = "tbl_topic_LIST_commontraining";
                    break;
                case 'tbl_topic_commonbusinessskills':
                    $table_skillmap = "tbl_topic_LIST_commonbusinessskills";
                    break;
            }
    
            try {
                // Use the current title in the query
                $find_skillmap = "SELECT * FROM $tableName WHERE Topic = ?";
                $stmt_findskillmap = sqlsrv_query($conn, $find_skillmap, [$title]);
            
                if ($stmt_findskillmap === false) {
                    throw new Exception('Skillmap query failed: ' . print_r(sqlsrv_errors(), true));
                }
            
                while ($skillmapRow = sqlsrv_fetch_array($stmt_findskillmap, SQLSRV_FETCH_ASSOC)) {
                    $topic = $skillmapRow['Topic'];
                    $topicCode = $skillmapRow['Topic Code'];
                    $topicColumnName = $skillmapRow['Topic_Column_Name'];
            
                    $update_skillmap = "UPDATE $table_skillmap SET $topicColumnName = ? WHERE [Employee_Number] = ?";
                    $paramsskillmap = ['999', $employeeNumber];
            
                    // Log the update attempt
                    error_log("Updating table: $table_skillmap with column: $topicColumnName for Employee Number: $employeeNumber");
            
                    $stmt_update = sqlsrv_query($conn, $update_skillmap, $paramsskillmap);
                    if ($stmt_update === false) {
                        throw new Exception('Skillmap update failed: ' . print_r(sqlsrv_errors(), true));
                    }
                }
            
                // Commit the transaction
                sqlsrv_commit($conn);
            
                // Success response
                $response = [
                    'status' => 'success',
                    'message' => 'Skillmap updated successfully.'
                ];
                echo json_encode($response);
            
            } catch (Exception $e) {
                // Rollback the transaction in case of error
                sqlsrv_rollback($conn);
            
                // Log the error
                error_log("Transaction failed: " . $e->getMessage());
            
                // Error response
                $response = [
                    'status' => 'error',
                    'message' => $e->getMessage(),
                    'tableName' => $tableName,
                    'title' => $title
                ];
                echo json_encode($response);
            }
            
        }
    }
}
// Optionally, you can print or log the results
echo "Imploded Table Names: " . $implodedTableNames . "<br>";
echo "Titles with PASSED status: " . implode(", ", $titles);
    

    // Commit the transaction
    sqlsrv_commit($conn);
    $response['status'] = 'success';
    $response['message'] = 'Data saved successfully.';
    $response['tableNames'] = $tableNames;
} else {
    $response['message'] = 'No data received.';
}

ob_end_clean(); 
echo json_encode($response);
sqlsrv_close($conn);
?>
