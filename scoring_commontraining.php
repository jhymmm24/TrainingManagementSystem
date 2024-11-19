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
    background-color: #F1C3DA;
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
     

             echo    $trainingrequestid;
             
             $get_data = "SELECT  * FROM [dbo].[tbl_topic_LIST_commontraining_MAINREQUEST] WHERE  [RequestNumber] = '$trainingrequestid'";
             $stmt3 = sqlsrv_query($conn,$get_data);
                            while($row = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
                                $id = $row['ID'];
                                $requestnumber = $row['RequestNumber'];
                                $requestdate= $row['Date_Requested'];
                              
                                $topic = $row['Topic'];
                                $typeoftraining = $row['Type of Training'];
                                $requestorname = $row['Requestor_Name'];
                                $section = $row['Section'];
                         
                                $startdate = $row['Start Date'];
                                $enddate = $row['End Date'];
                                $employeenumber =  $row['Employee_Number'];
                                $employeename =  $row['Employee_Name'];
                                $statustransaction = $row['StatusRequestNumber'];
                         
                              
                            }

             
             ?>
          
             <h5 class="card-title">Request Number: <?php echo $trainingrequestid ?></h5>


          
              <!-- Floating Labels Form -->

              
              <form class="row g-3">

              <div class="col-md-6">
                    <div class="form-floating">
                        <label for="employeeno">Requestor: <?php echo $requestorname ?></label>
                        <input type="text" class="form-control" id="employeeno" name="employeeno" placeholder="Employee Number" autocomplete="off" readonly>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                    <label for="floatingName">Section: <?php echo $section ?></label>
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Your Name" autocomplete="off">
                      
                    </div>
                    <br>
                </div>


              </form><!-- End floating Labels Form -->

            </div>
          </div>


     </form>






     <form id="form" class="row g-3" method="POST"  name="form" action="forms/sqlupdates.php?action=scoring_commontraining"  onsubmit="return validateCheckboxes()" autocomplete="off">

     <div class="card">
            <div class="card-body">
              <h5 class="card-title">Common Training - <?php echo $trainingtopic; ?></h5>


              
            
<input type="hidden" name="trainingtopic" value="<?php echo $trainingtopic; ?>">
<input type="hidden" name="trainingrequestid" value="<?php echo $trainingrequestid; ?>">

              <?php
    
                // SQL query to fetch data
                $sql_fetchemployee = "SELECT  * FROM [dbo].[tbl_topic_LIST_commontraining_MAINREQUEST] WHERE  [RequestNumber] = '$trainingrequestid'";
               
                $result_fetchemployee = sqlsrv_query($conn, $sql_fetchemployee);
                         

            // Define the columns to display based on the selected topic
            $defaultColumns = array('Employee_Number', 'Employee_Name', 'Position'); // Default columns
            $topicSpecificColumns = array();



                     // Add topic-specific columns
        if ($trainingtopic == 'Train the Trainers') {
          $topicSpecificColumns[] = 'Train_the_Trainers';
      }
      elseif ($trainingtopic == 'IE Techniques') {
          $topicSpecificColumns[] = 'IE_Techniques';
      }
      elseif ($trainingtopic == 'TWI -JR') {
          $topicSpecificColumns[] = 'TWI_JR';
      }
      elseif ($trainingtopic == 'TWI -JR') {
          $topicSpecificColumns[] = 'TWI_JI';
      }
      elseif ($trainingtopic == 'ISO90001 (QMS)') {
          $topicSpecificColumns[] = 'ISO90001_QMS';
      }
      elseif ($trainingtopic == 'QCC Basic Knowledge (QC 7 Tools)') {
          $topicSpecificColumns[] = 'QCC_Basic_Knowledge_QC_7_Tools';
      }
      elseif ($trainingtopic == 'Proposal Activity') {
          $topicSpecificColumns[] = 'Proposal_Activity';
      }
      elseif ($trainingtopic == 'Excel Macro Training') {
          $topicSpecificColumns[] = 'Excel_Macro_Training';
      }
      elseif ($trainingtopic == 'Safety Training') {
          $topicSpecificColumns[] = 'Safety_Training';
      }
      elseif ($trainingtopic == 'Quality Education') {
          $topicSpecificColumns[] = 'Quality_Education';
      }
      elseif ($trainingtopic == 'Fundamentals of Acceptance Sampling') {
          $topicSpecificColumns[] = 'Fundamentals_of_Acceptance_Sampling';
      }
      elseif ($trainingtopic == 'Zero Defects Through Poka Yoke') {
          $topicSpecificColumns[] = 'Zero_Defects_Through_Poka_Yoke';
      }
      elseif ($trainingtopic == 'Advanced Pull Manufacturing with Heijunka') {
          $topicSpecificColumns[] = 'Advanced_Pull_Manufacturing_with_Heijunka';
      }
      elseif ($trainingtopic == 'Achieving High Results Through People') {
          $topicSpecificColumns[] = 'Achieving_High_Results_Through_People';
      }
      else{
          echo "Column not found in database...";
      }
  
  
  


            

            $columnsToDisplay = array_merge($defaultColumns, $topicSpecificColumns);

            // Query to fetch data based on section and selected columns
            $sql_getdata = "SELECT " . implode(', ', $columnsToDisplay) . " FROM [dbo].[tbl_topic_LIST_commontraining_MAINREQUEST] WHERE [RequestNumber] = '$trainingrequestid'";
            $params = array($section);
            $stmt = sqlsrv_query($conn, $sql_getdata, $params);

            if ($stmt === false) {
                echo "Error in executing query.<br/>";
                die(print_r(sqlsrv_errors(), true));
            }

            // Check if query executed successfully
            if ($result_fetchemployee === false) {
                echo "Error in executing query.<br/>";
                die(print_r(sqlsrv_errors(), true));
            }

            // Build the table header
            echo '<table id="example24" class="display" style="width:100%; overflow-x: auto; white-space: nowrap; display: block;">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="all" name="selected[]" onclick="toggle(this);" style="width: 30px; height: 20px; accent-color: green;">Select All</th>';
            foreach ($columnsToDisplay as $column) {
                echo "<th>$column</th>";
            }
            echo '</tr>
                    </thead>
                    <tbody>';

            // Fetch and populate table data
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                // Set row style
                $rowStyle = "";

                echo "<tr$rowStyle>";
                echo "<td><input type='checkbox' name='row_checkbox[]'  value='" . $row['Employee_Number'] . "'></td>";
                foreach ($columnsToDisplay as $column) {
                    // Check if the current column is in topicSpecificColumns
                    echo '<input type="text" name="employee_data[' . $column . '][' . $row['Employee_Number'] . ']" hidden value="' . $row[$column] . '">';

                    if (in_array($column, $topicSpecificColumns)) {
                      echo "<td data-column-name='$column'><input type='text' name='employee_data[" . $row['Employee_Number'] . "][$column]' value='{$row[$column]}'></td>";

                      
                    } else {
                        echo "<td data-column-name='$column'>{$row[$column]}</td>";
                    }
                }
                echo "</tr>";
            }
            echo '</tbody>
                  </table>';
            ?>
        </div>
    </div>
    <button type="submit" value="btnSubmit" id="btnSubmit" name="btnSubmit">Submit</button>

</form>


            
            

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

<script>
    function calculateTotal(input) {
        // Get the values of gen_information_1st and quality_related_1st inputs
        var genInfoScore = parseFloat(input.parentNode.previousElementSibling.querySelector('input').value) || 0;
        var qualityScore = parseFloat(input.value) || 0;

        // Calculate the total score
        var totalScore = genInfoScore + qualityScore;

        // Update the total_1st input value
        input.parentNode.nextElementSibling.querySelector('input').value = totalScore;
    }
</script>


<script>
        new DataTable('#example24', {
            initComplete: function () {
                this.api()
                    .columns([])
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
        { orderable: false, targets: [] }
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



<script>
function toggle(source) {
    checkboxes = document.getElementsByName('row_checkbox[]');
    for(var i = 0, n = checkboxes.length; i < n; i++) {
        checkboxes[i].checked = source.checked;
    }
}
</script>


<script>
function validateCheckboxes() {
    var checkboxes = document.querySelectorAll('input[name="row_checkbox[]"]');
    var isChecked = false;

    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            isChecked = true;
            break;
        }
    }

    if (!isChecked) {
        alert("Please select at least one checkbox.");
        return false; // Prevent form submission
    }

    return true; // Allow form submission
}
</script>


</body>

</html>