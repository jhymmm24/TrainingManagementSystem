<?php
session_start();
 

$userid = $_SESSION['TMSuser_id'];

$control = $_GET['control'];
$usercategory = $_GET['usercategory'];

if ($_SESSION['user_id'] == null || $_SESSION['user_id'] == "") {

header("Location:../login.php?control=exam&usercategory=0");
}
else{
	header("Location:../login.php?control=login&usercategory=0");
}
 


?>