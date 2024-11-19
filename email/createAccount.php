<?php
require("../PhpMailer/src/PHPMailer.php");
require("../PhpMailer/src/SMTP.php");
require("../PhpMailer/src/Exception.php");

include '../Connection/connection.php';

$empno= $_POST['biph_id'];


/*$reqID = 'REQ-19';*/
$sqlreset = "SELECT * FROM [dbo].[tbl_accounts] WHERE [EmployeeNumber] = '$empno'";
$results = sqlsrv_query($conn,$sqlreset);
while ($row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) {
   $fullname = $row['Full_Name'];
   $adid = $row['ADID'];
   $email = $row['Email'];
   $employeenumber = $row['EmployeeNumber'];
   $password2 = $row['Pass'];
   $category = $row['Category'];
   

  }


$mail = new \PHPMailer\PHPMailer\PHPMailer();
				$mail->SMTPKeepAlive = true;
				$mail->setFrom('TMS@brother-biph.com.ph', 'TMS');
				$mail->Subject = '[BIPH_BPS] TMS  - Account Registration';
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


				$body = '<p style="font-size:16px;">Your account was successfully created at exactly '.$today.'</p>
				<p style="font-size:16px;">Username: '.$employeenumber.' <br> Password: '.$password2.' <br> Click this link to Login <a href="http://apbiphbpsts01:8080/TMS/login.php">TMS Login</a></p>
				<br>
				<h4 style="color:red;">**Note: This is a system generated email. Please do not reply to this message. ***</h4>
                <h4>🌐[TMS] - Training Management System🌐</h4><img src="cid:image">';
				

				$mail->Body = $body;


				


				try {
					$mail->addAddress($email,$fullname);
				} catch (Exception $e) {
					echo 'Invalid address skipped: ' . htmlspecialchars('johnmichael.macaraig@brother-biph.com.ph') . '<br>';
				}

                $mail->AddBCC('johnmichael.macaraig@brother-biph.com.ph');
			

		try {
			$mail->send();
		} catch (Exception $e) {
			echo 'Mailer Error (' . htmlspecialchars('johnmichael.macaraig@brother-biph.com.ph') . ') ' . $mail->ErrorInfo . '<br>';
			$mail->getSMTPInstance()->reset();
		}
		$mail->clearAddresses();


?>



