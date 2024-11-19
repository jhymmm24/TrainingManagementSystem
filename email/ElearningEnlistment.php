<?php
require("../PhpMailer/src/PHPMailer.php");
require("../PhpMailer/src/SMTP.php");
require("../PhpMailer/src/Exception.php");

include '../Connection/connection.php';




$target_empnames = [];



//get elearning details

	$sql_edetails = "SELECT * FROM [dbo].[tbl_elearningstatus] WHERE [RequestNumber] = '$reqlastIDno'";
    $result_details = sqlsrv_query($conn, $sql_edetails);

    while ($row = sqlsrv_fetch_array($result_details, SQLSRV_FETCH_ASSOC)) {
        $ElearningTransID = $row['ElearningTransID'];
        $title = $row['Title'];
        $target_empnames[] = $row['Target_Employee'];
		$targetemployeenumber = $row['EmployeeNumber'];
            $enddate = $row['End_Date'];
            $section = $row['Section'];

        $target_emails[] = $row['Email'];
            
    }

    
 // Join target employee names into a single string separated by commas
$target_empnames_str = implode(', ', $target_empnames);


	$mail = new \PHPMailer\PHPMailer\PHPMailer();
	$mail->SMTPKeepAlive = true;
	$mail->setFrom('TMS@brother-biph.com.ph', 'TMS');
	$mail->Subject = '[BIPH_BPS] TMS - E-Learning Enlistment';
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


// Add all target emails to the "To" field
foreach ($target_emails as $email) {
    $mail->addAddress($email); // Add each email address to the "To" field
}


// Initialize the email body
$body = '<p style="font-family:arial, sans-serif; font-size:16px;">Dear Employees,</p>
<p style="font-family:arial, sans-serif; font-size:16px;">Good day, this is to inform that you have been enlisted in <span style="color:blue;">' . $topic . '</span> Elearning Request.</p>
<table style="font-family:arial, sans-serif; border-collapse: collapse; width:100%">
    <tr style="background-color:#dddddd;">
        <th style="border:1px solid #dddddd; text-align:center;padding:8px;">E-Learning Request ID</th>
        <th style="border:1px solid #dddddd; text-align:center;padding:8px;">End Date</th>
        <th style="border:1px solid #dddddd; text-align:center;padding:8px;">Target Employees</th>
        <th style="border:1px solid #dddddd; text-align:center;padding:8px;">Section</th>
    </tr>';

// Ensure target employees and section are available
if (!empty($target_empnames)) {
    // Start loop to create a row for each target employee
    foreach ($target_empnames as $index => $empname) {
        if ($index == 0) {
            // First row will include the Section as well
            $body .= '<tr>
                        <td style="border:1px solid #dddddd; text-align:center;padding:8px;" rowspan="'.count($target_empnames).'">'.$reqlastIDno.'</td>
                        <td style="border:1px solid #dddddd; text-align:center;padding:8px;" rowspan="'.count($target_empnames).'">'.$enddate.'</td>
                        <td style="border:1px solid #dddddd; text-align:center;padding:8px;">'.$empname.'</td>
                        <td style="border:1px solid #dddddd; text-align:center;padding:8px;" rowspan="'.count($target_empnames).'">'.$section.'</td>
                      </tr>';
        } else {
            // Subsequent rows will only include the target employee name
            $body .= '<tr>
                        <td style="border:1px solid #dddddd; text-align:center;padding:8px;">'.$empname.'</td>
                      </tr>';
        }
    }
}

// Close the table
$body .= '</table>';

$body .= '<p style="font-size:16px; font-family:Century Gothic, sans-serif;">Click this link and Login your credentials <a href="http://apbiphbpsts01:8080/TMS/login.php">Training Management System</a>.</p>

<h4 style="color:red;">**Note: This is a system-generated email. Please do not reply to this message. ***</h4>
<h4>🌐[TMS] - Training Management System🌐</h4><img src="cid:image">';

// Assign the generated body to the email
$mail->Body = $body;




				$mail->addBCC('johnmichael.macaraig@brother-biph.com.ph');
				$mail->addBCC('jilltherese.garcia@brother-biph.com.ph');
				$mail->addBCC('bradly.mateo@brother-biph.com.ph');


                $sql_sectionpic = "SELECT * FROM [dbo].[tbl_accounts] WHERE Category = 'Section Training PIC' AND Section = '$section'";
                $results_sectionpic = sqlsrv_query($conn, $sql_sectionpic);
                
                // Fetch all rows into an array
                $rows = [];
                while ($row = sqlsrv_fetch_array($results_sectionpic, SQLSRV_FETCH_ASSOC)) {
                    $rows[] = $row;
                }
                
                // Loop through the array using foreach
                foreach ($rows as $row) {
                    try {
                        $mail->addCC($row['Email'], $row['Full_Name']);
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





