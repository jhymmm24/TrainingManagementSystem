<?php
require("PhpMailer/src/PHPMailer.php");
require("PhpMailer/src/SMTP.php");
require("PhpMailer/src/Exception.php");
include 'Connection/connection.php';

$mail = new \PHPMailer\PHPMailer\PHPMailer();
$mail->SMTPKeepAlive = true;
$mail->setFrom('TMS@brother-biph.com.ph', 'TMS');
$mail->Subject = '[BIPH_BPS] TMS - Elearning Questionnaire';
$mail->AltBody = 'Please do not reply to this email. Thank you!';
$mail->isSMTP();
$mail->Host = 'smtp.brother.co.jp';
$mail->SMTPAuth = false;
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
$mail->AddEmbeddedImage('assets/img/phishingalert.png', 'image');

$body = '
<p style="font-family: Arial, sans-serif; font-size: 16px;">Dear Section Training PIC,</p>
<p style="font-family: Arial, sans-serif; font-size: 16px;">Good day! This is to inform you that the questionnaire for "' . htmlspecialchars($title) . '" has been successfully uploaded.</p>
<p style="font-family: Arial, sans-serif; font-size: 16px;">You may now start enlisting.</p>
<p style="font-family: Arial, sans-serif; font-size: 16px;">
    <span style="color: blue; font-weight: bold;">End Date of Enlistment:</span> 
    <span style="font-style: italic; background-color: yellow;">' . htmlspecialchars($endenlist ) . '</span>
</p>

<p style="font-size:16px; font-family:Century Gothic, sans-serif;">Click this link and login your credentials <a href="http://apbiphbpsts01:8080/TMS/login.php">Training Management System</a>.</p>

<h4 style="color:red;">**Note: This is a system generated email. Please do not reply to this message. ***</h4>
<h4>🌐[TMS] - Training Management System🌐</h4>
<img src="cid:image">
';




$mail->Body = $body; // Add the body content

// Add BCC
try {
    $mail->AddBCC('johnmichael.macaraig@brother-biph.com.ph');
    $mail->addBCC('jilltherese.garcia@brother-biph.com.ph');
    $mail->addBCC('bradly.mateo@brother-biph.com.ph');
} catch (Exception $e) {
    echo 'Invalid BCC address: ' . htmlspecialchars('johnmichael.macaraig@brother-biph.com.ph') . '<br>';
}

// Fetch recipients from database
$sql2 = "SELECT * FROM [dbo].[tbl_accounts] WHERE Category = 'Section Training PIC'";
$results2 = sqlsrv_query($conn, $sql2);

if ($results2 === false) {
    die(print_r(sqlsrv_errors(), true)); // Handle query errors
}

while ($row = sqlsrv_fetch_array($results2, SQLSRV_FETCH_ASSOC)) {
    // Validate email format
    if (filter_var($row['Email'], FILTER_VALIDATE_EMAIL)) {
        try {
            $mail->addAddress($row['Email'], $row['Full_Name']);
        } catch (Exception $e) {
            echo 'Invalid address skipped: ' . htmlspecialchars($row['Email']) . '<br>';
            continue; // Continue adding valid email addresses
        }
    } else {
        echo 'Invalid email format skipped: ' . htmlspecialchars($row['Email']) . '<br>';
    }
}

// Send the email
try {
    if ($mail->send()) {
        echo 'Email has been sent successfully to all recipients.';
    } else {
        echo 'Error in sending email: ' . $mail->ErrorInfo;
    }
} catch (Exception $e) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

// Clear the recipient list after sending
$mail->clearAddresses();
$mail->clearBCCs(); // Also clear BCC

?>
