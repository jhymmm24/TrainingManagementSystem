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

             
/* Darker background on mouse-over */
.btn:hover {
  background-color: #00FFFF;
}
table tr:hover td {
  background-color: #C6F1F8;
}
table, th, td {
  border: 1px solid black;
}
#prc th{
    background-color: #D4DFAA;
}
  



</style>

<body>

  
<?php 
include 'header.php';
include 'sidebar.php';
?>


<main id="main" class="main">

<div class="pagetitle">
  <!-- <h1>Common Training</h1> -->
 
</div><!-- End Page Title -->


<div class="card">

            <div class="card-body">
            <?php 
             
             $trainingrequestid = $_GET['TrainingrequestID'];
             $trainingtopic = $_GET['TrainingTopic'];
             $targetemployee = $_GET['TargetEmployee'];
     
             
             $get_data = "SELECT  * FROM [dbo].[tbl_trainingrequest] WHERE  [RequestNumber] = '$trainingrequestid' and [Employee Name] = '$targetemployee' ";
             $stmt3 = sqlsrv_query($conn,$get_data);
                            while($row = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
                                $id = $row['ID'];
                                $requestnumber = $row['RequestNumber'];
                                $requestdate= $row['Request Date'];
                                $transactionnumber= $row['Transaction Number'];
                                $topic = $row['Topic'];
                                $typeoftraining = $row['Type of Training'];
                                $requestorname = $row['Requestor Name'];
                                $section = $row['Section'];
                                $rank = $row['Rank'];
                                $urgent = $row['Urgent'];
                                $reasonurgent = $row['Reason of Urgency'];
                                $targetdate = $row['Target'];
                                $employeenumber =  $row['Employee Number'];
                                $employeename =  $row['Employee Name'];
                                $status = $row['StatusTransaction'];
                         
                              
                            }

             
             ?>
       <form id="form" class="row g-3" method="POST" name="form" action="forms/sqlupdates.php?action=newstafftraining&requestnumber=<?php echo $trainingrequestid?>&recorder=<?php echo $fullname?>&empno=<?php  echo $empno?>&empname=<?php echo $employeename?>" autocomplete="off">       
             <h5 class="card-title">Request Number: <?php echo $trainingrequestid ?></h5>

          
              <!-- Floating Labels Form -->

              
  

              <div class="col-md-6">
                    <div class="form-floating">
                        <label for="empname">Target Employee: <?php echo $employeename ?></label>
                        <input type="text" class="form-control" id="empname" name="empname" placeholder="Employee Number" autocomplete="off" readonly>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                    <label for="floatingName">Employee Number: <?php echo $empno ?></label>
                        <input type="text" class="form-control" id="empno" name="empno" placeholder="Your Name" autocomplete="off">
                      
                    </div>
                    <br>
                </div>


      
            </div>
          </div>









 


     <div class="card">
            <div class="card-body">
              <h5 class="card-title">New Staff Training Evaluation</h5>


              <?php

              
    
                // SQL query to fetch data
                $sql_fetchemployee = "SELECT  * FROM [dbo].[tbl_trainingrequest] WHERE  [RequestNumber] = '$trainingrequestid'";
               
                $result_fetchemployee = sqlsrv_query($conn, $sql_fetchemployee);
                         


            // Check if query executed successfully
            if ($result_fetchemployee === false) {
                echo "Error in executing query.<br/>";
                die(print_r(sqlsrv_errors(), true));
            }



            // Query to fetch Full_Name from tbl_Accounts where Category is 'PE Training PIC'
        $queryPIC = "SELECT Full_Name FROM tbl_Accounts WHERE Category = 'Admin'";

        // Execute the query
        $stmt = sqlsrv_query($conn, $queryPIC);

        // Check if there were any results
        if( !$stmt ) {
            die( print_r(sqlsrv_errors(), true));
        }

        // Fetch the results and store them in an array
        $fullNames = array();
        while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {
            $fullNames[] = $row['Full_Name'];
        }

            
            echo '
            <table id="prc" name="prc" class="border" style="width:100%; overflow-x: auto; white-space: nowrap; display: block;">
                <thead>
                    <tr>
                        <th style="text-align: center;" rowspan="4">Training Contents</th>
                        <th style="text-align: center;" rowspan="4">Training Methods</th>
                        <th style="text-align: center;" colspan="4">Training Implementation</th>
                        <th style="text-align: center;" colspan="4">Evaluation</th>
                    </tr>
                    <tr>
                        <th style="font-size: 12px; text-align: center;">PIC of Training</th>
                        <th style="font-size: 12px; text-align: center;">Scheduled Date</th>
                        <th style="font-size: 12px; text-align: center;">Implemented on</th>
                        <th style="font-size: 12px; text-align: center;">Recorder</th>
        
                        <!-- Added Evaluation Columns -->
                        <th style="font-size: 12px; text-align: center;">Evaluation Methods</th>
                        <th style="font-size: 12px; text-align: center;">Passing Rate</th>
                        <th style="font-size: 12px; text-align: center;">Examination Score</th>
                        <th style="font-size: 12px; text-align: center;">Evaluation Results</th>
                     
                    </tr>
                </thead>
                <tbody>';
        
                // Static Training Contents List with their max score
                $trainingContents = array(
                    'Production Basic Knowledge' => 10,
                    'Indirect Materials Management' => 10,
                    'Daily and Monthly Production Management' => 10,
                    'Work Instruction Application' => 10,
                    'Duties of Line Leader' => 10,
                    'CPK' => 10,
                    'Yellow Card and Machine No. Control' => 10,
                    'Production Changes in Specification' => 7,
                    'NG Defect Handling (P and K Defect)' => 8,
                    'Pokayoke Discussion' => 15,
                    'Man Hour Management' => 20,
                    'Work Force Planning and Operation' => 10,
                    'Flow of Production Planning' => 10
                );
                $index = 0; // Initialize index for checking content
                // Loop through each training content and create a row for it
                foreach ($trainingContents as $trainingContent => $maxScore) {
                    // Get today's date and tomorrow's date
                    $today = date('Y-m-d'); // current date
                    $tomorrow = date('Y-m-d', strtotime('+1 day')); // tomorrow's date
        
                    // Add a row for each training content
                    $rowData = '<tr>';
        
                    // Add the static "Training Content" value
                    $rowData .= '<td style="text-align: center;">' . $trainingContent . '</td>';
        
                  /// Set the value of "Training Methods" based on the content index
                  $trainingMethod = ($index < 11) ? 'B' : 'A'; // First 11 content -> B, 12th and 13th -> A
                  $rowData .= '<td style="text-align: center;">' . $trainingMethod . '</td>';
                      
                 // Add the dropdown for Full_Name
                    $rowData .= '<td style="text-align: center; width:200px;"> 
                    <select name="training_pic[]" required>
                        <option value="">Select Training PIC</option>'; // Default empty option

                // Populate the dropdown with the names fetched from the database
                foreach ($fullNames as $fullName) {
                $rowData .= '<option value="' . htmlspecialchars($fullName) . '">' . htmlspecialchars($fullName) . '</option>';
                }

                $rowData .= '</select>
                </td>';

                $rowData .= '<td style="text-align: center; width:200px;">';
                $rowData .= '<input type="date" value="' . $today . '" name="date_today[]" id="date_today" style="width: 150px;">';
                $rowData .= '</td>';
                
                $rowData .= '<td style="text-align: center; width:200px;">';
                $rowData .= '<input type="date" value="' . $tomorrow . '" name="date_tomorrow[]" id="date_tomorrow" style="width: 150px;">';
                $rowData .= '</td>';

                
                    $rowData .= '<td style="text-align: center; width:200px; ">'.$fullname.'</td>';
        
                    // Evaluation columns
                    $rowData .= '<td style="text-align: center;">Exam</td>';
                    $rowData .= '<td style="text-align: center;">80%</td>';
        
                    // Add one input field for examination score based on max score for each training content
                    $rowData .= '<td style="text-align: center; ">
                                    <input type="number" style="width: 50px;"  name="examination_score[]" min="0" max="' . $maxScore . '"required onchange="validateExaminationScore(this, ' . $maxScore . ')">
                                  </td>';
        
                    // Evaluation Results - initially set as "Pending"
                    $rowData .= '<td style="text-align: center;">
                                    <span class="evaluation-result">Pending</span>
                                  </td>';
        
         
                    // Close row
                    $rowData .= '</tr>';
        
                    // Push the row data into the rows array
                    $rowsData[] = $rowData;
                    $index++;
                }
        
                // After the loop, join all rows together
                $tableBody = implode('', $rowsData);
        
                // Echo out the table body
                echo $tableBody;
        
                // Close tbody tag
                echo '</tbody>
            </table>';
        
        ?>
<!-- Add a Submit Button -->
<button type="submit" class="btn btn-primary" name="submit_evaluation">Submit Evaluation</button>


      <script>
// JavaScript to validate input, reset value if greater than max, and calculate the percentage
function validateExaminationScore(input, maxScore) {
    var score = parseInt(input.value) || 0; // Get the score, default to 0 if empty
    var row = input.closest('tr'); // Get the closest row (tr)

    // Check if the score is greater than the max allowed score
    if (score > maxScore) {
        // Show a popup message (balloon or alert)
        alert("Score exceeds the maximum allowed value of " + maxScore + ". The score will be reset to 0.");

        // Reset the input value to 0
        input.value = 0;
        score = 0; // Reset score to 0
    }

    // Calculate the percentage
    var percentage = (score / maxScore) * 100; // Calculate the percentage

    // Call the function to update the evaluation result
    updateEvaluationResult(row, score, maxScore, percentage);
}

// Function to update the evaluation result based on the score
function updateEvaluationResult(row, score, maxScore, percentage) {
    var resultCell = row.querySelector('.evaluation-result');
    var resultText = '';

    // Check if the percentage is above the passing rate (80%)
    if (percentage >= 80) {
        resultText = 'PASSED';
        resultCell.style.color = 'green'; // Green for passed
    } else {
        resultText = 'FAILED';
        resultCell.style.color = 'red'; // Red for failed
    }

    // Update the result cell text and also the percentage
    resultCell.textContent = resultText + ' (' + percentage.toFixed(2) + '%)';
}
</script>


    </div>
    </div>


    


    




             


   



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
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>



<link rel="stylesheet" type="text/css" href="/jquery.datetimepicker.css">
<script src="/jquery.js"></script>
<script src="/build/jquery.datetimepicker.full.min.js"></script>

<!-- <script>
    function calculateTotal(input) {
        // Get the values of gen_information_1st and quality_related_1st inputs
        var genInfoScore = parseFloat(input.parentNode.previousElementSibling.querySelector('input').value) || 0;
        var qualityScore = parseFloat(input.value) || 0;

        // Calculate the total score
        var totalScore = genInfoScore + qualityScore;

        // Update the total_1st input value
        input.parentNode.nextElementSibling.querySelector('input').value = totalScore;



    }
</script> -->
<script>
    function calculateTotal(input) {
        // Get the values of gen_information_1st and quality_related_1st inputs
        var genInfoScore = parseFloat(input.parentNode.previousElementSibling.querySelector('input').value) || 0;
        var qualityScore = parseFloat(input.value) || 0;

        // Calculate the total score
        var totalScore = genInfoScore + qualityScore;

        // Update the total_1st input value
        var totalInput = input.parentNode.nextElementSibling.querySelector('input');
        totalInput.value = totalScore;

        // Disable retake fields if total score is 100
        var retakeGenInfoInput = input.parentNode.nextElementSibling.nextElementSibling.querySelector('input');
        var retakeQualityInput = retakeGenInfoInput.parentNode.nextElementSibling.querySelector('input');
        var totalRetakeInput = retakeQualityInput.parentNode.nextElementSibling.querySelector('input');

        if (totalScore === 100) {
            retakeGenInfoInput.disabled = true;
            retakeQualityInput.disabled = true;
            totalRetakeInput.disabled = true;
        } else {
            retakeGenInfoInput.disabled = false;
            retakeQualityInput.disabled = false;
            totalRetakeInput.disabled = false;
        }
    }
</script>





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