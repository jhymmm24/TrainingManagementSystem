
<?php


$userid = $_SESSION['TMSuser_id'];



$sql = "SELECT * FROM tbl_accounts WHERE EmployeeNumber =  '".$userid."' ";
$stmt = sqlsrv_query($conn,$sql);
while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

  $empno = $row['EmployeeNumber'];
  $fullname = $row['Full_Name'];
  $adid = $row['ADID'];
  $email = $row['Email'];
  $pass = $row['Pass'];
  $category = $row['Category'];
  $section = $row['Section'];
  $position = $row['Position'];


  
  
  

}





?>