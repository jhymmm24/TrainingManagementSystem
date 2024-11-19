


<?php 


include 'Connection/connection.php';
//include 'forms/overall.php';
?>

<?php

//var_dump($_POST);

$function = $_GET['function'];



if ($function == 'UploadAttendees') {

    //$titleID = $_GET['TitleID'];

$selected = $_GET['selectedrows'];
$title = $_GET['topic'];
$startdate = $_GET['startdate'];
$enddate = $_GET['enddate'];

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

    

    $sql_insert = "INSERT INTO [dbo].[tbl_elearningstatus] (ElearningTransID, Title, EmployeeNumber, Target_Employee, Section, Target_Date, End_Date, Elearning_Status,TotalNumber_Target,Email)
                   VALUES ('$elearningUNIQUE', '$title', '$empno', '$fullname', '$section', '$startdate', '$enddate', 'NOT YET','1','$email')";
    $resultscreate = sqlsrv_query($conn, $sql_insert);

    
}


//include 'email/ElearningEnlistment.php';
    ?>
    <script>
        
       // alert("Successfully Submitted!");
     //  window.location.replace("uploading.php");
    </script>
    <?php

 
 


}