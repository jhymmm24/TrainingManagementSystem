<?php
require("../PhpMailer/src/PHPMailer.php");
require("../PhpMailer/src/SMTP.php");
require("../PhpMailer/src/Exception.php");
include '../Connection/connection.php';
//include 'forms/overall.php';
/*$reqID = 'REQ-19';*/
$target_empnames = [];




$sql10 = "SELECT * FROM  $tablename WHERE [RequestNumber] = '$reqlastIDno'";

$results = sqlsrv_query($conn,$sql10);

while ($row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) {
   $requestorname = $row['Requestor_Name'];
   $requestno = $row['RequestNumber'];
   $requestdate = $row['Date_Requested'];
   $requeststatus = $row['StatusRequestNumber'];
   $topic = $row['Topic'];
   $typeoftraining = $row['Type of Training'];
   $section = $row['Section'];
   $position = $row['Position'];

  $section = $row['Section'];

   $target_empno = $row['Employee_Number'];
   $target_empnames[] = $row['Employee_Name']; // Collect all target employee names
 


  }

 // Join target employee names into a single string separated by commas
$target_empnames_str = implode(', ', $target_empnames);

echo $target_empnames_str;

$mail = new \PHPMailer\PHPMailer\PHPMailer();
				$mail->SMTPKeepAlive = true;
				$mail->setFrom('TMS@brother-biph.com.ph', 'TMS');
				$mail->Subject = '[BIPH_BPS] TMS - Elearning Enlistment';
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

			
               $body = '<p style="font-family:arial, sans-serif; font-size:16px;">Dear Training PIC,</p>
			   <p style="font-family:arial, sans-serif; font-size:16px;">Good day, this is to inform that we have submitted a ' . $topic . ' Training Request.</p>
                <table style="font-family:arial, sans-serif; border-collapse: collapse; width:100%">
                    <tr style="background-color:#dddddd;">
                        <th style="border:1px solid #dddddd; text-align:center;padding:8px;">Training Request ID</th>
                        <th style="border:1px solid #dddddd; text-align:center;padding:8px;">Request Date</th>
                        <th style="border:1px solid #dddddd; text-align:center;padding:8px;">Target Employees</th>
                        <th style="border:1px solid #dddddd; text-align:center;padding:8px;">Section</th>
                    </tr>
                    <tr>
                        <td style="border:1px solid #dddddd; text-align:center;padding:8px;" rowspan="'.count($target_empnames).'">'.$requestno.'</td>
                        <td style="border:1px solid #dddddd; text-align:center;padding:8px;" rowspan="'.count($target_empnames).'">'.$requestdate.'</td>';
                        
                // Start loop to create a row for each target employee
                foreach ($target_empnames as $index => $empname) {
                    if ($index == 0) {
                        // First row will include the Section as well
                        $body .= '<td style="border:1px solid #dddddd; text-align:center;padding:8px;">'.$empname.'</td>
                                  <td style="border:1px solid #dddddd; text-align:center;padding:8px;" rowspan="'.count($target_empnames).'">'.$section.'</td>
                        </tr>';
                    } else {
                        // Subsequent rows will only include the target employee name
                        $body .= '<tr>
                                    <td style="border:1px solid #dddddd; text-align:center;padding:8px;">'.$empname.'</td>
                                  </tr>';
                    }
                }

				$body .= '</table>
				

				    <p style="font-size:16px; font-family:Century Gothic, sans-serif;"> Click this link  and Login your credentials <a href="http://apbiphbpsts01:8080/TMS/login.php">Training Management System</a>.</p>


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
				



			$sql2 = "SELECT * FROM [dbo].[tbl_ems] WHERE Full_Name = 'John Michael Macaraig' ";
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
