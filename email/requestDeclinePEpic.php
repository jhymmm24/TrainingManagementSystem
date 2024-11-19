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
//include 'forms/overall.php';
/*$reqID = 'REQ-19';*/

foreach ($selectedArray as $selectedValues) {


$sql10 = "SELECT * FROM [dbo].[tbl_trainingrequest] WHERE [RequestNumber] = '$selectedValues'";
$results = sqlsrv_query($conn,$sql10);
while ($row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) {
   $requestorname = $row['Requestor Name'];
   $requestdate = $row['Request Date'];
   $requeststatus = $row['Request_Status'];
   $topic = $row['Topic'];
   $typeoftraining = $row['Type of Training'];
   $section = $row['Section'];
   $rank = $row['Rank'];
   $urgent = $row['Urgent'];
   $urgent_reason = $row['Reason of Urgency'];
   $target = $row['Target'];
   $target_empno = $row['Employee Number'];
   $target_empname = $row['Employee Name'];
 
   $sectionspv = $row['Section SPV Approver'];
   $sectionmgr = $row['Section MGR Approver'];
   $petrainingpic = $row['PE Training PIC Approver'];
   $pespvapprover = $row['PE SPV Approver'];
   $mgrapprover = $row['PE MGR Approver'];
   $spvdeclinedreason = $row['SPV_Declined_Reason'];
   $mgrdeclinedreason = $row['MGR_Declined_Reason'];

   
   $declined_pe_pic = $row['PE_PIC_Declined'];
   $declined_pe_spv = $row['PE_SPV_Declined'];
   $declined_pe_mgr = $row['PE_MGR_Declined'];
   $declined_section_spv = $row['Section_SPV_Declined'];
   $declined_section_mgr = $row['Section_MGR_Declined'];


   $declined_reason_pepic = $row['PE_PIC_Declined_Reason'];
   $declined_reason_pespv = $row['PE_SPV_Declined_Reason'];
   $declined_reason_pemgr = $row['PE_MGR_Declined_Reason'];
   $declined_reason_sectionspv = $row['SPV_Declined_Reason'];
   $declined_reason_sectionmgr= $row['MGR_Declined_Reason'];

   $declinedby = $row['Declined By'];

  }

 

$mail = new \PHPMailer\PHPMailer\PHPMailer();
				$mail->SMTPKeepAlive = true;
				$mail->setFrom('TMS@brother-biph.com.ph', 'TMS');
				$mail->Subject = '[BIPH_BPS] TMS - Training Request have been Declined - ['. $selectedValues .']';
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


				$body = '<p style="font-family:arial, sans-serif; font-size:16px;">Good day, this is to inform that '.$topic.'Training Request has been declined by PE Trainig PIC.</p>
				<p style="font-family:arial, sans-serif; font-size:16px;">Declined Reason: '.$declined_reason_pepic.'</p>
		
				<table style="font-family:arial, sans-serif; border-collapse: collapse; width:100%"><tr style="background-color:#dddddd;">
			    <th style="border:1px solid #dddddd; text-align:left;padding:8px;">Training Request ID</th>
				<th style="border:1px solid #dddddd; text-align:left;padding:8px;">Request Date</th>
				<th style="border:1px solid #dddddd; text-align:left;padding:8px;">Declined By</th>
				<th style="border:1px solid #dddddd; text-align:left;padding:8px;">Section</th>
			
					</tr>';
				$body .= "<tr>
				<td style='border:1px solid #dddddd; text-align:left;padding:8px;'>$selectedValues</td>
				<td style='border:1px solid #dddddd; text-align:left;padding:8px;'>$requestdate</td>
				<td style='border:1px solid #dddddd; text-align:left;padding:8px;'>$declined_pe_pic</td>
			    <td style='border:1px solid #dddddd; text-align:left;padding:8px;'>$section</td>
			

				
				</tr>"; 

				$body .= '</table>

					    <p style="font-size:16px; font-family:Century Gothic, sans-serif;"> Click this link  and Login your credentials <a href="http://apbiphbpsts01:8080/TMS/login.php">Training Management System</a>.</p>
				
				<h4 style="color:red;">**Note: This is a system generated email. Please do not reply to this message. ***</h4>
				<h4>🌐[TMS] - Training Management System🌐</h4><img src="cid:image">';

				$mail->Body = $body;

				$mail->addBCC('johnmichael.macaraig@brother-biph.com.ph');
				$mail->addCC('jilltherese.garcia@brother-biph.com.ph');
				$mail->addCC('bradly.mateo@brother-biph.com.ph');


				$sql1 = "SELECT * FROM [dbo].[tbl_ems] WHERE Full_Name = '$pespvapprover' ";
				$results1 = sqlsrv_query($conn,$sql1);
				while ($row = sqlsrv_fetch_array($results1, SQLSRV_FETCH_ASSOC)) {
					try {
						$mail->addCC($row['Email'], $row['Full_Name']);
					} catch (Exception $e) {
						echo 'Invalid address skipped: ' . htmlspecialchars($row['Email']) . '<br>';
						continue;
					}
				}

			$sql2 = "SELECT * FROM [dbo].[tbl_ems] WHERE Full_Name = '$requestorname' ";
			$results2 = sqlsrv_query($conn,$sql2);
			while ($row = sqlsrv_fetch_array($results2, SQLSRV_FETCH_ASSOC)) {
				try {
					$mail->addAddress($row['Email'], $row['Full_Name']);
				} catch (Exception $e) {
					echo 'Invalid address skipped: ' . htmlspecialchars($row['Email']) . '<br>';
					continue;
				}
			}



			$sql3 = "SELECT * FROM [dbo].[tbl_ems] WHERE Full_Name = '$sectionspv' ";
			$results3 = sqlsrv_query($conn,$sql3);
			while ($row = sqlsrv_fetch_array($results3, SQLSRV_FETCH_ASSOC)) {
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


	}

?>
