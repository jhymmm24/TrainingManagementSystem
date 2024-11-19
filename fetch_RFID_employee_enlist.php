<?php 
include 'Connection/connection.php';

if (isset($_POST['empno']) && isset($_POST['rfid'])) {
    $empno = $_POST['empno'];
    $rfid = $_POST['rfid'];

    if ($conn === false) {
        die(json_encode(['error' => 'Connection failed: ' . print_r(sqlsrv_errors(), true)]));
    }

    // $sql = "SELECT * FROM [dbo].[tbl_topic_LIST_hashira_MAINREQUEST] WHERE Employee_Number = ? AND [Type of Training] = 'E-LEARNING'";

 // Prepare your SQL statement with placeholders
// $sql = "
// SELECT Employee_Number, [Type of Training], Topic,Employee_Name
// FROM [dbo].[tbl_topic_LIST_hashira_MAINREQUEST] 
// WHERE Employee_Number = ? 
//   AND [Type of Training] = 'E-LEARNING'

// UNION ALL

// SELECT Employee_Number, [Type of Training], Topic,Employee_Name
// FROM [dbo].[tbl_topic_LIST_commonbusinesskill_MAINREQUEST] 
// WHERE Employee_Number = ? 
//   AND [Type of Training] = 'E-LEARNING'

// UNION ALL

// SELECT Employee_Number, [Type of Training], Topic,Employee_Name
// FROM [dbo].[tbl_topic_LIST_commontraining_MAINREQUEST] 
// WHERE Employee_Number = ? 
//   AND [Type of Training] = 'E-LEARNING'

// UNION ALL

// SELECT Employee_Number, [Type of Training], Topic,Employee_Name
// FROM [dbo].[tbl_topic_LIST_companyfundamentals_MAINREQUEST] 
// WHERE Employee_Number = ? 
//   AND [Type of Training] = 'E-LEARNING'

// UNION ALL

// SELECT Employee_Number, [Type of Training], Topic,Employee_Name
// FROM [dbo].[tbl_topic_LIST_mgtgroupregulation_MAINREQUEST] 
// WHERE Employee_Number = ? 
//   AND [Type of Training] = 'E-LEARNING'

// UNION ALL

// SELECT Employee_Number, [Type of Training], Topic,Employee_Name
// FROM [dbo].[tbl_topic_LIST_qualityanalysis_MAINREQUEST] 
// WHERE Employee_Number = ? 
//   AND [Type of Training] = 'E-LEARNING'

// UNION ALL

// SELECT Employee_Number, [Type of Training], Topic,Employee_Name
// FROM [dbo].[tbl_topic_LIST_technicalskill_MAINREQUEST] 
// WHERE Employee_Number = ? 
//   AND [Type of Training] = 'E-LEARNING'

// UNION ALL

// SELECT Employee_Number, [Type of Training], Topic ,Employee_Name
// FROM [dbo].[tbl_topic_LIST_technicalstandard_MAINREQUEST] 
// WHERE Employee_Number = ? 
//   AND [Type of Training] = 'E-LEARNING'

// UNION ALL

// SELECT Employee_Number, [Type of Training], Topic ,Employee_Name
// FROM [dbo].[tbl_topic_LIST_workstandard_MAINREQUEST] 
// WHERE Employee_Number = ? 
//   AND [Type of Training] = 'E-LEARNING';
// ";


// // Create an array with the same $empno for all placeholders
// $params = array_fill(0, 9, array($empno)); // Fill with 9 elements, each being the employee number

$params = array($empno);


$sql = "SELECT * FROM tbl_elearningstatus WHERE EmployeeNumber = ? AND Elearning_Status != 'PASSED'";


// Execute the query
$stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(json_encode(['error' => 'Query failed: ' . print_r(sqlsrv_errors(), true)]));
    }





    echo "<html><body>";
    echo "<style>
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th, td {
                border: 1px solid black;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
            .table-container {
            overflow-x: auto; 
            margin-top: 20px; 
        }
          </style>";

          $topics = [];
          $fullname = "";
          $elearningStatus = []; // Create an associative array for storing Elearning_Status
          
          while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
              $topic = htmlspecialchars($row['Title']);
              $fullname = htmlspecialchars($row['Target_Employee']);
              $status = htmlspecialchars($row['Elearning_Status']); // Fetch Elearning_Status
          
              if (!in_array($topic, $topics)) {
                  $topics[] = $topic;
              }
          
              // Store the Elearning_Status in the associative array
              $elearningStatus[$topic] = $status;
          }
          
          echo "<div class='table-container'>";
          echo "<table>";
          echo "<thead><tr><th>Employee_Name</th>";
          
          foreach ($topics as $topic) {
              echo "<th>" . htmlspecialchars($topic) . "</th>";
          }
          echo "</tr></thead>";
          
          echo "<tr><td>$fullname</td>";
          foreach ($topics as $topic) {
              // Set the value of the input field to the corresponding Elearning_Status
              $value = isset($elearningStatus[$topic]) ? $elearningStatus[$topic] : ''; // Retrieve the Elearning_Status value
          
              // Check if the status is "passed" and set the disabled attribute accordingly
              $disabled = ($value === 'PASSED') ? 'disabled' : '';
          
              echo "<td><input type='text' class='topic-field' name='" . htmlspecialchars($topic) . "' value='$value' $disabled></td>";
          }
          echo "</tr>";
          
          echo "</table>";
  

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
} else {
    echo json_encode(['error' => 'Employee number (empno) and RFID are required.']);
}
?>
