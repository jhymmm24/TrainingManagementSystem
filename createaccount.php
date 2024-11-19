<!DOCTYPE html>
<html lang="en">

<?php

include 'Connection/connection.php';
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
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

           

              <div class="card mb-3" style="background-image: url('<?php echo $bgImage; ?>');">

                <div class="card-body" >

                  <div class="pt-4 pb-2">
               
                  <img src="assets/img/TMSBROWN.png" style="width:500px; margin-left:-30px;"alt="" id="tmslogo">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small" style="color:white; ">Enter your details to create account</p>
                  </div>

                  <form method="POST" action="forms/sqlupdates.php?action=register" class="row g-3 needs-validation" novalidate>
                    <div class="col-12">
                      <label for="yourName" class="form-label" style="color:white; ">EMPLOYEE NUMBER</label>
                      
                      <input type="search" list="datalist" name="biph_id" class="form-control" id="biph_id" required onchange="checkID();">
          
                      <datalist id="datalist">
                      <?php
                      include 'Connection/connection.php';
                              $sql_datalist = "SELECT EmpNo, ADID FROM tbl_ems";
                              $stmt2 = sqlsrv_query($conn,$sql_datalist);
                              while($row3 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
                                echo '<option value="'.$row3['EmpNo'].'">'.$row3['ADID'].'</option>';
                              }
                              ?>
                             
                       </datalist>
          

                      <div class="invalid-feedback">Please, enter your Employee Number!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label" style="color:white; " >FULL NAME </label>
                      <input type="text" name="fullname" class="form-control"  id="fullname" required readonly>

                      <div class="invalid-feedback">Please enter your Fullname!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label" style="color:white; ">ADID</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="adid" class="form-control" id="adid" required readonly>
                        <div class="invalid-feedback">Please enter your ADID!</div>
                      </div>
                    </div>


                    <div class="col-12">
                      <label for="yourPosition" class="form-label" style="color:white; ">Position </label>
                      <input type="text" name="position" class="form-control"  id="position" required readonly>
                      <div class="invalid-feedback">Please enter your Position!</div>
                    </div>

                  

                    <div class="col-12">
                      <label for="yourSection" class="form-label" style="color:white; ">Section </label>
                      <input type="text" name="section" class="form-control"  id="section" required readonly>
                      <div class="invalid-feedback">Please enter your Section!</div>
                    </div>

                 


                    <div class="col-12">
                      <label for="yourEmail" class="form-label" style="color:white; ">Email </label>
                      <input type="text" name="email" class="form-control"  id="email" required readonly>

                      <div class="invalid-feedback">Please enter your Email!</div>
                    </div>

                    <div class="col-12">
    <label class="form-label" style="color:white;">Category</label>
    <div class="col-sm-12">
        <select class="form-select" aria-label="Default select example" id="category" name="category" required>
            <option selected disabled>Select Category</option>
            <option value="User">User</option>
            <option value="Approver" id="approver-option" style="display: none;">Approver</option> <!-- Added an ID for the Approver option -->
        </select>
    </div>
</div>     
                    <div class="invalid-feedback">Please enter your category!</div>
                   
                
                    <div class="col-12">
                      <label for="yourPassword" class="form-label" style="color:white; ">Password</label>
                      <input type="password" name="password" class="form-control" id="password" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <!-- <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms" style="color:white; ">I agree and accept the <a href="#" style="color:yellow; ">terms and conditions</a></label>
                        <div class="invalid-feedback" style="color:white; ">You must agree before submitting.</div>
                      </div>
                    </div> -->
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0" style="color:white; ">Already have an account? <a href="login.php"  class="custom"  >Log in</a></p>
                    </div>

                
                  </form>




                </div>
              </div>

              </div>
                    </div>

        
            </div>
<!-- 
            try dto -->
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
            $(document).ready(function() {
                var biph_id = document.getElementById('biph_id').value;

                if (biph_id == null || biph_id == "") {
                    // Clear input fields if biph_id is empty
                    document.getElementById('biph_id').focus();
                    document.getElementById('fullname').value = "";
                    document.getElementById('adid').value = "";
                    document.getElementById('section').value = "";
                    document.getElementById('position').value = "";
                    document.getElementById('email').value = "";
                } else {
                    $.ajax({
                        url: "fetchdata.php",
                        method: "POST",
                        data: { biph_id: biph_id },
                        dataType: "JSON",
                        success: function(data) {
                            // Fill the form fields with data received from the server
                            $('#fullname').val(data.fullname);
                            $('#adid').val(data.adid);
                            $('#section').val(data.section);
                            $('#position').val(data.position);
                            $('#email').val(data.email);

                            // Call the function to update the category based on the position
                            updateCategoryBasedOnPosition(data.position);
                        }
                    });
                }
            });
        }

        function updateCategoryBasedOnPosition(position) {
            const approverOption = document.getElementById('approver-option');
            const categorySelect = document.getElementById('category');

            // Check if the position is blank
            if (!position || position.trim() === '') {
                approverOption.style.display = 'none'; // Hide the Approver option
                approverOption.disabled = true; // Disable the Approver option
                categorySelect.value = ''; // Reset the dropdown if position is blank
            } else if ((position === 'Supervisor')||(position === 'Junior Supervisor')||(position === 'Senior Supervisor')||(position === 'Manager')||(position === 'Assistant Manager')||(position === 'Senior Manager')||(position === 'Adviser')) {
                approverOption.style.display = 'block'; // Show the Approver option
                approverOption.disabled = false; // Enable the Approver option
                categorySelect.value = 'Approver'; // Set the dropdown value to "Approver"
            } else {
                approverOption.style.display = 'none'; // Hide the Approver option
                approverOption.disabled = true; // Disable the Approver option
                categorySelect.value = ''; // Reset the dropdown if not "Senior Supervisor"
            }
        }   function updateCategoryBasedOnPosition(position) {
            const approverOption = document.getElementById('approver-option');
            const categorySelect = document.getElementById('category');

            // Check if the position is blank
            if (!position || position.trim() === '') {
                approverOption.style.display = 'none'; // Hide the Approver option
                approverOption.disabled = true; // Disable the Approver option
                categorySelect.value = ''; // Reset the dropdown if position is blank
            } else if ((position === 'Supervisor')||(position === 'Junior Supervisor')||(position === 'Senior Supervisor')||(position === 'Manager')||(position === 'Assistant Manager')||(position === 'Senior Manager')||(position === 'Adviser')) {
                approverOption.style.display = 'block'; // Show the Approver option
                approverOption.disabled = false; // Enable the Approver option
                categorySelect.value = 'Approver'; // Set the dropdown value to "Approver"
            } else {
                approverOption.style.display = 'none'; // Hide the Approver option
                approverOption.disabled = true; // Disable the Approver option
                categorySelect.value = ''; // Reset the dropdown if not "Senior Supervisor"
            }
        }
    </script>






<script>
function openOutlook() {
    // Assuming Outlook is installed as the default email client
    window.location.href = "mailto:johnmichael.macaraig@brother-biph.com.ph";
}
</script>


</body>

</html>