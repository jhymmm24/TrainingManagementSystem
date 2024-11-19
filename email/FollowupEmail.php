<?php
require("../PhpMailer/src/PHPMailer.php");
require("../PhpMailer/src/SMTP.php");
require("../PhpMailer/src/Exception.php");

include '../Connection/connection.php';

$title = $_GET['title'];
$section = $_GET['section'];

$emailArray = array(); 

// Prepare the query with placeholders for parameters
$sql_email = "SELECT Email
              FROM [dbo].[tbl_elearningstatus] 
              WHERE [Title] = ? 
              AND TotalNumber_Finished IS NULL 
              AND Section = ? 
              AND Email LIKE '%@brother-biph.com.ph%'";

// Prepare the statement
$stmt = sqlsrv_prepare($conn, $sql_email, array(&$title, &$section));

// Execute the query
if (sqlsrv_execute($stmt)) {
    // Process the result set
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        // Store the email addresses in the array
        $emailArray[] = $row['Email'];
    }
} else {
    // Handle error
    die(print_r(sqlsrv_errors(), true));
}

// Echo the fetched email addresses
if (count($emailArray) > 0) {
    echo "Fetched Email Addresses: <br>";
    foreach ($emailArray as $email) {
        echo $email . "<br>"; // Output each email on a new line
    }
} else {
    echo "No email addresses found.";
}



// Fetch other details for the email
$sql_details = "SELECT * FROM [dbo].[tbl_elearningstatus] WHERE [Title] = '$title'";
$results = sqlsrv_query($conn, $sql_details);
while ($row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) {
    $fullname = $row['Target_Employee'];
    $email = $row['Email'];
    $employeenumber = $row['EmployeeNumber'];
    $startdate = $row['Target_Date'];
    $enddate = $row['End_Date'];
}

$mail = new \PHPMailer\PHPMailer\PHPMailer();
$mail->SMTPKeepAlive = true;
$mail->setFrom('TMS@brother-biph.com.ph', 'TMS');
$mail->Subject = '[BIPH_BPS] TMS - E-Learning - Follow-Up';
$mail->AltBody = 'Please do not reply to this email. Thank you!';
$mail->isSMTP();
$mail->Host = 'smtp.brother.co.jp';
$mail->SMTPAuth = FALSE;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->Username = 'ZZPYPH04';
$mail->Password = '.p&55worD';
$mail->Port = 25;
$mail->isHTML(true); // Set email format to HTML
$mail->CharSet = 'utf-8';
$mail->AddEmbeddedImage('../assets/img/phishingalert.png', 'image');

// Compose email body
$body = '
<p style="font-size:16px; font-family:Century Gothic, sans-serif;">Good day!</p>
<p style="font-size:16px; font-family:Century Gothic, sans-serif;">This is a kind follow-up for the E-learning you have not finished yet as of <span style="background-color: yellow;">' . $today . '.</span></p>
<p style="font-size:16px; font-family:Century Gothic, sans-serif;">E-Learning Title: ' . $title . '</p>
<p style="font-size:16px; font-family:Century Gothic, sans-serif;">Start Date: ' . $startdate . '</p>
<p style="font-size:16px; font-family:Century Gothic, sans-serif;"><span style="background-color: yellow;">End Date: ' . $enddate . '</span></p>
<p style="font-size:16px; font-family:Century Gothic, sans-serif;">Click this link to answer and Login your credentials <a href="http://apbiphbpsts01:8080/TMS/forms/sessionchecker.php?control=exam&usercategory=0">Training Management System</a>.</p>
<br>
<h4 style="color:red; font-family:Century Gothic, sans-serif;">**Note: This is a system generated email. Please do not reply to this message. ***</h4>
<h4 style="font-size:14px; font-family:Century Gothic, sans-serif;">🌐[TMS] - Training Management System🌐</h4><img src="cid:image">';

$mail->Body = $body;

$mail->Priority = 1;


// Add all valid (non-null, non-blank, domain-filtered) email addresses to the "BCC" field
foreach ($emailArray as $email) {
    $mail->addAddress($email); // You can use addAddress($email) if you want all emails in the "To" field
}




$sql_CC = "SELECT * FROM tbl_accounts WHERE Category = 'Section Training PIC' AND Section ='$section'";
$results_CC = sqlsrv_query($conn, $sql_CC);

// Initialize an array to hold the CC email addresses and names
$ccArray = [];

while ($row = sqlsrv_fetch_array($results_CC, SQLSRV_FETCH_ASSOC)) {
    try {
        // Add the CC info to the array
        $ccArray[] = ['email' => $row['Email'], 'name' => $row['Full_Name']];
    } catch (Exception $e) {
        echo 'Invalid address skipped: ' . htmlspecialchars($row['Email']) . '<br>';
        continue;
    }
}

// Add CCs to the mail object after the loop
foreach ($ccArray as $cc) {
    $mail->addCC($cc['email'], $cc['name']);
}


// Add a BCC recipient (for admin or a logging address)
$mail->addBCC('johnmichael.macaraig@brother-biph.com.ph');

$mail->addBCC('jilltherese.garcia@brother-biph.com.ph');
$mail->addBCC('bradly.mateo@brother-biph.com.ph');




// Try sending the email
try {
    // Send the email
    $mail->send();
} catch (Exception $e) {
    echo 'Mailer Error: ' . $mail->ErrorInfo . '<br>';
}
?>

<script>
     alert("Follow-up Email Successfully sent!");
     window.location.replace("../monitoring.php");
</script>
