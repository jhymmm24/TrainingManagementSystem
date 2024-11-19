<!DOCTYPE html>
<html lang="en">

<?php

session_start();


if(!isset($_SESSION['TMSuser_id'])) {
  ?>
      <script>
          alert("Must Login first");
          window.location = "login.php";
      </script>
  <?php
 }

include 'Connection/connection.php';
include 'forms/overall.php';





?>


<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Training Management System</title>
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
 

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">


  <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  



  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jul 27 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>
.sidebar{

    /* background: url("assets/img/sidebarimage.jpg") ; */
    background: url("assets/img/wood.jpg") ;
    
    background-size: 500px 1000000px;
}

.header{
   background-color: #cca175; 
   background-image: linear-gradient(-180deg, #cca175 0%, #B88A4D 100%);

  box-sizing: border-box;
  color: #FFFFFF;
  display: flex;
  font-size: 16px;
  justify-content: center;
  padding: 1rem 1.75rem;
  text-decoration: none;
  width: 100%;
  border: 0;
 
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
 
  /* background: url("assets/img/headerimage.jpg") ; */

}


.button-43:hover {
  background-image: linear-gradient(-180deg, #1D95C9 0%, #17759C 100%);
}

@media (min-width: 768px) {
  .button-43 {
    padding: 1rem 2rem;
  }
}
.button-25:hover {
  box-shadow: rgba(255, 255, 255, 0.3) 0 0 2px inset, rgba(0, 0, 0, 0.4) 0 1px 2px;
  text-decoration: none;
  transition-duration: .15s, .15s;
}

.button-25:active {
  box-shadow: rgba(0, 0, 0, 0.15) 0 2px 4px inset, rgba(0, 0, 0, 0.4) 0 1px 1px;
}

.button-25:disabled {
  cursor: not-allowed;
  opacity: .6;
}

.button-25:disabled:active {
  pointer-events: none;
}

.button-25:disabled:hover {
  box-shadow: none;
}
#datetime{
    position:absolute;
    left: 60%;
    top: 80%;
    transform: translate(-50%, -50%)
}
#pe{
    position:absolute;
    left: 60%;
    top: 30%;
    transform: translate(-50%, -50%)
}

body{
  

  background-image: url('assets/img/blackboard.jpg');
   
   background-size: auto; 
 background-repeat: no-repeat; 


  
}
table tr:hover td {
  background-color: #C6F1F8;
}
.btn {
  background-color: #5BB4DD;
  border: none;
  color: white;
  padding: 12px 30px;
  cursor: pointer;
  font-size: 17px;
}

/* Darker background on mouse-over */
.btn:hover {
  background-color: #00FFFF;
}

@font-face {
    font-family: 'Eraser';
    src: url('assets/fonts/Eraser.ttf'); /* Replace 'path/to/chalkboard-font.ttf' with the actual path to your font file */
}

.custom-font {
    font-family: 'Eraser', sans-serif; /* Apply your custom font */
    /* Add any other styles you want to apply */
    
  
}

#footer, .footer {
    color: white; /* Set footer color to white */
    /* Additional styles can be added here */


}



.logo3d {
  padding-top: 200px;
   width: 250px; /* Adjust the width as needed */
            
        }


        .typewriter h1 {
  overflow: hidden; /* Ensures the content is not revealed until the animation */
  border-right: .15em solid orange; /* The typwriter cursor */
  white-space: nowrap; /* Keeps the content on a single line */
  margin: 0 auto; /* Gives that scrolling effect as the typing happens */
  letter-spacing: .15em; /* Adjust as needed */
  animation: 
    typing 3.5s steps(40, end),
    blink-caret .75s step-end infinite;
}

/* The typing effect */
@keyframes typing {
  from { width: 0 }
  to { width: 100% }
}

/* The typewriter cursor effect */
@keyframes blink-caret {
  from, to { border-color: transparent }
  50% { border-color: orange; }
}

.sidebar-nav .nav-content span {
    color: white;
    font-size: 14px;
}

 

</style>

<body>


  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <a href="maintenance.php" >
    <img src="assets/img/TMSRESIZEENGRAVED.png" alt="Your Logo" class="logo3d" draggable="false" style="margin-top:-10px;">
    </a>
    </div><!-- End Logo -->


    
    <div class="row">         
     <div class="align-items-center justify-content-between text-align: center;">
        <span id="datetime" style="font-size: 12px; position:absolute; " ></span> 
    </div>
    </div>

    <h8 id="pe">BIPH - PRODUCTION ENGINEERING</h8>

    <!-- <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div>End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        


        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/userlogo.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $fullname?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $fullname?></h6>
              <span><?php echo $section?></span>
              <span><?php echo $position?></span>
              <span>|</span>
              <span><?php echo $category?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <!-- <li>
              <a class="dropdown-item d-flex align-items-center" href="userprofile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
         -->

           
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="login.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

 <?php
 
//  include 'sidebar.php';
 
 ?>

    <main id="main" class="main">

<div class="pagetitle">

  <h1 class="custom-font" style="color:white; font-size: 48px;">UNDER SYSTEM MAINTENANCE  . . .</h1>

 
</div><!-- End Page Title -->



<section class="section">
  <div class="row">
    <div class="col-lg-12">

     

    </div>
  </div>
</section>

</main><!-- End #main -->

    

    



  <!-- ======= Footer ======= -->
<?php 

include 'footer.php';


?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
 
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>




  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

 


<script>
       new DataTable('#example23', {
            initComplete: function () {
                this.api()
                    .columns([1,2,3,4,5,6])
                    .every(function () {
                        let column = this;
        
                        // Create select element
                        let select = document.createElement('select');
                        select.add(new Option(''));
                        column.header().replaceChildren(select);
        
                        // Apply listener for user change in value
                        select.addEventListener('change', function () {
                            var val = DataTable.util.escapeRegex(select.value);
        
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
        
                        // Add list of options
                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d, j) {
                                select.add(new Option(d));
                            });
                    });
            },
            columnDefs: [
        { orderable: false, targets: [0,1,2,3,4,5,6,7,8] }
        ]
        });


  </script>
<script>
                    function clickSend()
                    {
                 Swal.fire({
                    title: "Are you sure you want to Generate?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    denyButtonText: `No`
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        Swal.fire("Successfully Sent!", "", "success");
                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                    });
                }

</script>
  
<script>
      // create a function to update the date and time
      function updateDateTime() {
        // create a new `Date` object
        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second:'2-digit'};
       
        const now = new Date();
      

        // get the current date and time as a string
        const currentDateTime = now.toLocaleString("en-US", options);
        

        // update the `textContent` property of the `span` element with the `id` of `datetime`
        document.querySelector('#datetime').textContent = currentDateTime;
      }

      // call the `updateDateTime` function every second
      setInterval(updateDateTime, 1000);
    </script>

<script type="text/javascript">
  function toggle(source) {
    var checkboxes = document.querySelectorAll('input[class="single-checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
</script>


   <!-- Modal -->

    <!-- Modal Structure -->
<div class="modal fade" id="inputConsoleModal" style ="background-color:black;"tabindex="-1" role="dialog" aria-labelledby="inputConsoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inputConsoleModalLabel">Console</h5>
                <button type="button" style="color:red; border:none; background-color:white;" class="close" data-bs-dismiss="modal">&times;</button>
          
                </button>
            </div>
            <div class="modal-body">
            <input type="text" class="form-control" id="consoleInput" placeholder="" autocomplete="off">

            </div>
            
           
        </div>
    </div>
</div>

<!-- New Modal for BattleCity content -->
<div class="modal fade modal-xl" id="battleCityModal" tabindex="-1" role="dialog" aria-labelledby="battleCityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="battleCityModalLabel">BattleCity Content</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Include the content you want to show here -->
                <iframe src="BattleCity/index.html" style="width: 100%; height: 400px;" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>


    <script>
        // JavaScript to handle the key press event and show the modal
        $(document).ready(function() {
            $(document).keydown(function(event) {
                if (event.key === '~' || event.keyCode === 192) { // 192 is the keyCode for `
                    $('#inputConsoleModal').modal('show');
                }
            });
        });

        function submitConsoleInput() {
            var input = $('#consoleInput').val();
            // Handle the input as needed~
            console.log('Console Input:', input);
            // Close the modal
            $('#inputConsoleModal').modal('hide');
        }
    </script>

<script>
    document.getElementById('consoleInput').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            var inputValue = this.value.toLowerCase(); // get the input value in lowercase
            if (inputValue === 'battlecity') {
                // Hide the existing modal
                var inputConsoleModal = new bootstrap.Modal(document.getElementById('inputConsoleModal'));
                inputConsoleModal.hide();
                
                // Show the new modal
                var battleCityModal = new bootstrap.Modal(document.getElementById('battleCityModal'));
                battleCityModal.show();
            } else {
                alert('Invalid command!'); // you can customize this alert
            }
        }
    });
</script>

</body>

</html>