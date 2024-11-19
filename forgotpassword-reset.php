<!DOCTYPE html>
<html lang="en">

<?php

include 'Connection/connection.php';

$user_id= $_GET['user_id'];
?>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> Register - Training Management System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/headerlogo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<style>
    #tmslogo{
       
       margin-left: 50px;
   }
.card{
        background-color: #C6F1F8;
        border-style: solid;
        border-color: #5BB4DD;
    }

    body {
        background-color: #2e2521; /* Black background */
        color: #fff; /* White text */
        font-family: Arial, sans-serif; /* Font family */
        margin: 0; /* Remove default margin */
        padding: 0; /* Remove default padding */
    }
</style>




  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jul 27 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

    <?php
    // Path to your background image
    $bgImage = "assets/img/Engraved_BG.png";
   
  ?>

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

           

            <div class="card mb-3" style="background-image: url('<?php echo $bgImage; ?>'); border-color:white;">

                <div class="card-body">


                <?php
                $user_id = $_GET['user_id'];

                $sqlforgot =   "SELECT  * from tbl_ems WHERE [EmpNo] = '$user_id'";
                                
                     $result = sqlsrv_query($conn, $sqlforgot);

                     while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                         $empno = $row['EmpNo'];
                         $fullname = $row['Full_Name'];
                         $email = $row['Email'];

                        }
                
                

                
                ?>

                  <div class="pt-4 pb-2">
                  <img src="assets/img/TMSBROWN.png" style="width:500px; margin-left:-30px;"alt="" id="tmslogo">
                    <h5 class="card-title text-center pb-0 fs-4">Forgot Password</h5>
                    <p class="text-center small" style="color:white;">Enter your details to reset your password</p>
                  </div>

                  <form method="POST" action="forms/sqlupdates.php?action=newpassword" class="row g-3 needs-validation" novalidate>
                    <div class="col-12">
                      <label for="yourName" class="form-label" style="color:white;">EMPLOYEE NUMBER</label>
                      
                      <input type="text" name="biph_id" class="form-control"  value ="<?php echo $empno?>" id="biph_id" readonly required >

          

                      <div class="invalid-feedback">Please, enter your Employee Number!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label" style="color:white;">FULL NAME </label>
                      <input type="text" name="fullname" value ="<?php echo $fullname?>" class="form-control"  id="fullname" required readonly>

                      <div class="invalid-feedback">Please enter your Fullname!</div>
                    </div>

                 
                   
                    <div class="col-12">
                      <label for="yourPassword" class="form-label" style="color:white;">EMAIL</label>
                      <input type="text" name="email" value ="<?php echo $email?>"class="form-control" id="email" required readonly>
                      <div class="invalid-feedback">Please enter your Email!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label" style="color:white;">NEW PASSWORD</label>
                      <input type="password" name="newpassword" class="form-control" id="newpassword" required autocomplete="off" >
                      <div class="invalid-feedback">Please enter your New Password!</div>
                    </div>


              
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" >Reset Password </button>
                    </div>
                   
                  </form>

                </div>
              </div>

          
              <div class="credits">

<div class="copyright" style="color:white;">
&copy; Copyright 2024 <strong><span>BPS</span></strong>. All Rights Reserved
</div>
  <!-- All the links in the footer should remain intact. -->
  <!-- You can delete the links only if you purchased the pro version. -->
  <!-- Licensing information: https://bootstrapmade.com/license/ -->
  <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
  Designed & Developed by <a href="" style="color:#B5754A;" onclick="openOutlook()">JM MACARAIG</a>
</div>

            </div>
          </div>
        </div>


      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <script type="text/javascript">
  function checkID() {
    $(document).ready(function(){   
     
      var biph_id= document.getElementById('biph_id').value;
  
      
      if (biph_id == null || biph_id == "") {
        document.addUser.biph_id.focus();
        document.getElementById('biph_id').focus();
        document.getElementById('biph_id').value = "";
        document.getElementById('fullname').value ="";
        document.getElementById('adid').value ="";
        document.getElementById('email').value ="";
   
      }
      else{
 
        $.ajax({
          url:"fetchdata.php",
          method:"POST",
          data:{biph_id:biph_id},
          dataType:"JSON",
          success:function(data)
          {
            
            $('#fullname').val(data.fullname);
            $('#email').val(data.email);
           
          }
        });
      }
 
    });
 
  }
</script>


</body>

</html>