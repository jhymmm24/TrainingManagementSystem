
<?php


include 'Connection/connection.php';


session_start();
unset($_SESSION['TMSuser_id']);

$control = $_GET['control'];
$usercategory = $_GET['usercategory'];



if($usercategory == null || $control == null){
 header('location:login.php?control=login&usercategory=0');
}






?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login - Training Management System</title>
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

   <style>
    #tmslogo{
       
        margin-left: 50px;
    }
    .card{
        background-color: #C6F1F8;
        border-style: solid;
        border-color: white;
    }

    /* CSS for the card */
    .card {
           width: 500px;
            background-size: cover;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            margin: 20px;
        }

        /* CSS for the card content */
        .card-content {
            padding: 20px;
            color: white;
            text-align: center;
        }


        
@font-face {
    font-family: 'Eraser';
    src: url('assets/fonts/Eraser.ttf'); /* Replace 'path/to/chalkboard-font.ttf' with the actual path to your font file */
}

.custom-font {
    font-family: 'Eraser', sans-serif; /* Apply your custom font */
    /* Add any other styles you want to apply */
    
  
}

button {
  position: relative;
  padding: 13px 35px;
  background: #f5ddb7;
  font-size: 17px;
  font-weight: 900;
  color: #181818;
  border: none;
  border-radius: 8px;
  box-shadow: 2px 2px 5px #18181869, inset 2px 2px 10px #ffffffb0;
  transition: all .3s ease-in-out;
}



button:hover {
  box-shadow: rgba(255, 255, 255, .2) 0 3px 15px inset, rgba(0, 0, 0, .1) 0 3px 5px, rgba(0, 0, 0, .1) 0 10px 13px;
  transform: scale(1.05);
}


.custom {

  color:yellow;

}


.custom:hover {

color:green;

}

body {
        background-color: #2e2521; /* Black background */
        color: #fff; /* White text */
        font-family: Arial, sans-serif; /* Font family */
        margin: 0; /* Remove default margin */
        padding: 0; /* Remove default padding */
        transform:scale(.75);
        height:100vh;
        
    }

.card{

 

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

  <?php
    // Path to your background image
    $bgImage = "assets/img/Engraved_BG.png";
   
  ?>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container" >
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center" >

              <!-- <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/tmscrop.png" alt="">
                  <span class="d-none d-lg-block">Training Management System</span>
                </a>
              </div> -->

              <div class="card mb-3" style="background-image: url('<?php echo $bgImage; ?>');" >

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <!-- <h5 class="card-title text-center pb-0 fs-4"></h5> -->
                    <img src="assets/img/TMSBROWN.png" style="width:500px; margin-left:-30px;"alt="" id="tmslogo">
                    <p class="custom-font" style="font-size: 30px; color:white; margin-left: 70px;">Login to your account</p>
                  </div>

                  <form class="row g-3 needs-validation" autocomplete="off"  method="POST" action="forms/sqlupdates.php?action=login&control=<?php echo $control?>">

                    <div class="col-12">
                      <label for="ADID" class="form-label" style="color:white;">Enter your Employee Number</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        
                      <input type="search" list="brow1" name="biph_id" class="form-control" id="biph_id" required>

                      <datalist id="brow1">
                      <?php
                              $sql2 = "SELECT EmployeeNumber, ADID FROM tbl_accounts";
                              $stmt2 = sqlsrv_query($conn,$sql2);
                              while($row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
                                echo '<option value="'.$row2['EmployeeNumber'].'">'.$row2['ADID'].'</option>';
                              }
                              ?>
                       </datalist>


                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label" style="color:white;">Enter your PASSWORD</label>
                      <input type="password" name="password" class="form-control" id="password" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    

                 
                    <div class="col-12 text-center">
                      <button class="button"  type="submit"  href="">Login</button>
                    </div>
                    <div class="col-6">
                      <p class="small mb-0" style="color:white;">Don't have account? <a href="createaccount.php"   class="custom" ><br>Create an account</a></p>
                    </div>


                    <div class="col-6">
                    <p class="small mb-0 " style="text-align:right;"><a href="forgotpassword.php" class="custom" >Forgot Password</a></p>
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
                <!-- Designed & Developed by <a href="" style="color:#B5754A;" onclick="openOutlook()">JM MACARAIG</a> -->
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

  <script>
function openOutlook() {
    // Assuming Outlook is installed as the default email client
    window.location.href = "mailto:johnmichael.macaraig@brother-biph.com.ph";
}
</script>

</body>

</html>