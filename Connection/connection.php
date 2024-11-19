<?php


$server_name = "APBIPHBPSTS01";
$connection = array("Database"=>"TEST_TMS", "UID"=>"TMS_user", "PWD"=>"TMS_user123","CharacterSet"=> 'UTF-8');
$conn =sqlsrv_connect($server_name, $connection);


/*WEB SERVER INFORMATION*/
$portNo = $_SERVER['SERVER_PORT'];
$serverName = getenv('COMPUTERNAME');

 
/*EMAIL-SMTP INFORMATION*/
$smtp_username = "ZZPYPH04";
$smtp_password = ".p&55worD";
$smtp_port = 25;

/*DATE TODAY GMT +8*/
date_default_timezone_set('Asia/Singapore');
$today_formated = date("Y-m-d");
$time_now = date("h:i:s A");
$today = date("F d, Y h:i A", time());




?>



