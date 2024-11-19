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

/* background: url("assets/img/sidebarimage.jpg") ; */
background: url("assets/img/wood.jpg") ;

background-size: 500px 1000000px;
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

.card{
       
        border-style: solid;
        border-color: #B45309;
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

/* Override SimpleDatatable styles for the passed rows */
table.display.dataTable tbody tr.passed-row {
    background-color: #c8e6c9 !important; /* Light green background */
}

iframe{
                display: block;       /* iframes are inline by default */
                background: #000;
                border: none;         /* Reset default border */
                height: 50vh;        /* Viewport-relative units */
                width: 78vw;
                        
             }

             @font-face {
    font-family: 'Eraser';
    src: url('assets/fonts/Eraser.ttf'); /* Replace 'path/to/chalkboard-font.ttf' with the actual path to your font file */
}

.custom-font {
    font-family: 'Eraser', sans-serif; /* Apply your custom font */
    /* Add any other styles you want to apply */
    
  
}

 



</style>

<body>

  
<?php


include 'header.php';


include 'sidebar.php';


?>


<main id="main" class="main">
<h1 class="custom-font" style="color:white; font-size: 48px;">E-Learning Examination</h1>
<div class="pagetitle">
  <!-- <h1>Common Training</h1> -->
 
</div><!-- End Page Title -->



   
          <div class="card">
            <div class="card-body">
            <h5 class="card-title">Training and Examination</h5>


      

      
            
             
          
   


          <table id="example24" class="display" style="width:100%; overflow-x: auto;  white-space: nowrap;   display: block;">
    <thead>
        <tr>
            <th style=" width: 5px;">Select</th>
            <th style=" text-align: center;">Request Number</th>
            <th style=" text-align: center;">E-LEARNING ID</th>
            <th style=" text-align: center;">E-LEARNING TITLE</th>
            <th  style=" text-align: center;" >Employee Number</th>
            <th style=" text-align: center;" >Full Name</th>
            <th style=" text-align: center;">Section</th>
            <th style=" text-align: center;">Upload Date</th>
            <th style=" text-align: center;">Target Date</th>
            <th style=" text-align: center;">Status</th>
            <th style=" text-align: center;"></th>
         
         
        </tr>
        <tr>
        <th style=" width: 5px;"></th>
        <th style=" text-align: center;">Request Number</th>
        <th style=" text-align: center;">E-LEARNING ID</th>
            <th style=" text-align: center;">E-LEARNING TITLE</th>
            <th  style=" text-align: center;" >Employee Number</th>
            <th style=" text-align: center;" >Full Name</th>
            <th style=" text-align: center;">Section</th>
            <th style=" text-align: center;">Upload Date</th>
            <th style=" text-align: center;">Target Date</th>
            <th style=" text-align: center;">Status</th>
            <th style=" text-align: center;"></th>

        </tr>
    </thead>
    <tbody>

    <?php

      if ($category == 'User') {
        $trequest = "SELECT * FROM [dbo].[tbl_elearningstatus] WHERE EmployeeNumber = ?";
        $params = array($empno);  // Parameterized query
      } elseif (($category == 'Section Training PIC')||($category == 'Approver')) {
        $trequest = "SELECT * FROM [dbo].[tbl_elearningstatus] WHERE Section = ? AND Email IS NOT NULL";
        $params = array($section);  // Parameterized query
      }else{
        $trequest = "SELECT * FROM [dbo].[tbl_elearningstatus] WHERE  Email IS NOT NULL";
        $params = array($section);  // Parameterized query
      }

      $stmt3 = sqlsrv_query($conn, $trequest, $params);
      if ($stmt3 === false) {
        die(print_r(sqlsrv_errors(), true));  // Handle SQL errors properly
      }

                          while($row = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
                              $id = $row['ID'];
                              $title = $row['Title'];
                              $targetemployee= $row['Target_Employee'];
                              $uploaddate = $row['End_Date'];
                              $targetdate = $row['Target_Date'];
                              $status = $row['Elearning_Status'];
                              $section = $row['Section'];
                              $employeeno = $row['EmployeeNumber'];
                              $elearningID= $row['ElearningTransID'];
                              $requestnumber= $row['RequestNumber'];
                              $classification = $row['Classification'];

                               // Add a class to highlight row green if status is "PASSED"
                               $rowClass = ($status === 'PASSED') ? 'passed-row' : '';

                               $email = $row['Email'];
                                      
                            

                     


                            
                            
                              

                              echo

                              '<tr class="' . $rowClass . '">
                                  <td style="width: 5px; text-align: center;"> <input type="checkbox" name="selected[]" class="single-checkbox" id="selected" value="'.$id.'"></td>
                                  <td style=" text-align: center;">'  . $row['RequestNumber'] .'</td>
                                  <td style=" text-align: center;">'  . $row['ElearningTransID'] .'</td>
                                  <td style=" text-align: center;">'  . $row['Title'] .'</td>
                                  <td style=" text-align: center;">'  . $row['EmployeeNumber'] .'</td>
                                  <td style=" text-align: center;">'  . $row['Target_Employee'] .'</td>
                                  <td style=" text-align: center;">'  . $row['Section'] .'</td>
                                  <td style=" text-align: center;">'  . $row['Target_Date'] .'</td>
                                  <td style=" text-align: center;">'  . $row['End_Date'] .'</td>
                                  <td style=" text-align: center;">'  . $row['Elearning_Status'] .'</td>
                                  
                                  
                                
                                 
                              
                              ';
                              ?>
                              <td>
                              <?php
                              if($employeeno === $empno){
                                      if ($status !== 'PASSED') {
                                        echo '<a href="examination.php?requestnumber='.$requestnumber.'&elearningID='.$elearningID.'&employeeno='.$employeeno.'&title='.$title.'&classification='.$classification.'" class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Click to answer">
                                              </a>';
                                    } else {
                                        echo '<button onclick="alert(\'You have already passed the exam.\')" class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Already Passed">
                                              </button>';
                                    }
                              }else{
                              
                               echo '<a href="#" onclick="alert(\'You have no permission to answer.\')" class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                  <img src="assets/img/quizbw.png" style="width: 35px; height: 35px; border: none;" title="No Permission to Answer">
                                </a>';
                                                  
                              }
                              
                              ?>
                            
                              
                              </td>
                                

                      <!-- <button class="openModalBtn" id="openModalBtn" data-id="<?php echo $elearningID;?>" style="background-color:transparent; border:none;"> <img src="assets/img/quiz.png" style ="width:35px; height:35px; border:none;" title="Click to answer"></button> -->
                          
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
      
<!-- 
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

    <div class="card">
            <div class="card-body">
            <h5 class="card-title">Elearning</h5>

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

    
    // Retrieve questions based on the selected title
    $generate_questions = "SELECT * FROM [dbo].[tbl_question] WHERE [Title] = 'test1'";
    $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt = sqlsrv_query($conn, $generate_questions, $params, $options);

    $row_count = sqlsrv_num_rows($stmt);

    // Initialize score and attempts
    $score = 0;
    $attempts = isset($_SESSION['attempts']) ? $_SESSION['attempts'] : 3;

    
    if ($row_count > 0) {
      $questions = array();
      while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
          $questions[] = $row;
      }
      shuffle($questions); // Randomize the sequence of questions
      echo "<form method='post' id='quiz_form'>";
      foreach ($questions as $row) {
          echo "<h3>Question: " . $row['Questions'] . "</h3>";
          
          // Display choices from database dynamically
          $query = "SELECT ChoicesA, ChoicesB, ChoicesC FROM [dbo].[tbl_question] WHERE ID = " . $row['ID'];
          $choices_result = sqlsrv_query($conn, $query);
          
          if ($choices_result) {
              $choice_row = sqlsrv_fetch_array($choices_result, SQLSRV_FETCH_ASSOC);
              if ($choice_row) {
                  echo '<input type="radio" name="answers[' . $row['ID'] . ']" value="' . $choice_row['ChoicesA'] . '"> ' . $choice_row['ChoicesA'] . '<br>';
                  echo '<input type="radio" name="answers[' . $row['ID'] . ']" value="' . $choice_row['ChoicesB'] . '"> ' . $choice_row['ChoicesB'] . '<br>';
                  echo '<input type="radio" name="answers[' . $row['ID'] . ']" value="' . $choice_row['ChoicesC'] . '"> ' . $choice_row['ChoicesC'] . '<br>';
              } else {
                  echo "No choices found for this question.";
              }
          } else {
              echo "Error retrieving choices.";
          }
          
          echo '<br>';
      }
      echo "</form>"; // Close the form tag
  }
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
                  
                    $_SESSION['cooldown_end_time'] = time() + 30; // 30 seconds cooldown
                    $attempts = 3; // Reset attempts to 3
                    echo "You've exhausted all attempts. Please wait <span id='cooldown_timer'>30</span> seconds before trying again.";
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
                                  location.reload();
                                    timerElement.innerHTML = remainingTime;
                                }
                            }, 1000);
                          </script>";
                }
            }

            // Store attempts in session
            $_SESSION['attempts'] = $attempts;
        }
    }
 
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
 -->

    


    




             


   



</main><!-- End #main -->


    

    



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
                    .columns([1,2,3,4,5,6,7,8,9])
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
        { orderable: false, targets: [0,1,2,3,4,5,6] }
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