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
  <link href="assets/img/tmscrop.png" rel="icon">
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

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

<!-- Date Time Picker  -->

<link rel="stylesheet" type="text/css" href="/jquery.datetimepicker.css"/>
<script src="/jquery.js"></script>
<script src="/build/jquery.datetimepicker.full.min.js"></script>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>



  <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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

    background: url("assets/img/sidebarimage.jpg") ;
    background-repeat: no-repeat;
    background-size: 500px 1000px;
}

.header{
  /* background-color: #F7BD13; */
  background: url("assets/img/headerimage.jpg") ;

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
  background-color: #CAF2F1;
  
}
.card{
       
        border-style: solid;
        border-color: #5BB4DD;
    }

.btn {
  background-color: DodgerBlue;
  border: none;
  color: white;
  padding: 12px 30px;
  cursor: pointer;
  font-size: 17px;
}

/* Darker background on mouse-over */
.btn:hover {
  background-color: RoyalBlue;
}
table tr:hover td {
  background-color: #C6F1F8;
}

iframe{
                display: block;       /* iframes are inline by default */
                background: #000;
                border: none;         /* Reset default border */
                height: 50vh;        /* Viewport-relative units */
                width: 78vw;
                        
             }
  



</style>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/tmscrop.png" alt="">
        <span class="d-none d-lg-block" style="  font-size: 18px;">Training Management System</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
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
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="userprofile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
        

           
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Enlistments</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse  " data-bs-parent="#sidebar-nav">
          <li>
            <a href="commontraining.php">
            <i class="bi bi-circle"></i><span>Common Training</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="bi bi-circle"></i><span>HASHIRA</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="bi bi-circle"></i><span>Technical Standard</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="bi bi-circle"></i><span>Other Trainings</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Training Application</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse  " data-bs-parent="#sidebar-nav">
          <li>
            <a href="trainingrequest.php"  >
              <i class="bi bi-circle"></i><span>Training Request</span>
            </a>
          </li>
          <li>
            <a href="requestapproval.php">
              <i class="bi bi-circle"></i><span>Request Approval</span>
            </a>
          </li>
          <li>
            <a href="requeststatus.php">
              <i class="bi bi-circle"></i><span>Request Status</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>E-Learning</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse collapse show" data-bs-parent="#sidebar-nav">
          <li>
            <a href="uploading.php" >
              <i class="bi bi-circle"></i><span>Uploading</span>
            </a>
          </li>
          <li>
            <a href="exam.php" class="active">
              <i class="bi bi-circle"></i><span>Training Examination</span>
            </a>
          </li>
          <li>
            <a href="questionnaire.php">
              <i class="bi bi-circle"></i><span>Questionnaire</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Training Result</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="trainingresult.php">
              <i class="bi bi-circle"></i><span>Training Result Summary</span>
            </a>
          </li>
          <li>
            <a href="trainingresult-soldering.php">
              <i class="bi bi-circle"></i><span>Soldering</span>
            </a>
          </li>
          <li>
            <a href="trainingresult-prodbasic.php">
              <i class="bi bi-circle"></i><span>Prod Basic Skill</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->



     
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#skillmap-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person"></i><span>PE Skill Map</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="skillmap-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="skillmap.php" >
              <i class="bi bi-circle"></i><span>Skill Map Summary</span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Skill Map Results</span>
            </a>
          </li>
         
        </ul>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#chartsx-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people-fill"></i><span>PE Section Training</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="chartsx-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="sectiontraining-pbs.php">
              <i class="bi bi-circle"></i><span>Prod. Basic Skill Training</span>
            </a>
          </li>
          <li>
            <a href="sectiontraining-soldering.php">
              <i class="bi bi-circle"></i><span>Soldering</span>
            </a>
          </li>
          <li>
            <a href="sectiontraining-internal.php">
              <i class="bi bi-circle"></i><span>Section Internal Training</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="">
          <i class="bi bi-card-checklist"></i>
          <span>Masterlist</span>
        </a>
      </li><!-- End Contact Page Nav -->

    
      <li class="nav-item">
        <a class="nav-link collapsed" href="login.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->

      

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
          <i class="bi bi-file-earmark"></i>
          <span>Blank</span>
        </a>
      </li><!-- End Blank Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->


<main id="main" class="main">

<div class="pagetitle">
  <!-- <h1>Common Training</h1> -->
 
</div><!-- End Page Title -->


<div class="card">



            <div class="card-body">
          
             <h5 class="card-title">Training and Examination</h5>



              <!-- Floating Labels Form -->

              
              <form class="row g-3">

              <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="employeeno" name="employeeno" placeholder="Employee Number" onchange="checkID();" autocomplete="off">
                    <label for="floatingName">BIPH Employee Number : </label>
                  </div>
                </div>
               
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Your Name" autocomplete="off">
                    <label for="floatingName">Name: </label>
                  </div>
                  <br>
                </div>
               
         



             

            
            
                
         
              
       
              </form><!-- End floating Labels Form -->

            </div>
          </div>

   
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>


      

      
            
             
          
   


          <table id="example24" class="display" style="width:100%; overflow-x: auto;  white-space: nowrap;   display: block;">
    <thead>
        <tr>
            <th style=" width: 5px;">Select</th>
            <th style=" text-align: center;">E-LEARNING ID</th>
            <th style=" text-align: center;">E-LEARNING TITLE</th>
            <th  style=" text-align: center;" >Employee Number</th>
            <th style=" text-align: center;" >Full Name</th>
            <th style=" text-align: center;">Section</th>
            <th style=" text-align: center;">Upload Date</th>
            <th style=" text-align: center;">Target Date</th>
            <th style=" text-align: center;"></th>
         
        </tr>
        <tr>
        <th style=" width: 5px;"></th>
        <th style=" text-align: center;">E-LEARNING ID</th>
            <th style=" text-align: center;">E-LEARNING TITLE</th>
            <th  style=" text-align: center;" >Employee Number</th>
            <th style=" text-align: center;" >Full Name</th>
            <th style=" text-align: center;">Section</th>
            <th style=" text-align: center;">Upload Date</th>
            <th style=" text-align: center;">Target Date</th>
            <th style=" text-align: center;"></th>
        </tr>
    </thead>
    <tbody>

    <?php
           $trequest = "SELECT  * FROM [dbo].[tbl_elearningstatus]";
           $stmt3 = sqlsrv_query($conn,$trequest);
                          while($row = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
                              $id = $row['ID'];
                              $title = $row['Title'];
                              $targetemployee= $row['Target_Employee'];
                              $uploaddate = $row['Upload_Date'];
                              $targetdate = $row['Target_Date'];
                              $status = $row['Elearning_Status'];
                              $section = $row['Section'];
                              $employeeno = $row['EmployeeNumber'];
                              $elearningID= $row['ElearningTransID'];
                            
                            
                              

                              echo

                              '<tr>
                                  <td style="width: 5px; text-align: center;"> <input type="checkbox" name="selected[]" class="single-checkbox" id="selected" value="'.$id.'"></td>
                                  <td style=" text-align: center;">'  . $row['ElearningTransID'] .'</td>
                                  <td style=" text-align: center;">'  . $row['Title'] .'</td>
                                  <td style=" text-align: center;">'  . $row['EmployeeNumber'] .'</td>
                                  <td style=" text-align: center;">'  . $row['Target_Employee'] .'</td>
                                  <td style=" text-align: center;">'  . $row['Section'] .'</td>
                                  <td style=" text-align: center;">'  . $row['Upload_Date'] .'</td>
                                  <td style=" text-align: center;">'  . $row['Target_Date'] .'</td>
                                  
                                
                                 
                              
                              ';
                              ?>
                                <td>

                      <button class="openModalBtn" id="openModalBtn" data-id="<?php echo $elearningID;?>" style="background-color:transparent; border:none;"> <img src="assets/img/quiz.png" style ="width:35px; height:35px; border:none;" title="Click to answer"></button>
                          
                          <!-- Modal container -->
                          <div id="myModal" class="modal fade"></div>

                      <?php
                         
                          }
                          
                        
          
          ?>
         
           
              

              
          </tbody>
        
      </table>


  <br>








</form>
</div>
</div>
      

    <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>

              <iframe src="elearning_20180913135927.pdf"></iframe>
              <br>
              <div class="row">
              
              <div class="col-12" style="display:flex; justify-content:right; align-items:left;">
            <button type="submit" class="btn btn-primary" style = "justify-content:left; color:black; font-weight: bold;justify-content:left;  margin-left: 20px; background-color: #F3EA9C; border-color:#FF0000;" id="edit">Change</button>
            <button type="submit" class="btn btn-primary" style = "justify-content:left; margin-left: 5px; color:black; font-weight: bold;justify-content:left;  margin-left: 20px; background-color: #F3EA9C; border-color:#FF0000;" id="add">Save</button>


          


              </div>
            </div>


            
            

    </div>
    </div>

   
                  <?php
if (isset($_SESSION['cooldown_end_time']) && time() < $_SESSION['cooldown_end_time']) {
  $cooldown_remaining = $_SESSION['cooldown_end_time'] - time();
  echo "You've exhausted all attempts.Please wait <span id='cooldown_timer'>$cooldown_remaining</span> seconds before attempting again.";
  // JavaScript for updating cooldown timer dynamically
  echo "<script>
          setInterval(function() {
              var timerElement = document.getElementById('cooldown_timer');
              var remainingTime = parseInt(timerElement.innerHTML);
              remainingTime--;
              if (remainingTime <= 0) {
                  clearInterval();
                  location.reload(); // Reload the page when cooldown ends
              } else {
                  timerElement.innerHTML = remainingTime;
              }
          }, 1000);
        </script>";
} else {
  // Proceed with the quiz
  $generate_questions = "SELECT * FROM [dbo].[tbl_question] WHERE [Title] = 'test1'";
  $params = array();
  $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
  $stmt = sqlsrv_query($conn, $generate_questions, $params, $options);
  $row_count = sqlsrv_num_rows($stmt);

  // Initialize score and attempts
  $score = 0;
  $attempts = isset($_SESSION['attempts']) ? $_SESSION['attempts'] : 3;

  if ($row_count > 0) {
      echo "<form method='post'>";
      while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
          echo "<h3>Question: " . $row['Questions'] . "</h3>";

          // Display choices
          $choices = explode(",", $row['ChoicesA']);

          foreach ($choices as $choice) {
              echo '<input type="radio" name="answers[' . $row['ID'] . ']" value="' . $choice . '">  ' . $choice . '<br>';
          }
          echo '<br>';
      }

      
      echo '<input type="submit" name="submit_answers" value="Submit">';
      echo '</form>';

      if (isset($_POST['submit_answers'])) {
          // Loop through each submitted answer
          foreach ($_POST['answers'] as $question_id => $user_answer) {
              // Fetch the correct answer from the database
              $correct_answer_query = "SELECT Answers FROM [dbo].[tbl_question] WHERE ID = ?";
              $params = array($question_id);
              $stmt = sqlsrv_query($conn, $correct_answer_query, $params);
              $correct_answer_row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
              $correct_answer = $correct_answer_row['Answers'];

              // Compare user's answer with correct answer and update score accordingly
              if ($user_answer == $correct_answer) {
                  $score++;
              }
          }

          // Check if the score is perfect or if the user has attempts left
          if ($score == 3) {
            echo '<script>
            Swal.fire({
            title: "Congratulations!",
            text: "You have PASSED the E-Learning.",
            imageUrl: "assets/img/congrats.gif",
            imageSize: "100x100",
           
            imageAlt: "Custom image"
            });
          </script>';
          } else {
              $attempts--;
              if ($attempts > 0) {
                  echo "You have $attempts attempt(s) left.";
                 
              } else {
                  // Set cooldown period
                  $_SESSION['cooldown_end_time'] = time() + 30; // 10 seconds cooldown
                  $attempts = 3; // Reset attempts to 0
                  echo "You've exhausted all attempts. Please wait <span id='cooldown_timer'>30</span> seconds before trying again.";
                  // JavaScript for updating cooldown timer dynamically
                  echo "<script>
                          setInterval(function() {
                              var timerElement = document.getElementById('cooldown_timer');
                              var remainingTime = parseInt(timerElement.innerHTML);
                              remainingTime--;
                              if (remainingTime <= 0) {
                                  clearInterval();
                                 
                              } else {
                                 location.reload();
                                 
                              }
                          }, 1000);
                        </script>";
              }
          }

          // Store attempts in session
          $_SESSION['attempts'] = $attempts;
      }
  }
}
                                  //echo "Your answer for question " . $row['Questions'] . ": " . $user_answer . "<br>";

                                  // Compare user's answer with correct answer and update score accordingly
                                  // You need to fetch the correct answer from the database and compare it with $user_answer
                                  // Assuming $correct_answer contains the correct answer
                                  // $correct_answer = $row['Answers'];
                                 
                                  // if ($user_answer == $correct_answer) {
                                  //     echo "Correct!";
                                  //     // Update score
                                  //     $score++;
                                     
                                  // } else {
                                  //     echo "Incorrect!";
                                  // }
                                  // echo "<br>";
                               

                             
                            

                              //     if(isset($_POST['answer[1]']) && $_POST['answer[1]'] == 'Filipinas') {
                              //       $score++;

                                   
                              //   }

                              //   if(isset($_POST['answer[1]']) && $_POST['answer[1]'] == 'Emilio Aguinaldo') {
                              //     $score++;
                              // }


                        

                          
                                  // Process user's answer here, e.g., check it against correct answer
                                
                                 
                                  // Add your logic here to check if the user's answer is correct
                                  // You can compare $user_answer with the correct answer from the database
                                  // and perform appropriate actions
                              
                              //break; // Display only one question at a time, remove this line if you want to display all questions
                                                          

                            //     }
                            //     echo "<h2>Your score is: $score / 3</h2>";

                            //   }else{
                            //     echo "No questions found in the database.";
                            // }


                  ?>

                    
                      <br>
                      <div class="row">
                      
                      <div class="col-12" style="display:flex; justify-content:right; align-items:left;">
                   
                    <button type="submit" class="btn btn-primary" style = "justify-content:left; margin-left: 5px; color:black; font-weight: bold;justify-content:left;  margin-left: 20px; background-color: #F3EA9C; border-color:#FF0000;" id="add">Submit</button>


                  


                      </div>
                    </div>
   
     </form>

            
            

    </div>
    </div>


    


    




             


   



</main><!-- End #main -->


    

    



  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>BPS</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="">ABCDE</a>
    </div>
  </footer><!-- End Footer -->

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



<link rel="stylesheet" type="text/css" href="/jquery.datetimepicker.css">
<script src="/jquery.js"></script>
<script src="/build/jquery.datetimepicker.full.min.js"></script>


  <script>
        new DataTable('#example24', {
            initComplete: function () {
                this.api()
                    .columns([1,2,3,4,5])
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
        { orderable: false, targets: [0,1,2,3,4,5] }
        ]
        });



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
  function selectComboBox()
  {
      var selectedTopic = document.getElementById('selectedCombo').value;
      if (selectedTopic == '1') {
        document.getElementById('rank').disabled = false ;
        document.getElementById('generate').style.visibility= "hidden";
        document.getElementById('go').style.visibility= "visible";
        document.getElementById('delete').style.visibility= "visible";
      }
      else if (selectedTopic  == '2') {
        document.getElementById('rank').disabled = true;
        document.getElementById('generate').style.visibility= "visible";
        document.getElementById('go').style.visibility= "hidden";
        document.getElementById('delete').style.visibility= "hidden";
      }
      else{
       
        document.getElementById('rank').disabled = false ;
        document.getElementById('generate').style.visibility= "hidden";
      }
 
  }
</script>



<script type="text/javascript">
  function checkID() {
    $(document).ready(function(){   
     
      var biph_id= document.getElementById('employeeno').value;
  
      
      if (biph_id == null || biph_id == "") {
        document.addUser.biph_id.focus();
        document.getElementById('biphemployeeno_id').focus();
        document.getElementById('employeeno').value = "";
        document.getElementById('fullname').value ="";
        document.getElementById('adid').value ="";
        document.getElementById('section').value ="";
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
            $('#adid').val(data.adid);
            $('#section').val(data.section);
            $('#email').val(data.email);
          }
        });
      }
 
    });
 
  }
</script>

<script>
$(document).ready(function(){
    // Button click event handler for all buttons with class openModalBtn
    $('table tbody').on('click', '.openModalBtn', function() {
  
        // Get the ID from the button's data attribute
        var id = $(this).data("id");
        // AJAX request to load modal content with ID parameter
        $.ajax({
            url: "examslogs.php?id=" + id, // PHP file that generates modal content with ID parameter
            success: function(response){
                // Display modal with loaded content
                $("#myModal").html(response);
                $("#myModal").modal('show'); // Show Bootstrap modal
            }
        });
    });
});
</script>
</body>

</html>