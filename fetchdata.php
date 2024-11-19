<?php
include 'Connection/connection.php';


$biph_id = $_POST['biph_id'];
 
$query = "SELECT * FROM tbl_ems WHERE EmpNo = '$biph_id'";
$stmt = sqlsrv_query($conn,$query);
while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
 
  $fullname = $row['Full_Name'];
  $fullname = utf8_encode($fullname);
  $email = $row['Email'];
  $adid = $row['ADID'];
  $section = $row['Section'];
  $position = $row['Position'];

}

  $data["fullname"] = $fullname;
  $data["email"] = $email;
  $data["adid"] = $adid;
  $data["section"] = $section;
  $data["position"] = $position;
  
echo json_encode($data);
?>
 