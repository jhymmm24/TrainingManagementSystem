<?php



require("../PhpMailer/src/PHPMailer.php");
require("../PhpMailer/src/SMTP.php");
require("../PhpMailer/src/Exception.php");
include '../Connection/connection.php';

// Check if $reqlastIDno is set
if (empty($reqlastIDno)) {
    echo "Request ID is missing.";
    exit;
}

$target_empnames = [];

$sql10 = "SELECT * FROM [dbo].[tbl_trainingrequest] WHERE [RequestNumber] = '$reqlastIDno'";
$results = sqlsrv_query($conn, $sql10);

if ($results === false) {
    echo "Error in SQL query execution.";
    exit;
}

if (sqlsrv_has_rows($results)) {
    while ($row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) {
        $requestorname = $row['Requestor Name'];
        $requestdate = $row['Request Date'];
        $topic = $row['Topic'];
        $typeoftraining = $row['Type of Training'];
        $section = $row['Section'];
        $rank = $row['Rank'];
        $urgent = $row['Urgent'];
        $urgent_reason = $row['Reason of Urgency'];
        $target = $row['Target'];
        $target_empno = $row['Employee Number'];
        $target_empnames[] = $row['Employee Name']; // Collect all target employee names

        $sectionspv = $row['Section SPV Approver'];
        $sectionmgr = $row['Section MGR Approver'];
        $petrainingpic = $row['PE Training PIC Approver'];
        $pespvapprover = $row['PE SPV Approver'];
        $mgrapprover = $row['PE MGR Approver'];
        $spvdeclinedreason = $row['SPV_Declined_Reason'];
        $mgrdeclinedreason = $row['MGR_Declined_Reason'];
    }
} else {
    echo "No data found for the specified RequestNumber.";
    exit;
}

// Join target employee names into a single string separated by commas
$target_empnames_str = implode(', ', $target_empnames);

$mail = new \PHPMailer\PHPMailer\PHPMailer();
$mail->SMTPKeepAlive = true;
$mail->setFrom('TMS@brother-biph.com.ph', 'TMS');
$mail->Subject = '[BIPH_BPS] TMS - Training Request  - ['. $reqlastIDno .']';
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

// Convert the collected employee names array into a string with <br> between each name
// Convert the collected employee names array into a string with <br> between each name
$target_empnames_str = implode('<br>', $allTargetEmpNames); // Join names with <br> for line breaks

// Building the email body
$body = '<p style="font-family:arial, sans-serif; font-size:16px;">Dear Section Supervisor,</p>
<p style="font-family:arial, sans-serif; font-size:16px;">Good day, this is to inform you that we have submitted a ' . $topic . ' Training Request.</p>
<table style="font-family:arial, sans-serif; border-collapse: collapse; width:100%">
    <tr style="background-color:#dddddd;">
        <th style="border:1px solid #dddddd; text-align:center;padding:8px;">Training Request ID</th>
        <th style="border:1px solid #dddddd; text-align:center;padding:8px;">Request Date</th>
        <th style="border:1px solid #dddddd; text-align:center;padding:8px;">Target Employees</th>
        <th style="border:1px solid #dddddd; text-align:center;padding:8px;">Section</th>
    </tr>
    <tr>
        <td style="border:1px solid #dddddd; text-align:center;padding:8px" rowspan="1">'.$reqlastIDno.'</td>
        <td style="border:1px solid #dddddd; text-align:center;padding:8px" rowspan="1">'.$requestdate.'</td>
        <td style="border:1px solid #dddddd; text-align:center;padding:8px" rowspan="1">
            '.$target_empnames_str.'
        </td>
        <td style="border:1px solid #dddddd; text-align:center;padding:8px" rowspan="1">'.$section.'</td>
    </tr>
</table>
<p style="font-size:16px; font-family:Century Gothic, sans-serif;">Click this link and Login your credentials <a href="http://apbiphbpsts01:8080/TMS/login.php">Training Management System</a>.</p>
<h4 style="color:red;">**Note: This is a system generated email. Please do not reply to this message. ***</h4>
<h4>🌐[TMS] - Training Management System🌐</h4><img src="cid:image">';


$mail->Body = $body;

$sql_CC = "SELECT * FROM [dbo].[tbl_ems] WHERE Full_Name = '$requestorname' ";
$results_CC = sqlsrv_query($conn,$sql_CC);
while ($row = sqlsrv_fetch_array($results_CC, SQLSRV_FETCH_ASSOC)) {
    try {
        $mail->addCC($row['Email'], $row['Full_Name']);
    } catch (Exception $e) {
        echo 'Invalid address skipped: ' . htmlspecialchars($row['Email']) . '<br>';
        continue;
    }
}

$mail->addBCC('johnmichael.macaraig@brother-biph.com.ph');
$mail->addBCC('jilltherese.garcia@brother-biph.com.ph');
$mail->addBCC('bradly.mateo@brother-biph.com.ph');

$sql2 = "SELECT * FROM [dbo].[tbl_ems] WHERE Full_Name = '$sectionspv' ";
$results2 = sqlsrv_query($conn,$sql2);
while ($row = sqlsrv_fetch_array($results2, SQLSRV_FETCH_ASSOC)) {
    try {
        $mail->addAddress($row['Email'], $row['Full_Name']);
    } catch (Exception $e) {
        echo 'Invalid address skipped: ' . htmlspecialchars($row['Email']) . '<br>';
        continue;
    }
}

try {
    $mail->send();
} catch (Exception $e) {
    echo 'Mailer Error (' . htmlspecialchars($row['Email']) . ') ' . $mail->ErrorInfo . '<br>';
    $mail->getSMTPInstance()->reset();
}
$mail->clearAddresses();
?>
