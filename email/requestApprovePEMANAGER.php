<?php

if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) {
    require_once("../PhpMailer/src/PHPMailer.php");
    require_once("../PhpMailer/src/SMTP.php");
    require_once("../PhpMailer/src/Exception.php");
    echo "PHPMailer class loaded\n"; // Debugging line
} else {
    echo "PHPMailer already loaded\n"; // Debugging line
}



include '../Connection/connection.php';

foreach ($_POST['selected'] as $selectedValues) {
    // Query to get the relevant data for the current loop
    $sql10 = "SELECT * FROM [dbo].[tbl_trainingrequest] WHERE [RequestNumber] = '$selectedValues'";
    $results = sqlsrv_query($conn, $sql10);
    
    // Resetting target employee names array for each loop
    $target_empnames = [];
    
    // Initialize variables outside the while loop
    $requestorname = '';
    $requestdate = '';
    $requeststatus = '';
    $topic = '';
    $section = '';
    $pespvapprover = '';

    
    // Collect all necessary data in the loop
    while ($row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) {
        $requestorname = $row['Requestor Name'];
        $requestdate = $row['Request Date'];
        $requeststatus = $row['Request_Status'];
        $topic = $row['Topic'];
        $section = $row['Section'];
        $target_empnames[] = $row['Employee Name']; // Collect all target employee names
        $pespvapprover = $row['PE SPV Approver'];
		$pemgrapprover = $row['PE MGR Approver'];

		$sectionspv = $row['Section SPV Approver'];
		$sectionmgr = $row['Section MGR Approver'];
		$petrainingpic = $row['PE Training PIC Approver'];
	
	
		$spvdeclinedreason = $row['SPV_Declined_Reason'];
		$mgrdeclinedreason = $row['MGR_Declined_Reason'];
	 
    }

    // Now, send the email only once after processing all rows
    if (!empty($target_empnames)) {
        // Join target employee names into a single string separated by commas
        $target_empnames_str = implode(', ', $target_empnames);

        // Initialize a new PHPMailer instance
        $mail = new \PHPMailer\PHPMailer\PHPMailer();
        $mail->SMTPKeepAlive = true;
        $mail->setFrom('TMS@brother-biph.com.ph', 'TMS');
        $mail->Subject = '[BIPH_BPS] TMS - Training Request Approval - [' . $selectedValues . ']';
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
        $mail->isHTML(true);
        $mail->CharSet = 'utf-8';
        $mail->AddEmbeddedImage('../assets/img/phishingalert.png', 'image');

        // Build the email body
		$body = '<p style="font-family:arial, sans-serif; font-size:16px;">Dear PE Manager,</p>';
        $body .= '<p style="font-family:arial, sans-serif; font-size:16px;">Good day, please see below request link for approval of ' . $topic . ' Training Request.</p>';
        $body .= '<table style="font-family:arial, sans-serif; border-collapse: collapse; width:100%">';
        $body .= '<tr style="background-color:#dddddd;">
                        <th style="border:1px solid #dddddd; text-align:center;padding:8px;">Training Request ID</th>
                        <th style="border:1px solid #dddddd; text-align:center;padding:8px;">Request Date</th>
                        <th style="border:1px solid #dddddd; text-align:center;padding:8px;">Target Employees</th>
                        <th style="border:1px solid #dddddd; text-align:center;padding:8px;">Section</th>
                    </tr>';
        
        foreach ($target_empnames as $index => $empname) {
            if ($index == 0) {
                $body .= '<tr>
                            <td style="border:1px solid #dddddd; text-align:center;padding:8px;" rowspan="' . count($target_empnames) . '">' . $selectedValues . '</td>
                            <td style="border:1px solid #dddddd; text-align:center;padding:8px;" rowspan="' . count($target_empnames) . '">' . $requestdate . '</td>
                            <td style="border:1px solid #dddddd; text-align:center;padding:8px;">' . $empname . '</td>
                            <td style="border:1px solid #dddddd; text-align:center;padding:8px;" rowspan="' . count($target_empnames) . '">' . $section . '</td>
                          </tr>';
            } else {
                $body .= '<tr><td style="border:1px solid #dddddd; text-align:center;padding:8px;">' . $empname . '</td></tr>';
            }
        }

        $body .= '</table>';
        $body .= '<p style="font-size:16px; font-family:Century Gothic, sans-serif;"> Click this link  and Login your credentials <a href="http://apbiphbpsts01:8080/TMS/login.php">Training Management System</a>.</p>';
        $body .= '<h4 style="color:red;">**Note: This is a system generated email. Please do not reply to this message. ***</h4>
                  <h4>🌐[TMS] - Training Management System🌐</h4><img src="cid:image">';

        $mail->Body = $body;

        // Add BCC recipients
        $mail->addCC('johnmichael.macaraig@brother-biph.com.ph');
        $mail->addCC('jilltherese.garcia@brother-biph.com.ph');
        $mail->addCC('bradly.mateo@brother-biph.com.ph');

        // Add main recipients
        $sql2 = "SELECT * FROM [dbo].[tbl_ems] WHERE Full_Name = '$pemgrapprover'";
        $results2 = sqlsrv_query($conn, $sql2);
        while ($row = sqlsrv_fetch_array($results2, SQLSRV_FETCH_ASSOC)) {
            try {
                $mail->addAddress($row['Email'], $row['Full_Name']);
            } catch (Exception $e) {
                echo 'Invalid address skipped: ' . htmlspecialchars($row['Email']) . '<br>';
                continue;
            }
        }

        // Add CC recipients
        $sql_CC = "SELECT * FROM [dbo].[tbl_ems] WHERE Full_Name = '$requestorname'";
        $results_CC = sqlsrv_query($conn, $sql_CC);
        while ($row = sqlsrv_fetch_array($results_CC, SQLSRV_FETCH_ASSOC)) {
            try {
                $mail->addCC($row['Email'], $row['Full_Name']);
            } catch (Exception $e) {
                echo 'Invalid address skipped: ' . htmlspecialchars($row['Email']) . '<br>';
                continue;
            }
        }


		    // Add CC recipients
			// $sql_CC2 = "SELECT * FROM [dbo].[tbl_ems] WHERE Full_Name = '$sectionspv'";
			// $results_CC2 = sqlsrv_query($conn, $sql_CC2);
			// while ($row = sqlsrv_fetch_array($results_CC2, SQLSRV_FETCH_ASSOC)) {
			// 	try {
			// 		$mail->addCC($row['Email'], $row['Full_Name']);
			// 	} catch (Exception $e) {
			// 		echo 'Invalid address skipped: ' . htmlspecialchars($row['Email']) . '<br>';
			// 		continue;
			// 	}
			// }

        // Send the email
        try {
            $mail->send();
            echo 'Email sent for Request Number: ' . $selectedValues . '<br>';
        } catch (Exception $e) {
            echo 'Mailer Error (' . htmlspecialchars($row['Email']) . ') ' . $mail->ErrorInfo . '<br>';
            $mail->getSMTPInstance()->reset();
        }

        // Clear the addresses and recipients for the next loop
        $mail->clearAddresses();
        $mail->clearCCs();
    } else {
        echo 'No target employees found for Request Number: ' . $selectedValues . '<br>';
    }
}
