<?php 


session_start();


include '../Connection/connection.php';


?>


<?php

$Action = isset($_GET['action']) ? $_GET['action'] : '';


if ($Action == 'login')
    {   
        include 'overall.php';
     
        $employeeno = $_POST['biph_id'];
        $pass  = $_POST['password'];

        $usercategory = $_GET['usercategory'];
        
        

        
        $control = $_GET['control'];
        
// SQL query to check if the user exists and get the role/category
$sql = "SELECT * FROM tbl_accounts WHERE EmployeeNumber = '$employeeno' AND PASS = '$pass' ";
$params = array();
$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$stmt = sqlsrv_query($conn, $sql, $params, $options);
$row_count = sqlsrv_num_rows($stmt);

        if ($row_count >= 1) {
            // Fetch user data (assuming the role/category is in the 'UserCategory' field in your table)
            $row = sqlsrv_fetch_array($stmt);
            $usercategory = $row['Category']; // Replace with the actual field name for user category
            
            // Set session variables
            $_SESSION['TMSuser_id'] = $employeeno;
            $_SESSION['category'] = $usercategory; // Store user category (role) in session

            date_default_timezone_set('Asia/Manila'); // This sets the time zone to Manila, Philippines

            // Get the current time and set the target time
            // $current_time = new DateTime();
            // $target_time = new DateTime();
            // $target_time->setTime(8, 21); 
            
            // // Check if the current time is greater than or equal to 4:31 PM
            // if ($current_time >= $target_time) {
            //     // After 4:31 PM, update the redirect logic
            //     if ($control == 'login') {
            //         if ($usercategory == 'SUPERADMIN') {
            //             header('Location: ../index.php'); // SUPERADMIN has access to index.php
            //         } else {
            //             header('Location: ../index.php'); // Or redirect to index.php with a message for other roles
            //         }
            //     }
            // } else {
            //     // Before 4:31 PM, original logic applies
            //     if ($control == 'login') {
            //         // Check the role and redirect accordingly
            //         if ($usercategory == 'SUPERADMIN') {
            //             header('Location: ../index.php'); // SUPERADMIN has access to index.php
            //         } else {
            //             // Redirect to a page for other roles or show an error
            //             header('Location: ../restricted.php'); // Or redirect to a page with insufficient access message
            //         }
            //     } elseif ($control == 'exam') {
            //         header('Location: ../restricted.php'); // Or redirect to a page with insufficient access message
            //     }
            // }
            
            if ($control == 'login') {
                // Check the role and redirect accordingly
                if ($usercategory == 'SUPERADMIN') {
                    header('Location: ../index.php'); // SUPERADMIN has access to index.php
                } else {
                    header('Location: ../index.php'); // SUPERADMIN has access to index.php
                    // Redirect to a page for other roles or show an error
                //    header('Location: ../restricted.php'); // Or redirect to a page with insufficient access message
                }
            } elseif ($control == 'exam') {
                header('Location: ../exam.php');
                // header('Location: ../exam.php'); // Or redirect to a page with insufficient access message
               // header('Location: ../restricted.php'); // Or redirect to a page with insufficient access message
            }

   
    
            }
            else 
            {
               
                ?>
                
                <script>
                alert('ADID or Password is incorrect');
                window.location = "../login.php";
                </script>
                <?php
            
            }


    }

elseif ($Action == 'register'){

    $employeeno = $_POST['biph_id'];
    $adid  = $_POST['adid'];
    $password = $_POST['password'];
    $category = $_POST['category'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $section = $_POST['section'];
    $position = $_POST['position'];
    
    // Check if the employee number already exists in the table
    $sqlcheckuser = "SELECT * FROM tbl_accounts WHERE EmployeeNumber = ?";
    $params = array($employeeno);
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $results = sqlsrv_query($conn, $sqlcheckuser, $params, $options);
    $row_count = sqlsrv_num_rows($results);
    
    if ($row_count > 0) {
        // EmployeeNumber exists, show an alert and redirect back to create account page
        ?>
        <script>
            alert('User already exists');
            window.location = "../createaccount.php";
        </script>
        <?php
    } else {
        // EmployeeNumber does not exist, insert the new user
        $sqlcreateuser = "INSERT INTO tbl_accounts (EmployeeNumber, ADID, Pass, Category, Full_Name, Email, Section, Position) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $paramscreate = array($employeeno, $adid, $password, $category, $fullname, $email, $section, $position);
        $resultscreate = sqlsrv_query($conn, $sqlcreateuser, $paramscreate);
    
        if ($resultscreate) {
            include '../email/createAccount.php';
            ?>
            <script>
                alert('User successfully registered');
                window.location = "../login.php";
            </script>
            <?php
        } else {
            // Handle error in case the insert query fails
            ?>
            <script>
                alert('Error registering user. Please try again.');
                window.location = "../createaccount.php";
            </script>
            <?php
        }
    }
    

}
elseif($Action == 'reset'){

   

    $empno= $_POST['biph_id'];

    $sqlcheckuser2 = "SELECT * FROM tbl_accounts  WHERE EmployeeNumber='$empno'";

    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $results = sqlsrv_query($conn,$sqlcheckuser2,  $params, $options);
    $row_count= sqlsrv_num_rows($results);

    if($row_count > 1 ){
        
        ?>
            <script> 
            alert('cant be reset');
            </script>
        <?php

    }
    else {
       
        ?>
        <script> 
                window.location="../email/resetPassword.php?biph_id=<?php echo $empno?>";
         </script>
    <?php

        
    }


}
elseif($Action=='newpassword'){

    $empno= $_POST['biph_id'];

    $newpass= $_POST['newpassword'];



    $sqlupdatepass = "UPDATE tbl_accounts SET Pass ='$newpass' WHERE EmployeeNumber = '$empno'";
    $resultsupdate = sqlsrv_query($conn,$sqlupdatepass);

    
    ?>
           
    <script>
        alert('Password successfully reset');
        window.location="../login.php";
    </script>

    
<?php


}
elseif($Action == 'commontraining'){

    
    
    $topic = $_POST['topic'];
    $typetraining = $_POST['typeoftraining'];
    $classification ='CommonTraining';

    
    $startEnlist = isset($_POST['start_enlist_hidden']) ? $_POST['start_enlist_hidden'] : '';
    $endEnlist = isset($_POST['end_enlist_hidden']) ? $_POST['end_enlist_hidden'] : '';

    // Debug: Check if these values are being passed
    echo "Start Enlist: " . $startEnlist . "<br>";
    echo "End Enlist: " . $endEnlist . "<br>";


    $starttime = isset($_POST['starttime']) && !empty($_POST['starttime']) ? $_POST['starttime'] :'N/A';
    $enddate = isset($_POST['enddate']) && !empty($_POST['enddate']) ? $_POST['enddate'] : 'N/A';
    $startdate = isset($_POST['startdate']) && !empty($_POST['startdate']) ? $_POST['startdate'] : 'N/A';
    $endtime = isset($_POST['endtime']) && !empty($_POST['endtime']) ? $_POST['endtime'] : 'N/A';
    $meetingroom = isset($_POST['meetingroom']) && !empty($_POST['meetingroom']) ? $_POST['meetingroom'] : 'N/A';
  
    


    $requestorname = $_GET['requestorname'];

    $tablename= "tbl_topic_LIST_commontraining_MAINREQUEST";


    
    $table_skillmap = "tbl_topic_commontraining";


    $datetoday=  date("Y-m-d");

    $selectedEmployeesString = $_POST['selectedEmployeesInput']; // Retrieve selected employee numbers
    $selectedEmployees = explode(',', $selectedEmployeesString); // Convert comma-separated string to array



    

    
// Query to get the last request number
$sql_reqid = "SELECT MAX(RequestNumber) as lastReqID FROM [dbo].[tbl_topic_LIST_commontraining_MAINREQUEST]";
$stmt_reqid = sqlsrv_query($conn, $sql_reqid);

// Fetch the last request number
if ($row4 = sqlsrv_fetch_array($stmt_reqid, SQLSRV_FETCH_ASSOC)) {
    $reqlastID = $row4['lastReqID'];

    // Extract numeric part
    if ($reqlastID) {
        $parts = explode('-', $reqlastID);
        $lastNumber = (int) end($parts);
    } else {
        $lastNumber = 0;
    }

    // Generate the new request number
    $nextNumber = $lastNumber + 1;
    // Get the current date and time without separators
    $currentDateTime = date("Ymd_His");
   
    // Create the request ID with the current date and time
    $reqlastIDno = "TrainingRequest-CommonTraining-" . $currentDateTime . "-" . $nextNumber;
}

// Query to get the last transaction number
$sql3 = "SELECT MAX(ID) as lastID FROM tbl_trainingrequest";
$stmt3 = sqlsrv_query($conn, $sql3);
if ($row3 = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
    $lastID = $row3['lastID'];
    if ($lastID == null || $lastID == "") {
        $lastID = 0; // set to 0 if no previous records
    }
    $nextTransactionNumber = $lastID + 1;
    $transactionNumber = "REQUEST-MS2023-" . sprintf("%04d", $nextTransactionNumber);
}

foreach ($selectedEmployees as $selectedValue) {
    echo "Employee Number: $selectedValue\n";

    // Check if the combination of employee number and topic already exists
    $validationQuery = "SELECT COUNT(*) AS count FROM $tablename WHERE Employee_Number = ? AND Topic = ?";
    $validationStmt = sqlsrv_prepare($conn, $validationQuery, array(&$selectedValue, &$topic));

    if (!$validationStmt) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($validationStmt)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the validation query
    if ($row = sqlsrv_fetch_array($validationStmt, SQLSRV_FETCH_ASSOC)) {
        $count = $row['count'];

        // Debugging: Print out count to see if it's correct
        echo "Count: $count\n";

        if ($count > 0) {
            // Combination of employee number and topic already exists, skip insertion
            echo "Combination of Employee Number $selectedValue and Topic $topic already exists. Skipping...\n";
            continue; // Skip to next selected employee
        }
    }

    // If no matching combination exists, proceed with data retrieval and insertion

    // Query to retrieve email and date hired
    $selectEmailDatehired = "SELECT Email, Date_Hired FROM [dbo].[View_MasterList] WHERE EmpNo = ?";
    $selectStmtEmailDatehired = sqlsrv_prepare($conn, $selectEmailDatehired, array(&$selectedValue));

    if (!$selectStmtEmailDatehired) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($selectStmtEmailDatehired)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the SELECT query
    if ($row = sqlsrv_fetch_array($selectStmtEmailDatehired, SQLSRV_FETCH_ASSOC)) {
        // Retrieve additional information
        $email = $row['Email'];
        $datehired = $row['Date_Hired'];
    }

    // Query to retrieve additional information for the selected employee
    $selectQuery = "SELECT * FROM [dbo].[tbl_topic_LIST_commontraining] WHERE Employee_Number = ?";
    $selectStmt = sqlsrv_prepare($conn, $selectQuery, array(&$selectedValue));

    if (!$selectStmt) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($selectStmt)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the SELECT query
    if ($row = sqlsrv_fetch_array($selectStmt, SQLSRV_FETCH_ASSOC)) {
        // Retrieve additional information
        $employeename = $row['Employee_Name'];
        $employeenumber = $row['Employee_Number'];
        $section = $row['Section'];
        $position = $row['Position'];

        // Display additional information (optional)
        echo "Employee Name: $employeename, Department: $position\n";

        // Insert the selected employee number along with additional information into the database
        $insertQuery = "INSERT INTO $tablename (RequestNumber, Employee_Number, Employee_Name, Section, Position, Email, [Date Hired], Topic, [Type of Training], [Start Date], [End Date], [Start Time], [End Time], [Meeting Room], [Date_Requested], [Requestor_Name]) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = sqlsrv_prepare($conn, $insertQuery, array(
            &$reqlastIDno, &$employeenumber, &$employeename, &$section, &$position, &$email, &$datehired, &$topic, &$typetraining,
            &$startEnlist, &$endEnlist, &$starttime, &$endtime, &$meetingroom, &$datetoday, &$requestorname
        ));

        if (!$insertStmt) {
            // Handle SQL error
            die(print_r(sqlsrv_errors(), true));
        }

        // Execute the prepared statement
        if (!sqlsrv_execute($insertStmt)) {
            // Handle execution error
            die(print_r(sqlsrv_errors(), true));
        }

        // Display success message or perform any other action as needed
        echo "Employee Number $selectedValue inserted successfully!\n";
    } else {
        // Handle case where employee data could not be found
        echo "No data found for Employee Number: $selectedValue\n";
    }

    // Increment transaction number for next iteration
    $nextTransactionNumber++;
    $transactionNumber = "REQUEST-MS2023-" . sprintf("%04d", $nextTransactionNumber);

         

      


    }




            ?>
            <script>  
    alert("Submit Successfully!");               
       window.location="../commontraining.php";
            </script>
            <?php 




}


elseif($Action == 'qualityanalysis'){

    
    

    $topic = $_POST['topic'];
    $typetraining = $_POST['typeoftraining'];
    $classification = 'QualityAnalysis';


    $startEnlist = isset($_POST['start_enlist_hidden']) ? $_POST['start_enlist_hidden'] : '';
    $endEnlist = isset($_POST['end_enlist_hidden']) ? $_POST['end_enlist_hidden'] : '';

    // Debug: Check if these values are being passed
    echo "Start Enlist: " . $startEnlist . "<br>";
    echo "End Enlist: " . $endEnlist . "<br>";

    $starttime = isset($_POST['starttime']) && !empty($_POST['starttime']) ? $_POST['starttime'] :'N/A';
    $endtime = isset($_POST['endtime']) && !empty($_POST['endtime']) ? $_POST['endtime'] : 'N/A';
    $startdate = isset($_POST['startdate']) && !empty($_POST['startdate']) ? $_POST['startdate'] : 'N/A';
    $enddate = isset($_POST['enddate']) && !empty($_POST['enddate']) ? $_POST['enddate'] : 'N/A';

    
    $meetingroom = isset($_POST['meetingroom']) && !empty($_POST['meetingroom']) ? $_POST['meetingroom'] : 'N/A';

    


    $requestorname = $_GET['requestorname'];

    $tablename= "tbl_topic_LIST_qualityanalysis_MAINREQUEST";

        $table_skillmap ="tbl_topic_qualityanalysis";
    

    $datetoday=  date("Y-m-d");

    $selectedEmployeesString = $_POST['selectedEmployeesInput']; // Retrieve selected employee numbers
    $selectedEmployees = explode(',', $selectedEmployeesString); // Convert comma-separated string to array



    
// Query to get the last request number
$sql_reqid = "SELECT MAX(RequestNumber) as lastReqID FROM [dbo].[tbl_topic_LIST_qualityanalysis_MAINREQUEST]";
$stmt_reqid = sqlsrv_query($conn, $sql_reqid);

// Fetch the last request number
if ($row4 = sqlsrv_fetch_array($stmt_reqid, SQLSRV_FETCH_ASSOC)) {
    $reqlastID = $row4['lastReqID'];

    // Extract numeric part
    if ($reqlastID) {
        $parts = explode('-', $reqlastID);
        $lastNumber = (int) end($parts);
    } else {
        $lastNumber = 0;
    }

    // Generate the new request number
    $nextNumber = $lastNumber + 1;
    // Get the current date and time without separators
    $currentDateTime = date("Ymd_His");

    // Create the request ID with the current date and time
    $reqlastIDno = "TrainingRequest-QualityAnalysis-" . $currentDateTime . "-" . $nextNumber;
}

// Query to get the last transaction number
$sql3 = "SELECT MAX(ID) as lastID FROM tbl_trainingrequest";
$stmt3 = sqlsrv_query($conn, $sql3);
if ($row3 = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
    $lastID = $row3['lastID'];
    if ($lastID == null || $lastID == "") {
        $lastID = 0; // set to 0 if no previous records
    }
    $nextTransactionNumber = $lastID + 1;
    $transactionNumber = "REQUEST-MS2023-" . sprintf("%04d", $nextTransactionNumber);
}

foreach ($selectedEmployees as $selectedValue) {
    echo "Employee Number: $selectedValue\n";

    // Check if the combination of employee number and topic already exists
    $validationQuery = "SELECT COUNT(*) AS count FROM $tablename WHERE Employee_Number = ? AND Topic = ?";
    $validationStmt = sqlsrv_prepare($conn, $validationQuery, array(&$selectedValue, &$topic));

    if (!$validationStmt) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($validationStmt)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the validation query
    if ($row = sqlsrv_fetch_array($validationStmt, SQLSRV_FETCH_ASSOC)) {
        $count = $row['count'];

        // Debugging: Print out count to see if it's correct
        echo "Count: $count\n";

        if ($count > 0) {
            // Combination of employee number and topic already exists, skip insertion
            echo "Combination of Employee Number $selectedValue and Topic $topic already exists. Skipping...\n";
            continue; // Skip to next selected employee
        }
    }

    // If no matching combination exists, proceed with data retrieval and insertion

    // Query to retrieve email and date hired
    $selectEmailDatehired = "SELECT Email, Date_Hired FROM [dbo].[View_MasterList] WHERE EmpNo = ?";
    $selectStmtEmailDatehired = sqlsrv_prepare($conn, $selectEmailDatehired, array(&$selectedValue));

    if (!$selectStmtEmailDatehired) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($selectStmtEmailDatehired)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the SELECT query
    if ($row = sqlsrv_fetch_array($selectStmtEmailDatehired, SQLSRV_FETCH_ASSOC)) {
        // Retrieve additional information
        $email = $row['Email'];
        $datehired = $row['Date_Hired'];
    }

    // Query to retrieve additional information for the selected employee
    $selectQuery = "SELECT * FROM [dbo].[tbl_topic_LIST_qualityanalysis] WHERE Employee_Number = ?";
    $selectStmt = sqlsrv_prepare($conn, $selectQuery, array(&$selectedValue));

    if (!$selectStmt) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($selectStmt)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the SELECT query
    if ($row = sqlsrv_fetch_array($selectStmt, SQLSRV_FETCH_ASSOC)) {
        // Retrieve additional information
        $employeename = $row['Employee_Name'];
        $employeenumber = $row['Employee_Number'];
        $section = $row['Section'];
        $position = $row['Position'];

        // Display additional information (optional)
        echo "Employee Name: $employeename, Department: $position\n";

        // Insert the selected employee number along with additional information into the database
        $insertQuery = "INSERT INTO $tablename (RequestNumber, Employee_Number, Employee_Name, Section, Position, Email, [Date Hired], Topic, [Type of Training], [Start Date], [End Date], [Start Time], [End Time], [Meeting Room], [Date_Requested], [Requestor_Name]) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = sqlsrv_prepare($conn, $insertQuery, array(
            &$reqlastIDno, &$employeenumber, &$employeename, &$section, &$position, &$email, &$datehired, &$topic, &$typetraining,
            &$startEnlist, &$endEnlist, &$starttime, &$endtime, &$meetingroom, &$datetoday, &$requestorname
        ));

        if (!$insertStmt) {
            // Handle SQL error
            die(print_r(sqlsrv_errors(), true));
        }

        // Execute the prepared statement
        if (!sqlsrv_execute($insertStmt)) {
            // Handle execution error
            die(print_r(sqlsrv_errors(), true));
        }

        // Display success message or perform any other action as needed
        echo "Employee Number $selectedValue inserted successfully!\n";
    } else {
        // Handle case where employee data could not be found
        echo "No data found for Employee Number: $selectedValue\n";
    }

    // Increment transaction number for next iteration
    $nextTransactionNumber++;
    $transactionNumber = "REQUEST-MS2023-" . sprintf("%04d", $nextTransactionNumber);

         

      

    }

        if($typetraining === 'E-LEARNING'){

            echo $typetraining;


                        
       
// Retrieve selected employee numbers and convert to an array
$selectedEmployeesString = $_POST['selectedEmployeesInput']; 
$selectedEmployees = explode(',', $selectedEmployeesString); // Convert comma-separated string to array

// Get the topic from the POST request
$topic = $_POST['topic']; 

// Query to get the last request number
$sql_reqid = "SELECT MAX(ElearningTransID) as lastReqID FROM [dbo].[tbl_elearningstatus]";
$stmt_reqid = sqlsrv_query($conn, $sql_reqid);

// Fetch the last request number
if ($row4 = sqlsrv_fetch_array($stmt_reqid, SQLSRV_FETCH_ASSOC)) {
    $reqlastID = $row4['lastReqID'];

    // Extract numeric part of the last request ID
    if ($reqlastID) {
        $parts = explode('-', $reqlastID);
        $lastNumber = (int) end($parts); // Get the last numeric part of the ID
    } else {
        $lastNumber = 0; // If no last request exists, start from 1
    }

    // Generate the new request number
    $nextNumber = $lastNumber + 1;
    // Get the current date and time without separators
    $currentDateTime = date("Ymd_His");

    // Create the new request ID
    $elearningUNIQUE = "ElearningReq-" . $currentDateTime . "-" . $nextNumber;
}

// Loop through each selected employee
foreach ($selectedEmployees as $selectedEmployee) {
    // Get employee details from tbl_ems
    $sql_Getems = "SELECT * FROM [dbo].[tbl_ems] WHERE [EmpNo] = '$selectedEmployee'";
    $result = sqlsrv_query($conn, $sql_Getems);

    if ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $empno = $row['EmpNo'];
        $fullname = $row['Full_Name'];
        $section = $row['Section'];
        $email = $row['Email'];
    } else {
        // Skip if employee data is not found
        echo "Employee with EmpNo $selectedEmployee not found.<br>";
        continue;
    }

    // Check if the employee with the same Topic already exists in tbl_elearningstatus
    $sql_check_existing = "SELECT * FROM [dbo].[tbl_elearningstatus] 
                           WHERE Target_Employee = '$fullname' 
                           AND Title = '$topic'";
    $check_result = sqlsrv_query($conn, $sql_check_existing);
    
    // Check if any rows are returned
    if ($row_check = sqlsrv_fetch_array($check_result, SQLSRV_FETCH_ASSOC)) {
        // If the employee with the same topic exists, skip this insertion
        echo "Skipping: $fullname is already enlisted for the topic $topic.<br>";
        continue; // Skip to the next employee in the array
    }

    // Insert the new record into tbl_elearningstatus
    $sql_insert = "INSERT INTO [dbo].[tbl_elearningstatus] 
                   (RequestNumber, ElearningTransID, Title, EmployeeNumber, Target_Employee, Section, Target_Date, End_Date, Elearning_Status, TotalNumber_Target, Email, Classification, table_name)
                   VALUES ('$reqlastIDno', '$elearningUNIQUE', '$topic', '$empno', '$fullname', '$section', '$startEnlist', '$endEnlist', 'NOT YET', '1', '$email', '$classification', '$table_skillmap')";

    $resultscreate = sqlsrv_query($conn, $sql_insert);

    if (!$resultscreate) {
        echo "Error inserting record for $fullname.<br>";
    } else {
        echo "Successfully inserted record for $fullname.<br>";
    }

}

                    include '../email/ElearningEnlistment.php';



        }




            ?>
            <script>  
    //    alert("Submit Successfully!");               
    //  window.location="../qualityanalysis.php";
            </script>
            <?php 


}


elseif($Action == 'mgtgroupregulation'){

    
    
    $topic = $_POST['topic'];
    $typetraining = $_POST['typeoftraining'];
    $classification = 'MgtGroupRegulation';


    $startEnlist = isset($_POST['start_enlist_hidden']) ? $_POST['start_enlist_hidden'] : '';
    $endEnlist = isset($_POST['end_enlist_hidden']) ? $_POST['end_enlist_hidden'] : '';

    // Debug: Check if these values are being passed
    echo "Start Enlist: " . $startEnlist . "<br>";
    echo "End Enlist: " . $endEnlist . "<br>";

    $starttime = isset($_POST['starttime']) && !empty($_POST['starttime']) ? $_POST['starttime'] :'N/A';
    $endtime = isset($_POST['endtime']) && !empty($_POST['endtime']) ? $_POST['endtime'] : 'N/A';
    $startdate = isset($_POST['startdate']) && !empty($_POST['startdate']) ? $_POST['startdate'] : 'N/A';
    $enddate = isset($_POST['enddate']) && !empty($_POST['enddate']) ? $_POST['enddate'] : 'N/A';
    $meetingroom = isset($_POST['meetingroom']) && !empty($_POST['meetingroom']) ? $_POST['meetingroom'] : 'N/A';

    


    $requestorname = $_GET['requestorname'];

    $tablename= "tbl_topic_LIST_mgtgroupregulation_MAINREQUEST";

    $table_skillmap= "tbl_topic_mgtgroupregulation";

    $datetoday=  date("Y-m-d");

    $selectedEmployeesString = $_POST['selectedEmployeesInput']; // Retrieve selected employee numbers
    $selectedEmployees = explode(',', $selectedEmployeesString); // Convert comma-separated string to array



    
// Query to get the last request number
$sql_reqid = "SELECT MAX(RequestNumber) as lastReqID FROM [dbo].[tbl_topic_LIST_mgtgroupregulation_MAINREQUEST]";
$stmt_reqid = sqlsrv_query($conn, $sql_reqid);

// Fetch the last request number
if ($row4 = sqlsrv_fetch_array($stmt_reqid, SQLSRV_FETCH_ASSOC)) {
    $reqlastID = $row4['lastReqID'];

    // Extract numeric part
    if ($reqlastID) {
        $parts = explode('-', $reqlastID);
        $lastNumber = (int) end($parts);
    } else {
        $lastNumber = 0;
    }

    // Generate the new request number
    $nextNumber = $lastNumber + 1;
    // Get the current date and time without separators
    $currentDateTime = date("Ymd_His");
   
    // Create the request ID with the current date and time
    $reqlastIDno = "TrainingRequest-MgtGroupRegulation-" . $currentDateTime . "-" . $nextNumber;
}

// Query to get the last transaction number
$sql3 = "SELECT MAX(ID) as lastID FROM tbl_trainingrequest";
$stmt3 = sqlsrv_query($conn, $sql3);
if ($row3 = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
    $lastID = $row3['lastID'];
    if ($lastID == null || $lastID == "") {
        $lastID = 0; // set to 0 if no previous records
    }
    $nextTransactionNumber = $lastID + 1;
    $transactionNumber = "REQUEST-MS2023-" . sprintf("%04d", $nextTransactionNumber);
}

foreach ($selectedEmployees as $selectedValue) {
    echo "Employee Number: $selectedValue\n";

    // Check if the combination of employee number and topic already exists
    $validationQuery = "SELECT COUNT(*) AS count FROM $tablename WHERE Employee_Number = ? AND Topic = ?";
    $validationStmt = sqlsrv_prepare($conn, $validationQuery, array(&$selectedValue, &$topic));

    if (!$validationStmt) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($validationStmt)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the validation query
    if ($row = sqlsrv_fetch_array($validationStmt, SQLSRV_FETCH_ASSOC)) {
        $count = $row['count'];

        // Debugging: Print out count to see if it's correct
        echo "Count: $count\n";

        if ($count > 0) {
            // Combination of employee number and topic already exists, skip insertion
            echo "Combination of Employee Number $selectedValue and Topic $topic already exists. Skipping...\n";
            continue; // Skip to next selected employee
        }
    }

    // If no matching combination exists, proceed with data retrieval and insertion

    // Query to retrieve email and date hired
    $selectEmailDatehired = "SELECT Email, Date_Hired FROM [dbo].[View_MasterList] WHERE EmpNo = ?";
    $selectStmtEmailDatehired = sqlsrv_prepare($conn, $selectEmailDatehired, array(&$selectedValue));

    if (!$selectStmtEmailDatehired) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($selectStmtEmailDatehired)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the SELECT query
    if ($row = sqlsrv_fetch_array($selectStmtEmailDatehired, SQLSRV_FETCH_ASSOC)) {
        // Retrieve additional information
        $email = $row['Email'];
        $datehired = $row['Date_Hired'];
    }

    // Query to retrieve additional information for the selected employee
    $selectQuery = "SELECT * FROM [dbo].[tbl_topic_LIST_mgtgroupregulation] WHERE Employee_Number = ?";
    $selectStmt = sqlsrv_prepare($conn, $selectQuery, array(&$selectedValue));

    if (!$selectStmt) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($selectStmt)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the SELECT query
    if ($row = sqlsrv_fetch_array($selectStmt, SQLSRV_FETCH_ASSOC)) {
        // Retrieve additional information
        $employeename = $row['Employee_Name'];
        $employeenumber = $row['Employee_Number'];
        $section = $row['Section'];
        $position = $row['Position'];

        // Display additional information (optional)
        echo "Employee Name: $employeename, Department: $position\n";

        // Insert the selected employee number along with additional information into the database
        $insertQuery = "INSERT INTO $tablename (RequestNumber, Employee_Number, Employee_Name, Section, Position, Email, [Date Hired], Topic, [Type of Training], [Start Date], [End Date], [Start Time], [End Time], [Meeting Room], [Date_Requested], [Requestor_Name]) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = sqlsrv_prepare($conn, $insertQuery, array(
            &$reqlastIDno, &$employeenumber, &$employeename, &$section, &$position, &$email, &$datehired, &$topic, &$typetraining,
            &$startEnlist, &$endEnlist, &$starttime, &$endtime, &$meetingroom, &$datetoday, &$requestorname
        ));

        if (!$insertStmt) {
            // Handle SQL error
            die(print_r(sqlsrv_errors(), true));
        }

        // Execute the prepared statement
        if (!sqlsrv_execute($insertStmt)) {
            // Handle execution error
            die(print_r(sqlsrv_errors(), true));
        }

        // Display success message or perform any other action as needed
        echo "Employee Number $selectedValue inserted successfully!\n";
    } else {
        // Handle case where employee data could not be found
        echo "No data found for Employee Number: $selectedValue\n";
    }

    // Increment transaction number for next iteration
    $nextTransactionNumber++;
    $transactionNumber = "REQUEST-MS2023-" . sprintf("%04d", $nextTransactionNumber);

         

      
      

    }
    if($typetraining === 'E-LEARNING'){

        echo $typetraining;


                        
                $selected = $_POST['selectedEmployeesInput']; // Retrieve selected employee numbers
                $selectedArray = explode(',', $selectedEmployeesString); // Convert comma-separated string to array

             
                // Convert the comma-separated string to an array
                $selectedArray = explode(',', $selected);






                        
       
// Retrieve selected employee numbers and convert to an array
$selectedEmployeesString = $_POST['selectedEmployeesInput']; 
$selectedEmployees = explode(',', $selectedEmployeesString); // Convert comma-separated string to array

// Get the topic from the POST request
$topic = $_POST['topic']; 

// Query to get the last request number
$sql_reqid = "SELECT MAX(ElearningTransID) as lastReqID FROM [dbo].[tbl_elearningstatus]";
$stmt_reqid = sqlsrv_query($conn, $sql_reqid);

// Fetch the last request number
if ($row4 = sqlsrv_fetch_array($stmt_reqid, SQLSRV_FETCH_ASSOC)) {
    $reqlastID = $row4['lastReqID'];

    // Extract numeric part of the last request ID
    if ($reqlastID) {
        $parts = explode('-', $reqlastID);
        $lastNumber = (int) end($parts); // Get the last numeric part of the ID
    } else {
        $lastNumber = 0; // If no last request exists, start from 1
    }

    // Generate the new request number
    $nextNumber = $lastNumber + 1;
    // Get the current date and time without separators
    $currentDateTime = date("Ymd_His");

    // Create the new request ID
    $elearningUNIQUE = "ElearningReq-" . $currentDateTime . "-" . $nextNumber;
}

// Loop through each selected employee
foreach ($selectedEmployees as $selectedEmployee) {
    // Get employee details from tbl_ems
    $sql_Getems = "SELECT * FROM [dbo].[tbl_ems] WHERE [EmpNo] = '$selectedEmployee'";
    $result = sqlsrv_query($conn, $sql_Getems);

    if ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $empno = $row['EmpNo'];
        $fullname = $row['Full_Name'];
        $section = $row['Section'];
        $email = $row['Email'];
    } else {
        // Skip if employee data is not found
        echo "Employee with EmpNo $selectedEmployee not found.<br>";
        continue;
    }

    // Check if the employee with the same Topic already exists in tbl_elearningstatus
    $sql_check_existing = "SELECT * FROM [dbo].[tbl_elearningstatus] 
                           WHERE Target_Employee = '$fullname' 
                           AND Title = '$topic'";
    $check_result = sqlsrv_query($conn, $sql_check_existing);
    
    // Check if any rows are returned
    if ($row_check = sqlsrv_fetch_array($check_result, SQLSRV_FETCH_ASSOC)) {
        // If the employee with the same topic exists, skip this insertion
        echo "Skipping: $fullname is already enlisted for the topic $topic.<br>";
        continue; // Skip to the next employee in the array
    }

    // Insert the new record into tbl_elearningstatus
    $sql_insert = "INSERT INTO [dbo].[tbl_elearningstatus] 
                   (RequestNumber, ElearningTransID, Title, EmployeeNumber, Target_Employee, Section, Target_Date, End_Date, Elearning_Status, TotalNumber_Target, Email, Classification, table_name)
                   VALUES ('$reqlastIDno', '$elearningUNIQUE', '$topic', '$empno', '$fullname', '$section', '$startEnlist', '$endEnlist', 'NOT YET', '1', '$email', '$classification', '$table_skillmap')";

    $resultscreate = sqlsrv_query($conn, $sql_insert);

    if (!$resultscreate) {
        echo "Error inserting record for $fullname.<br>";
    } else {
        echo "Successfully inserted record for $fullname.<br>";
    }
}
                include '../email/ElearningEnlistment.php';




    }




        ?>
        <script>  
 alert("Submit Successfully!");               
  window.location="../mgtgroupregulation.php";
        </script>
        <?php 
    
 


}



elseif($Action == 'workstandard'){


    
    $topic = $_POST['topic'];
    $typetraining = $_POST['typeoftraining'];
    $classification = 'WorkStandard';

    $startEnlist = isset($_POST['start_enlist_hidden']) ? $_POST['start_enlist_hidden'] : '';
    $endEnlist = isset($_POST['end_enlist_hidden']) ? $_POST['end_enlist_hidden'] : '';

    // Debug: Check if these values are being passed
    echo "Start Enlist: " . $startEnlist . "<br>";
    echo "End Enlist: " . $endEnlist . "<br>";


    $starttime = isset($_POST['starttime']) && !empty($_POST['starttime']) ? $_POST['starttime'] :'N/A';
    $endtime = isset($_POST['endtime']) && !empty($_POST['endtime']) ? $_POST['endtime'] : 'N/A';
    $startdate = isset($_POST['startdate']) && !empty($_POST['startdate']) ? $_POST['startdate'] : 'N/A';
    $enddate = isset($_POST['enddate']) && !empty($_POST['enddate']) ? $_POST['enddate'] : 'N/A';
    $meetingroom = isset($_POST['meetingroom']) && !empty($_POST['meetingroom']) ? $_POST['meetingroom'] : 'N/A';

 


    $requestorname = $_GET['requestorname'];

    $tablename= "tbl_topic_LIST_workstandard_MAINREQUEST";

    $table_skillmap ="tbl_topic_workstandard";

    $datetoday=  date("Y-m-d");

    $selectedEmployeesString = $_POST['selectedEmployeesInput']; // Retrieve selected employee numbers
    $selectedEmployees = explode(',', $selectedEmployeesString); // Convert comma-separated string to array




// Query to get the last request number
$sql_reqid = "SELECT MAX(RequestNumber) as lastReqID FROM [dbo].[tbl_topic_LIST_workstandard_MAINREQUEST]";
$stmt_reqid = sqlsrv_query($conn, $sql_reqid);

// Fetch the last request number
if ($row4 = sqlsrv_fetch_array($stmt_reqid, SQLSRV_FETCH_ASSOC)) {
    $reqlastID = $row4['lastReqID'];

    // Extract numeric part
    if ($reqlastID) {
        $parts = explode('-', $reqlastID);
        $lastNumber = (int) end($parts);
    } else {
        $lastNumber = 0;
    }

    // Generate the new request number
    $nextNumber = $lastNumber + 1;
    // Get the current date and time without separators
    $currentDateTime = date("Ymd_His");

    // Create the request ID with the current date and time
    $reqlastIDno = "TrainingRequest-WorkStandard-" . $currentDateTime . "-" . $nextNumber;
}

// Query to get the last transaction number
$sql3 = "SELECT MAX(ID) as lastID FROM tbl_trainingrequest";
$stmt3 = sqlsrv_query($conn, $sql3);
if ($row3 = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
    $lastID = $row3['lastID'];
    if ($lastID == null || $lastID == "") {
        $lastID = 0; // set to 0 if no previous records
    }
    $nextTransactionNumber = $lastID + 1;
    $transactionNumber = "REQUEST-MS2023-" . sprintf("%04d", $nextTransactionNumber);
}

foreach ($selectedEmployees as $selectedValue) {
    echo "Employee Number: $selectedValue\n";

    // Check if the combination of employee number and topic already exists
    $validationQuery = "SELECT COUNT(*) AS count FROM $tablename WHERE Employee_Number = ? AND Topic = ?";
    $validationStmt = sqlsrv_prepare($conn, $validationQuery, array(&$selectedValue, &$topic));

    if (!$validationStmt) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($validationStmt)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the validation query
    if ($row = sqlsrv_fetch_array($validationStmt, SQLSRV_FETCH_ASSOC)) {
        $count = $row['count'];

        // Debugging: Print out count to see if it's correct
        echo "Count: $count\n";

        if ($count > 0) {
            // Combination of employee number and topic already exists, skip insertion
            echo "Combination of Employee Number $selectedValue and Topic $topic already exists. Skipping...\n";
            continue; // Skip to next selected employee
        }
    }

    // If no matching combination exists, proceed with data retrieval and insertion

    // Query to retrieve email and date hired
    $selectEmailDatehired = "SELECT Email, Date_Hired FROM [dbo].[View_MasterList] WHERE EmpNo = ?";
    $selectStmtEmailDatehired = sqlsrv_prepare($conn, $selectEmailDatehired, array(&$selectedValue));

    if (!$selectStmtEmailDatehired) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($selectStmtEmailDatehired)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the SELECT query
    if ($row = sqlsrv_fetch_array($selectStmtEmailDatehired, SQLSRV_FETCH_ASSOC)) {
        // Retrieve additional information
        $email = $row['Email'];
        $datehired = $row['Date_Hired'];
    }

    // Query to retrieve additional information for the selected employee
    $selectQuery = "SELECT * FROM [dbo].[tbl_topic_LIST_workstandard] WHERE Employee_Number = ?";
    $selectStmt = sqlsrv_prepare($conn, $selectQuery, array(&$selectedValue));

    if (!$selectStmt) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($selectStmt)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the SELECT query
    if ($row = sqlsrv_fetch_array($selectStmt, SQLSRV_FETCH_ASSOC)) {
        // Retrieve additional information
        $employeename = $row['Employee_Name'];
        $employeenumber = $row['Employee_Number'];
        $section = $row['Section'];
        $position = $row['Position'];

        // Display additional information (optional)
        echo "Employee Name: $employeename, Department: $position\n";

        // Insert the selected employee number along with additional information into the database
        $insertQuery = "INSERT INTO $tablename (RequestNumber, Employee_Number, Employee_Name, Section, Position, Email, [Date Hired], Topic, [Type of Training], [Start Date], [End Date], [Start Time], [End Time], [Meeting Room], [Date_Requested], [Requestor_Name]) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = sqlsrv_prepare($conn, $insertQuery, array(
            &$reqlastIDno, &$employeenumber, &$employeename, &$section, &$position, &$email, &$datehired, &$topic, &$typetraining,
            &$startEnlist, &$endEnlist, &$starttime, &$endtime, &$meetingroom, &$datetoday, &$requestorname
        ));

        if (!$insertStmt) {
            // Handle SQL error
            die(print_r(sqlsrv_errors(), true));
        }

        // Execute the prepared statement
        if (!sqlsrv_execute($insertStmt)) {
            // Handle execution error
            die(print_r(sqlsrv_errors(), true));
        }

        // Display success message or perform any other action as needed
        echo "Employee Number $selectedValue inserted successfully!\n";
    } else {
        // Handle case where employee data could not be found
        echo "No data found for Employee Number: $selectedValue\n";
    }

    // Increment transaction number for next iteration
    $nextTransactionNumber++;
    $transactionNumber = "REQUEST-MS2023-" . sprintf("%04d", $nextTransactionNumber);

         

    }

    
    if($typetraining === 'E-LEARNING'){

        echo $typetraining;


                        
       
// Retrieve selected employee numbers and convert to an array
$selectedEmployeesString = $_POST['selectedEmployeesInput']; 
$selectedEmployees = explode(',', $selectedEmployeesString); // Convert comma-separated string to array

// Get the topic from the POST request
$topic = $_POST['topic']; 

// Query to get the last request number
$sql_reqid = "SELECT MAX(ElearningTransID) as lastReqID FROM [dbo].[tbl_elearningstatus]";
$stmt_reqid = sqlsrv_query($conn, $sql_reqid);

// Fetch the last request number
if ($row4 = sqlsrv_fetch_array($stmt_reqid, SQLSRV_FETCH_ASSOC)) {
    $reqlastID = $row4['lastReqID'];

    // Extract numeric part of the last request ID
    if ($reqlastID) {
        $parts = explode('-', $reqlastID);
        $lastNumber = (int) end($parts); // Get the last numeric part of the ID
    } else {
        $lastNumber = 0; // If no last request exists, start from 1
    }

    // Generate the new request number
    $nextNumber = $lastNumber + 1;
    // Get the current date and time without separators
    $currentDateTime = date("Ymd_His");

    // Create the new request ID
    $elearningUNIQUE = "ElearningReq-" . $currentDateTime . "-" . $nextNumber;
}

// Loop through each selected employee
foreach ($selectedEmployees as $selectedEmployee) {
    // Get employee details from tbl_ems
    $sql_Getems = "SELECT * FROM [dbo].[tbl_ems] WHERE [EmpNo] = '$selectedEmployee'";
    $result = sqlsrv_query($conn, $sql_Getems);

    if ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $empno = $row['EmpNo'];
        $fullname = $row['Full_Name'];
        $section = $row['Section'];
        $email = $row['Email'];
    } else {
        // Skip if employee data is not found
        echo "Employee with EmpNo $selectedEmployee not found.<br>";
        continue;
    }

    // Check if the employee with the same Topic already exists in tbl_elearningstatus
    $sql_check_existing = "SELECT * FROM [dbo].[tbl_elearningstatus] 
                           WHERE Target_Employee = '$fullname' 
                           AND Title = '$topic'";
    $check_result = sqlsrv_query($conn, $sql_check_existing);
    
    // Check if any rows are returned
    if ($row_check = sqlsrv_fetch_array($check_result, SQLSRV_FETCH_ASSOC)) {
        // If the employee with the same topic exists, skip this insertion
        echo "Skipping: $fullname is already enlisted for the topic $topic.<br>";
        continue; // Skip to the next employee in the array
    }

    // Insert the new record into tbl_elearningstatus
    $sql_insert = "INSERT INTO [dbo].[tbl_elearningstatus] 
                   (RequestNumber, ElearningTransID, Title, EmployeeNumber, Target_Employee, Section, Target_Date, End_Date, Elearning_Status, TotalNumber_Target, Email, Classification, table_name)
                   VALUES ('$reqlastIDno', '$elearningUNIQUE', '$topic', '$empno', '$fullname', '$section', '$startEnlist', '$endEnlist', 'NOT YET', '1', '$email', '$classification', '$table_skillmap')";

    $resultscreate = sqlsrv_query($conn, $sql_insert);

    if (!$resultscreate) {
        echo "Error inserting record for $fullname.<br>";
    } else {
        echo "Successfully inserted record for $fullname.<br>";
    }


}

            include '../email/ElearningEnlistment.php';







            }












            ?>
            <script>  
//   alert("Submit Successfully!");               
//     window.location="../workstandard.php";
         </script>
            <?php 

    
 
      


}



elseif($Action == 'prodhashira'){


    

    
    $topic = $_POST['topic'];
    $typetraining = $_POST['typeoftraining'];
    $classification = 'ProdHashira';


    
    $startEnlist = isset($_POST['start_enlist_hidden']) ? $_POST['start_enlist_hidden'] : '';
    $endEnlist = isset($_POST['end_enlist_hidden']) ? $_POST['end_enlist_hidden'] : '';

    // Debug: Check if these values are being passed
    echo "Start Enlist: " . $startEnlist . "<br>";
    echo "End Enlist: " . $endEnlist . "<br>";


    $starttime = isset($_POST['starttime']) && !empty($_POST['starttime']) ? $_POST['starttime'] :'N/A';
    $endtime = isset($_POST['endtime']) && !empty($_POST['endtime']) ? $_POST['endtime'] : 'N/A';
    $startdate = isset($_POST['startdate']) && !empty($_POST['startdate']) ? $_POST['startdate'] : 'N/A';
    $enddate = isset($_POST['enddate']) && !empty($_POST['enddate']) ? $_POST['enddate'] : 'N/A';
    $meetingroom = isset($_POST['meetingroom']) && !empty($_POST['meetingroom']) ? $_POST['meetingroom'] : 'N/A';

    


    $requestorname = $_GET['requestorname'];

    $tablename= "tbl_topic_LIST_hashira_MAINREQUEST";

    $table_skillmap= "tbl_topic_hashira";

  
    $datetoday=  date("Y-m-d");

    $selectedEmployeesString = $_POST['selectedEmployeesInput']; // Retrieve selected employee numbers
    $selectedEmployees = explode(',', $selectedEmployeesString); // Convert comma-separated string to array



    

// Query to get the last request number
$sql_reqid = "SELECT MAX(RequestNumber) as lastReqID FROM [dbo].[tbl_topic_LIST_hashira_MAINREQUEST]";
$stmt_reqid = sqlsrv_query($conn, $sql_reqid);

// Fetch the last request number
if ($row4 = sqlsrv_fetch_array($stmt_reqid, SQLSRV_FETCH_ASSOC)) {
    $reqlastID = $row4['lastReqID'];

    // Extract numeric part
    if ($reqlastID) {
        $parts = explode('-', $reqlastID);
        $lastNumber = (int) end($parts);
    } else {
        $lastNumber = 0;
    }

    // Generate the new request number
    $nextNumber = $lastNumber + 1;
    // Get the current date and time without separators
    $currentDateTime = date("Ymd_His");

    // Create the request ID with the current date and time
    $reqlastIDno = "TrainingRequest-ProdHashira-" . $currentDateTime . "-" . $nextNumber;
}

// Query to get the last transaction number
$sql3 = "SELECT MAX(ID) as lastID FROM tbl_trainingrequest";
$stmt3 = sqlsrv_query($conn, $sql3);
if ($row3 = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
    $lastID = $row3['lastID'];
    if ($lastID == null || $lastID == "") {
        $lastID = 0; // set to 0 if no previous records
    }
    $nextTransactionNumber = $lastID + 1;
    $transactionNumber = "REQUEST-MS2023-" . sprintf("%04d", $nextTransactionNumber);
}

foreach ($selectedEmployees as $selectedValue) {
    echo "Employee Number: $selectedValue\n";

    // Check if the combination of employee number and topic already exists
    $validationQuery = "SELECT COUNT(*) AS count FROM $tablename WHERE Employee_Number = ? AND Topic = ?";
    $validationStmt = sqlsrv_prepare($conn, $validationQuery, array(&$selectedValue, &$topic));

    if (!$validationStmt) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($validationStmt)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the validation query
    if ($row = sqlsrv_fetch_array($validationStmt, SQLSRV_FETCH_ASSOC)) {
        $count = $row['count'];

        // Debugging: Print out count to see if it's correct
        echo "Count: $count\n";

        if ($count > 0) {
            // Combination of employee number and topic already exists, skip insertion
            echo "Combination of Employee Number $selectedValue and Topic $topic already exists. Skipping...\n";
            continue; // Skip to next selected employee
        }
    }

    // If no matching combination exists, proceed with data retrieval and insertion

    // Query to retrieve email and date hired
    $selectEmailDatehired = "SELECT Email, Date_Hired FROM [dbo].[View_MasterList] WHERE EmpNo = ?";
    $selectStmtEmailDatehired = sqlsrv_prepare($conn, $selectEmailDatehired, array(&$selectedValue));

    if (!$selectStmtEmailDatehired) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($selectStmtEmailDatehired)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the SELECT query
    if ($row = sqlsrv_fetch_array($selectStmtEmailDatehired, SQLSRV_FETCH_ASSOC)) {
        // Retrieve additional information
        $email = $row['Email'];
        $datehired = $row['Date_Hired'];
    }

    // Query to retrieve additional information for the selected employee
    $selectQuery = "SELECT * FROM [dbo].[tbl_topic_LIST_hashira] WHERE Employee_Number = ?";
    $selectStmt = sqlsrv_prepare($conn, $selectQuery, array(&$selectedValue));

    if (!$selectStmt) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($selectStmt)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the SELECT query
    if ($row = sqlsrv_fetch_array($selectStmt, SQLSRV_FETCH_ASSOC)) {
        // Retrieve additional information
        $employeename = $row['Employee_Name'];
        $employeenumber = $row['Employee_Number'];
        $section = $row['Section'];
        $position = $row['Position'];

        // Display additional information (optional)
        echo "Employee Name: $employeename, Department: $position\n";

        // Insert the selected employee number along with additional information into the database
        $insertQuery = "INSERT INTO $tablename (RequestNumber, Employee_Number, Employee_Name, Section, Position, Email, [Date Hired], Topic, [Type of Training], [Start Date], [End Date], [Start Time], [End Time], [Meeting Room], [Date_Requested], [Requestor_Name]) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = sqlsrv_prepare($conn, $insertQuery, array(
            &$reqlastIDno, &$employeenumber, &$employeename, &$section, &$position, &$email, &$datehired, &$topic, &$typetraining,
            &$startEnlist, &$endEnlist, &$starttime, &$endtime, &$meetingroom, &$datetoday, &$requestorname
        ));

        if (!$insertStmt) {
            // Handle SQL error
            die(print_r(sqlsrv_errors(), true));
        }

        // Execute the prepared statement
        if (!sqlsrv_execute($insertStmt)) {
            // Handle execution error
            die(print_r(sqlsrv_errors(), true));
        }

        // Display success message or perform any other action as needed
        echo "Employee Number $selectedValue inserted successfully!\n";
    } else {
        // Handle case where employee data could not be found
        echo "No data found for Employee Number: $selectedValue\n";
    }

    // Increment transaction number for next iteration
    $nextTransactionNumber++;
    $transactionNumber = "REQUEST-MS2023-" . sprintf("%04d", $nextTransactionNumber);
      
        }

        if($typetraining === 'E-LEARNING'){

            echo $typetraining;


                            
                    $selected = $_POST['selectedEmployeesInput']; // Retrieve selected employee numbers
                    $selectedArray = explode(',', $selectedEmployeesString); // Convert comma-separated string to array

                 
                    // Convert the comma-separated string to an array
                    $selectedArray = explode(',', $selected);






                      
       
// Retrieve selected employee numbers and convert to an array
$selectedEmployeesString = $_POST['selectedEmployeesInput']; 
$selectedEmployees = explode(',', $selectedEmployeesString); // Convert comma-separated string to array

// Get the topic from the POST request
$topic = $_POST['topic']; 

// Query to get the last request number
$sql_reqid = "SELECT MAX(ElearningTransID) as lastReqID FROM [dbo].[tbl_elearningstatus]";
$stmt_reqid = sqlsrv_query($conn, $sql_reqid);

// Fetch the last request number
if ($row4 = sqlsrv_fetch_array($stmt_reqid, SQLSRV_FETCH_ASSOC)) {
    $reqlastID = $row4['lastReqID'];

    // Extract numeric part of the last request ID
    if ($reqlastID) {
        $parts = explode('-', $reqlastID);
        $lastNumber = (int) end($parts); // Get the last numeric part of the ID
    } else {
        $lastNumber = 0; // If no last request exists, start from 1
    }

    // Generate the new request number
    $nextNumber = $lastNumber + 1;
    // Get the current date and time without separators
    $currentDateTime = date("Ymd_His");

    // Create the new request ID
    $elearningUNIQUE = "ElearningReq-" . $currentDateTime . "-" . $nextNumber;
}

// Loop through each selected employee
foreach ($selectedEmployees as $selectedEmployee) {
    // Get employee details from tbl_ems
    $sql_Getems = "SELECT * FROM [dbo].[tbl_ems] WHERE [EmpNo] = '$selectedEmployee'";
    $result = sqlsrv_query($conn, $sql_Getems);

    if ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $empno = $row['EmpNo'];
        $fullname = $row['Full_Name'];
        $section = $row['Section'];
        $email = $row['Email'];
    } else {
        // Skip if employee data is not found
        echo "Employee with EmpNo $selectedEmployee not found.<br>";
        continue;
    }

    // Check if the employee with the same Topic already exists in tbl_elearningstatus
    $sql_check_existing = "SELECT * FROM [dbo].[tbl_elearningstatus] 
                           WHERE Target_Employee = '$fullname' 
                           AND Title = '$topic'";
    $check_result = sqlsrv_query($conn, $sql_check_existing);
    
    // Check if any rows are returned
    if ($row_check = sqlsrv_fetch_array($check_result, SQLSRV_FETCH_ASSOC)) {
        // If the employee with the same topic exists, skip this insertion
        echo "Skipping: $fullname is already enlisted for the topic $topic.<br>";
        continue; // Skip to the next employee in the array
    }

    // Insert the new record into tbl_elearningstatus
    $sql_insert = "INSERT INTO [dbo].[tbl_elearningstatus] 
                   (RequestNumber, ElearningTransID, Title, EmployeeNumber, Target_Employee, Section, Target_Date, End_Date, Elearning_Status, TotalNumber_Target, Email, Classification, table_name)
                   VALUES ('$reqlastIDno', '$elearningUNIQUE', '$topic', '$empno', '$fullname', '$section', '$startEnlist', '$endEnlist', 'NOT YET', '1', '$email', '$classification', '$table_skillmap')";

    $resultscreate = sqlsrv_query($conn, $sql_insert);

    if (!$resultscreate) {
        echo "Error inserting record for $fullname.<br>";
    } else {
        echo "Successfully inserted record for $fullname.<br>";
    }


                        
                    }


                    include '../email/ElearningEnlistment.php';



        }




            ?>
            <script>  
         alert("Submit Successfully!");               
          window.location="../hashira.php";
            </script>
            <?php 

}



elseif($Action == 'PCBAprodhashira'){


    

    
    $topic = $_POST['topic'];
    $typetraining = $_POST['typeoftraining'];
    $classification = 'ProdHashira';


    
    $startEnlist = isset($_POST['start_enlist_hidden']) ? $_POST['start_enlist_hidden'] : '';
    $endEnlist = isset($_POST['end_enlist_hidden']) ? $_POST['end_enlist_hidden'] : '';

    // Debug: Check if these values are being passed
    echo "Start Enlist: " . $startEnlist . "<br>";
    echo "End Enlist: " . $endEnlist . "<br>";


    $starttime = isset($_POST['starttime']) && !empty($_POST['starttime']) ? $_POST['starttime'] :'N/A';
    $endtime = isset($_POST['endtime']) && !empty($_POST['endtime']) ? $_POST['endtime'] : 'N/A';
    $startdate = isset($_POST['startdate']) && !empty($_POST['startdate']) ? $_POST['startdate'] : 'N/A';
    $enddate = isset($_POST['enddate']) && !empty($_POST['enddate']) ? $_POST['enddate'] : 'N/A';
    $meetingroom = isset($_POST['meetingroom']) && !empty($_POST['meetingroom']) ? $_POST['meetingroom'] : 'N/A';

    


    $requestorname = $_GET['requestorname'];

    $tablename= "tbl_topic_LIST_hashira_MAINREQUEST";

    $table_skillmap= "tbl_topic_hashira";

  
    $datetoday=  date("Y-m-d");

    $selectedEmployeesString = $_POST['selectedEmployeesInput']; // Retrieve selected employee numbers
    $selectedEmployees = explode(',', $selectedEmployeesString); // Convert comma-separated string to array



    

            // Query to get the last request number
            $sql_reqid = "SELECT MAX(RequestNumber) as lastReqID FROM [dbo].[tbl_topic_LIST_hashira_MAINREQUEST]";
            $stmt_reqid = sqlsrv_query($conn, $sql_reqid);

            // Fetch the last request number
            if ($row4 = sqlsrv_fetch_array($stmt_reqid, SQLSRV_FETCH_ASSOC)) {
                $reqlastID = $row4['lastReqID'];

                // Extract numeric part
                if ($reqlastID) {
                    $parts = explode('-', $reqlastID);
                    $lastNumber = (int) end($parts);
                } else {
                    $lastNumber = 0;
                }

                // Generate the new request number
                $nextNumber = $lastNumber + 1;
                // Get the current date and time without separators
                $currentDateTime = date("Ymd_His");

                // Create the request ID with the current date and time
            $reqlastIDno = "TrainingRequest-ProdHashira-" . $currentDateTime . "-" . $nextNumber;
            }

                    
        // Query to get the last transaction number
        $sql3 = "SELECT MAX(ID) as lastID FROM tbl_trainingrequest";
        $stmt3 = sqlsrv_query($conn,$sql3);
        if ($row3 = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
            $lastID = $row3['lastID'];
            if ($lastID == null || $lastID == "") {
                $lastID = 0; // set to 0 if no previous records
            }
            $nextTransactionNumber = $lastID + 1;
            $transactionNumber = "REQUEST-MS2023-" . sprintf("%04d", $nextTransactionNumber);
        }



                
    foreach ($selectedEmployees as $selectedValue) {
        echo "Employee Number: $selectedValue\n";


           // Check if the combination of employee number and topic already exists
                $validationQuery = "SELECT COUNT(*) AS count FROM $tablename WHERE Employee_Number = ? AND Topic = ?";
                $validationStmt = sqlsrv_prepare($conn, $validationQuery, array(&$selectedValue, &$topic));

                if (!$validationStmt) {
                    // Handle SQL error
                    die(print_r(sqlsrv_errors(), true));
                }

                // Execute the prepared statement
                if (!sqlsrv_execute($validationStmt)) {
                    // Handle execution error
                    die(print_r(sqlsrv_errors(), true));
                }

                    // Fetch the result of the validation query
            if ($row = sqlsrv_fetch_array($validationStmt, SQLSRV_FETCH_ASSOC)) {
                $count = $row['count'];

                // Debugging: Print out count to see if it's correct
                echo "Count: $count\n";

                    if ($count > 0) {
                        // Combination of employee number and topic already exists, skip insertion
                        echo "Combination of Employee Number $selectedValue and Topic $topic already exists. Skipping...\n";
                        continue; // Skip to next selected employee
                    }
                }


        

                                // Query to retrieve email
                            $selectEmailDatehired = "SELECT Email,Date_Hired FROM  [dbo].[View_MasterList] WHERE EmpNo = ?";
                            $selectStmtEmailDatehired = sqlsrv_prepare($conn, $selectEmailDatehired, array(&$selectedValue));
                            
                            if (!$selectStmtEmailDatehired) {
                                // Handle SQL error
                                die(print_r(sqlsrv_errors(), true));
                            }

                            // Execute the prepared statement
                            if (!sqlsrv_execute($selectStmtEmailDatehired)) {
                                // Handle execution error
                                die(print_r(sqlsrv_errors(), true));
                            }

                                    // Fetch the result of the SELECT query
                                    if ($row = sqlsrv_fetch_array($selectStmtEmailDatehired, SQLSRV_FETCH_ASSOC)) {
                                        // Retrieve additional information
                                        $email = $row['Email'];
                                        $datehired = $row['Date_Hired'];
                                    
                                    }

          // Query to retrieve additional information for the selected employee
    $selectQuery = "SELECT * FROM  [dbo].[tbl_topic_LIST_hashira] WHERE Employee_Number = ?";
    $selectStmt = sqlsrv_prepare($conn, $selectQuery, array(&$selectedValue));
    
    if (!$selectStmt) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($selectStmt)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

            // Fetch the result of the SELECT query
            if ($row = sqlsrv_fetch_array($selectStmt, SQLSRV_FETCH_ASSOC)) {
                // Retrieve additional information
                $employeename = $row['Employee_Name'];
                $employeenumber = $row['Employee_Number'];
                $section = $row['Section'];
                $position = $row['Position'];
                // $requestorname = $row['Requestor_Name'];
                

                // Display additional information (optional)
                echo "Employee Name: $employeename, Department: $position\n";

                // Insert the selected employee number along with additional information into the database
                $insertQuery = "INSERT INTO $tablename (RequestNumber,Employee_Number, Employee_Name, Section, Position, Email, [Date Hired], Topic, [Type of Training], [Start Date], [End Date], [Start Time], [End Time], [Meeting Room],[Date_Requested],[Requestor_Name]) 
                VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)";
                $insertStmt = sqlsrv_prepare($conn, $insertQuery, array(&$reqlastIDno,&$employeenumber, &$employeename, &$section, &$position,&$email, &$datehired, &$topic, &$typetraining, &$startEnlist, &$endEnlist,
                &$starttime, &$endtime, &$meetingroom,&$datetoday,&$requestorname));


           
      


        

                if (!$insertStmt) {
                    // Handle SQL error
                    die(print_r(sqlsrv_errors(), true));
                }

                // Execute the prepared statement
                if (!sqlsrv_execute($insertStmt)) {
                    // Handle execution error
                    die(print_r(sqlsrv_errors(), true));
                }



        
                  
    

                // Display success message or perform any other action as needed
                echo "Employee Number $selectedValue inserted successfully!\n";
            } else {
                // Handle case where employee data could not be found
                echo "No data found for Employee Number: $selectedValue\n";
            }

            
                         // Increment transaction number for next iteration
                         $nextTransactionNumber++;
                         $transactionNumber = "REQUEST-MS2023-" . sprintf("%04d", $nextTransactionNumber);
         
      
        }

        if($typetraining === 'E-LEARNING'){

            echo $typetraining;


                            
                    $selected = $_POST['selectedEmployeesInput']; // Retrieve selected employee numbers
                    $selectedArray = explode(',', $selectedEmployeesString); // Convert comma-separated string to array

                 
                    // Convert the comma-separated string to an array
                    $selectedArray = explode(',', $selected);








                                // Query to get the last request number
                                $sql_reqid = "SELECT MAX(ElearningTransID) as lastReqID FROM [dbo].[tbl_elearningstatus]";
                                $stmt_reqid = sqlsrv_query($conn, $sql_reqid);

                                // Fetch the last request number
                                if ($row4 = sqlsrv_fetch_array($stmt_reqid, SQLSRV_FETCH_ASSOC)) {
                                    $reqlastID = $row4['lastReqID'];

                                    // Extract numeric part
                                    if ($reqlastID) {
                                        $parts = explode('-', $reqlastID);
                                        $lastNumber = (int) end($parts);
                                    } else {
                                        $lastNumber = 0;
                                    }

                                    // Generate the new request number
                                    $nextNumber = $lastNumber + 1;
                                    // Get the current date and time without separators
                                    $currentDateTime = date("Ymd_His");

                                    // Create the request ID with the current date and time
                                $elearningUNIQUE = "ElearningReq-" . $currentDateTime . "-" . $nextNumber;
                                }


                    echo  $selected;


                    // Counter for the total count

                                
                    foreach ($selectedArray  as $selectedValues) {
                        $sql_Getems = "SELECT * FROM [dbo].[tbl_ems] WHERE [EmpNo] = '$selectedValues'";
                        $result = sqlsrv_query($conn, $sql_Getems);

                        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                            $empno = $row['EmpNo'];
                            $fullname = $row['Full_Name'];
                            $section = $row['Section'];
                            $email = $row['Email'];
                            
                        }

                        // Increment the last ElearningTransID for the next insertion

                        

                        $sql_insert = "INSERT INTO [dbo].[tbl_elearningstatus] (RequestNumber,ElearningTransID, Title, EmployeeNumber, Target_Employee, Section, Target_Date, End_Date, Elearning_Status,TotalNumber_Target,Email,Classification,table_name)
                                    VALUES ('$reqlastIDno','$elearningUNIQUE', '$topic', '$empno', '$fullname', '$section', '$startEnlist', '$endEnlist', 'NOT YET','1','$email','$classification','$table_skillmap')";
                        $resultscreate = sqlsrv_query($conn, $sql_insert);

                        
                    }


                    include '../email/ElearningEnlistment.php';



        }




            ?>
            <script>  
         alert("Submit Successfully!");               
          window.location="../pcba_enlistment.php";
            </script>
            <?php 

}

elseif($Action == 'techstandard'){


    

    
    $topic = $_POST['topic'];
    $typetraining = $_POST['typeoftraining'];
    $classification = 'TechnicalStandard';


       
    $startEnlist = isset($_POST['start_enlist_hidden']) ? $_POST['start_enlist_hidden'] : '';
    $endEnlist = isset($_POST['end_enlist_hidden']) ? $_POST['end_enlist_hidden'] : '';

    // Debug: Check if these values are being passed
    echo "Start Enlist: " . $startEnlist . "<br>";
    echo "End Enlist: " . $endEnlist . "<br>";



    $starttime = isset($_POST['starttime']) && !empty($_POST['starttime']) ? $_POST['starttime'] :'N/A';
    $endtime = isset($_POST['endtime']) && !empty($_POST['endtime']) ? $_POST['endtime'] : 'N/A';
    $startdate = isset($_POST['startdate']) && !empty($_POST['startdate']) ? $_POST['startdate'] : 'N/A';
    $enddate = isset($_POST['enddate']) && !empty($_POST['enddate']) ? $_POST['enddate'] : 'N/A';
    $meetingroom = isset($_POST['meetingroom']) && !empty($_POST['meetingroom']) ? $_POST['meetingroom'] : 'N/A';

    


    $requestorname = $_GET['requestorname'];

    $tablename= "tbl_topic_LIST_technicalstandard_MAINREQUEST";

    $table_skillmap= "tbl_topic_technicalstandard";

  
    $datetoday=  date("Y-m-d");

    $selectedEmployeesString = $_POST['selectedEmployeesInput']; // Retrieve selected employee numbers
    $selectedEmployees = explode(',', $selectedEmployeesString); // Convert comma-separated string to array




    

// Query to get the last request number
$sql_reqid = "SELECT MAX(RequestNumber) as lastReqID FROM [dbo].[tbl_topic_LIST_technicalstandard_MAINREQUEST]";
$stmt_reqid = sqlsrv_query($conn, $sql_reqid);

// Fetch the last request number
if ($row4 = sqlsrv_fetch_array($stmt_reqid, SQLSRV_FETCH_ASSOC)) {
    $reqlastID = $row4['lastReqID'];

    // Extract numeric part
    if ($reqlastID) {
        $parts = explode('-', $reqlastID);
        $lastNumber = (int) end($parts);
    } else {
        $lastNumber = 0;
    }

    // Generate the new request number
    $nextNumber = $lastNumber + 1;
    // Get the current date and time without separators
    $currentDateTime = date("Ymd_His");

    // Create the request ID with the current date and time
    $reqlastIDno = "TrainingRequest-TechnicalStandard-" . $currentDateTime . "-" . $nextNumber;
}

// Query to get the last transaction number
$sql3 = "SELECT MAX(ID) as lastID FROM tbl_trainingrequest";
$stmt3 = sqlsrv_query($conn, $sql3);
if ($row3 = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
    $lastID = $row3['lastID'];
    if ($lastID == null || $lastID == "") {
        $lastID = 0; // set to 0 if no previous records
    }
    $nextTransactionNumber = $lastID + 1;
    $transactionNumber = "REQUEST-MS2023-" . sprintf("%04d", $nextTransactionNumber);
}

foreach ($selectedEmployees as $selectedValue) {
    echo "Employee Number: $selectedValue\n";

    // Check if the combination of employee number and topic already exists
    $validationQuery = "SELECT COUNT(*) AS count FROM $tablename WHERE Employee_Number = ? AND Topic = ?";
    $validationStmt = sqlsrv_prepare($conn, $validationQuery, array(&$selectedValue, &$topic));

    if (!$validationStmt) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($validationStmt)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the validation query
    if ($row = sqlsrv_fetch_array($validationStmt, SQLSRV_FETCH_ASSOC)) {
        $count = $row['count'];

        // Debugging: Print out count to see if it's correct
        echo "Count: $count\n";

        if ($count > 0) {
            // Combination of employee number and topic already exists, skip insertion
            echo "Combination of Employee Number $selectedValue and Topic $topic already exists. Skipping...\n";
            continue; // Skip to next selected employee
        }
    }

    // If no matching combination exists, proceed with data retrieval and insertion

    // Query to retrieve email and date hired
    $selectEmailDatehired = "SELECT Email, Date_Hired FROM [dbo].[View_MasterList] WHERE EmpNo = ?";
    $selectStmtEmailDatehired = sqlsrv_prepare($conn, $selectEmailDatehired, array(&$selectedValue));

    if (!$selectStmtEmailDatehired) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($selectStmtEmailDatehired)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the SELECT query
    if ($row = sqlsrv_fetch_array($selectStmtEmailDatehired, SQLSRV_FETCH_ASSOC)) {
        // Retrieve additional information
        $email = $row['Email'];
        $datehired = $row['Date_Hired'];
    }

    // Query to retrieve additional information for the selected employee
    $selectQuery = "SELECT * FROM [dbo].[tbl_topic_LIST_technicalstandard] WHERE Employee_Number = ?";
    $selectStmt = sqlsrv_prepare($conn, $selectQuery, array(&$selectedValue));

    if (!$selectStmt) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($selectStmt)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the SELECT query
    if ($row = sqlsrv_fetch_array($selectStmt, SQLSRV_FETCH_ASSOC)) {
        // Retrieve additional information
        $employeename = $row['Employee_Name'];
        $employeenumber = $row['Employee_Number'];
        $section = $row['Section'];
        $position = $row['Position'];

        // Display additional information (optional)
        echo "Employee Name: $employeename, Department: $position\n";

        // Insert the selected employee number along with additional information into the database
        $insertQuery = "INSERT INTO $tablename (RequestNumber, Employee_Number, Employee_Name, Section, Position, Email, [Date Hired], Topic, [Type of Training], [Start Date], [End Date], [Start Time], [End Time], [Meeting Room], [Date_Requested], [Requestor_Name]) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = sqlsrv_prepare($conn, $insertQuery, array(
            &$reqlastIDno, &$employeenumber, &$employeename, &$section, &$position, &$email, &$datehired, &$topic, &$typetraining,
            &$startEnlist, &$endEnlist, &$starttime, &$endtime, &$meetingroom, &$datetoday, &$requestorname
        ));

        if (!$insertStmt) {
            // Handle SQL error
            die(print_r(sqlsrv_errors(), true));
        }

        // Execute the prepared statement
        if (!sqlsrv_execute($insertStmt)) {
            // Handle execution error
            die(print_r(sqlsrv_errors(), true));
        }

        // Display success message or perform any other action as needed
        echo "Employee Number $selectedValue inserted successfully!\n";
    } else {
        // Handle case where employee data could not be found
        echo "No data found for Employee Number: $selectedValue\n";
    }

    // Increment transaction number for next iteration
    $nextTransactionNumber++;
    $transactionNumber = "REQUEST-MS2023-" . sprintf("%04d", $nextTransactionNumber);
      
      
        }

        if($typetraining === 'E-LEARNING'){

            echo $typetraining;


                            
            $selected = $_POST['selectedEmployeesInput']; // Retrieve selected employee numbers
            $selectedArray = explode(',', $selectedEmployeesString); // Convert comma-separated string to array

         
            // Convert the comma-separated string to an array
            $selectedArray = explode(',', $selected);






              

// Retrieve selected employee numbers and convert to an array
$selectedEmployeesString = $_POST['selectedEmployeesInput']; 
$selectedEmployees = explode(',', $selectedEmployeesString); // Convert comma-separated string to array

// Get the topic from the POST request
$topic = $_POST['topic']; 

// Query to get the last request number
$sql_reqid = "SELECT MAX(ElearningTransID) as lastReqID FROM [dbo].[tbl_elearningstatus]";
$stmt_reqid = sqlsrv_query($conn, $sql_reqid);

// Fetch the last request number
if ($row4 = sqlsrv_fetch_array($stmt_reqid, SQLSRV_FETCH_ASSOC)) {
$reqlastID = $row4['lastReqID'];

// Extract numeric part of the last request ID
if ($reqlastID) {
$parts = explode('-', $reqlastID);
$lastNumber = (int) end($parts); // Get the last numeric part of the ID
} else {
$lastNumber = 0; // If no last request exists, start from 1
}

// Generate the new request number
$nextNumber = $lastNumber + 1;
// Get the current date and time without separators
$currentDateTime = date("Ymd_His");

// Create the new request ID
$elearningUNIQUE = "ElearningReq-" . $currentDateTime . "-" . $nextNumber;
}

// Loop through each selected employee
foreach ($selectedEmployees as $selectedEmployee) {
// Get employee details from tbl_ems
$sql_Getems = "SELECT * FROM [dbo].[tbl_ems] WHERE [EmpNo] = '$selectedEmployee'";
$result = sqlsrv_query($conn, $sql_Getems);

if ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
$empno = $row['EmpNo'];
$fullname = $row['Full_Name'];
$section = $row['Section'];
$email = $row['Email'];
} else {
// Skip if employee data is not found
echo "Employee with EmpNo $selectedEmployee not found.<br>";
continue;
}

// Check if the employee with the same Topic already exists in tbl_elearningstatus
$sql_check_existing = "SELECT * FROM [dbo].[tbl_elearningstatus] 
                   WHERE Target_Employee = '$fullname' 
                   AND Title = '$topic'";
$check_result = sqlsrv_query($conn, $sql_check_existing);

// Check if any rows are returned
if ($row_check = sqlsrv_fetch_array($check_result, SQLSRV_FETCH_ASSOC)) {
// If the employee with the same topic exists, skip this insertion
echo "Skipping: $fullname is already enlisted for the topic $topic.<br>";
continue; // Skip to the next employee in the array
}

// Insert the new record into tbl_elearningstatus
$sql_insert = "INSERT INTO [dbo].[tbl_elearningstatus] 
           (RequestNumber, ElearningTransID, Title, EmployeeNumber, Target_Employee, Section, Target_Date, End_Date, Elearning_Status, TotalNumber_Target, Email, Classification, table_name)
           VALUES ('$reqlastIDno', '$elearningUNIQUE', '$topic', '$empno', '$fullname', '$section', '$startEnlist', '$endEnlist', 'NOT YET', '1', '$email', '$classification', '$table_skillmap')";

$resultscreate = sqlsrv_query($conn, $sql_insert);

if (!$resultscreate) {
echo "Error inserting record for $fullname.<br>";
} else {
echo "Successfully inserted record for $fullname.<br>";
}


                    }

                    include '../email/ElearningEnlistment.php';
              



        }
   



            ?>
            <script>  
         alert("Submit Successfully!");               
          window.location="../technicalstandard.php";
            </script>
            <?php 

}





elseif($Action == 'commonbusinessskills'){



    
    

    
    $topic = $_POST['topic'];
    $typetraining = $_POST['typeoftraining'];
    $classification = 'CommonBusinessSkills';

    $startEnlist = isset($_POST['start_enlist_hidden']) ? $_POST['start_enlist_hidden'] : '';
    $endEnlist = isset($_POST['end_enlist_hidden']) ? $_POST['end_enlist_hidden'] : '';

    // Debug: Check if these values are being passed
    echo "Start Enlist: " . $startEnlist . "<br>";
    echo "End Enlist: " . $endEnlist . "<br>";



    $starttime = isset($_POST['starttime']) && !empty($_POST['starttime']) ? $_POST['starttime'] :'N/A';
    $endtime = isset($_POST['endtime']) && !empty($_POST['endtime']) ? $_POST['endtime'] : 'N/A';
    $startdate = isset($_POST['startdate']) && !empty($_POST['startdate']) ? $_POST['startdate'] : 'N/A';
    $enddate = isset($_POST['enddate']) && !empty($_POST['enddate']) ? $_POST['enddate'] : 'N/A';
    $meetingroom = isset($_POST['meetingroom']) && !empty($_POST['meetingroom']) ? $_POST['meetingroom'] : 'N/A';

    


    $requestorname = $_GET['requestorname'];

    $tablename= "tbl_topic_LIST_commonbusinesskill_MAINREQUEST";


    $table_skillmap= "tbl_topic_commonbusinesskill";

    $datetoday=  date("Y-m-d");

    $selectedEmployeesString = $_POST['selectedEmployeesInput']; // Retrieve selected employee numbers
    $selectedEmployees = explode(',', $selectedEmployeesString); // Convert comma-separated string to array



    

    

// Query to get the last request number
$sql_reqid = "SELECT MAX(RequestNumber) as lastReqID FROM [dbo].[tbl_topic_LIST_commonbusinesskill_MAINREQUEST]";
$stmt_reqid = sqlsrv_query($conn, $sql_reqid);

// Fetch the last request number
if ($row4 = sqlsrv_fetch_array($stmt_reqid, SQLSRV_FETCH_ASSOC)) {
    $reqlastID = $row4['lastReqID'];

    // Extract numeric part
    if ($reqlastID) {
        $parts = explode('-', $reqlastID);
        $lastNumber = (int) end($parts);
    } else {
        $lastNumber = 0;
    }

    // Generate the new request number
    $nextNumber = $lastNumber + 1;
    // Get the current date and time without separators
    $currentDateTime = date("Ymd_His");

    // Create the request ID with the current date and time
    $reqlastIDno = "TrainingRequest-CommonBusinessSkills-" . $currentDateTime . "-" . $nextNumber;
}

// Query to get the last transaction number
$sql3 = "SELECT MAX(ID) as lastID FROM tbl_trainingrequest";
$stmt3 = sqlsrv_query($conn, $sql3);
if ($row3 = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
    $lastID = $row3['lastID'];
    if ($lastID == null || $lastID == "") {
        $lastID = 0; // set to 0 if no previous records
    }
    $nextTransactionNumber = $lastID + 1;
    $transactionNumber = "REQUEST-MS2023-" . sprintf("%04d", $nextTransactionNumber);
}

foreach ($selectedEmployees as $selectedValue) {
    echo "Employee Number: $selectedValue\n";

    // Check if the combination of employee number and topic already exists
    $validationQuery = "SELECT COUNT(*) AS count FROM $tablename WHERE Employee_Number = ? AND Topic = ?";
    $validationStmt = sqlsrv_prepare($conn, $validationQuery, array(&$selectedValue, &$topic));

    if (!$validationStmt) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($validationStmt)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the validation query
    if ($row = sqlsrv_fetch_array($validationStmt, SQLSRV_FETCH_ASSOC)) {
        $count = $row['count'];

        // Debugging: Print out count to see if it's correct
        echo "Count: $count\n";

        if ($count > 0) {
            // Combination of employee number and topic already exists, skip insertion
            echo "Combination of Employee Number $selectedValue and Topic $topic already exists. Skipping...\n";
            continue; // Skip to next selected employee
        }
    }

    // If no matching combination exists, proceed with data retrieval and insertion

    // Query to retrieve email and date hired
    $selectEmailDatehired = "SELECT Email, Date_Hired FROM [dbo].[View_MasterList] WHERE EmpNo = ?";
    $selectStmtEmailDatehired = sqlsrv_prepare($conn, $selectEmailDatehired, array(&$selectedValue));

    if (!$selectStmtEmailDatehired) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($selectStmtEmailDatehired)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the SELECT query
    if ($row = sqlsrv_fetch_array($selectStmtEmailDatehired, SQLSRV_FETCH_ASSOC)) {
        // Retrieve additional information
        $email = $row['Email'];
        $datehired = $row['Date_Hired'];
    }

    // Query to retrieve additional information for the selected employee
    $selectQuery = "SELECT * FROM [dbo].[tbl_topic_LIST_commonbusinesskill] WHERE Employee_Number = ?";
    $selectStmt = sqlsrv_prepare($conn, $selectQuery, array(&$selectedValue));

    if (!$selectStmt) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($selectStmt)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the SELECT query
    if ($row = sqlsrv_fetch_array($selectStmt, SQLSRV_FETCH_ASSOC)) {
        // Retrieve additional information
        $employeename = $row['Employee_Name'];
        $employeenumber = $row['Employee_Number'];
        $section = $row['Section'];
        $position = $row['Position'];

        // Display additional information (optional)
        echo "Employee Name: $employeename, Department: $position\n";

        // Insert the selected employee number along with additional information into the database
        $insertQuery = "INSERT INTO $tablename (RequestNumber, Employee_Number, Employee_Name, Section, Position, Email, [Date Hired], Topic, [Type of Training], [Start Date], [End Date], [Start Time], [End Time], [Meeting Room], [Date_Requested], [Requestor_Name]) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = sqlsrv_prepare($conn, $insertQuery, array(
            &$reqlastIDno, &$employeenumber, &$employeename, &$section, &$position, &$email, &$datehired, &$topic, &$typetraining,
            &$startEnlist, &$endEnlist, &$starttime, &$endtime, &$meetingroom, &$datetoday, &$requestorname
        ));

        if (!$insertStmt) {
            // Handle SQL error
            die(print_r(sqlsrv_errors(), true));
        }

        // Execute the prepared statement
        if (!sqlsrv_execute($insertStmt)) {
            // Handle execution error
            die(print_r(sqlsrv_errors(), true));
        }

        // Display success message or perform any other action as needed
        echo "Employee Number $selectedValue inserted successfully!\n";
    } else {
        // Handle case where employee data could not be found
        echo "No data found for Employee Number: $selectedValue\n";
    }

    // Increment transaction number for next iteration
    $nextTransactionNumber++;
    $transactionNumber = "REQUEST-MS2023-" . sprintf("%04d", $nextTransactionNumber);
      
    }
    if($typetraining === 'E-LEARNING'){

        echo $typetraining;


         
                            
        $selected = $_POST['selectedEmployeesInput']; // Retrieve selected employee numbers
        $selectedArray = explode(',', $selectedEmployeesString); // Convert comma-separated string to array

     
        // Convert the comma-separated string to an array
        $selectedArray = explode(',', $selected);






          

// Retrieve selected employee numbers and convert to an array
$selectedEmployeesString = $_POST['selectedEmployeesInput']; 
$selectedEmployees = explode(',', $selectedEmployeesString); // Convert comma-separated string to array

// Get the topic from the POST request
$topic = $_POST['topic']; 

// Query to get the last request number
$sql_reqid = "SELECT MAX(ElearningTransID) as lastReqID FROM [dbo].[tbl_elearningstatus]";
$stmt_reqid = sqlsrv_query($conn, $sql_reqid);

// Fetch the last request number
if ($row4 = sqlsrv_fetch_array($stmt_reqid, SQLSRV_FETCH_ASSOC)) {
$reqlastID = $row4['lastReqID'];

// Extract numeric part of the last request ID
if ($reqlastID) {
$parts = explode('-', $reqlastID);
$lastNumber = (int) end($parts); // Get the last numeric part of the ID
} else {
$lastNumber = 0; // If no last request exists, start from 1
}

// Generate the new request number
$nextNumber = $lastNumber + 1;
// Get the current date and time without separators
$currentDateTime = date("Ymd_His");

// Create the new request ID
$elearningUNIQUE = "ElearningReq-" . $currentDateTime . "-" . $nextNumber;
}

// Loop through each selected employee
foreach ($selectedEmployees as $selectedEmployee) {
// Get employee details from tbl_ems
$sql_Getems = "SELECT * FROM [dbo].[tbl_ems] WHERE [EmpNo] = '$selectedEmployee'";
$result = sqlsrv_query($conn, $sql_Getems);

if ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
$empno = $row['EmpNo'];
$fullname = $row['Full_Name'];
$section = $row['Section'];
$email = $row['Email'];
} else {
// Skip if employee data is not found
echo "Employee with EmpNo $selectedEmployee not found.<br>";
continue;
}

// Check if the employee with the same Topic already exists in tbl_elearningstatus
$sql_check_existing = "SELECT * FROM [dbo].[tbl_elearningstatus] 
               WHERE Target_Employee = '$fullname' 
               AND Title = '$topic'";
$check_result = sqlsrv_query($conn, $sql_check_existing);

// Check if any rows are returned
if ($row_check = sqlsrv_fetch_array($check_result, SQLSRV_FETCH_ASSOC)) {
// If the employee with the same topic exists, skip this insertion
echo "Skipping: $fullname is already enlisted for the topic $topic.<br>";
continue; // Skip to the next employee in the array
}

// Insert the new record into tbl_elearningstatus
$sql_insert = "INSERT INTO [dbo].[tbl_elearningstatus] 
       (RequestNumber, ElearningTransID, Title, EmployeeNumber, Target_Employee, Section, Target_Date, End_Date, Elearning_Status, TotalNumber_Target, Email, Classification, table_name)
       VALUES ('$reqlastIDno', '$elearningUNIQUE', '$topic', '$empno', '$fullname', '$section', '$startEnlist', '$endEnlist', 'NOT YET', '1', '$email', '$classification', '$table_skillmap')";

$resultscreate = sqlsrv_query($conn, $sql_insert);

if (!$resultscreate) {
echo "Error inserting record for $fullname.<br>";
} else {
echo "Successfully inserted record for $fullname.<br>";
}
}

                include '../email/ElearningEnlistment.php';



    }




        ?>
        <script>  
alert("Submit Successfully!");               
  window.location="../commonbusinessskills.php";
        </script>
        <?php 

    
 

}






elseif($Action == 'companyfundamentals'){



    
    

    
    $topic = $_POST['topic'];
    $typetraining = $_POST['typeoftraining'];
    $classification = 'CompanyFundamentals';


    $startEnlist = isset($_POST['start_enlist_hidden']) ? $_POST['start_enlist_hidden'] : '';
    $endEnlist = isset($_POST['end_enlist_hidden']) ? $_POST['end_enlist_hidden'] : '';

    // Debug: Check if these values are being passed
    echo "Start Enlist: " . $startEnlist . "<br>";
    echo "End Enlist: " . $endEnlist . "<br>";


    $starttime = isset($_POST['starttime']) && !empty($_POST['starttime']) ? $_POST['starttime'] :'N/A';
    $endtime = isset($_POST['endtime']) && !empty($_POST['endtime']) ? $_POST['endtime'] : 'N/A';
    $startdate = isset($_POST['startdate']) && !empty($_POST['startdate']) ? $_POST['startdate'] : 'N/A';
    $enddate = isset($_POST['enddate']) && !empty($_POST['enddate']) ? $_POST['enddate'] : 'N/A';
    $meetingroom = isset($_POST['meetingroom']) && !empty($_POST['meetingroom']) ? $_POST['meetingroom'] : 'N/A';

    


    $requestorname = $_GET['requestorname'];

    $tablename= "tbl_topic_LIST_companyfundamentals_MAINREQUEST";


    $table_skillmap= "tbl_topic_companyfundamentals";

    $datetoday=  date("Y-m-d");

    $selectedEmployeesString = $_POST['selectedEmployeesInput']; // Retrieve selected employee numbers
    $selectedEmployees = explode(',', $selectedEmployeesString); // Convert comma-separated string to array



    

// Query to get the last request number
$sql_reqid = "SELECT MAX(RequestNumber) as lastReqID FROM [dbo].[tbl_topic_LIST_companyfundamentals_MAINREQUEST]";
$stmt_reqid = sqlsrv_query($conn, $sql_reqid);

// Fetch the last request number
if ($row4 = sqlsrv_fetch_array($stmt_reqid, SQLSRV_FETCH_ASSOC)) {
    $reqlastID = $row4['lastReqID'];

    // Extract numeric part
    if ($reqlastID) {
        $parts = explode('-', $reqlastID);
        $lastNumber = (int) end($parts);
    } else {
        $lastNumber = 0;
    }

    // Generate the new request number
    $nextNumber = $lastNumber + 1;
    // Get the current date and time without separators
    $currentDateTime = date("Ymd_His");

    // Create the request ID with the current date and time
    $reqlastIDno = "TrainingRequest-CompanyFundamentals-" . $currentDateTime . "-" . $nextNumber;
}

// Query to get the last transaction number
$sql3 = "SELECT MAX(ID) as lastID FROM tbl_trainingrequest";
$stmt3 = sqlsrv_query($conn, $sql3);
if ($row3 = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
    $lastID = $row3['lastID'];
    if ($lastID == null || $lastID == "") {
        $lastID = 0; // set to 0 if no previous records
    }
    $nextTransactionNumber = $lastID + 1;
    $transactionNumber = "REQUEST-MS2023-" . sprintf("%04d", $nextTransactionNumber);
}

foreach ($selectedEmployees as $selectedValue) {
    echo "Employee Number: $selectedValue\n";

    // Check if the combination of employee number and topic already exists
    $validationQuery = "SELECT COUNT(*) AS count FROM $tablename WHERE Employee_Number = ? AND Topic = ?";
    $validationStmt = sqlsrv_prepare($conn, $validationQuery, array(&$selectedValue, &$topic));

    if (!$validationStmt) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($validationStmt)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the validation query
    if ($row = sqlsrv_fetch_array($validationStmt, SQLSRV_FETCH_ASSOC)) {
        $count = $row['count'];

        // Debugging: Print out count to see if it's correct
        echo "Count: $count\n";

        if ($count > 0) {
            // Combination of employee number and topic already exists, skip insertion
            echo "Combination of Employee Number $selectedValue and Topic $topic already exists. Skipping...\n";
            continue; // Skip to next selected employee
        }
    }

    // If no matching combination exists, proceed with data retrieval and insertion

    // Query to retrieve email and date hired
    $selectEmailDatehired = "SELECT Email, Date_Hired FROM [dbo].[View_MasterList] WHERE EmpNo = ?";
    $selectStmtEmailDatehired = sqlsrv_prepare($conn, $selectEmailDatehired, array(&$selectedValue));

    if (!$selectStmtEmailDatehired) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($selectStmtEmailDatehired)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the SELECT query
    if ($row = sqlsrv_fetch_array($selectStmtEmailDatehired, SQLSRV_FETCH_ASSOC)) {
        // Retrieve additional information
        $email = $row['Email'];
        $datehired = $row['Date_Hired'];
    }

    // Query to retrieve additional information for the selected employee
    $selectQuery = "SELECT * FROM [dbo].[tbl_topic_LIST_companyfundamentals] WHERE Employee_Number = ?";
    $selectStmt = sqlsrv_prepare($conn, $selectQuery, array(&$selectedValue));

    if (!$selectStmt) {
        // Handle SQL error
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the prepared statement
    if (!sqlsrv_execute($selectStmt)) {
        // Handle execution error
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the result of the SELECT query
    if ($row = sqlsrv_fetch_array($selectStmt, SQLSRV_FETCH_ASSOC)) {
        // Retrieve additional information
        $employeename = $row['Employee_Name'];
        $employeenumber = $row['Employee_Number'];
        $section = $row['Section'];
        $position = $row['Position'];

        // Display additional information (optional)
        echo "Employee Name: $employeename, Department: $position\n";

        // Insert the selected employee number along with additional information into the database
        $insertQuery = "INSERT INTO $tablename (RequestNumber, Employee_Number, Employee_Name, Section, Position, Email, [Date Hired], Topic, [Type of Training], [Start Date], [End Date], [Start Time], [End Time], [Meeting Room], [Date_Requested], [Requestor_Name]) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = sqlsrv_prepare($conn, $insertQuery, array(
            &$reqlastIDno, &$employeenumber, &$employeename, &$section, &$position, &$email, &$datehired, &$topic, &$typetraining,
            &$startEnlist, &$endEnlist, &$starttime, &$endtime, &$meetingroom, &$datetoday, &$requestorname
        ));

        if (!$insertStmt) {
            // Handle SQL error
            die(print_r(sqlsrv_errors(), true));
        }

        // Execute the prepared statement
        if (!sqlsrv_execute($insertStmt)) {
            // Handle execution error
            die(print_r(sqlsrv_errors(), true));
        }

        // Display success message or perform any other action as needed
        echo "Employee Number $selectedValue inserted successfully!\n";
    } else {
        // Handle case where employee data could not be found
        echo "No data found for Employee Number: $selectedValue\n";
    }

    // Increment transaction number for next iteration
    $nextTransactionNumber++;
    $transactionNumber = "REQUEST-MS2023-" . sprintf("%04d", $nextTransactionNumber);
      

    }
    if($typetraining === 'E-LEARNING'){

        echo $typetraining;


         
                            
        $selected = $_POST['selectedEmployeesInput']; // Retrieve selected employee numbers
        $selectedArray = explode(',', $selectedEmployeesString); // Convert comma-separated string to array

     
        // Convert the comma-separated string to an array
        $selectedArray = explode(',', $selected);






          

// Retrieve selected employee numbers and convert to an array
$selectedEmployeesString = $_POST['selectedEmployeesInput']; 
$selectedEmployees = explode(',', $selectedEmployeesString); // Convert comma-separated string to array

// Get the topic from the POST request
$topic = $_POST['topic']; 

// Query to get the last request number
$sql_reqid = "SELECT MAX(ElearningTransID) as lastReqID FROM [dbo].[tbl_elearningstatus]";
$stmt_reqid = sqlsrv_query($conn, $sql_reqid);

// Fetch the last request number
if ($row4 = sqlsrv_fetch_array($stmt_reqid, SQLSRV_FETCH_ASSOC)) {
$reqlastID = $row4['lastReqID'];

// Extract numeric part of the last request ID
if ($reqlastID) {
$parts = explode('-', $reqlastID);
$lastNumber = (int) end($parts); // Get the last numeric part of the ID
} else {
$lastNumber = 0; // If no last request exists, start from 1
}

// Generate the new request number
$nextNumber = $lastNumber + 1;
// Get the current date and time without separators
$currentDateTime = date("Ymd_His");

// Create the new request ID
$elearningUNIQUE = "ElearningReq-" . $currentDateTime . "-" . $nextNumber;
}

// Loop through each selected employee
foreach ($selectedEmployees as $selectedEmployee) {
// Get employee details from tbl_ems
$sql_Getems = "SELECT * FROM [dbo].[tbl_ems] WHERE [EmpNo] = '$selectedEmployee'";
$result = sqlsrv_query($conn, $sql_Getems);

if ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
$empno = $row['EmpNo'];
$fullname = $row['Full_Name'];
$section = $row['Section'];
$email = $row['Email'];
} else {
// Skip if employee data is not found
echo "Employee with EmpNo $selectedEmployee not found.<br>";
continue;
}

// Check if the employee with the same Topic already exists in tbl_elearningstatus
$sql_check_existing = "SELECT * FROM [dbo].[tbl_elearningstatus] 
               WHERE Target_Employee = '$fullname' 
               AND Title = '$topic'";
$check_result = sqlsrv_query($conn, $sql_check_existing);

// Check if any rows are returned
if ($row_check = sqlsrv_fetch_array($check_result, SQLSRV_FETCH_ASSOC)) {
// If the employee with the same topic exists, skip this insertion
echo "Skipping: $fullname is already enlisted for the topic $topic.<br>";
continue; // Skip to the next employee in the array
}

// Insert the new record into tbl_elearningstatus
$sql_insert = "INSERT INTO [dbo].[tbl_elearningstatus] 
       (RequestNumber, ElearningTransID, Title, EmployeeNumber, Target_Employee, Section, Target_Date, End_Date, Elearning_Status, TotalNumber_Target, Email, Classification, table_name)
       VALUES ('$reqlastIDno', '$elearningUNIQUE', '$topic', '$empno', '$fullname', '$section', '$startEnlist', '$endEnlist', 'NOT YET', '1', '$email', '$classification', '$table_skillmap')";

$resultscreate = sqlsrv_query($conn, $sql_insert);

if (!$resultscreate) {
echo "Error inserting record for $fullname.<br>";
} else {
echo "Successfully inserted record for $fullname.<br>";
}
                    
                }


                include '../email/ElearningEnlistment.php';



    }




        ?>
        <script>  
alert("Submit Successfully!");               
  window.location="../companyfundamentals.php";
        </script>
        <?php 

    
 

}


elseif($Action == 'commontrainingRemove'){


    
  
     // Retrieve parameters from the URL (assuming they are passed via GET)
     $selectedItemIds = isset($_GET['selectedItemId']) ? $_GET['selectedItemId'] : '';
     $topics = isset($_GET['topics']) ? $_GET['topics'] : '';
     $names = isset($_GET['names']) ? $_GET['names'] : '';
     
     // Explode the values into arrays
     $itemIdsArray = explode(',', $selectedItemIds);
     $topicsArray = explode(',', $topics);
     $namesArray = explode(',', $names);
     
     // Check if the arrays have the same length
     if (count($topicsArray) !== count($namesArray)) {
         die('Error: Topics and Names arrays do not have the same length.');
     }
   
     
     // Handle deletion from the first table (using ID)
     foreach ($itemIdsArray as $arrayVal) {
         $arrayVal = trim($arrayVal);
     
         if (!empty($arrayVal)) {
             // Perform deletion from the first table (tbl_topic_LIST_hashira_MAINREQUEST)
             $query_remove = "DELETE FROM [dbo].[tbl_topic_LIST_commontraining_MAINREQUEST] WHERE [ID] = ?";
             $params = array($arrayVal);
             $stmt = sqlsrv_query($conn, $query_remove, $params);
     
             if ($stmt === false) {
                 // Handle query execution error
                 die(print_r(sqlsrv_errors(), true));
             }
         }
     }
     
     // Handle deletion from the second table (using Topic and Employee Name)
     foreach ($topicsArray as $index => $topic) {
         $topic = trim($topic);
         $name = isset($namesArray[$index]) ? trim($namesArray[$index]) : ''; // Get the corresponding name for the topic
     
         // Only proceed if both topic and name are not empty
         if (!empty($topic) && !empty($name)) {
             // Perform deletion from the second table (tbl_elearningstatus)
             $query_removeElearning = "DELETE FROM [dbo].[tbl_elearningstatus] WHERE [Title] = ? AND [Target_Employee] = ?";
             $params_elearning = array($topic, $name);
             $stmt2 = sqlsrv_query($conn, $query_removeElearning, $params_elearning);
     
             if ($stmt2 === false) {
                 // Handle query execution error
                 echo "Error deleting from tbl_elearningstatus for Topic: $topic, Name: $name.<br>";
                 die(print_r(sqlsrv_errors(), true));
             } else {
                 echo "Deleted record from tbl_elearningstatus for Topic: $topic, Name: $name.<br>";  // Debugging output
             }
         } else {
             echo "Skipping deletion for Topic: $topic, Name: $name because they are empty.<br>";  // Debugging output
         }
     }
  

    

    ?>
    <script>  
    alert("Remove Successfully!");               
     window.location="../commontraining.php";
    </script>
    <?php 
  

   



}


elseif($Action == 'workstandardRemove'){


     // Retrieve parameters from the URL (assuming they are passed via GET)
     $selectedItemIds = isset($_GET['selectedItemId']) ? $_GET['selectedItemId'] : '';
     $topics = isset($_GET['topics']) ? $_GET['topics'] : '';
     $names = isset($_GET['names']) ? $_GET['names'] : '';
     
     // Explode the values into arrays
     $itemIdsArray = explode(',', $selectedItemIds);
     $topicsArray = explode(',', $topics);
     $namesArray = explode(',', $names);
     
     // Check if the arrays have the same length
     if (count($topicsArray) !== count($namesArray)) {
         die('Error: Topics and Names arrays do not have the same length.');
     }
   
     
     // Handle deletion from the first table (using ID)
     foreach ($itemIdsArray as $arrayVal) {
         $arrayVal = trim($arrayVal);
     
         if (!empty($arrayVal)) {
             // Perform deletion from the first table (tbl_topic_LIST_hashira_MAINREQUEST)
             $query_remove = "DELETE FROM [dbo].[tbl_topic_LIST_workstandard_MAINREQUEST] WHERE [ID] = ?";
             $params = array($arrayVal);
             $stmt = sqlsrv_query($conn, $query_remove, $params);
     
             if ($stmt === false) {
                 // Handle query execution error
                 die(print_r(sqlsrv_errors(), true));
             }
         }
     }
     
     // Handle deletion from the second table (using Topic and Employee Name)
     foreach ($topicsArray as $index => $topic) {
         $topic = trim($topic);
         $name = isset($namesArray[$index]) ? trim($namesArray[$index]) : ''; // Get the corresponding name for the topic
     
         // Only proceed if both topic and name are not empty
         if (!empty($topic) && !empty($name)) {
             // Perform deletion from the second table (tbl_elearningstatus)
             $query_removeElearning = "DELETE FROM [dbo].[tbl_elearningstatus] WHERE [Title] = ? AND [Target_Employee] = ?";
             $params_elearning = array($topic, $name);
             $stmt2 = sqlsrv_query($conn, $query_removeElearning, $params_elearning);
     
             if ($stmt2 === false) {
                 // Handle query execution error
                 echo "Error deleting from tbl_elearningstatus for Topic: $topic, Name: $name.<br>";
                 die(print_r(sqlsrv_errors(), true));
             } else {
                 echo "Deleted record from tbl_elearningstatus for Topic: $topic, Name: $name.<br>";  // Debugging output
             }
         } else {
             echo "Skipping deletion for Topic: $topic, Name: $name because they are empty.<br>";  // Debugging output
         }
     }
     

    

    ?>
    <script>  
    alert("Remove Successfully!");               
     window.location="../workstandard.php";
    </script>
    <?php 



}


elseif($Action == 'qualityanalysisRemove'){


    
     // Retrieve parameters from the URL (assuming they are passed via GET)
     $selectedItemIds = isset($_GET['selectedItemId']) ? $_GET['selectedItemId'] : '';
     $topics = isset($_GET['topics']) ? $_GET['topics'] : '';
     $names = isset($_GET['names']) ? $_GET['names'] : '';
     
     // Explode the values into arrays
     $itemIdsArray = explode(',', $selectedItemIds);
     $topicsArray = explode(',', $topics);
     $namesArray = explode(',', $names);
     
     // Check if the arrays have the same length
     if (count($topicsArray) !== count($namesArray)) {
         die('Error: Topics and Names arrays do not have the same length.');
     }
   
     
     // Handle deletion from the first table (using ID)
     foreach ($itemIdsArray as $arrayVal) {
         $arrayVal = trim($arrayVal);
     
         if (!empty($arrayVal)) {
             // Perform deletion from the first table (tbl_topic_LIST_hashira_MAINREQUEST)
             $query_remove = "DELETE FROM [dbo].[tbl_topic_LIST_qualityanalysis_MAINREQUEST] WHERE [ID] = ?";
             $params = array($arrayVal);
             $stmt = sqlsrv_query($conn, $query_remove, $params);
     
             if ($stmt === false) {
                 // Handle query execution error
                 die(print_r(sqlsrv_errors(), true));
             }
         }
     }
     
     // Handle deletion from the second table (using Topic and Employee Name)
     foreach ($topicsArray as $index => $topic) {
         $topic = trim($topic);
         $name = isset($namesArray[$index]) ? trim($namesArray[$index]) : ''; // Get the corresponding name for the topic
     
         // Only proceed if both topic and name are not empty
         if (!empty($topic) && !empty($name)) {
             // Perform deletion from the second table (tbl_elearningstatus)
             $query_removeElearning = "DELETE FROM [dbo].[tbl_elearningstatus] WHERE [Title] = ? AND [Target_Employee] = ?";
             $params_elearning = array($topic, $name);
             $stmt2 = sqlsrv_query($conn, $query_removeElearning, $params_elearning);
     
             if ($stmt2 === false) {
                 // Handle query execution error
                 echo "Error deleting from tbl_elearningstatus for Topic: $topic, Name: $name.<br>";
                 die(print_r(sqlsrv_errors(), true));
             } else {
                 echo "Deleted record from tbl_elearningstatus for Topic: $topic, Name: $name.<br>";  // Debugging output
             }
         } else {
             echo "Skipping deletion for Topic: $topic, Name: $name because they are empty.<br>";  // Debugging output
         }
     }
     


    

    ?>
    <script>  
    alert("Remove Successfully!");               
     window.location="../qualityanalysis.php";
    </script>
    <?php 



}


elseif($Action == 'mgtgroupregulationRemove'){


    
     // Retrieve parameters from the URL (assuming they are passed via GET)
     $selectedItemIds = isset($_GET['selectedItemId']) ? $_GET['selectedItemId'] : '';
     $topics = isset($_GET['topics']) ? $_GET['topics'] : '';
     $names = isset($_GET['names']) ? $_GET['names'] : '';
     
     // Explode the values into arrays
     $itemIdsArray = explode(',', $selectedItemIds);
     $topicsArray = explode(',', $topics);
     $namesArray = explode(',', $names);
     
     // Check if the arrays have the same length
     if (count($topicsArray) !== count($namesArray)) {
         die('Error: Topics and Names arrays do not have the same length.');
     }
   
     
     // Handle deletion from the first table (using ID)
     foreach ($itemIdsArray as $arrayVal) {
         $arrayVal = trim($arrayVal);
     
         if (!empty($arrayVal)) {
             // Perform deletion from the first table (tbl_topic_LIST_hashira_MAINREQUEST)
             $query_remove = "DELETE FROM [dbo].[tbl_topic_LIST_mgtgroupregulation_MAINREQUEST] WHERE [ID] = ?";
             $params = array($arrayVal);
             $stmt = sqlsrv_query($conn, $query_remove, $params);
     
             if ($stmt === false) {
                 // Handle query execution error
                 die(print_r(sqlsrv_errors(), true));
             }
         }
     }
     
     // Handle deletion from the second table (using Topic and Employee Name)
     foreach ($topicsArray as $index => $topic) {
         $topic = trim($topic);
         $name = isset($namesArray[$index]) ? trim($namesArray[$index]) : ''; // Get the corresponding name for the topic
     
         // Only proceed if both topic and name are not empty
         if (!empty($topic) && !empty($name)) {
             // Perform deletion from the second table (tbl_elearningstatus)
             $query_removeElearning = "DELETE FROM [dbo].[tbl_elearningstatus] WHERE [Title] = ? AND [Target_Employee] = ?";
             $params_elearning = array($topic, $name);
             $stmt2 = sqlsrv_query($conn, $query_removeElearning, $params_elearning);
     
             if ($stmt2 === false) {
                 // Handle query execution error
                 echo "Error deleting from tbl_elearningstatus for Topic: $topic, Name: $name.<br>";
                 die(print_r(sqlsrv_errors(), true));
             } else {
                 echo "Deleted record from tbl_elearningstatus for Topic: $topic, Name: $name.<br>";  // Debugging output
             }
         } else {
             echo "Skipping deletion for Topic: $topic, Name: $name because they are empty.<br>";  // Debugging output
         }
     }
  

    

    ?>
    <script>  
    alert("Remove Successfully!");               
     window.location="../mgtgroupregulation.php";
    </script>
    <?php 



}



elseif($Action == 'prodhashiraRemove'){

     // Retrieve parameters from the URL (assuming they are passed via GET)
     $selectedItemIds = isset($_GET['selectedItemId']) ? $_GET['selectedItemId'] : '';
     $topics = isset($_GET['topics']) ? $_GET['topics'] : '';
     $names = isset($_GET['names']) ? $_GET['names'] : '';
     
     // Explode the values into arrays
     $itemIdsArray = explode(',', $selectedItemIds);
     $topicsArray = explode(',', $topics);
     $namesArray = explode(',', $names);
     
     // Check if the arrays have the same length
     if (count($topicsArray) !== count($namesArray)) {
         die('Error: Topics and Names arrays do not have the same length.');
     }
   
     
     // Handle deletion from the first table (using ID)
     foreach ($itemIdsArray as $arrayVal) {
         $arrayVal = trim($arrayVal);
     
         if (!empty($arrayVal)) {
             // Perform deletion from the first table (tbl_topic_LIST_hashira_MAINREQUEST)
             $query_remove = "DELETE FROM [dbo].[tbl_topic_LIST_hashira_MAINREQUEST] WHERE [ID] = ?";
             $params = array($arrayVal);
             $stmt = sqlsrv_query($conn, $query_remove, $params);
     
             if ($stmt === false) {
                 // Handle query execution error
                 die(print_r(sqlsrv_errors(), true));
             }
         }
     }
     
     // Handle deletion from the second table (using Topic and Employee Name)
     foreach ($topicsArray as $index => $topic) {
         $topic = trim($topic);
         $name = isset($namesArray[$index]) ? trim($namesArray[$index]) : ''; // Get the corresponding name for the topic
     
         // Only proceed if both topic and name are not empty
         if (!empty($topic) && !empty($name)) {
             // Perform deletion from the second table (tbl_elearningstatus)
             $query_removeElearning = "DELETE FROM [dbo].[tbl_elearningstatus] WHERE [Title] = ? AND [Target_Employee] = ?";
             $params_elearning = array($topic, $name);
             $stmt2 = sqlsrv_query($conn, $query_removeElearning, $params_elearning);
     
             if ($stmt2 === false) {
                 // Handle query execution error
                 echo "Error deleting from tbl_elearningstatus for Topic: $topic, Name: $name.<br>";
                 die(print_r(sqlsrv_errors(), true));
             } else {
                 echo "Deleted record from tbl_elearningstatus for Topic: $topic, Name: $name.<br>";  // Debugging output
             }
         } else {
             echo "Skipping deletion for Topic: $topic, Name: $name because they are empty.<br>";  // Debugging output
         }
     }
     


  
    

    ?>
    <script>  
    alert("Remove Successfully!");               
     window.location="../hashira.php";
    </script>
    <?php 



}




elseif($Action == 'PCBAprodhashiraRemove'){


    
    $selectedItemId = $_GET['selectedItemId'];

    // Explode the string to get an array of IDs
    $myArray = explode(',', $selectedItemId);
 
  

    
    foreach($myArray as $arrayVal){


        $arrayVal = trim($arrayVal);
 
               
       // Perform the deletion query
    $query_remove = "DELETE FROM [dbo].[tbl_elearningstatus] WHERE [ID] = ?";
    $params = array($arrayVal);
    $stmt = sqlsrv_query($conn, $query_remove, $params);

    if ($stmt === false) {
        // Handle query execution error
        die(print_r(sqlsrv_errors(), true));
    }
                  
    
    }  
  
  
    

    ?>
    <script>  
    alert("Remove Successfully!");               
     window.location="../pcba_enlistment.php";
    </script>
    <?php 



}


elseif($Action == 'technicalstandardRemove'){


     // Retrieve parameters from the URL (assuming they are passed via GET)
     $selectedItemIds = isset($_GET['selectedItemId']) ? $_GET['selectedItemId'] : '';
     $topics = isset($_GET['topics']) ? $_GET['topics'] : '';
     $names = isset($_GET['names']) ? $_GET['names'] : '';
     
     // Explode the values into arrays
     $itemIdsArray = explode(',', $selectedItemIds);
     $topicsArray = explode(',', $topics);
     $namesArray = explode(',', $names);
     
     // Check if the arrays have the same length
     if (count($topicsArray) !== count($namesArray)) {
         die('Error: Topics and Names arrays do not have the same length.');
     }
   
     
     // Handle deletion from the first table (using ID)
     foreach ($itemIdsArray as $arrayVal) {
         $arrayVal = trim($arrayVal);
     
         if (!empty($arrayVal)) {
             // Perform deletion from the first table (tbl_topic_LIST_hashira_MAINREQUEST)
             $query_remove = "DELETE FROM [dbo].[tbl_topic_LIST_technicalstandard_MAINREQUEST] WHERE [ID] = ?";
             $params = array($arrayVal);
             $stmt = sqlsrv_query($conn, $query_remove, $params);
     
             if ($stmt === false) {
                 // Handle query execution error
                 die(print_r(sqlsrv_errors(), true));
             }
         }
     }
     
     // Handle deletion from the second table (using Topic and Employee Name)
     foreach ($topicsArray as $index => $topic) {
         $topic = trim($topic);
         $name = isset($namesArray[$index]) ? trim($namesArray[$index]) : ''; // Get the corresponding name for the topic
     
         // Only proceed if both topic and name are not empty
         if (!empty($topic) && !empty($name)) {
             // Perform deletion from the second table (tbl_elearningstatus)
             $query_removeElearning = "DELETE FROM [dbo].[tbl_elearningstatus] WHERE [Title] = ? AND [Target_Employee] = ?";
             $params_elearning = array($topic, $name);
             $stmt2 = sqlsrv_query($conn, $query_removeElearning, $params_elearning);
     
             if ($stmt2 === false) {
                 // Handle query execution error
                 echo "Error deleting from tbl_elearningstatus for Topic: $topic, Name: $name.<br>";
                 die(print_r(sqlsrv_errors(), true));
             } else {
                 echo "Deleted record from tbl_elearningstatus for Topic: $topic, Name: $name.<br>";  // Debugging output
             }
         } else {
             echo "Skipping deletion for Topic: $topic, Name: $name because they are empty.<br>";  // Debugging output
         }
     }
     
  
    

    ?>
    <script>  
    alert("Remove Successfully!");               
     window.location="../technicalstandard.php";
    </script>
    <?php 



}



elseif($Action == 'commonbusinessskillsRemove'){


     // Retrieve parameters from the URL (assuming they are passed via GET)
     $selectedItemIds = isset($_GET['selectedItemId']) ? $_GET['selectedItemId'] : '';
     $topics = isset($_GET['topics']) ? $_GET['topics'] : '';
     $names = isset($_GET['names']) ? $_GET['names'] : '';
     
     // Explode the values into arrays
     $itemIdsArray = explode(',', $selectedItemIds);
     $topicsArray = explode(',', $topics);
     $namesArray = explode(',', $names);
     
     // Check if the arrays have the same length
     if (count($topicsArray) !== count($namesArray)) {
         die('Error: Topics and Names arrays do not have the same length.');
     }
   
     
     // Handle deletion from the first table (using ID)
     foreach ($itemIdsArray as $arrayVal) {
         $arrayVal = trim($arrayVal);
     
         if (!empty($arrayVal)) {
             // Perform deletion from the first table (tbl_topic_LIST_hashira_MAINREQUEST)
             $query_remove = "DELETE FROM [dbo].[tbl_topic_LIST_commonbusinesskill_MAINREQUEST] WHERE [ID] = ?";
             $params = array($arrayVal);
             $stmt = sqlsrv_query($conn, $query_remove, $params);
     
             if ($stmt === false) {
                 // Handle query execution error
                 die(print_r(sqlsrv_errors(), true));
             }
         }
     }
     
     // Handle deletion from the second table (using Topic and Employee Name)
     foreach ($topicsArray as $index => $topic) {
         $topic = trim($topic);
         $name = isset($namesArray[$index]) ? trim($namesArray[$index]) : ''; // Get the corresponding name for the topic
     
         // Only proceed if both topic and name are not empty
         if (!empty($topic) && !empty($name)) {
             // Perform deletion from the second table (tbl_elearningstatus)
             $query_removeElearning = "DELETE FROM [dbo].[tbl_elearningstatus] WHERE [Title] = ? AND [Target_Employee] = ?";
             $params_elearning = array($topic, $name);
             $stmt2 = sqlsrv_query($conn, $query_removeElearning, $params_elearning);
     
             if ($stmt2 === false) {
                 // Handle query execution error
                 echo "Error deleting from tbl_elearningstatus for Topic: $topic, Name: $name.<br>";
                 die(print_r(sqlsrv_errors(), true));
             } else {
                 echo "Deleted record from tbl_elearningstatus for Topic: $topic, Name: $name.<br>";  // Debugging output
             }
         } else {
             echo "Skipping deletion for Topic: $topic, Name: $name because they are empty.<br>";  // Debugging output
         }
     }
     
  
  
    

    ?>
    <script>  
    alert("Remove Successfully!");               
     window.location="../commonbusinessskills.php";
    </script>
    <?php 



}


elseif($Action == 'companyfundamentalsRemove'){

    // Retrieve parameters from the URL (assuming they are passed via GET)
    $selectedItemIds = isset($_GET['selectedItemId']) ? $_GET['selectedItemId'] : '';
    $topics = isset($_GET['topics']) ? $_GET['topics'] : '';
    $names = isset($_GET['names']) ? $_GET['names'] : '';
    
    // Explode the values into arrays
    $itemIdsArray = explode(',', $selectedItemIds);
    $topicsArray = explode(',', $topics);
    $namesArray = explode(',', $names);
    
    // Check if the arrays have the same length
    if (count($topicsArray) !== count($namesArray)) {
        die('Error: Topics and Names arrays do not have the same length.');
    }
  
    
    // Handle deletion from the first table (using ID)
    foreach ($itemIdsArray as $arrayVal) {
        $arrayVal = trim($arrayVal);
    
        if (!empty($arrayVal)) {
            // Perform deletion from the first table (tbl_topic_LIST_hashira_MAINREQUEST)
            $query_remove = "DELETE FROM [dbo].[tbl_topic_LIST_companyfundamentals_MAINREQUEST] WHERE [ID] = ?";
            $params = array($arrayVal);
            $stmt = sqlsrv_query($conn, $query_remove, $params);
    
            if ($stmt === false) {
                // Handle query execution error
                die(print_r(sqlsrv_errors(), true));
            }
        }
    }
    
    // Handle deletion from the second table (using Topic and Employee Name)
    foreach ($topicsArray as $index => $topic) {
        $topic = trim($topic);
        $name = isset($namesArray[$index]) ? trim($namesArray[$index]) : ''; // Get the corresponding name for the topic
    
        // Only proceed if both topic and name are not empty
        if (!empty($topic) && !empty($name)) {
            // Perform deletion from the second table (tbl_elearningstatus)
            $query_removeElearning = "DELETE FROM [dbo].[tbl_elearningstatus] WHERE [Title] = ? AND [Target_Employee] = ?";
            $params_elearning = array($topic, $name);
            $stmt2 = sqlsrv_query($conn, $query_removeElearning, $params_elearning);
    
            if ($stmt2 === false) {
                // Handle query execution error
                echo "Error deleting from tbl_elearningstatus for Topic: $topic, Name: $name.<br>";
                die(print_r(sqlsrv_errors(), true));
            } else {
                echo "Deleted record from tbl_elearningstatus for Topic: $topic, Name: $name.<br>";  // Debugging output
            }
        } else {
            echo "Skipping deletion for Topic: $topic, Name: $name because they are empty.<br>";  // Debugging output
        }
    }
    
 
 
  
  
    

    ?>
    <script>  
    alert("Remove Successfully!");               
     window.location="../companyfundamentals.php";
    </script>
    <?php 



}


elseif($Action == 'newstafftraining'){

// Ensure required POST data is available and is an array
if (isset($_POST['training_pic'], $_POST['date_today'], $_POST['date_tomorrow'], $_POST['examination_score']) && isset($_GET['requestnumber'])) {

    // Validate if the POST data are arrays
    if (!is_array($_POST['training_pic']) || !is_array($_POST['date_today']) || !is_array($_POST['date_tomorrow']) || !is_array($_POST['examination_score'])) {
        die("Error: The form fields must be arrays.");
    }

    // Get the RequestNumber from the URL
    $requestNumber = $_GET['requestnumber'];
 

    // Fetch the form data
    $trainingPIC = $_POST['training_pic']; // Array of selected PICs
    $scheduledDate = $_POST['date_today']; // Array of scheduled dates
    $implementedOn = $_POST['date_tomorrow']; // Array of implemented dates
    $examinationScores = $_POST['examination_score']; // Array of examination scores
   

    $empno = $_GET['empno'];
    $empname = $_GET['empname'];
    $recorder = $_GET['recorder'];



    // Define the training contents with max scores (static list)
    $trainingContents = array(
        'Production Basic Knowledge' => 10,
        'Indirect Materials Management' => 10,
        'Daily and Monthly Production Management' => 10,
        'Work Instruction Application' => 10,
        'Duties of Line Leader' => 10,
        'CPK' => 10,
        'Yellow Card and Machine No. Control' => 10,
        'Production Changes in Specification' => 7,
        'NG Defect Handling (P and K Defect)' => 8,
        'Pokayoke Discussion' => 15,
        'Man Hour Management' => 20,
        'Work Force Planning and Operation' => 10,
        'Flow of Production Planning' => 10
    );

    // Check if the arrays have the same length as trainingContents
    $expectedCount = count($trainingContents);
    if (count($trainingPIC) !== $expectedCount || count($scheduledDate) !== $expectedCount || count($implementedOn) !== $expectedCount || count($examinationScores) !== $expectedCount) {
        die("Error: The form data arrays do not match the expected length.");
    }

    // Flag to track if any error occurred during insertions
    $allInsertsSuccessful = true;

    // Loop through each training content and insert into the database
    $index = 0;
    foreach ($trainingContents as $trainingContent => $maxScore) {
        // Ensure that all values for this index exist
        $pic = isset($trainingPIC[$index]) ? $trainingPIC[$index] : '';
        $scheduled = isset($scheduledDate[$index]) ? $scheduledDate[$index] : '';
        $implemented = isset($implementedOn[$index]) ? $implementedOn[$index] : '';
        $examScore = isset($examinationScores[$index]) ? $examinationScores[$index] : 0;
            
            // Calculate 80% of the max score for this training content
            $passScore = $maxScore * 0.80;  // 80% of the max score
            $evaluationResult = $examScore >= $passScore ? 'Pass' : 'Fail';  // Pass if the score is >= 80% of max score

            // Skip if any required value is missing
            if (empty($pic) || empty($scheduled) || empty($implemented) || $examScore === 0) {
                echo "Warning: Missing data for training content: $trainingContent. Skipping this entry.<br>";
                $allInsertsSuccessful = false; // Mark as failure for subsequent actions
                continue;
            }
        // SQL Query to insert data into the database
        $sql = "
            INSERT INTO tbl_newstaff_records (
                RequestNumber, 
                Target_EmployeeNumber,
                Target_EmployeeName,
                Recorder,
                TrainingContent, 
                TrainingPIC, 
                ScheduledDate, 
                ImplementedOn, 
                ExaminationScore, 
                EvaluationResult
               
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)
        ";

        // Parameters for the SQL query
        $params = array(
            $requestNumber, 
            $empno,
            $empname,
            $recorder,
            $trainingContent, 
            $pic, 
            $scheduled,  // Scheduled Date for each content
            $implemented,  // Implemented On for each content
            $examScore, 
            $evaluationResult
         
        );

        // Execute the SQL query
        $stmt = sqlsrv_query($conn, $sql, $params);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $index++;
    }

    // If all insertions were successful, update the status in the tbl_transactions table
    if ($allInsertsSuccessful) {
        // SQL Query to update the status to 'DONE'
        $updateSql = "
            UPDATE tbl_trainingrequest
            SET StatusTransaction = 'DONE'
            WHERE RequestNumber = ? AND [Employee Name] = ?
        ";

        // Execute the update query
        $updateStmt = sqlsrv_query($conn, $updateSql, array($requestNumber,$empname));
        if ($updateStmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        echo "Success: Data inserted and status updated.";
    } else {
        echo "Error: Some entries were skipped due to missing data.";
    }

    ?>
    <script>  
    alert("Save Successfully!");               
    window.location="../trainingresult-newstaff.php";
    </script>
    
    <?php
   
    
    // Redirect after successful submission
    // header("Location: success_page.php");
    exit;
} else {
    die("Error: Missing required form data.");
}


}






elseif($Action == 'RemoveTrainingPIC'){


    
    if (isset($_GET['selectedItemId'])) {
        // Get the selected full names (comma-separated string)
        $selectedItemId = $_GET['selectedItemId'];
        
        // Explode the string to get an array of full names
        $fullnamesArray = explode(',', $selectedItemId);

        if ($conn === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        // Create a dynamic list of placeholders for the IN clause
        $placeholders = implode(',', array_fill(0, count($fullnamesArray), '?'));

        // SQL query to delete employee details for multiple full names
        $sql = "
        -- Delete from tbl_topic_LIST_commonbusinesskill
        DELETE FROM [dbo].[tbl_topic_LIST_commonbusinesskill]
        WHERE Employee_Name IN ($placeholders);
        
        -- Delete from tbl_topic_LIST_commontraining
        DELETE FROM [dbo].[tbl_topic_LIST_commontraining]
        WHERE Employee_Name IN ($placeholders);
        
        -- Delete from tbl_topic_LIST_companyfundamentals
        DELETE FROM [dbo].[tbl_topic_LIST_companyfundamentals]
        WHERE Employee_Name IN ($placeholders);
        
        -- Delete from tbl_topic_LIST_hashira
        DELETE FROM [dbo].[tbl_topic_LIST_hashira]
        WHERE Employee_Name IN ($placeholders);
        
        -- Delete from tbl_topic_LIST_mgtgroupregulation
        DELETE FROM [dbo].[tbl_topic_LIST_mgtgroupregulation]
        WHERE Employee_Name IN ($placeholders);
        
        -- Delete from tbl_topic_LIST_qualityanalysis
        DELETE FROM [dbo].[tbl_topic_LIST_qualityanalysis]
        WHERE Employee_Name IN ($placeholders);
        
        -- Delete from tbl_topic_LIST_technicalskill
        DELETE FROM [dbo].[tbl_topic_LIST_technicalskill]
        WHERE Employee_Name IN ($placeholders);
        
        -- Delete from tbl_topic_LIST_technicalstandard
        DELETE FROM [dbo].[tbl_topic_LIST_technicalstandard]
        WHERE Employee_Name IN ($placeholders);
        
        -- Delete from tbl_topic_LIST_workstandard
        DELETE FROM [dbo].[tbl_topic_LIST_workstandard]
        WHERE Employee_Name IN ($placeholders);


          DELETE FROM [dbo].[tbl_accounts]
        WHERE Full_Name IN ($placeholders);



        ";

        // Prepare the parameters, repeating for each table query
        $params = array_merge(
            $fullnamesArray, // For tbl_topic_LIST_commonbusinesskill
            $fullnamesArray, // For tbl_topic_LIST_commontraining
            $fullnamesArray, // For tbl_topic_LIST_companyfundamentals
            $fullnamesArray, // For tbl_topic_LIST_hashira
            $fullnamesArray, // For tbl_topic_LIST_mgtgroupregulation
            $fullnamesArray, // For tbl_topic_LIST_qualityanalysis
            $fullnamesArray, // For tbl_topic_LIST_technicalskill
            $fullnamesArray, // For tbl_topic_LIST_technicalstandard
            $fullnamesArray, // For tbl_topic_LIST_technicalstandard
            $fullnamesArray  // For tbl_topic_LIST_workstandard
        );

        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        // Close the connection
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
        ?>
        <script>  
        alert("Deleted Successfully!");               
        window.location="../adminmodule.php";
        </script>
        <?php
        exit();
    } else {
        echo "Invalid parameters.";
    }


  

   



}



elseif($Action == 'EditTrainingPIC'){

    if (isset($_GET['action']) && $_GET['action'] === 'EditTrainingPIC') {
        if (isset($_GET['selectedItemId']) && isset($_GET['fullname'])&& isset($_GET['section'])) {
            $selectedItemId = $_GET['selectedItemId'];
            $fullname = $_GET['fullname'];
       
      
            $sectionupdate = $_GET['section'];
    
        
            if ($conn === false) {
                die(print_r(sqlsrv_errors(), true));
            }
    
            // SQL query to update employee details
            $sql = "
            -- Update tbl_topic_LIST_commonbusinesskill
            UPDATE [dbo].[tbl_topic_LIST_commonbusinesskill]
            SET Section = ?
            WHERE Employee_Name = ?;
        
            -- Update tbl_topic_LIST_commontraining
            UPDATE [dbo].[tbl_topic_LIST_commontraining]
            SET Section = ?
            WHERE Employee_Name = ?;
        
            -- Update tbl_topic_LIST_companyfundamentals
            UPDATE [dbo].[tbl_topic_LIST_companyfundamentals]
            SET Section = ?
            WHERE Employee_Name = ?;
        
            -- Update tbl_topic_LIST_hashira
            UPDATE [dbo].[tbl_topic_LIST_hashira]
            SET Section = ?
            WHERE Employee_Name = ?;
        
            -- Update tbl_topic_LIST_mgtgroupregulation
            UPDATE [dbo].[tbl_topic_LIST_mgtgroupregulation]
            SET Section = ?
            WHERE Employee_Name = ?;
        
            -- Update tbl_topic_LIST_qualityanalysis
            UPDATE [dbo].[tbl_topic_LIST_qualityanalysis]
            SET Section = ?
            WHERE Employee_Name = ?;
        
            -- Update tbl_topic_LIST_technicalskill
            UPDATE [dbo].[tbl_topic_LIST_technicalskill]
            SET Section = ?
            WHERE Employee_Name = ?;
        
            -- Update tbl_topic_LIST_technicalstandard
            UPDATE [dbo].[tbl_topic_LIST_technicalstandard]
            SET Section = ?
            WHERE Employee_Name = ?;
        
            -- Update tbl_topic_LIST_workstandard
            UPDATE [dbo].[tbl_topic_LIST_workstandard]
            SET Section = ?
            WHERE Employee_Name = ?;
        ";
        
        $params = array(
            $sectionupdate, $fullname,  // For tbl_topic_LIST_commonbusinesskill
            $sectionupdate, $fullname,  // For tbl_topic_LIST_commontraining
            $sectionupdate, $fullname,  // For tbl_topic_LIST_companyfundamentals
            $sectionupdate, $fullname,  // For tbl_topic_LIST_hashira
            $sectionupdate, $fullname,  // For tbl_topic_LIST_mgtgroupregulation
            $sectionupdate, $fullname,  // For tbl_topic_LIST_qualityanalysis
            $sectionupdate, $fullname,  // For tbl_topic_LIST_technicalskill
            $sectionupdate, $fullname,  // For tbl_topic_LIST_technicalstandard
            $sectionupdate, $fullname   // For tbl_topic_LIST_workstandard
        );
        
        $stmt = sqlsrv_query($conn, $sql, $params);
        
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        
            // Close the connection
            sqlsrv_free_stmt($stmt);
            sqlsrv_close($conn);
            ?>
            <script>  
            alert("Update Successfully!");               
             window.location="../section_employeelist.php";
            </script>
            <?php
            exit();
        } else {
            echo "Invalid parameters.";
        }
    }


}


elseif($Action == 'EditPIC'){

    if (isset($_GET['action']) && $_GET['action'] === 'EditPIC') {
        if (isset($_GET['selectedItemId']) && isset($_GET['fullname']) && isset($_GET['adid']) && isset($_GET['email']) && isset($_GET['category']) && isset($_GET['section'])) {
            $selectedItemId = $_GET['selectedItemId'];
            $selectedItemId = $_GET['selectedItemId'];
            $fullname = $_GET['fullname'];
            $adid = $_GET['adid'];
            $email = $_GET['email'];
            $category = $_GET['category'];
            $sectionupdate = $_GET['section'];
       
      
         
    
        
            if ($conn === false) {
                die(print_r(sqlsrv_errors(), true));
            }
    
           
          // Prepare SQL statement
          $sql = "
          UPDATE tbl_accounts
          SET Section = ?, Category = ?
          WHERE Full_Name = ?
          ";

          // Parameters to bind
          $params = array($sectionupdate, $category, $fullname);

          // Execute the query
          $stmt = sqlsrv_query($conn, $sql, $params);

          // Check if the query was successful
          if ($stmt === false) {
              die(print_r(sqlsrv_errors(), true));
          }

          // Close resources
          sqlsrv_free_stmt($stmt);
          sqlsrv_close($conn);
            ?>
            <script>  
            alert("Update Successfully!");               
             window.location="../adminmodule.php";
            </script>
            <?php
            exit();
        } else {
            echo "Invalid parameters.";
        }
    }


   



}



elseif($Action== 'trainingrequest'){


 // Input retrieval
 // Input retrieval
$sectionspv = $_POST['sectionspv'] ?? '';
$sectionmgr = $_POST['sectionmgr'] ?? '';
$petrainingpic = $_POST['petrainingpic'] ?? '';
$pespv = $_POST['pespv'] ?? '';
$pemgr = $_POST['pemgr'] ?? '';

// Variables for training request
$tr_topic = $_POST['topic'] ?? '';
$tr_typetraining = $_POST['typeoftraining'] ?? '';
$tr_requestorname = $_POST['requestorname'] ?? '';
$tr_section = $_POST['section'] ?? '';
$tr_rank = $_POST['rank'] ?? '';
$tr_urgent = $_POST['urgent'] ?? '';
$tr_targetdate = $_POST['targetdate'] ?? '';
$tr_reason = $_POST['reason'] ?? '';

$daterequested = date("m/d/Y h:i:a");

// Get the last request number
$sql_reqid = "SELECT MAX(RequestNumber) as lastReqID FROM tbl_trainingrequest";
$stmt_reqid = sqlsrv_query($conn, $sql_reqid);
$lastNumber = 0;

if ($row4 = sqlsrv_fetch_array($stmt_reqid, SQLSRV_FETCH_ASSOC)) {
    $reqlastID = $row4['lastReqID'];
    if ($reqlastID) {
        $parts = explode('-', $reqlastID);
        $lastNumber = (int)end($parts);
    }
}

// Generate new request number
$nextNumber = $lastNumber + 1;
$currentYear = date("Y");
$reqlastIDno = "TrainingRequest-" . $currentYear . "-" . sprintf("%04d", $nextNumber);

// Get the last transaction number
$sql3 = "SELECT MAX(ID) as lastID FROM tbl_trainingrequest";
$stmt3 = sqlsrv_query($conn, $sql3);
$nextTransactionNumber = 0;

if ($row3 = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
    $lastID = $row3['lastID'] ?? 0;
    $nextTransactionNumber = $lastID + 1;
}

$transactionNumber = "REQUEST-MS" . $currentYear . "-" . sprintf("%04d", $nextTransactionNumber);
// Initialize an array to store all employee names for email
// Initialize an array to store all employee names for email
$allTargetEmpNames = [];

if (isset($_POST['selected_empnos'])) {
    $selectedEmpNos = explode(',', $_POST['selected_empnos']); // This gives you an array of EmpNo values
    
    // Prepare existing check statement for the same Target_Date with a different Rank
    $existingCheck = "SELECT [Employee Number], [Rank] FROM [dbo].[tbl_trainingrequest] WHERE [Target] = ?";
    $duplicateAlertShown = false; // Flag for duplicate alert

    // Check how many records already exist for the selected Target Date
    $countCheck = "SELECT COUNT(*) as recordCount FROM [dbo].[tbl_trainingrequest] WHERE [Target] = ?";
    $countStmt = sqlsrv_query($conn, $countCheck, array($tr_targetdate));

    if ($countStmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the count of records for the given Target Date
    $countRow = sqlsrv_fetch_array($countStmt, SQLSRV_FETCH_ASSOC);
    $existingCount = $countRow['recordCount'];

    // Validate: If 8 or more records already exist for this Target Date, block further insertion
    if ($existingCount >= 8) {
        echo "<script>alert('There are already 8 training requests for the selected target date. No more requests can be inserted for this date.');</script>";
        exit; // Block further processing
    }

    // Proceed with checking if the selected Rank already exists for the same Target Date
    $params = array($tr_targetdate);
    $stmtCheck = sqlsrv_query($conn, $existingCheck, $params);

    if ($stmtCheck === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $existingRanks = [];
    while ($rowCheck = sqlsrv_fetch_array($stmtCheck, SQLSRV_FETCH_ASSOC)) {
        $existingRanks[] = $rowCheck['Rank'];
    }

    // Check if the selected Rank is already in the list of existing ranks for that Target Date
    if (in_array($tr_rank, $existingRanks)) {
        // If the rank already exists for the same Target Date, allow insertion
        $duplicateAlertShown = false; // No duplicate alert needed
    } elseif (count($existingRanks) > 0) {
        // If there's already a different Rank for the same Target Date, block the insertion
        if (!$duplicateAlertShown) {
            echo "<script>alert('A training request with a different rank already exists for the selected target date. No new requests with a different rank can be inserted for this date.');</script>";
            $duplicateAlertShown = true; // Set flag to true after showing alert
        }
        // Skip processing employees if a different rank already exists for the target date
        exit;
    }

    // Proceed with normal processing if no duplicates for target date found
    foreach ($selectedEmpNos as $selectedValue) {
        $selectedValue = trim($selectedValue);

        // Fetch employee data
        $getdata = "SELECT * FROM [dbo].[View_MasterList] WHERE [EmpNo] = ?";
        $stmt2 = sqlsrv_query($conn, $getdata, array($selectedValue));

        if ($stmt2 === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        while ($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
            $id = $row['ID'];
            $employeeno = $row['EmpNo'];
            $fullname = $row['First_Name'] . ' ' . $row['Family_Name'];
            $section = $row['Section'];
            $position = $row['Position'];
            $email = $row['Email'];
            $datehired = $row['Date_Hired'];
            
            // Collect employee names for email
            $allTargetEmpNames[] = $fullname; // Add employee name to the list
        }

        // Insert new training request for this employee
        $query1 = "INSERT INTO [dbo].[tbl_trainingrequest] 
                    ([RequestNumber],[Transaction Number],[Topic],[Type of Training],[Requestor Name],[Section],[Rank],[Urgent],[Reason of Urgency],[Target],[Employee Number],[Employee Name],[Date Hired],[Position],[Request Date],[StatusTransaction],[StatusRequestNumber],[Section SPV Approver],[Section MGR Approver],[PE Training PIC Approver],[PE SPV Approver],[PE MGR Approver]) 
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $paramsInsert = array(
            $reqlastIDno, 
            $transactionNumber, 
            $tr_topic, 
            $tr_typetraining, 
            $tr_requestorname, 
            $tr_section, 
            $tr_rank, 
            $tr_urgent, 
            $tr_reason, 
            $tr_targetdate, 
            $employeeno, 
            $fullname, 
            $datehired, 
            $position, 
            $daterequested, 
            'NOT-YET', 
            'For Section SPV Approval', 
            $sectionspv, 
            $sectionmgr, 
            $petrainingpic, 
            $pespv, 
            $pemgr
        );

        $results1 = sqlsrv_query($conn, $query1, $paramsInsert);
        if ($results1 === false) {
            die("Error inserting data: " . print_r(sqlsrv_errors(), true));
        }

        // Increment transaction number for next iteration
        $nextTransactionNumber++;
        $transactionNumber = "REQUEST-MS" . $currentYear . "-" . sprintf("%04d", $nextTransactionNumber);
    }

    // After processing all employees, if no duplicates were found, send the email
    if (!$duplicateAlertShown) {
        // Now, send the email with the accumulated list of target employee names
        include '../email/trainingRequest.php';
    }

} else {
    echo "No employees selected.";
}



            ?>
            <script>
               alert('Successfully Submitted');
               window.location = "../trainingrequest.php";
            </script>
            <?php 







}elseif($Action== 'trainingrequestApprove'){

    
    $position = $_GET['position'];

 
    $section = $_GET['section'];
    
    $fname = $_GET['fname'];
    

    echo "Position: $position, Section: $section\n"; // Debug statement to print the values

    
     $selected = $_POST['selected'];





    foreach($_POST['selected'] as $selectedValues){

               
        
    $getdata = "SELECT * FROM [dbo].[tbl_trainingrequest] WHERE [RequestNumber] ='$selectedValues'";
     $stmt2 = sqlsrv_query($conn,$getdata);
                               while($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
                                   $id = $row['ID'];
                                   $employeeno = $row['Employee Number'];
                                   $fullname = $row['Employee Name'];
                                   $sectionTargetEmployee = $row['Section'];
                                 $positionTargetEmployee = $row['Position'];
                                //    $email = $row['Email'];
                                   $datehired = $row['Date Hired'];
                                   $transactionnumber = $row['Transaction Number'];
                                   $topic = $row['Topic'];
                                   $requestor = $row['Requestor Name'];
                                   $targetdate = $row['Target'];
                                   $requestdate = $row['Request Date'];
                                   $reqno = $row['RequestNumber'];
                                       
       }

                    if (($position == 'Supervisor' || $position == 'Junior Supervisor' || $position == 'Senior Supervisor') && $section=='PE') {

                        echo "Entering Supervisor in PE Section Condition\n"; // Debug statement
                        $update_status = "UPDATE [dbo].[tbl_trainingrequest] SET [StatusRequestNumber] = 'For PE MGR Approval', [PE_SPV_Approved_By]= '$fname' WHERE [RequestNumber] = '$selectedValues'";
                        $updateStmt = sqlsrv_query($conn, $update_status);
                    
                        if ($updateStmt === false) {
                            die(print_r(sqlsrv_errors(), true));
                        } else {
                            // require '../email/requestApprovePEMANAGER.php'; //TO PE MANAGER
                            echo "Supervisor in PE Section Condition: Query executed successfully\n"; // Debug statement
                        }
                        
                    } elseif (($position == 'Manager' || $position == 'Junior Manager' || $position == 'Senior Manager') && $section == 'PE') {

                        echo "Entering Manager in PE Section Condition\n"; // Debug statement
                        $update_status = "UPDATE [dbo].[tbl_trainingrequest] SET [StatusRequestNumber] = 'Approved', [StatusTransaction]='On-going', [PE_MGR_Approved_By]= '$fname' WHERE [RequestNumber] = '$selectedValues'";
                        $updateStmt = sqlsrv_query($conn, $update_status);
                    
                        if ($updateStmt === false) {
                            die(print_r(sqlsrv_errors(), true));
                        } else {
                            //require_once '../email/requestApproveREQUESTOR.php'; //TO REQUESTOR IF PE SECTION
                            echo "Manager in PE Section Condition: Query executed successfully\n"; // Debug statement
                        }

                    }


            
                elseif ($position == 'Supervisor' || $position == 'Junior Supervisor' || $position == 'Senior Supervisor') {

                    echo "Entering Supervisor Condition\n"; // Debug statement
                    $update_status = "UPDATE [dbo].[tbl_trainingrequest] SET [StatusRequestNumber] = 'For Section MGR Approval', [Section_SPV_Approved_By]= '$fname' WHERE [RequestNumber] = '$selectedValues'";
                    $updateStmt = sqlsrv_query($conn, $update_status);
                
                    if ($updateStmt === false) {
                        die(print_r(sqlsrv_errors(), true));
                    } else {
                        //require_once '../email/requestApproveSPV.php'; //TO SECTION MGR
                        echo "Supervisor Condition: Query executed successfully\n"; // Debug statement
                    }

                } elseif ($position == 'Manager' || $position == 'Junior Manager' || $position == 'Senior Manager' || $position =='Adviser') {

                    echo "Entering Manager Condition\n"; // Debug statement
                    $update_status = "UPDATE [dbo].[tbl_trainingrequest] SET [StatusRequestNumber] = 'For PE Training PIC Approval', [Section_MGR_Approved_By]= '$fname'  WHERE [RequestNumber] = '$selectedValues'";
                    $updateStmt = sqlsrv_query($conn, $update_status);
                
                    if ($updateStmt === false) {
                        die(print_r(sqlsrv_errors(), true));
                    } else {
                        //require_once '../email/requestApproveMGR.php'; //TO PE TRAINING PIC
                        echo "Manager Condition: Query executed successfully\n"; // Debug statement
                    }

                } elseif (($position == 'Senior Engineer' && $section == 'PE') || ($position == 'Engineer' && $section == 'PE')) {

                    echo "Entering Senior Engineer Condition\n"; // Debug statement
                    $update_status = "UPDATE [dbo].[tbl_trainingrequest] SET [StatusRequestNumber] = 'For PE SPV Approval' ,[PE_Training_PIC_Approved_By]= '$fname' WHERE [RequestNumber] = '$selectedValues'";
                    $updateStmt = sqlsrv_query($conn, $update_status);
                
                    if ($updateStmt === false) {
                        die(print_r(sqlsrv_errors(), true));
                    } else {
                        //require_once '../email/requestApprovePESPV.php';
                        echo "Senior Engineer Condition: Query executed successfully\n"; // Debug statement
                    }

                } else{
                    echo 'none'; // Handle other cases or do nothing
                }
    
    }


    if (($position == 'Supervisor' || $position == 'Junior Supervisor' || $position == 'Senior Supervisor') && $section=='PE') {

        try {
            require '../email/requestApprovePEMANAGER.php'; // TO PE MANAGER
            echo "<script>alert('Email successfully sent');</script>";
            // echo "Email to PE MGR Query executed successfully\n"; // Success message
        } catch (Exception $e) {
            // If an error occurs, display the error message
            echo "Error: Email not sent. " . $e->getMessage() . "\n"; 
            // Or you can use an alert in JavaScript if this is part of a webpage:
            echo "<script>alert('Email not sent. Please try again.');</script>";
        }
        
    }
    elseif(($position == 'Manager' || $position == 'Junior Manager' || $position == 'Senior Manager') && $section == 'PE'){

        try {
            require_once '../email/requestApproveREQUESTOR.php'; //TO REQUESTOR IF PE SECTION
            echo "<script>alert('Email successfully sent');</script>";
            // echo "Email to PE MGR Query executed successfully\n"; // Success message
        } catch (Exception $e) {
            // If an error occurs, display the error message
            echo "Error: Email not sent. " . $e->getMessage() . "\n"; 
            // Or you can use an alert in JavaScript if this is part of a webpage:
            echo "<script>alert('Email not sent. Please try again.');</script>";
        }
    }
    elseif($position == 'Supervisor' || $position == 'Junior Supervisor' || $position == 'Senior Supervisor'){
     

        try {
            require_once '../email/requestApproveSPV.php'; //TO SECTION MGR
            echo "<script>alert('Email successfully sent');</script>";
            // echo "Email to PE MGR Query executed successfully\n"; // Success message
        } catch (Exception $e) {
            // If an error occurs, display the error message
            echo "Error: Email not sent. " . $e->getMessage() . "\n"; 
            // Or you can use an alert in JavaScript if this is part of a webpage:
            echo "<script>alert('Email not sent. Please try again.');</script>";
        }

    }
    elseif($position == 'Manager' || $position == 'Junior Manager' || $position == 'Senior Manager'){
     

        try {
            require_once '../email/requestApproveMGR.php'; //TO PE TRAINING PIC
            echo "<script>alert('Email successfully sent');</script>";
            // echo "Email to PE MGR Query executed successfully\n"; // Success message
        } catch (Exception $e) {
            // If an error occurs, display the error message
            echo "Error: Email not sent. " . $e->getMessage() . "\n"; 
            // Or you can use an alert in JavaScript if this is part of a webpage:
            echo "<script>alert('Email not sent. Please try again.');</script>";
        }

    }
    elseif (($position == 'Senior Engineer' && $section == 'PE') || ($position == 'Engineer' && $section == 'PE'))
    {
     

        try {
            require_once '../email/requestApprovePESPV.php';
            echo "<script>alert('Email successfully sent');</script>";
            // echo "Email to PE MGR Query executed successfully\n"; // Success message
        } catch (Exception $e) {
            // If an error occurs, display the error message
            echo "Error: Email not sent. " . $e->getMessage() . "\n"; 
            // Or you can use an alert in JavaScript if this is part of a webpage:
            echo "<script>alert('Email not sent. Please try again.');</script>";
        }

    }
    else{
        echo 'none'; // Handle other cases or do nothing
    }
      
      
      
      
           



       



            ?>
            <script>                 
                 alert('Successfully approved');
                window.location="../requestapproval.php";
            </script>
            <?php 




}

elseif($Action =='trainingrequestDeclined'){

    $declinedby = $_GET['declinedby'];

    $reason = $_GET['reason'];
    $position = $_GET['position'];
    $section = $_GET['section'];
    // Get the selected training request numbers as a comma-separated string
        $selected = isset($_GET['selected']) ? $_GET['selected'] : '';

        // Split the selected values into an array
        $selectedArray = explode(',', $selected);
    // Debugging output
    echo "Declined By: " . htmlspecialchars($declinedby) . "<br>";

    echo "Reason: " . htmlspecialchars($reason) . "<br>";
    echo "Position: " . htmlspecialchars($position) . "<br>";
    
    
    // Get POSITION OF DECLINED BY
    $getpos = "SELECT Position FROM tbl_accounts WHERE [Full_Name] = ?";
    $stmt_getpos = sqlsrv_prepare($conn, $getpos, array($declinedby));
    
    if (sqlsrv_execute($stmt_getpos)) {
        $row = sqlsrv_fetch_array($stmt_getpos, SQLSRV_FETCH_ASSOC);
        if ($row) {
            $get_position = $row['Position'];
        } else {
            echo "No results found.";
            exit; // Exit if no position is found
        }
    } else {
        die(print_r(sqlsrv_errors(), true));
    }
    
    $updateSuccess = true; // Track if updates are successful


    
 





    foreach ($selectedArray as $selectedValue) {


    
        // Fetch the data
        $getdata = "SELECT * FROM [dbo].[tbl_trainingrequest] WHERE [RequestNumber] ='$selectedValue'";
        $stmt2 = sqlsrv_query($conn,$getdata);
        while($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
            $id = $row['ID'];
            $employeeno = $row['Employee Number'];
            $fullname = $row['Employee Name'];
            $sectionTargetEmployee = $row['Section'];
          $positionTargetEmployee = $row['Position'];
         //    $email = $row['Email'];
            $datehired = $row['Date Hired'];
            $transactionnumber = $row['Transaction Number'];
            $topic = $row['Topic'];
            $requestor = $row['Requestor Name'];
            $targetdate = $row['Target'];
            $requestdate = $row['Request Date'];
            $reqno = $row['RequestNumber'];
                
     }
    
        // Prepare the update query based on the position

        if ($get_position == 'Engineer' || $get_position == 'Senior Supervisor' || $get_position == 'Junior Supervisor') {
            $update_statusDeclined = "UPDATE [dbo].[tbl_trainingrequest] 
                SET [StatusRequestNumber] = 'Declined', 
                    [Section_SPV_Declined] = ?, 
                    [SPV_Declined_Reason] = ? 
                WHERE [RequestNumber] = ?";
            $updateParams = array($declinedby, $reason, $selectedValue);
        }
         else if(($get_position == 'Engineer' || $get_position == 'Senior Engineer') && $section == "PE") {
            $update_statusDeclined = "UPDATE [dbo].[tbl_trainingrequest] 
                SET [StatusRequestNumber] = 'For Section SPV Approval', 
                    [PE_PIC_Declined] = ?, 
                    [PE_PIC_Declined_Reason] = ? 
                WHERE [RequestNumber] = ?";
            $updateParams = array($declinedby, $reason, $selectedValue);
        } elseif (($get_position == 'Supervisor' || $get_position == 'Senior Supervisor' || $get_position == 'Junior Supervisor') && $section == "PE") {
            $update_statusDeclined = "UPDATE [dbo].[tbl_trainingrequest] 
            SET [StatusRequestNumber] = 'For Section SPV Approval', 
                [PE_SPV_Declined] = ?, 
                [PE_SPV_Declined_Reason] = ? 
            WHERE [RequestNumber] = ?";
            $updateParams = array($pespv, $reason, $selectedValue);
        

            } elseif (($get_position == 'Manager' || $get_position == 'Senior Manager' || $get_position == 'Assistant Manager') && $section == "PE") {
                $update_statusDeclined = "UPDATE [dbo].[tbl_trainingrequest] 
                SET [StatusRequestNumber] = 'For PE Training PIC Approval', 
                    [PE_MGR_Declined] = ?, 
                    [PE_MGR_Declined_Reason] = ? 
                WHERE [RequestNumber] = ?";
                $updateParams = array($pespv, $reason, $selectedValue);
            }
      
        elseif ($get_position == 'Manager') {
            $update_statusDeclined = "UPDATE [dbo].[tbl_trainingrequest] 
                SET [StatusRequestNumber] = 'For Section SPV Approval', 
                    [Section_MGR_Declined] = ?, 
                    [MGR_Declined_Reason] = ? 
                WHERE [RequestNumber] = ?";
            $updateParams = array($declinedby, $reason, $selectedValue);
        } else {
            $update_statusDeclined = "UPDATE [dbo].[tbl_trainingrequest] 
                SET [StatusRequestNumber] = 'Declined', 
                    [Declined By] = ? 
                WHERE [RequestNumber] = ?";
            $updateParams = array($declinedby, $selectedValue);
        }
    
        $updateStmt = sqlsrv_query($conn, $update_statusDeclined, $updateParams);
    
        if ($updateStmt === false) {
            $updateSuccess = false;
            die(print_r(sqlsrv_errors(), true));
        }
    
       
    }
    

     // Send email based on the position
     if (($get_position == 'Supervisor' || $get_position == 'Junior Supervisor' || $get_position == 'Senior Supervisor') && $section == 'PE') {
        try {
            require_once '../email/requestDeclinePESPV.php';
            echo "<script>alert('Email successfully sent');</script>";
        } catch (Exception $e) {
            echo "Error: Email not sent. " . $e->getMessage() . "\n";
            echo "<script>alert('Email not sent. Please try again.');</script>";
        }
    } 

        
    
    elseif ($get_position == 'Supervisor' || $get_position == 'Junior Supervisor' || $get_position == 'Senior Supervisor') {
        try {
            require_once '../email/requestDeclineSPV.php';
            echo "<script>alert('Email successfully sent');</script>";
        } catch (Exception $e) {
            echo "Error: Email not sent. " . $e->getMessage() . "\n";
            echo "<script>alert('Email not sent. Please try again.');</script>";
        }
    } 


    elseif (($position == 'Senior Engineer' && $section == 'PE') || ($position == 'Engineer' && $section == 'PE'))
    {
        try {
            require_once '../email/requestDeclinePEPIC.php';
            echo "<script>alert('Email successfully sent');</script>";
            // echo "Email to PE MGR Query executed successfully\n"; // Success message
        } catch (Exception $e) {
            // If an error occurs, display the error message
            echo "Error: Email not sent. " . $e->getMessage() . "\n"; 
            // Or you can use an alert in JavaScript if this is part of a webpage:
            echo "<script>alert('Email not sent. Please try again.');</script>";
        }
    }
    

    
    elseif (($get_position == 'Manager' || $get_position == 'Assistant Manager' || $get_position == 'Senior Manager') && $section == 'PE') {
        try {
            require_once '../email/requestDeclinePEMGR.php';
            echo "<script>alert('Email successfully sent');</script>";
        } catch (Exception $e) {
            echo "Error: Email not sent. " . $e->getMessage() . "\n";
            echo "<script>alert('Email not sent. Please try again.');</script>";
        }
    } 





    elseif ($get_position == 'Manager' || $get_position == 'Junior Manager' || $get_position == 'Senior Manager') {
        try {
            require_once '../email/requestDeclineMGR.php';
            echo "<script>alert('Email successfully sent');</script>";
        } catch (Exception $e) {
            echo "Error: Email not sent. " . $e->getMessage() . "\n";
            echo "<script>alert('Email not sent. Please try again.');</script>";
        }
    } 



    else {
        echo 'none'; // Handle other cases or do nothing
    }
    
      
        ?>

            <script>
                alert('Declined Success'); // Corrected the alert function
                    window.location = '../requestapproval.php';
            </script>

        <?php



    // if ($updateSuccess) {
    //     echo "Training request(s) successfully updated.";
    // } else {
    //     echo "There was an error updating the training request(s).";
    // }

    // if ($updateSuccess) {
    //     echo "<script>
    //         alert('Declined Success'); // Corrected the alert function
    //         window.location = '../requestapproval.php';
    //     </script>";
    // }
}




elseif($Action =='solderingtraining'){
// Check if the form data is posted
 // Check if the form data is posted
 if (isset($_POST['employee_data'])) {
    // Loop through each selected employee number
    foreach ($_POST['employee_data']['Employee Number'] as $key => $selectedEmployeeNumber) {
        // Query to fetch data based on the selected employee number
        $getDataQuery = "SELECT * FROM [dbo].[tbl_trainingrequest] WHERE [Employee Number] = ?";
        
        // Prepare and execute the query
        $stmt = sqlsrv_prepare($conn, $getDataQuery, array($selectedEmployeeNumber));
        if (sqlsrv_execute($stmt)) {
            // Fetch data from the result set
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $requestNumber = $row['RequestNumber']; // TrainingRequest-2023-0001
                $transactionNumber = $row['Transaction Number']; // REQUEST-MS2023-0001
                $employeeNumber = $row['Employee Number'];
                $employeeName = $row['Employee Name'];
                $position = $row['Position'];
               
                $genInformation1st = $_POST['gen_information_1st'][$key] ?? '';
                $qualityRelated1st = $_POST['quality_related_1st'][$key] ?? '';
                $total1st = $_POST['total_1st'][$key] ?? '';
                $genInformationRetake = $_POST['gen_information_retake'][$key] ?? '';
                $qualityRelatedRetake = $_POST['quality_related_retake'][$key] ?? '';
                $totalRetake = $_POST['total_retake'][$key] ?? '';
                $practical1st = $_POST['practical_1st'][$key] ?? '';
                $practicalRetake = $_POST['practical_retake'][$key] ?? '';
                $remarks = $_POST['remarks'][$key] ?? '';

                // Query to check if the record exists
                $checkQuery = "SELECT COUNT(*) AS count FROM [dbo].[tbl_soldering_scores] WHERE [RequestNumber] = ? AND [TransactionNumber] = ?";
                $checkStmt = sqlsrv_prepare($conn, $checkQuery, array($requestNumber, $transactionNumber));
                sqlsrv_execute($checkStmt);
                $checkRow = sqlsrv_fetch_array($checkStmt, SQLSRV_FETCH_ASSOC);

                if ($checkRow['count'] > 0) {
                    // Record exists, perform update
                    $updateQuery = "UPDATE [dbo].[tbl_soldering_scores]
                                    SET [Gen_Information_1stTake] = ?, [Quality_Related_1stTake] = ?, [Total_Score_1stTake] = ?, [Gen_Information_ReTake] = ?, 
                                        [Quality_Related_ReTake] = ?, [Total_Score_ReTake] = ?, [Practical_1st] = ?, [Practical_Retake] = ?, [Remarks] = ?
                                    WHERE [RequestNumber] = ? AND [TransactionNumber] = ?";
                    $updateParams = array($genInformation1st, $qualityRelated1st, $total1st, $genInformationRetake, $qualityRelatedRetake, $totalRetake, $practical1st, $practicalRetake, $remarks, $requestNumber, $transactionNumber);
                    $updateStmt = sqlsrv_prepare($conn, $updateQuery, $updateParams);
                    if (sqlsrv_execute($updateStmt)) {
                        // Check if Remarks is "PASSED" and update another table if so
                        if ($remarks == "PASSED") {
                            // Update another table
                            $updateStatusQuery = "UPDATE [dbo].[tbl_trainingrequest] SET [StatusTransaction] = 'PASSED' WHERE [Transaction Number] = ?";
                            $updateStatusStmt = sqlsrv_prepare($conn, $updateStatusQuery, array($transactionNumber));
                            if (!sqlsrv_execute($updateStatusStmt)) {
                                // Handle update error
                                // echo "Error updating status: " . print_r(sqlsrv_errors(), true);
                            }
                        }
                    } else {
                        // Handle update error
                        // echo "Error updating data: " . print_r(sqlsrv_errors(), true);
                    }
                } else {
                    // Record does not exist, perform insert
                    $insertQuery = "INSERT INTO [dbo].[tbl_soldering_scores] ([RequestNumber],[TransactionNumber],[EmployeeNumber],[EmployeeName],[Position],[Gen_Information_1stTake],
                                    [Quality_Related_1stTake],[Total_Score_1stTake],[Gen_Information_ReTake],[Quality_Related_ReTake],[Total_Score_ReTake],[Practical_1st],
                                    [Practical_Retake],[Remarks]) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                    $insertParams = array($requestNumber, $transactionNumber, $employeeNumber, $employeeName, $position, $genInformation1st, $qualityRelated1st, $total1st,
                                          $genInformationRetake, $qualityRelatedRetake, $totalRetake, $practical1st, $practicalRetake, $remarks);
                    $insertStmt = sqlsrv_prepare($conn, $insertQuery, $insertParams);
                    if (sqlsrv_execute($insertStmt)) {
                        // Check if Remarks is "PASSED" and update another table if so
                        if ($remarks == "PASSED") {
                            // Update another table
                            $updateStatusQuery = "UPDATE [dbo].[tbl_trainingrequest] SET [StatusTransaction] = 'PASSED' WHERE [Transaction Number] = ?";
                            $updateStatusStmt = sqlsrv_prepare($conn, $updateStatusQuery, array($transactionNumber));
                            if (!sqlsrv_execute($updateStatusStmt)) {
                                // Handle update error
                                // echo "Error updating status: " . print_r(sqlsrv_errors(), true);
                            }
                        }
                        // echo "Data inserted successfully.<br>";
                    } else {
                        // Handle insertion error
                        // echo "Error inserting data: " . print_r(sqlsrv_errors(), true);
                    }
                }
            }
        } else {
            // Handle query execution error
            // echo "Error executing query: " . print_r(sqlsrv_errors(), true);
        }
    }
} else {
    // Handle case where form data is not posted
    echo "No data received from the form.";
}
?>
<script>                 
    //  alert('Successfully submitted');
    // window.location="../trainingresult-soldering.php";
</script>
<?php 



}

elseif($Action =='scoring_qualityanalysis'){

    if (isset($_POST['btnSubmit'])) {
        // Check if the form is being submitted


        echo "Form submitted!<br>";

     


        // Define the columns to display based on the selected topic
    $topicSpecificColumns = array();

    $trainingtopic = $_POST['trainingtopic'];
    $trainingrequestid = $_POST['trainingrequestid'];

    // Add topic-specific columns
    if ($trainingtopic == 'Product Introduction') {
        $topicSpecificColumns[] = 'Product_Introduction';
    } elseif ($trainingtopic == 'Quality Criteria (Defects)') {
        $topicSpecificColumns[] = 'Quality_Criteria_Defects';
    } elseif ($trainingtopic == 'Basic Cassette Troubleshooting') {
        $topicSpecificColumns[] = 'Basic_Cassette_Troubleshooting';
    }
    
        if (isset($_POST['row_checkbox']) && is_array($_POST['row_checkbox'])) {
            // Loop through the selected checkboxes
            foreach ($_POST['row_checkbox'] as $selectedCheckbox) {
                // Loop through each topic-specific column to handle dynamic updates
                foreach ($topicSpecificColumns as $column) {
                    if (isset($_POST['employee_data'][$selectedCheckbox][$column])) {
                        $columnValue = $_POST['employee_data'][$selectedCheckbox][$column];
    
                        // Query to update the database based on the selected employee number and column
                        $updateQuery = "UPDATE [dbo].[tbl_topic_LIST_qualityanalysis_MAINREQUEST] SET [$column] = ? WHERE [Employee_Number] = ?";
                        $params = array($columnValue, $selectedCheckbox);
                        $updateStmt = sqlsrv_prepare($conn, $updateQuery, $params);
    
                        if ($updateStmt) {
                            if (sqlsrv_execute($updateStmt)) {
                                echo "Update successful for Employee_Number: $selectedCheckbox.<br>";
                            } else {
                                echo "Update failed for Employee_Number: $selectedCheckbox: " . print_r(sqlsrv_errors(), true) . "<br>";
                            }
                        } else {
                            echo "Preparation of update statement failed for Employee_Number: $selectedCheckbox.<br>";
                        }
                    } else {
                        echo "No value found for column $column for Employee_Number: $selectedCheckbox.<br>";
                    }
                }
            }
        } else {
            echo "No checkboxes are selected.";
        }
    }
    

        
   



}



elseif($Action =='scoring_workstandard'){

    if (isset($_POST['btnSubmit'])) {
        // Check if the form is being submitted


        echo "Form submitted!<br>";

     


        // Define the columns to display based on the selected topic
    $topicSpecificColumns = array();

    $trainingtopic = $_POST['trainingtopic'];
    $trainingrequestid = $_POST['trainingrequestid'];

            // Add topic-specific columns
            if ($trainingtopic == 'Work Standard for Preparing Process Control Charts') {
                $topicSpecificColumns[] = 'Work_Standard_for_Preparing_Process_Control_Charts';
            }
            elseif ($trainingtopic == 'Work Standard for Analysis Techniques') {
                $topicSpecificColumns[] = 'Work_Standard_for_Analysis_Techniques';
            }
            elseif ($trainingtopic == 'Standard for Intermediate Materials Production Quantity Comparison') {
                $topicSpecificColumns[] = 'Standard_for_Intermediate_Materials_Production_Quantity_Comparison';
            }
            elseif ($trainingtopic == 'Standard for Determining Standard Times for Assembly Processes') {
                $topicSpecificColumns[] = 'Standard_for_Determining_Standard_Times_for_Assembly_Processes';
            }
            elseif ($trainingtopic == 'Work Standard for Jig Specification Preparation') {
              $topicSpecificColumns[] = 'Work_Standard_for_Jig_Specification_Preparation';
          }
          elseif ($trainingtopic == 'Work Standard for Preparing Job Instruction Sheets') {
            $topicSpecificColumns[] = 'Work_Standard_for_Preparing_Job_Instruction_Sheets';
        }
        elseif ($trainingtopic == 'Work Standard for Specification Kanban') {
          $topicSpecificColumns[] = 'Work_Standard_for_Specification_Kanban';
      }
      elseif ($trainingtopic == 'Work Standard for Man-hour control') {
        $topicSpecificColumns[] = 'Work_Standard_for_Man-hour_control';
    }
    elseif ($trainingtopic == 'Work Standard for Process Design') {
      $topicSpecificColumns[] = 'Work_Standard_for_Process_Design';
  }
  elseif ($trainingtopic == 'Work Standard for Learning Curve and Line Establishment') {
    $topicSpecificColumns[] = 'Work_Standard_for_Learning_Curve_and_Line_Establishment';
}
elseif ($trainingtopic == 'Work Standard for Prevention of Total Defect') {
  $topicSpecificColumns[] = 'Work_Standard_for_Prevention_of_Total_Defect';
}
elseif ($trainingtopic == 'Work Standard for Preparation of New Jig Models') {
$topicSpecificColumns[] = 'Work_Standard_for_Preparation_of_New_Jig_Models';
}
elseif ($trainingtopic == 'Work Standard for Assembly Lines') {
$topicSpecificColumns[] = 'Work_Standard_for_Assembly_Lines';
}
elseif ($trainingtopic == 'Work Standard for Stopping and Restarting a Production Line') {
$topicSpecificColumns[] = 'Work_Standard_for_Stopping_and_Restarting_a_Production_Line';
}
elseif ($trainingtopic == 'Work Standard for Training to Improve Abilities of Inspectors') {
$topicSpecificColumns[] = 'Work_Standard_for_Training_to_Improve_Abilities_of_Inspectors';
}

elseif ($trainingtopic == 'Work Standard for Container Inspection before Loading') {
$topicSpecificColumns[] = 'Work_Standard_for_Container_Inspection_before_Loading';
}

elseif ($trainingtopic == 'Work Standard for Part Distribution') {
$topicSpecificColumns[] = 'Work_Standard_for_Part_Distribution';
}

elseif ($trainingtopic == 'Work Standard for Warehouse Layout') {
$topicSpecificColumns[] = 'Work_Standard_for_Warehouse_Layout';
}

elseif ($trainingtopic == 'Work Standard for PS Processes') {
$topicSpecificColumns[] = 'Work_Standard_for_PS_Processes';
}

elseif ($trainingtopic == 'Work Standard for Parts Acceptance Inspection') {
$topicSpecificColumns[] = 'Work_Standard_for_Parts_Acceptance_Inspection';
}

elseif ($trainingtopic == 'Work Standard for Factory Efficiency Manhour Management') {
$topicSpecificColumns[] = 'Work_Standard_for_Factory_Efficiency_Manhour_Management';
}

elseif ($trainingtopic == 'Work Standard for Direct and Indirect Operation Optimization Activities') {
$topicSpecificColumns[] = 'Work_Standard_for_Direct_and_Indirect_Operation_Optimization_Activities';
}
elseif ($trainingtopic == 'Work Standard for Factory Concurrency Progress') {
$topicSpecificColumns[] = 'Work_Standard_for_Factory_Concurrency_Progress';
}
elseif ($trainingtopic == 'Work Standard for Production Loss Debit Invoicing') {
$topicSpecificColumns[] = 'Work_Standard_for_Production_Loss_Debit_Invoicing';
}
elseif ($trainingtopic == 'Work Standard for Assembly Fixtures') {
$topicSpecificColumns[] = 'Work_Standard_for_Assembly_Fixtures';
}
elseif ($trainingtopic == 'Work Standard for Establishing New Models') {
$topicSpecificColumns[] = 'Work_Standard_for_Establishing_New_Models';
}
elseif ($trainingtopic == 'Work Standard for Handling Belt Conveyors') {
$topicSpecificColumns[] = 'Work_Standard_for_Handling_Belt_Conveyors';
}
else{
echo "Cant find Column";
}





    
        if (isset($_POST['row_checkbox']) && is_array($_POST['row_checkbox'])) {
            // Loop through the selected checkboxes
            foreach ($_POST['row_checkbox'] as $selectedCheckbox) {
                // Loop through each topic-specific column to handle dynamic updates
                foreach ($topicSpecificColumns as $column) {
                    if (isset($_POST['employee_data'][$selectedCheckbox][$column])) {
                        $columnValue = $_POST['employee_data'][$selectedCheckbox][$column];
    
                        // Query to update the database based on the selected employee number and column
                        $updateQuery = "UPDATE [dbo].[tbl_topic_LIST_workstandard_MAINREQUEST] SET [$column] = ? WHERE [Employee_Number] = ?";
                        $params = array($columnValue, $selectedCheckbox);
                        $updateStmt = sqlsrv_prepare($conn, $updateQuery, $params);
    
                        if ($updateStmt) {
                            if (sqlsrv_execute($updateStmt)) {
                                echo "Update successful for Employee_Number: $selectedCheckbox.<br>";
                            } else {
                                echo "Update failed for Employee_Number: $selectedCheckbox: " . print_r(sqlsrv_errors(), true) . "<br>";
                            }
                        } else {
                            echo "Preparation of update statement failed for Employee_Number: $selectedCheckbox.<br>";
                        }
                    } else {
                        echo "No value found for column $column for Employee_Number: $selectedCheckbox.<br>";
                    }
                }
            }
        } else {
            echo "No checkboxes are selected.";
        }
    }
    

        
   

}


elseif($Action =='scoring_mgtgroupregulation'){

    if (isset($_POST['btnSubmit'])) {
        // Check if the form is being submitted


        echo "Form submitted!<br>";

     


        // Define the columns to display based on the selected topic
    $topicSpecificColumns = array();

    $trainingtopic = $_POST['trainingtopic'];
    $trainingrequestid = $_POST['trainingrequestid'];

 // Add topic-specific columns
   
                        // Add topic-specific columns
                        if ($trainingtopic == 'Measuring instruments management procedure') {
                            $topicSpecificColumns[] = 'Measuring_instruments_management_procedure';
                        }
                        elseif ($trainingtopic == 'Product Incident Handling Regulation') {
                            $topicSpecificColumns[] = 'Product_Incident_Handling_Regulation';
                        }
                        elseif ($trainingtopic == 'Parts Storage Regulations') {
                            $topicSpecificColumns[] = 'Parts_Storage_Regulations';
                        }
                        elseif ($trainingtopic == 'Regulations for process quality control') {
                            $topicSpecificColumns[] = 'Regulations_for_process_quality_control';
                        }
                        elseif ($trainingtopic == 'Procedure for quality-related failure costs indicator management') {
                        $topicSpecificColumns[] = 'Procedure_for_quality_related_failure_costs_indicator_management';
                    }
                    elseif ($trainingtopic == 'Regulation for Handling Critical Quality Problems') {
                        $topicSpecificColumns[] = 'Regulation_for_Handling_Critical_Quality_Problems';
                    }
                    elseif ($trainingtopic == 'Product Safety Rules') {
                    $topicSpecificColumns[] = 'Product_Safety_Rules';
                }
                elseif ($trainingtopic == 'Regulation for Quality Assurance') {
                    $topicSpecificColumns[] = 'Regulation_for_Quality_Assurance';
                }
                elseif ($trainingtopic == 'Regulation for production daily control management') {
                $topicSpecificColumns[] = 'Regulation_for_production_daily_control_management';
            }
     else{
       echo "Column not found in database...";
               }
    
        if (isset($_POST['row_checkbox']) && is_array($_POST['row_checkbox'])) {
            // Loop through the selected checkboxes
            foreach ($_POST['row_checkbox'] as $selectedCheckbox) {
                // Loop through each topic-specific column to handle dynamic updates
                foreach ($topicSpecificColumns as $column) {
                    if (isset($_POST['employee_data'][$selectedCheckbox][$column])) {
                        $columnValue = $_POST['employee_data'][$selectedCheckbox][$column];
    
                        // Query to update the database based on the selected employee number and column
                        $updateQuery = "UPDATE [dbo].[tbl_topic_LIST_mgtgroupregulation_MAINREQUEST] SET [$column] = ? WHERE [Employee_Number] = ?";
                        $params = array($columnValue, $selectedCheckbox);
                        $updateStmt = sqlsrv_prepare($conn, $updateQuery, $params);
    
                        if ($updateStmt) {
                            if (sqlsrv_execute($updateStmt)) {
                                echo "Update successful for Employee_Number: $selectedCheckbox.<br>";
                            } else {
                                echo "Update failed for Employee_Number: $selectedCheckbox: " . print_r(sqlsrv_errors(), true) . "<br>";
                            }
                        } else {
                            echo "Preparation of update statement failed for Employee_Number: $selectedCheckbox.<br>";
                        }
                    } else {
                        echo "No value found for column $column for Employee_Number: $selectedCheckbox.<br>";
                    }
                }
            }
        } else {
            echo "No checkboxes are selected.";
        }
    }
    

        
   

}



elseif($Action =='scoring_prodhashira'){

    if (isset($_POST['btnSubmit'])) {
        // Check if the form is being submitted


        echo "Form submitted!<br>";

     


        // Define the columns to display based on the selected topic
    $topicSpecificColumns = array();

    $trainingtopic = $_POST['trainingtopic'];
    $trainingrequestid = $_POST['trainingrequestid'];

 // Add topic-specific columns
   
                   
            
        // Add topic-specific columns
        if ($trainingtopic == 'Observation Standard Operation') {
            $topicSpecificColumns[] = 'ObservationStandardOperation';
        }
        elseif ($trainingtopic == 'Limit Sample') {
            $topicSpecificColumns[] = 'LimitSample';
        }
        elseif ($trainingtopic == 'Quality Check Status by Supervisor') {
            $topicSpecificColumns[] = 'QualityCheckStatusBySupervisor';
        }
        elseif ($trainingtopic == 'Assembly Basic Action Check Status by Supervisor') {
            $topicSpecificColumns[] = 'AssemblyBasicActionCheckStatusBySupervisor';
        }
        elseif ($trainingtopic == 'Specification Change Work') {
            $topicSpecificColumns[] = 'SpecificationChangeWork';
        }
        elseif ($trainingtopic == 'First In First Out') {
            $topicSpecificColumns[] = 'FirstInFirstOut';
        }
        elseif ($trainingtopic == 'Maintain and control equipment, jig, tool and measuring instrument') {
            $topicSpecificColumns[] = 'MaintainAndControlEquipmentJigToolAndMeasuringInstrument';
        }
        elseif ($trainingtopic == 'Maintain and control work environment') {
            $topicSpecificColumns[] = 'MaintainAndControlWorkEnvironment';
        }
        elseif ($trainingtopic == 'Understanding Change point: Design Change') {
            $topicSpecificColumns[] = 'UnderstandingChangePointDesignChange';
        }
        elseif ($trainingtopic == 'Understanding Change point: Man') {
            $topicSpecificColumns[] = 'UnderstandingChangePointMan';
        }
        elseif ($trainingtopic == 'Understanding Change point: Awareness') {
            $topicSpecificColumns[] = 'UnderstandingChangePointAwareness';
        }
        elseif ($trainingtopic == 'Preparation for a change and quality Check method') {
            $topicSpecificColumns[] = 'PreparationForAChangeAndQualityCheckMethod';
        }
        elseif ($trainingtopic == 'Production Line stop in case of abnormality') {
            $topicSpecificColumns[] = 'ProductionLineStopInCaseOfAbnormality';
        }
        elseif ($trainingtopic == 'Recurrence prevention of in-process defect outflow') {
            $topicSpecificColumns[] = 'RecurrencePreventionOfInProcessDefectOutflow';
        }
        elseif ($trainingtopic == 'Recurrence prevention of in-process defect') {
            $topicSpecificColumns[] = 'RecurrencePreventionOfInProcessDefect';
        }
        elseif ($trainingtopic == 'Recurrence prevention from outflow to post process') {
            $topicSpecificColumns[] = 'RecurrencePreventionFromOutflowToPostProcess';
        }
        elseif ($trainingtopic == 'Important process control') {
            $topicSpecificColumns[] = 'ImportantProcessControl';
        }
        elseif ($trainingtopic == 'Control of Fabrication condition') {
            $topicSpecificColumns[] = 'ControlOfFabricationCondition';
        }
        elseif ($trainingtopic == 'Trend Control') {
            $topicSpecificColumns[] = 'TrendControl';
        }
        elseif ($trainingtopic == 'Quality Kiken Yochi') {
            $topicSpecificColumns[] = 'QualityKikenYochi';
        }
        elseif ($trainingtopic == 'Development of quality oriented personnel') {
            $topicSpecificColumns[] = 'DevelopmentOfQualityOrientedPersonnel';
        }
        elseif ($trainingtopic == 'Work Instruction Sheet') {
            $topicSpecificColumns[] = 'WorkInstructionSheet';
        }
        elseif ($trainingtopic == 'Process Organization Table: Inlne operation') {
            $topicSpecificColumns[] = 'ProcessOrganizationTableInlineOperation';
        }
        elseif ($trainingtopic == 'Process Organization Table: Offline Operation') {
            $topicSpecificColumns[] = 'ProcessOrganizationTableOfflineOperation';
        }
        elseif ($trainingtopic == 'Rules in Automated Operation') {
            $topicSpecificColumns[] = 'RulesInAutomatedOperation';
        }
        elseif ($trainingtopic == 'Understanding Production Progress') {
            $topicSpecificColumns[] = 'UnderstandingProductionProgress';
        }
        elseif ($trainingtopic == 'Root cause investigation') {
            $topicSpecificColumns[] = 'RootCauseInvestigation';
        }
        elseif ($trainingtopic == 'Implementation of Recovery measures') {
            $topicSpecificColumns[] = 'ImplementationOfRecoveryMeasures';
        }
        elseif ($trainingtopic == 'Proper Stock in Production Site') {
            $topicSpecificColumns[] = 'ProperStockInProductionSite';
        }
        elseif ($trainingtopic == 'Securing Manpower') {
            $topicSpecificColumns[] = 'SecuringManpower';
        }
        elseif ($trainingtopic == 'Human Resource Development') {
            $topicSpecificColumns[] = 'HumanResourceDevelopment';
        }
        elseif ($trainingtopic == 'Kitting') {
            $topicSpecificColumns[] = 'Kitting';
        }
        elseif ($trainingtopic == 'Cost Education and Reduction Activity') {
            $topicSpecificColumns[] = 'CostEducationAndReductionActivity';
        }
        elseif ($trainingtopic == 'Usage Control/Understanding Energy Cost') {
            $topicSpecificColumns[] = 'UsageControlUnderstandingEnergyCost';
        }
        elseif ($trainingtopic == 'Usage/Cost Control') {
            $topicSpecificColumns[] = 'UsageCostControl';
        }
        elseif ($trainingtopic == 'First-In, First-Out') {
            $topicSpecificColumns[] = 'FirstInFirstOut';
        }
        elseif ($trainingtopic == 'Labor Cost') {
            $topicSpecificColumns[] = 'LaborCost';
        }
        elseif ($trainingtopic == 'Control of Fixed Assets') {
            $topicSpecificColumns[] = 'ControlOfFixedAssets';
        }
        elseif ($trainingtopic == 'Used space in Production area') {
            $topicSpecificColumns[] = 'UsedSpaceInProductionArea';
        }
        elseif ($trainingtopic == 'Accuracy of Budget Control') {
            $topicSpecificColumns[] = 'AccuracyOfBudgetControl';
        }
        elseif ($trainingtopic == 'Reduction of Cost of Poor Quality') {
            $topicSpecificColumns[] = 'ReductionOfCostOfPoorQuality';
        }
        else{
            echo "Column not found in database...";
        }
    
    



    
        if (isset($_POST['row_checkbox']) && is_array($_POST['row_checkbox'])) {
            // Loop through the selected checkboxes
            foreach ($_POST['row_checkbox'] as $selectedCheckbox) {
                // Loop through each topic-specific column to handle dynamic updates
                foreach ($topicSpecificColumns as $column) {
                    if (isset($_POST['employee_data'][$selectedCheckbox][$column])) {
                        $columnValue = $_POST['employee_data'][$selectedCheckbox][$column];
    
                        // Query to update the database based on the selected employee number and column
                        $updateQuery = "UPDATE [dbo].[tbl_topic_LIST_hashira_MAINREQUEST] SET [$column] = ? WHERE [Employee_Number] = ?";
                        $params = array($columnValue, $selectedCheckbox);
                        $updateStmt = sqlsrv_prepare($conn, $updateQuery, $params);
    
                        if ($updateStmt) {
                            if (sqlsrv_execute($updateStmt)) {
                                echo "Update successful for Employee_Number: $selectedCheckbox.<br>";
                            } else {
                                echo "Update failed for Employee_Number: $selectedCheckbox: " . print_r(sqlsrv_errors(), true) . "<br>";
                            }
                        } else {
                            echo "Preparation of update statement failed for Employee_Number: $selectedCheckbox.<br>";
                        }
                    } else {
                        echo "No value found for column $column for Employee_Number: $selectedCheckbox.<br>";
                    }
                }
            }
        } else {
            echo "No checkboxes are selected.";
        }
    }
    

        
   

}




elseif($Action =='scoring_commontraining'){

    if (isset($_POST['btnSubmit'])) {
        // Check if the form is being submitted


        echo "Form submitted!<br>";

     


        // Define the columns to display based on the selected topic
    $topicSpecificColumns = array();

    $trainingtopic = $_POST['trainingtopic'];
    $trainingrequestid = $_POST['trainingrequestid'];

 // Add topic-specific columns
   


                     // Add topic-specific columns
                     if ($trainingtopic == 'Train the Trainers') {
                        $topicSpecificColumns[] = 'Train_the_Trainers';
                    }
                    elseif ($trainingtopic == 'IE Techniques') {
                        $topicSpecificColumns[] = 'IE_Techniques';
                    }
                    elseif ($trainingtopic == 'TWI -JR') {
                        $topicSpecificColumns[] = 'TWI_JR';
                    }
                    elseif ($trainingtopic == 'TWI -JR') {
                        $topicSpecificColumns[] = 'TWI_JI';
                    }
                    elseif ($trainingtopic == 'ISO90001 (QMS)') {
                        $topicSpecificColumns[] = 'ISO90001_QMS';
                    }
                    elseif ($trainingtopic == 'QCC Basic Knowledge (QC 7 Tools)') {
                        $topicSpecificColumns[] = 'QCC_Basic_Knowledge_QC_7_Tools';
                    }
                    elseif ($trainingtopic == 'Proposal Activity') {
                        $topicSpecificColumns[] = 'Proposal_Activity';
                    }
                    elseif ($trainingtopic == 'Excel Macro Training') {
                        $topicSpecificColumns[] = 'Excel_Macro_Training';
                    }
                    elseif ($trainingtopic == 'Safety Training') {
                        $topicSpecificColumns[] = 'Safety_Training';
                    }
                    elseif ($trainingtopic == 'Quality Education') {
                        $topicSpecificColumns[] = 'Quality_Education';
                    }
                    elseif ($trainingtopic == 'Fundamentals of Acceptance Sampling') {
                        $topicSpecificColumns[] = 'Fundamentals_of_Acceptance_Sampling';
                    }
                    elseif ($trainingtopic == 'Zero Defects Through Poka Yoke') {
                        $topicSpecificColumns[] = 'Zero_Defects_Through_Poka_Yoke';
                    }
                    elseif ($trainingtopic == 'Advanced Pull Manufacturing with Heijunka') {
                        $topicSpecificColumns[] = 'Advanced_Pull_Manufacturing_with_Heijunka';
                    }
                    elseif ($trainingtopic == 'Achieving High Results Through People') {
                        $topicSpecificColumns[] = 'Achieving_High_Results_Through_People';
                    }
                    else{
                        echo "Column not found in database...";
                    }
                
                
                
              


    
        if (isset($_POST['row_checkbox']) && is_array($_POST['row_checkbox'])) {
            // Loop through the selected checkboxes
            foreach ($_POST['row_checkbox'] as $selectedCheckbox) {
                // Loop through each topic-specific column to handle dynamic updates
                foreach ($topicSpecificColumns as $column) {
                    if (isset($_POST['employee_data'][$selectedCheckbox][$column])) {
                        $columnValue = $_POST['employee_data'][$selectedCheckbox][$column];
    
                        // Query to update the database based on the selected employee number and column
                        $updateQuery = "UPDATE [dbo].[tbl_topic_LIST_commontraining_MAINREQUEST] SET [$column] = ? WHERE [Employee_Number] = ?";
                        $params = array($columnValue, $selectedCheckbox);
                        $updateStmt = sqlsrv_prepare($conn, $updateQuery, $params);
    
                        if ($updateStmt) {
                            if (sqlsrv_execute($updateStmt)) {
                                echo "Update successful for Employee_Number: $selectedCheckbox.<br>";
                            } else {
                                echo "Update failed for Employee_Number: $selectedCheckbox: " . print_r(sqlsrv_errors(), true) . "<br>";
                            }
                        } else {
                            echo "Preparation of update statement failed for Employee_Number: $selectedCheckbox.<br>";
                        }
                    } else {
                        echo "No value found for column $column for Employee_Number: $selectedCheckbox.<br>";
                    }
                }
            }
        } else {
            echo "No checkboxes are selected.";
        }
    }
    

        
   

}




elseif($Action =='scoring_techstandard'){

    if (isset($_POST['btnSubmit'])) {
        // Check if the form is being submitted


        echo "Form submitted!<br>";

     


        // Define the columns to display based on the selected topic
    $topicSpecificColumns = array();

    $trainingtopic = $_POST['trainingtopic'];
    $trainingrequestid = $_POST['trainingrequestid'];

 // Add topic-specific columns
   


        // Add topic-specific columns
        if ($trainingtopic == 'Standard for proces control chart') {
            $topicSpecificColumns[] = 'Standard_for_proces_control_chart';
        }
        elseif ($trainingtopic == 'Standard for Electronic Component Packaging and Storage') {
            $topicSpecificColumns[] = 'Standard_for_Electronic_Component_Packaging_and_Storage';
        }
        elseif ($trainingtopic == 'Air blow selection and installation work standard') {
            $topicSpecificColumns[] = 'Air_blow_selection_and_installation_work_standard';
        }
        elseif ($trainingtopic == 'Air blow work standard') {
            $topicSpecificColumns[] = 'Air_blow_work_standard';
        }
        elseif ($trainingtopic == 'Cleaning work standard in product assembling') {
            $topicSpecificColumns[] = 'Cleaning_work_standard_in_product_assembling';
        }
        elseif ($trainingtopic == 'Clean Bench Standard') {
            $topicSpecificColumns[] = 'Clean_Bench_Standard';
        }
        elseif ($trainingtopic == 'Screw tightening Equipment Selection/ Installation Standard') {
            $topicSpecificColumns[] = 'Screw_tightening_Equipment_Selection_Installation_Standard';
        }
        elseif ($trainingtopic == 'Electric Screwdriver work standard') {
            $topicSpecificColumns[] = 'Electric_Screwdriver_work_standard';
        }
        elseif ($trainingtopic == 'Standard for the operations carried out for preventing damage to the external parts operation') {
            $topicSpecificColumns[] = 'Standard_for_the_operations_carried_out_for_preventing_damage_to_the_external_parts_operation';
        }
        elseif ($trainingtopic == 'Standard for selection and installation ionizers') {
            $topicSpecificColumns[] = 'Standard_for_selection_and_installation_ionizers';
        }
        elseif ($trainingtopic == 'Work standard for installing ionizers') {
            $topicSpecificColumns[] = 'Work_standard_for_installing_ionizers';
        }
        elseif ($trainingtopic == 'Visual Appearance work standard') {
            $topicSpecificColumns[] = 'Visual_Appearance_work_standard';
        }
        elseif ($trainingtopic == 'Standard for appearance and visual check with limit samples') {
            $topicSpecificColumns[] = 'Standard_for_appearance_and_visual_check_with_limit_samples';
        }
        elseif ($trainingtopic == 'Production Equipments Maintenance Standard') {
            $topicSpecificColumns[] = 'Production_Equipments_Maintenance_Standard';
        }
        elseif ($trainingtopic == 'Lever-type Dial Gauge Handling Standard') {
            $topicSpecificColumns[] = 'Levertype_Dial_Gauge_Handling_Standard';
        }
        elseif ($trainingtopic == 'Standard for determining standard times for assembly processes') {
            $topicSpecificColumns[] = 'Standard_for_determining_standard_times_for_assembly_processes';
        }
        elseif ($trainingtopic == 'Standard for Standard Time Settings for Machining Operations') {
            $topicSpecificColumns[] = 'Standard_for_Standard_Time_Settings_for_Machining_Operations';
        }
        elseif ($trainingtopic == 'Basic Standardfor implementation of countermeasure against electrostatic damage') {
            $topicSpecificColumns[] = 'Basic_Standardfor_implementation_of_countermeasure_against_electrostatic_damge';
        }
        elseif ($trainingtopic == 'Standard for handling wrist strap') {
            $topicSpecificColumns[] = 'Standard_for_handling_wrist_strap';
        }
        elseif ($trainingtopic == 'Standard for handling conductive mat') {
            $topicSpecificColumns[] = 'Standard_for_handling_conductive_mat';
        }
        elseif ($trainingtopic == 'Standard for handling anti static shoes') {
            $topicSpecificColumns[] = 'Standard_for_handling_anti_static_shoes';
        }
        elseif ($trainingtopic == 'Standard for job instruction sheets') {
            $topicSpecificColumns[] = 'Standard_for_job_instruction_sheets';
        }
        elseif ($trainingtopic == 'Standard for Part Delivery Packaging') {
            $topicSpecificColumns[] = 'Standard_for_Part_Delivery_Packaging';
        }
        elseif ($trainingtopic == 'Standard for Preparing Process Analysis Tree Sheets') {
            $topicSpecificColumns[] = 'Standard_for_Preparing_Process_Analysis_Tree_Sheets';
        }
        elseif ($trainingtopic == 'Standard for Safety Tests in Production Processes') {
            $topicSpecificColumns[] = 'Standard_for_Safety_Tests_in_Production_Processes';
        }
        elseif ($trainingtopic == 'Torque Driver Work Standard ') {
            $topicSpecificColumns[] = 'Torque_Driver_Work_Standard';
        }
        elseif ($trainingtopic == 'Preparation and managerial standards of hand soldering tools ') {
            $topicSpecificColumns[] = 'Preparation_and_managerial_standards_of_hand_soldering_tools';
        }
        elseif ($trainingtopic == 'Hand Soldering Work Standard ') {
            $topicSpecificColumns[] = 'Hand_Soldering_Work_Standard';
        }
        elseif ($trainingtopic == 'Standards of Adhesion ') {
            $topicSpecificColumns[] = 'Standards_of_Adhesion';
        }
        elseif ($trainingtopic == 'Standard for Grease and Oil Applying Operation ') {
            $topicSpecificColumns[] = 'Standard_for_Grease_and_Oil_Applying_Operation';
        }
        elseif ($trainingtopic == 'Standard for Product Safety Risk Assessment ') {
            $topicSpecificColumns[] = 'Standard_for_Product_Safety_Risk_Assessment';
        }
        elseif ($trainingtopic == 'Standard for Determining Product Safety Markings ') {
            $topicSpecificColumns[] = 'Standard_for_Determining_Product_Safety_Markings';
        }
        elseif ($trainingtopic == 'Standard for Product Safety Information in Instruction Manuals ') {
            $topicSpecificColumns[] = 'Standard_for_Product_Safety_Information_in_Instruction_Manuals';
        }
        elseif ($trainingtopic == 'Standard for Safety Assurance Indications on Products ') {
            $topicSpecificColumns[] = 'Standard_for_Safety_Assurance_Indications_on_Products';
        }
        elseif ($trainingtopic == 'Air Cleanliness Measurement Standard') {
            $topicSpecificColumns[] = 'Air_Cleanliness_Measurement_Standard';
        }
        else{
            echo "Column not found in database...";
        }
    
    
    
                
                
              


    
        if (isset($_POST['row_checkbox']) && is_array($_POST['row_checkbox'])) {
            // Loop through the selected checkboxes
            foreach ($_POST['row_checkbox'] as $selectedCheckbox) {
                // Loop through each topic-specific column to handle dynamic updates
                foreach ($topicSpecificColumns as $column) {
                    if (isset($_POST['employee_data'][$selectedCheckbox][$column])) {
                        $columnValue = $_POST['employee_data'][$selectedCheckbox][$column];
    
                        // Query to update the database based on the selected employee number and column
                        $updateQuery = "UPDATE [dbo].[tbl_topic_LIST_technicalstandard_MAINREQUEST] SET [$column] = ? WHERE [Employee_Number] = ?";
                        $params = array($columnValue, $selectedCheckbox);
                        $updateStmt = sqlsrv_prepare($conn, $updateQuery, $params);
    
                        if ($updateStmt) {
                            if (sqlsrv_execute($updateStmt)) {
                                echo "Update successful for Employee_Number: $selectedCheckbox.<br>";
                            } else {
                                echo "Update failed for Employee_Number: $selectedCheckbox: " . print_r(sqlsrv_errors(), true) . "<br>";
                            }
                        } else {
                            echo "Preparation of update statement failed for Employee_Number: $selectedCheckbox.<br>";
                        }
                    } else {
                        echo "No value found for column $column for Employee_Number: $selectedCheckbox.<br>";
                    }
                }
            }
        } else {
            echo "No checkboxes are selected.";
        }
    }
    

        
   

}



elseif($Action =='skillmap'){
   

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Loop through the submitted training data
        foreach ($_POST['training_attended'] as $index => $attended_training) {
            // Get the Employee Number for this row
            $employee_number = $_POST['employee_number'][$index];
        
            // Get the selected topic and input score for this row
            $selected_topic = $_POST['selected_topic'][$index];
            $input_score = $_POST['input_score'][$index];
            // Concatenate selected topic code with the inputted score for Training_Attended
            $training_attended = $selected_topic;
            
            // Inputted score for Skill_Map_Score
            $skill_map_score = $attended_training;
            
            // Retrieve existing Skill_Map_Score data from the database
            $sql_select = "SELECT Skill_Map_Score FROM [dbo].[tbl_masterlist] WHERE Employee_Number = ?";
            $params_select = array($employee_number);
            $stmt_select = sqlsrv_query($conn, $sql_select, $params_select);
    
            if ($stmt_select === false) {
                die(print_r(sqlsrv_errors(), true));
            }
    
            // Fetch the existing Skill_Map_Score data
            $existing_skill_map_score = "";
            if ($row = sqlsrv_fetch_array($stmt_select, SQLSRV_FETCH_ASSOC)) {
                $existing_skill_map_score = $row['Skill_Map_Score'];
            }
    
            // Concatenate existing and new Skill_Map_Score data
            $skill_map_score = $existing_skill_map_score != "" ? $existing_skill_map_score . ", " . $skill_map_score : $skill_map_score;
    
            // Check if attended_training is not empty before updating
            if (!empty($attended_training)) {
                $sql = "UPDATE [dbo].[tbl_masterlist] 
                        SET Training_Attended = CASE 
                                                    WHEN LEN(Training_Attended) > 0 THEN CONCAT(Training_Attended, ', ', ?)
                                                    ELSE ?
                                                END,
                            Skill_Map_Score = ?
                        WHERE Employee_Number = ?";
                $params = array($training_attended, $training_attended, $skill_map_score, $employee_number);
                $stmt = sqlsrv_query($conn, $sql, $params);
    
                // Check if the SQL statement was executed successfully
                if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
            }
        }
    }
    ?>

    <script>
alert('Successfully inserted');
window.location="../skillmap_prodhash.php";


    </script>

    <?php
    
    
     
}elseif($Action =='update'){



    if(isset($_POST['action']) && $_POST['action'] === 'update') {


    
        if(isset($_POST['employee_number']) && isset($_POST['updated_value']) && isset($_POST['column_name']) && isset($_POST['table_name'])) {
            $employee_number = $_POST['employee_number'];
            $updated_value = $_POST['updated_value'];
            $column_name = $_POST['column_name'];
  
            $table_name = $_POST['table_name']; // Retrieve table name
    
            echo "Employee Number: $employee_number<br>";
            echo "Updated Value: $updated_value<br>";
            echo "Column Name: $column_name<br>";
            echo "table Name: $table_name<br>";
    
            // Ensure $column_name is not null and is a valid column name
            if (!empty($column_name)) {
                // Prepare the SQL statement using a parameterized query to prevent SQL injection
                $sql_update = "UPDATE $table_name
                               SET $column_name = ?
                               WHERE Employee_Number = ?"; // Assuming Employee_Number is the primary key
    
                // Prepare the parameters for the prepared statement
                $params = array(&$updated_value, &$employee_number);
    
                // Prepare the SQL statement
                $stmt = sqlsrv_prepare($conn, $sql_update, $params);
    
                if ($stmt === false) {
                    // If preparation fails, handle errors
                    $errors = sqlsrv_errors();
                    foreach ($errors as $error) {
                        echo "SQLSTATE[" . $error['SQLSTATE'] . "]: " . $error['message'] . "<br>";
                    }
                } else {
                    // Execute the prepared statement
                    $result = sqlsrv_execute($stmt);
    
                    if ($result === false) {
                        // If execution fails, handle errors
                        $errors = sqlsrv_errors();
                        foreach ($errors as $error) {
                            echo "SQLSTATE[" . $error['SQLSTATE'] . "]: " . $error['message'] . "<br>";
                        }
                    } else {
                        // Update successful
                 
                    
                       echo "Update successful";
                         // Redirect the user to another page after 2 seconds
                  
                    }
                }
            } else {
                // Handle the case when $column_name is empty or null
                echo "Column name is empty or null. Cannot proceed with update.";
            }
        }
    }

  
    
    

    
    
    

}



?>




