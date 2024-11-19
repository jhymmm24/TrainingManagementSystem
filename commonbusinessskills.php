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



  <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 

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
    

    table  td {
  
  text-align: center;

}
table tr:hover td {
  background-color: #C6F1F8;
  text-align: center;
}
#startdate, #enddate, #starttime, #endtime, #topic, #typeoftraining, #selectedposition, #meetingroom{

  background-color: #FFF7DA;
  border-width:2px; 
  border-style:solid;
   border-color:#78432C;
}



#loading {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.7);
            z-index: 9999;
            text-align: center;
        }
#loading img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }


/* CSS */
.button-33 {
  background-color: #c2fbd7;
  border-radius: 100px;
  box-shadow: rgba(44, 187, 99, .2) 0 -25px 18px -14px inset,rgba(44, 187, 99, .15) 0 1px 2px,rgba(44, 187, 99, .15) 0 2px 4px,rgba(44, 187, 99, .15) 0 4px 8px,rgba(44, 187, 99, .15) 0 8px 16px,rgba(44, 187, 99, .15) 0 16px 32px;
  color: green;
  cursor: pointer;
  display: inline-block;
  font-family: CerebriSans-Regular,-apple-system,system-ui,Roboto,sans-serif;
  padding: 7px 20px;
  text-align: center;
  text-decoration: none;
  transition: all 250ms;
  border: 0;
  font-size: 16px;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-33:hover {
  box-shadow: rgba(44,187,99,.35) 0 -25px 18px -14px inset,rgba(44,187,99,.25) 0 1px 2px,rgba(44,187,99,.25) 0 2px 4px,rgba(44,187,99,.25) 0 4px 8px,rgba(44,187,99,.25) 0 8px 16px,rgba(44,187,99,.25) 0 16px 32px;
  transform: scale(1.05) rotate(-1deg);
}



.button-49 {
                  outline: 0;
                    grid-gap: 8px;
                    align-items: center;
                    background-color: #FF4742;
                    color: #000;
                    border: 1px solid #000;
                    border-radius: 4px;
                    cursor: pointer;
                    display: inline-flex;
                    flex-shrink: 0;
                    font-size: 16px;
                    gap: 8px;
                    justify-content: center;
                    line-height: 1.5;
                    overflow: hidden;
                    padding: 12px 16px;
                    text-decoration: none;
                    text-overflow: ellipsis;
                    transition: all .14s ease-out;
                    white-space: nowrap;
                  
 }
 .button-49:hover {
                        box-shadow: 4px 4px 0 #000;
                        transform: translate(-4px,-4px);
                    }
                    :focus-visible{
                        outline-offset: 1px;
    }

    /* CSS */
.button-89 {
  --b: 3px;   /* border thickness */
  --s: .45em; /* size of the corner */
  --color: #373B44;
  
  padding: calc(.5em + var(--s)) calc(.9em + var(--s));
  color: var(--color);
  --_p: var(--s);
  background:
    conic-gradient(from 90deg at var(--b) var(--b),#0000 90deg,var(--color) 0)
    var(--_p) var(--_p)/calc(100% - var(--b) - 2*var(--_p)) calc(100% - var(--b) - 2*var(--_p));
  transition: .3s linear, color 0s, background-color 0s;
  outline: var(--b) solid #0000;
  outline-offset: .6em;
  font-size: 16px;

  border: 0;

  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-89:hover,
.button-89:focus-visible{
  --_p: 0px;
  outline-color: var(--color);
  outline-offset: .05em;
}

.button-89:active {
  background: var(--color);
  color: #fff;
}

.button-88{
  
                    outline: 0;
                    grid-gap: 8px;
                    align-items: center;
                    background-color: #97BF77;
                    color: #000;
                    border: 1px solid #000;
                    border-radius: 4px;
                    cursor: pointer;
                    display: inline-flex;
                    flex-shrink: 0;
                    font-size: 16px;
                    gap: 8px;
                    justify-content: center;
                    line-height: 1.5;
                    overflow: hidden;
                    padding: 12px 12px;
                    text-decoration: none;
                    text-overflow: ellipsis;
                    transition: all .14s ease-out;
                    white-space: nowrap;
                    width: 100px;
}
.button-88:hover {
                        box-shadow: 4px 4px 0 #000;
                        transform: translate(-4px,-4px);
                    }

.button-88:focus-visible{
                        outline-offset: 1px;
                    }


  #loading {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.7);
            z-index: 9999;
            text-align: center;
        }
#loading img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        

.button-cus1{
    display: inline-block;
                outline: 0;
                cursor: pointer;
                border-radius: 6px;
                border: 2px solid #33691E;
                color: BLACK;
                background: 0 0;
                padding: 8px;
                box-shadow: rgba(0, 0, 0, 0.07) 0px 2px 4px 0px, rgba(0, 0, 0, 0.05) 0px 1px 1.5px 0px;
                font-weight: 800;
                font-size: 16px;
                height: 42px;
                width: 200px;
    }
    .button-cus1:hover{
                    background-color: #C0FFC0;
                    color: BLACK;
                }
                

                .button-cus3{
    display: inline-block;
                outline: 0;
                cursor: pointer;
                border-radius: 6px;
                border: 2px solid #94090D;
                color: BLACK;
                background: 0 0;
                padding: 8px;
                box-shadow: rgba(0, 0, 0, 0.07) 0px 2px 4px 0px, rgba(0, 0, 0, 0.05) 0px 1px 1.5px 0px;
                font-weight: 800;
                font-size: 16px;
                height: 42px;
                width: 200px;
    }
    .button-cus3:hover{
                    background-color: #D40D12;
                    color: BLACK;
                }

              
   
                
                  


</style>

<body>

  

  <!-- ======= Sidebar ======= -->
<?php


include 'header.php';


include 'sidebar.php';


?>
  <!-- End Sidebar-->

<main id="main" class="main">

<div class="pagetitle">
</div><!-- End Page Title -->


<div class="card">

            <div class="card-body">
              <h5 class="card-title">Common Business Skills</h5>

              <div id="loading">
          <img src="assets/img/Spin.gif" alt="Loading...">
        </div>


              <!-- Floating Labels Form -->
   <form id="formid" class="row g-3" method="POST"  name="formid" action="forms/sqlupdates.php?action=commonbusinessskills&requestorname=<?php echo $fullname;?>">

   <?php
   
   $topic = 'commonbusinessskills';
   $monthtoday = date('F Y');
   ?>
                
          <div class="col-md-6">
                  <div class="form-floating">
                  <label for="floatingSelect" style="background-color:F3EA9C; margin-top:-10px; font-size: 12px;color:#7F7F7F;">Topic :</label>

                <select class="form-select"  onchange="selectComboBoxTopic()" id="topic" name="topic" aria-label="State" style="font-weight: bold; border-width:2px; border-style:solid;  padding: 10px; background-color: #FFF7DA; padding-top:25px;"required>
                          
                <option value="" selected disabled>Select a topic</option>
                          <?php
                              $commontrainingtopic = "SELECT available_topic FROM [dbo].[tbl_topicsetting] WHERE month ='$monthtoday' AND category = 'Common Business Skills' ORDER BY available_topic ASC";
                              $stmt2 = sqlsrv_query($conn,$commontrainingtopic);
                              while($row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
                                echo '<option >'.$row2['available_topic'].'</option>';
                              }
                              ?>
                 </select>
                      
                </div>
             
                </div>


                <script>
                function selectComboBoxTopic() {
                    var selectedTopic = document.getElementById('topic').value;

                    if (!selectedTopic) {
                        document.getElementById('start_enlist').value = '';
                        document.getElementById('start_enlist').disabled = true;
                        document.getElementById('end_enlist').value = '';
                        document.getElementById('end_enlist').disabled = true;
                        return;
                    }

                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'get_start_end_enlist_dates.php?topic=' + encodeURIComponent(selectedTopic), true);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            var data = JSON.parse(xhr.responseText);
                            if (data.success) {
                                document.getElementById('start_enlist').disabled = true;
                                document.getElementById('end_enlist').disabled = true;

                                if (data.start_enlist_dates && data.start_enlist_dates.length > 0) {
                                    document.getElementById('start_enlist').value = data.start_enlist_dates[0];
                                } else {
                                    document.getElementById('start_enlist').disabled = true;
                                    document.getElementById('start_enlist').value = '';
                                }

                                if (data.end_enlist_dates && data.end_enlist_dates.length > 0) {
                                    document.getElementById('end_enlist').value = data.end_enlist_dates[0];
                                } else {
                                    document.getElementById('end_enlist').disabled = true;
                                    document.getElementById('end_enlist').value = '';
                                }
                            } else {
                                alert("No start or end enlist dates found for this topic.");
                            }
                        }
                    };
                    xhr.send();
                }
            </script>
                <div class="col-md-6">
                  <div class="form-floating">
                  <label for="floatingSelect" style="background-color:F3EA9C; margin-top:-10px; font-size: 12px;color:#7F7F7F;">Type of Training :</label>

                <select class="form-select"  onchange="selectComboBoxTrainingType()" id="typeoftraining" name="typeoftraining" aria-label="State" style="font-weight: bold; border-width:2px; border-style:solid;  padding: 10px; background-color: #FFF7DA; padding-top:25px;"required>
                       <option selected></option>
                        <option value="FACE TO FACE">FACE TO FACE</option>
                        <option value="E-LEARNING">E-LEARNING</option>
                    </select>
                
                </div>
                
                </div>
          
                <div class="col-md-6">
                  
                  <div class="form-floating">
                  <label for="floatingPassword" style="margin-top:-10px;  font-size: 12px; color:#7F7F7F;">Start Date</label>
                  <input type="date" class="form-control" id="start_enlist" name="start_enlist" placeholder="Start Enlist Date" disabled>
                  
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-floating">
                  <label for="floatingPassword" style="margin-top:-10px;  font-size: 12px; color:#7F7F7F;">End Date</label>
                  <input type="date" class="form-control" id="end_enlist" name="end_enlist" placeholder="End Enlist Date" disabled>
                   
                  </div>
                </div>


                <input type="hidden" id="start_enlist_hidden" name="start_enlist_hidden">
<input type="hidden" id="end_enlist_hidden" name="end_enlist_hidden">


                
                <div class="col-md-6">
                  <div class="form-floating">
                  <label for="floatingSelect" style="background-color:F3EA9C; margin-top:-10px; font-size: 12px;color:#7F7F7F;">Meeting Room :</label>

                <select class="form-select"  onchange="selectComboBox()" id="meetingroom" name="meetingroom" aria-label="State" style="border-width:2px; border-style:solid;  padding: 10px; background-color: #FFF7DA; padding-top:25px;">
                           <?php
                              $mtgroom = "SELECT * FROM [dbo].[tbl_meetingroom]";
                              $stmt2 = sqlsrv_query($conn,$mtgroom);
                              while($row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
                                echo '<option value="'.$row2['Meeting Room'].'">'.$row2['Meeting Room'].'</option>';
                              }
                              ?>
               
                    </select>
                </div>
             
                </div>

                <div class="col-md-6">
                  <div class="form-floating">
                  <label for="floatingSelect" style="background-color:F3EA9C; margin-top:-10px; font-size: 12px;color:#7F7F7F;">Position :</label>

                <select class="form-select"  onchange="selectComboBox()" id="selectedposition" name="selectedposition"aria-label="State" style=" border-width:2px; border-style:solid; padding: 10px; background-color: #FFF7DA; padding-top:25px;"required>
                       <option selected></option>
                        <option value="STAFF">STAFF</option>
                        <option value="ENGINEER">ENGINEER</option>
                        
                   
                    </select>
                </div>
                </div>

                         
<h5 class="card-title">Elearning Target Attendees</h5>

<div id="loading">
    <img src="assets/img/Spin.gif" alt="Loading...">
</div>

    <div class="row">

            
                <div class="col-md-3">

                
                <input type="button" id="employeelist" name="employeelist"  value="Employee List" class="button-89">  

                  
                </div>

                <div id="table-container"></div>

    </div>

    <div class="row">
              
              <div class="col-12" style="display:flex; justify-content:right; align-items:left;">
              <button type="button" class="button-cus1 float-right mt-3 " id="btn-submit" role="button">Submit</button>
            <!-- <button type="button" class="btn btn-primary" style = "justify-content:left; margin-left: 5px;">Save</button> -->
              </div>
       </div>
  
</div>

</div>


<input type="hidden" id="selectedEmployeesInput" name="selectedEmployeesInput" value=""> 





</form>
  



              

     




<form>

          <div class="card" >
            <div class="card-body">
              <h5 class="card-title"></h5>


              <table id="example24" class="display" style="width:100%;  overflow-x: auto;  white-space: nowrap;   display: block;">
        <thead>
            <tr>
                <th></th>
                <th style="text-align: center;">Topic</th>
                <th style="text-align: center;">Type of Training</th>
                <th style="text-align: center;">Start Date</th>
                <th style="text-align: center;">End Date</th>
                <th style="text-align: center;">Start Time</th>
                <th style="text-align: center;">End Time</th>
                <th style="text-align: center;">Room</th>
                <th style="text-align: center;">Position</th>
                <th style="text-align: center;">Date Hired</th>
                <th style="text-align: center;">Emp No.</th>
                <th style="text-align: center;">Name</th>
            </tr>
            <tr>
            <th><input type="checkbox" id="all" name="all" onclick="toggle2(this);" style="width: 30px; height: 20px; accent-color: green;"style="width:5px;">Select All</th>
                <th style="text-align: center;">Topic</th>
                <th style="text-align: center;">Type of Training</th>
                <th style="text-align: center;">Start Date</th>
                <th style="text-align: center;">End Date</th>
                <th style="text-align: center;">Start Time</th>
                <th style="text-align: center;">End Time</th>
                <th style="text-align: center;">Room</th>
                <th style="text-align: center;">Position</th>
                <th style="text-align: center;">Date Hired</th>
                <th style="text-align: center;">Emp No.</th>
                <th style="text-align: center;">Name</th>
            </tr>
        </thead>
        <tbody>
        <?php
               $selectcommon = "SELECT * FROM [dbo].[tbl_topic_LIST_commonbusinesskill_MAINREQUEST] where Section = '$section'";
               $stmt3 = sqlsrv_query($conn,$selectcommon);
                              while($row = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
                                  $id2 = $row['ID'];
                                  $employeeno2 = $row['Employee_Number'];
                                  $fullname2 = $row['Employee_Name'];
                                  $section2 = $row['Section'];
                                  $position2 = $row['Position'];
                                  $email2 = $row['Email'];
                                  $datehired2 = $row['Date Hired'];             
                                  $topic2 = $row['Topic'];
                                  $typeoftraining2 = $row['Type of Training'];
                                  $startdate2 = $row['Start Date'];
                                  $enddate2 = $row['End Date'];
                                  $starttime2 = $row['Start Time'];
                                  $endtime2 = $row['End Time'];
                                  $meetingrom2 = $row['Meeting Room'];
                                  

                                  echo

                                  '<tr>
                                      <td style="width: 5px;"> <input type="checkbox" name="selected[]" class="single-checkbox2" id="selected" value="'.$id2.'"></td>
                                      <td style=" font-size: 12px;">'  . $row['Topic'] .'</td>
                                      <td style=" font-size: 12px;">'  . $row['Type of Training'] .'</td>
                                      <td style=" font-size: 12px;">'  . $row['Start Date'] .'</td>
                                      <td style=" font-size: 12px;">'  . $row['End Date'] .'</td>
                                      <td style=" font-size: 12px;">'  . $row['Start Time'] .'</td>
                                      <td style=" font-size: 12px;">'  . $row['End Time'] .'</td>
                                      <td style=" font-size: 12px;">'  . $row['Meeting Room'] .'</td>
                                      <td style=" font-size: 12px;">'  . $row['Position'] .'</td>
                                      <td style=" font-size: 12px;">'  . $row['Date Hired'] .'</td>
                                      <td style=" font-size: 12px;">'  . $row['Employee_Number'] .'</td>
                                      <td style=" font-size: 12px;">'  . $row['Employee_Name'] .'</td>
                                  ';
                              

                              }

              
              ?>
        </tbody>
       
    </table>

<br>
             



              <div class="row">
              
                <div class="col-12" style="display:flex; justify-content:right; align-items:left;">
              <button type="button"  class="button-cus3" role="button" style = "justify-content:left;" onclick="return confirm_remove()">Remove</button>
              <!-- <button type="button" class="btn btn-primary" style = "justify-content:left; margin-left: 5px;">Save</button> -->
                </div>
              </div>

              </form>

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

document.getElementById('btn-submit').addEventListener('click', function() {
    // Get all the checkboxes
    var checkboxes = document.querySelectorAll('input[name="row_checkbox[]"]:checked');
    
    // If no checkboxes are checked, show an error message
    if (checkboxes.length === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please select at least one employee!',
        });
        return;
    }

    // Get selected type of training
    var dropdown = document.getElementById('typeoftraining');
    var selectedTrainingType = dropdown.value;

    if (!selectedTrainingType) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please select a type of training!',
        });
        return;
    }

    // Gather the selected employee numbers
    var selectedEmployees = [];
    checkboxes.forEach(function(checkbox) {
        selectedEmployees.push(checkbox.value);
    });

    // Get the start and end enlist date values
    var startEnlist = document.getElementById('start_enlist').value;
    var endEnlist = document.getElementById('end_enlist').value;

    // Check if start and end dates are selected, if not show an error
    if (!startEnlist || !endEnlist) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please select both start and end dates!',
        });
        return;
    }

    // Show Swal.fire confirmation dialog with the selected employees
    Swal.fire({
        title: 'Are you sure?',
        html: 'Do you want to enlist the following selected employees?<br>' + selectedEmployees.join('<br>'),
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result.isConfirmed) {
            // Set the values of hidden fields with the start and end enlist dates
            document.getElementById('start_enlist_hidden').value = startEnlist;
            document.getElementById('end_enlist_hidden').value = endEnlist;

            // Also pass the selected employees to the form as a comma-separated string
            var selectedEmployeesString = selectedEmployees.join(',');
            document.getElementById('selectedEmployeesInput').value = selectedEmployeesString;

            // Submit the form
            document.getElementById('formid').submit();
        }
    });
});

</script>



  
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
        { orderable: false, targets: [0,1,2,3,4,5,6] }
        ]
        });



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

<script type="text/javascript">
  function toggle2(source) {
    var checkboxes = document.querySelectorAll('input[class="single-checkbox2"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
</script>



  <script>
        new DataTable('#example24', {
                

            initComplete: function () {
            
                this.api()
                    .columns([1,2,3,4,5,6,7,8,9,10])
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

<script>
                    function clickSend()
                    {
                 Swal.fire({
                    title: "Are you sure you want to Enlist?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    denyButtonText: `No`
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        document.getElementbyId("btnsubmit").click();
                        
                        // Swal.fire("Successfully Enlist!", "", "success");
                        
                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                    });
                }
</script>
 

<script>

  
function confirm_remove() {
    var inputElems = document.getElementsByTagName("input"),
        count = 0;
    
    // Loop through all input elements to count checked checkboxes
    for (var i = 0; i < inputElems.length; i++) {
      if (inputElems[i].type == "checkbox" && inputElems[i].checked == true) {
        count++;
      }
    }

    // Get all checkboxes with the name 'selected[]'
    var checkboxes = document.getElementsByName('selected[]');
    var vals = [];
    var topics = [];  // Array to hold Topic values
    var names = [];   // Array to hold Employee Name values

    // Loop through each checkbox and gather associated Topic and Name values
    for (var i = 0, n = checkboxes.length; i < n; i++) {
      if (checkboxes[i].checked) {
        vals.push(checkboxes[i].value);  // Add the selected checkbox value
        var row = checkboxes[i].closest('tr');  // Get the parent row of the checkbox
        var topic = row.querySelector('td:nth-child(2)').innerText;  // Get the Topic from the second column
        var name = row.querySelector('td:nth-child(12)').innerText;  // Get the Employee Name from the twelfth column

        topics.push(topic);  // Add the Topic to the array
        names.push(name);    // Add the Name to the array
      }
    }

    // If no checkboxes are selected, show an alert
    if (count <= 0) {
      Swal.fire({
        title: 'Kindly check desired control number',
        text: 'No selected values detected!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
      }).then((result) => {
        if (result.isConfirmed) {
          // Additional actions if needed
        }
      });
    } else {
      // If checkboxes are selected, show the confirmation dialog with the Topic and Name details
      Swal.fire({
        title: 'Are you sure you want to remove selected items?',
        text: 'Control Number(s): ' + vals.join(', ') + '\n' +
              'Topic(s): ' + topics.join(', ') + '\n' +
              'Employee Name(s): ' + names.join(', '),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, remove it!'
      }).then((result) => {
        if (result.isConfirmed) {
          // Redirect to the removal URL with selected item IDs, topics, and names
          window.location.href = 'forms/sqlupdates.php?action=commonbusinessskillsRemove&selectedItemId=' + vals.join(',') +
                                '&topics=' + encodeURIComponent(topics.join(',')) + 
                                '&names=' + encodeURIComponent(names.join(','));
        }
      });
    }
  }
          
    
          
                    
                
            
              
</script>


<script type="text/javascript">
  function selectComboBox() {
    var typeoftraining = document.getElementById('typeoftraining');
    var topic = document.getElementById('topic').value;

    console.log('Selected Topic:', topic); // Check console log

    if (typeoftraining.value === 'E-LEARNING') {
      // Disable unnecessary fields for E-LEARNING
      document.getElementById('starttime').disabled = true;
      document.getElementById('starttime').style.backgroundColor = 'DarkGray';
      document.getElementById('endtime').disabled = true;
      document.getElementById('endtime').style.backgroundColor = 'DarkGray';
      document.getElementById('meetingroom').disabled = true;
      document.getElementById('meetingroom').style.backgroundColor = 'DarkGray';
      document.getElementById('selectedposition').disabled = true;
      document.getElementById('selectedposition').style.backgroundColor = 'DarkGray';

      // AJAX request to fetch data from tbl_question
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'fetch_topic_date.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        if (xhr.status === 200) {
          var data = JSON.parse(xhr.responseText);
          if (data.length > 0) {
            // Populate start date and end date based on fetched data
            document.getElementById('startdate').value = data[0].start_date;
            document.getElementById('enddate').value = data[0].end_date;

              // Make start date and end date readonly
              document.getElementById('startdate').readOnly = true;
              document.getElementById('startdate').style.backgroundColor = '#A9A9A9';
            document.getElementById('enddate').readOnly = true;
            document.getElementById('enddate').style.backgroundColor = '#A9A9A9';
          } else {
            // Handle case where no data is found
            alert('No questionaire/ppt found for selected topic.');
            document.getElementById('startdate').value = '';
            document.getElementById('enddate').value = '';
          }
        } else {
          alert('Error fetching data. Please try again.');
        }
      };
      xhr.send('topic=' + encodeURIComponent(topic)); // Ensure proper encoding
    } else if (typeoftraining.value === 'FACE TO FACE') {
      // Enable fields for FACE TO FACE
      document.getElementById('starttime').disabled = false;
      document.getElementById('starttime').style.backgroundColor = '#FFF7DA';
      document.getElementById('endtime').disabled = false;
      document.getElementById('endtime').style.backgroundColor = '#FFF7DA';
      document.getElementById('meetingroom').disabled = false;
      document.getElementById('meetingroom').style.backgroundColor = '#FFF7DA';
      document.getElementById('selectedposition').disabled = false;
      document.getElementById('selectedposition').style.backgroundColor = '#FFF7DA';
    }
  }
</script>

<!-- 
<script type="text/javascript">
  function selectComboBox()
  {
      var selectedTopic = document.getElementById('typeoftraining').value;
      if (selectedTopic == 'E-LEARNING') {
        document.getElementById('starttime').disabled = true ;
        document.getElementById('starttime').style.backgroundColor = 'DarkGray';
        document.getElementById('endtime').disabled = true;
        document.getElementById('endtime').style.backgroundColor = 'DarkGray';
        document.getElementById('meetingroom').disabled = true;
        document.getElementById('meetingroom').style.backgroundColor = 'DarkGray';
        document.getElementById('selectedposition').disabled = true;
        document.getElementById('selectedposition').style.backgroundColor = 'DarkGray';

      }else if(selectedTopic == 'FACE TO FACE'){

       

        document.getElementById('starttime').disabled = false ;
        document.getElementById('endtime').disabled = false;
        document.getElementById('meetingroom').disabled = false;
        document.getElementById('selectedposition').disabled = false;
        document.getElementById('starttime').style.backgroundColor = '#FFF7DA';
        document.getElementById('endtime').style.backgroundColor = '#FFF7DA';
        document.getElementById('meetingroom').style.backgroundColor = '#FFF7DA';
        document.getElementById('selectedposition').style.backgroundColor = '#FFF7DA';
      }
     
      else{
       
        document.getElementById('starttime').disabled = false ;
        document.getElementById('endtime').disabled = false;
        document.getElementById('meetingroom').disabled = false;
        document.getElementById('selectedposition').disabled = false;
        document.getElementById('starttime').style.backgroundColor = '#FFF7DA';
        document.getElementById('endtime').style.backgroundColor = '#FFF7DA';
        document.getElementById('meetingroom').style.backgroundColor = '#FFF7DA';
        document.getElementById('selectedposition').style.backgroundColor = '#FFF7DA';
      }
      
 
  }
</script> -->







<script>
    $(document).ready(function(){
        $('#employeelist').click(function(){

          var selectedTopic = $('#topic').val();

        // Show loading GIF
        $('#loading').show();
         
            $.ajax({
                url: 'display_tableEMS.php',
                method: 'POST',
                data: { 
                    section: '<?php echo $section; ?>',
                    topic: '<?php echo $topic; ?>', // Pass the $topic variable here

                    topicDropdown: selectedTopic // Pass the selected topic dynamically
                
                },
                
                success: function(response){

                   // Hide loading GIF
                   $('#loading').hide();


                    $('#table-container').html(response);
                },
                error: function(){
                    // Hide loading GIF on error
                    $('#loading').hide();

                    // Display an error message or handle the error appropriately
                    $('#table-container').html("An error occurred while fetching data.");
                }
               
            });
        });
    });
</script>


<script type="text/javascript">
  function selectComboBoxTrainingType()
  {
      var selectedTopic = document.getElementById('typeoftraining').value;
      if (selectedTopic == 'E-LEARNING') {
        document.getElementById('meetingroom').value = "";  // Set value to empty
        document.getElementById('meetingroom').disabled = true;
        document.getElementById('meetingroom').style.backgroundColor = 'DarkGray';
        document.getElementById('selectedposition').disabled = true;
        document.getElementById('selectedposition').style.backgroundColor = 'DarkGray';

      }else if(selectedTopic == 'FACE TO FACE'){

       

        document.getElementById('meetingroom').disabled = false;
        document.getElementById('selectedposition').disabled = false;
    
        document.getElementById('meetingroom').style.backgroundColor = '#FFF7DA';
        document.getElementById('selectedposition').style.backgroundColor = '#FFF7DA';
      }
     
      else{
       
      
        document.getElementById('meetingroom').disabled = false;
        document.getElementById('selectedposition').disabled = false;
    
        document.getElementById('meetingroom').style.backgroundColor = '#FFF7DA';
        document.getElementById('selectedposition').style.backgroundColor = '#FFF7DA';
      }

 
  }
</script>






</body>

</html>

