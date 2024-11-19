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

<!-- Include Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Include Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


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
    table tr:hover td {
  background-color: #C6F1F8;
}

.btn {
  background-color: DodgerBlue;
  border: none;
  color: white;
  padding: 12px 30px;
  cursor: pointer;
  font-size: 17px;
}
.button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #04AA6D;
}

.button1:hover {
  background-color: #04AA6D;
  color: white;
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
          
             <h5 class="card-title">Training Request</h5>

             <div id="loading">
    <img src="assets/img/Spin.gif" alt="Loading...">
</div>



 <form id="form" class="row g-3" method="POST"  name="form" action="forms/sqlupdates.php?action=trainingrequest" autocomplete="off">
 <input type="hidden" id="selectedItems" name="selectedItems">
             <div class="row">

             <div class="col-md-6">
                  <div class="form-floating">
                  <label for="floatingSelect" style="background-color:F3EA9C; margin-top:-10px; font-size: 12px;color:#FFF7DA;">Topic :</label>

                <select class="form-select"  onchange="selectComboBox()" id="topic" name="topic" aria-label="State" style="font-weight: bold; border-width:2px; border-style:solid; border-color:#78432C; padding: 10px; background-color: #FFF7DA; padding-top:25px;" required>
               
                  
                      <option value="Manual Soldering">Manual Soldering</option>
                      <option value="New Staff Training">New Staff Training</option>
                 </select>     
                </div>
                </div>
     
                <div class="col-md-6">
                  
                  <div class="form-floating">
                    
                  <label for="floatingSelect" style="background-color:F3EA9C; margin-top:-10px; font-size: 12px;color:#FFF7DA;">Type of Training :</label>

                <select class="form-select"  onchange="selectComboBox()"  id="typeoftraining" name="typeoftraining" aria-label="State" style="font-weight: bold; border-width:2px; border-style:solid; border-color:#78432C; padding: 10px; background-color: #FFF7DA; padding-top:25px;"required>
                     
                        <option value="FACE TO FACE">FACE TO FACE</option>
                        <option value="E-LEARNING">E-LEARNING</option>
                </select>
                
                </div>
                </div>
                
        

             
            

              <!-- Floating Labels Form -->
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="form-floating" >
                    <input type="text" class="form-control" id="requestorname" name="requestorname" value="<?php echo $fullname;?>"placeholder="Your Name" autocomplete="false" readonly>
                    <label for="floatingName">Requestor Name</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="section" name="section" placeholder="Your Section" value="<?php echo $section;?>" readonly>
                    <label for="floatingName">Section</label>
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-floating">
               
                 <select class="form-select" id="rank" name="rank" aria-label="State">
                 <option selected disabled>-</option>
                         <option value="New Leader">New Leader</option>
                         <option value="New Staff">New Staff</option>
                          <option value="A">A</option>
                          <option value="B">B</option>
                          <option value="C">C</option>
                          <option value="PS">PS</option>

                        </select>
                    <label for="floatingSelect">Rank</label>

                  </div>
                </div>
                
         
                <div class="col-md-6">
                  <div class="form-floating">
                    <select class="form-select" id="urgent" name="urgent" aria-label="State">
                    <option selected disabled>-</option>
                      <option value="YES">YES</option>
                      <option value="NO">NO</option>
                    </select>
                    <label for="floatingSelect">Urgent</label>
                  </div>
                </div>


                <div class="col-md-6">
    <div class="form-floating">
        <input type="text" class="form-control" id="targetdate" name="targetdate" placeholder="Target Date" required>
        <label for="targetdate">Target Date</label>
    </div>
</div>
<!-- 
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">  -->
<!-- 
<script>
document.addEventListener('DOMContentLoaded', function () {
    flatpickr("#targetdate", {
        disable: [
            function(date) {
                // Get the day of the week (0 = Sunday, 1 = Monday, 2 = Tuesday, ..., 6 = Saturday)
                const day = date.getDay();
                // Disable Tuesdays (2) and Thursdays (4)
                const isDisabledDay = day === 2 || day === 4;

                // Get today's date and set the hours to 0 for accurate comparison
                const today = new Date();
                today.setHours(0, 0, 0, 0); // Reset time to midnight

                // Disable dates that are before today
                const isPastDate = date < today;

                return isDisabledDay || isPastDate;
            }
        ],
        dateFormat: "Y-m-d", // Format for the date input
    });
});
</script> -->

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<script>
document.addEventListener('DOMContentLoaded', function () {
    const targetDateInput = flatpickr("#targetdate", {
        disable: [
            function(date) {
                // Get the day of the week (0 = Sunday, 1 = Monday, 2 = Tuesday, ..., 6 = Saturday)
                const day = date.getDay();
                // Get the current date
                const today = new Date();
                today.setHours(0, 0, 0, 0); // Reset time to midnight

                // Disable past dates
                const isPastDate = date < today;

                // Disable Tuesdays (2) and Thursdays (4)
                const isDisabledDay = day === 1 || day === 3 || day === 4 || day === 0 || day === 6;

                return isDisabledDay || isPastDate;
            }
        ],
        dateFormat: "Y-m-d",
    });

    document.getElementById('topic').addEventListener('change', function() {
        if (this.value === 'New Staff Training') {
            targetDateInput.set('disable', [
                function(date) {
                    // Disable all dates from the third week onward
                    const weekOfMonth = Math.ceil(date.getDate() / 7);
                    return weekOfMonth >= 3;
                }
            ]);
        } else {
            targetDateInput.set('disable', [
                function(date) {
                    // Default disable function
                    const today = new Date();
                    today.setHours(0, 0, 0, 0); // Reset time to midnight
                    const isPastDate = date < today;
                    const isDisabledDay = date.getDay() === 2 || date.getDay() === 4;
                    return isDisabledDay || isPastDate;
                }
            ]);
        }
    });
});
</script>




                <div class="col-md-6">
                  <div class="form-floating">
                    <select class="form-select" id="reason" name="reason" aria-label="State">
                    <option selected disabled>-</option>
                      <option value="Line Stop">Line Stop</option>
                      <option value="For transfer to other section">For transfer to other section</option>
                      <option value="For transfer of process">For transfer of process</option>
                      <option value="Shift Up/Increase Line">Shift Up/Increase Line</option>
                    </select>
                    <label for="floatingSelect">Reason of Urgency</label>
                  </div>
                </div>


                <?php
            

                        
              // SQL query to fetch supervisors from the database
              $querygetspv = "SELECT Full_Name FROM [dbo].[tbl_ems] WHERE Section = '$section' and Position LIKE '%Supervisor%'";
              $result = sqlsrv_query($conn, $querygetspv);

              if ($result === false) {
                  // Handle query execution error
                  echo "Error executing query.";
                  die(print_r(sqlsrv_errors(), true));
              }

              // Output the select dropdown
              echo '<div class="col-md-6">';
              echo '<div class="form-floating">';
              echo '<select class="form-select" id="sectionspv" name="sectionspv" aria-label="State">';

              // Add a default option
              echo '<option selected disabled>-</option>';
              
              // Loop through the result set and populate options
              while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                  echo '<option value="' . $row['Full_Name'] . '">' . $row['Full_Name'] . '</option>';
              }

              // Close select dropdown
              echo '</select>';
              echo '<label for="floatingSelect">Section SPV</label>';
              echo '</div>';
              echo '</div>';

                              ?>


            <?php
            


            if ($section == 'BPS') {
                $querygetmgr = "SELECT Full_Name FROM [dbo].[tbl_ems] WHERE (Section = 'BPS' OR Section = 'PE') AND (Position LIKE '%Manager%' OR Position LIKE '%Adviser%')";
            } else {
                $querygetmgr = "SELECT Full_Name FROM [dbo].[tbl_ems] WHERE Section = '$section' AND (Position LIKE '%Manager%' OR Position LIKE '%Adviser%')";
            }
                        
            // // SQL query to fetch manager from the database
            // $querygetmgr = "SELECT Full_Name FROM [dbo].[tbl_ems] WHERE Section = '$section' and (Position LIKE '%Manager%'  OR  Position LIKE '%Adviser%')";
            $result = sqlsrv_query($conn, $querygetmgr);

            if ($result === false) {
                // Handle query execution error
                echo "Error executing query.";
                die(print_r(sqlsrv_errors(), true));
            }

            // Output the select dropdown
            echo '<div class="col-md-6">';
            echo '<div class="form-floating">';
            echo '<select class="form-select" id="sectionmgr" name="sectionmgr" aria-label="State">';

            // Add a default option
            echo '<option selected disabled>-</option>';

            // Loop through the result set and populate options
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                echo '<option value="' . $row['Full_Name'] . '">' . $row['Full_Name'] . '</option>';
            }

            // Close select dropdown
            echo '</select>';
            echo '<label for="floatingSelect">Section MGR</label>';
            echo '</div>';
            echo '</div>';

            ?>




          <?php
            

                        
         
            echo '<div class="col-md-6">';
            echo '<div class="form-floating">';
            echo '<select class="form-select" id="petrainingpic" name="petrainingpic" aria-label="State">';
            
            // Add a default option
            echo '<option selected>-</option>';
            
            // Add hardcoded options
            echo '<option value="Jayvee Hernandez">Jayvee Hernandez</option>';
            echo '<option value="Agustina Andres">Agustina Andres</option>';
       
            echo '<option value="Jane Balais">Jane Balais</option>';
            echo '<option value="Bradly Mateo">Bradly Mateo</option>';
            echo '<option value="Jill Therese Garcia">Jill Therese Garcia</option>';
           
            
            // Close select dropdown
            echo '</select>';
            echo '<label for="floatingSelect">PE Training PIC</label>';
            echo '</div>';
            echo '</div>';

            ?>


          <?php
            

                        
            // SQL query to fetch manager from the database
            $querygetspv = "SELECT Full_Name FROM [dbo].[tbl_ems] WHERE Section = 'PE' and Position LIKE '%supervisor%'";
            $result = sqlsrv_query($conn, $querygetspv);

            if ($result === false) {
                // Handle query execution error
                echo "Error executing query.";
                die(print_r(sqlsrv_errors(), true));
            }

            // Output the select dropdown
            echo '<div class="col-md-6">';
            echo '<div class="form-floating">';
            echo '<select class="form-select" id="pespv" name="pespv" aria-label="State">';

            // Add a default option
            echo '<option selected disabled>-</option>';

            // Loop through the result set and populate options
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                echo '<option value="' . $row['Full_Name'] . '">' . $row['Full_Name'] . '</option>';
            }

            // Close select dropdown
            echo '</select>';
            echo '<label for="floatingSelect">PE SPV Approver</label>';
            echo '</div>';
            echo '</div>';

            ?>


          <?php
            

                        
            // SQL query to fetch manager from the database
            $querygetspv = "SELECT Full_Name FROM [dbo].[tbl_ems] WHERE Section = 'PE' and Position LIKE '%manager%'";
            $result = sqlsrv_query($conn, $querygetspv);

            if ($result === false) {
                // Handle query execution error
                echo "Error executing query.";
                die(print_r(sqlsrv_errors(), true));
            }

            // Output the select dropdown
            echo '<div class="col-md-6">';
            echo '<div class="form-floating">';
            echo '<select class="form-select" id="pemgr" name="pemgr" aria-label="State">';

            // Add a default option
            echo '<option selected disabled>-</option>';

            // Loop through the result set and populate options
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                echo '<option value="' . $row['Full_Name'] . '">' . $row['Full_Name'] . '</option>';
            }

            // Close select dropdown
            echo '</select>';
            echo '<label for="floatingSelect">PE MGR Approver</label>';
            echo '</div>';
            echo '</div>';

            ?>









                <script>
    document.addEventListener("DOMContentLoaded", function() {
        var urgentSelect = document.getElementById('urgent');
        var reasonSelect = document.getElementById('reason');

        // Add event listener to the urgent select input
        urgentSelect.addEventListener('change', function() {
            // Check if the selected value is 'NO'
            if (urgentSelect.value === 'NO') {
                // Disable the reason select input
                reasonSelect.disabled = true;
            } else {
                // Enable the reason select input
                reasonSelect.disabled = false;
            }
        });
    });
</script>

              
       
             <!-- End floating Labels Form -->

           
     
             
             
             

             <div class="row">

 

<div class="col-md-3">

<br>
<input type="button" id="employeelist" name="employeelist"  value="Employee List" class="button-89" hidden>  

  
</div>

<div id="table-container"></div>



</div>

    

</div>
<button type="submit" value="btnSubmit" id="btnSubmit" name="btnSubmit" hidden>Submit</button>
    <button type="button" class="button button1" onclick="clickApproved()" style="width: 250px;" hidden>SUBMIT</button>
              
</div>




<div>

  <?php
  $sql_getdata = "SELECT * FROM View_MasterList WHERE Section = ?";
  $params = array($section);
  
  $stmt = sqlsrv_query($conn, $sql_getdata, $params);
  ?>
    <table id="trainingrequest" class="display">
    <input type="hidden" name="selected_empnos" id="selected_empnos" value="">
        <thead>
            <tr>
                <th style="text-align: center;">
                    <!-- <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this);">
                    Select All -->
                </th>
                <th style="text-align: center;">Employee Number</th>
                <th style="text-align: center;">Employee Name</th>
                <th style="text-align: center;">Date Hired</th>
                <th style="text-align: center;">Position</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                echo '
                <tr>
                    <td style="text-align: center; ">
                        <input type="checkbox" name="row_checkbox[]" value="' . $row['EmpNo'] . '" style="transform: scale(1.5); margin: 0; cursor: pointer;">
                    </td>
                    <td style="text-align: center;">' . $row['EmpNo'] . '</td>
                    <td style="text-align: center;">' . $row['First_Name'] . ' ' . $row['Family_Name'] . '</td>
                    <td style="text-align: center;">' . $row['Date_Hired'] . '</td>
                    <td style="text-align: center;">' . $row['Position'] . '</td>
                </tr>';
            }
            ?>
        </tbody>
    </table>
    <button type="button" id="submitButton"  class="button button1">Submit Selected</button>
</form>
          </div>




<!--           

          <script>
// Initialize an object to track selected EmpNos
let selectedEmpNos = {};

// Maximum allowed selections
const MAX_SELECTIONS = 8;

// Initialize DataTable
$(document).ready(function() {
    const table = $('#trainingrequest').DataTable();

    // On each draw (when the page changes)
    table.on('draw', function() {
        // Restore the checkbox state based on the selectedEmpNos
        $('input[name="row_checkbox[]"]').each(function() {
            const empNo = $(this).val();
            if (selectedEmpNos[empNo]) {
                $(this).prop('checked', true);
            }
        });
    });

    // Toggle individual checkboxes
    $('body').on('change', 'input[name="row_checkbox[]"]', function() {
        const empNo = $(this).val();
        if ($(this).is(':checked')) {
            if (Object.keys(selectedEmpNos).length < MAX_SELECTIONS) {
                selectedEmpNos[empNo] = true;
            } else {
                $(this).prop('checked', false);
                Swal.fire('Selection Limit Reached', 'You can select a maximum of ' + MAX_SELECTIONS + ' employees.', 'warning');
            }
        } else {
            delete selectedEmpNos[empNo];
        }
    });

    // Handle select all toggle
    $('#selectAll').on('click', function() {
        const isChecked = $(this).is(':checked');
        if (isChecked) {
            if (Object.keys(selectedEmpNos).length + $('input[name="row_checkbox[]"]:not(:checked)').length > MAX_SELECTIONS) {
                $(this).prop('checked', false);
                Swal.fire('Selection Limit Reached', 'You can select a maximum of ' + MAX_SELECTIONS + ' employees.', 'warning');
                return;
            }
        }

        $('input[name="row_checkbox[]"]').each(function() {
            const empNo = $(this).val();
            $(this).prop('checked', isChecked);
            if (isChecked) {
                selectedEmpNos[empNo] = true;
            } else {
                delete selectedEmpNos[empNo];
            }
        });
    });

    // Handle form submission with SweetAlert confirmation
    $('#submitButton').on('click', function(e) {
        e.preventDefault();

        let selectedEmpNosArray = Object.keys(selectedEmpNos);

        if (selectedEmpNosArray.length > 0) {
            Swal.fire({
                title: 'Confirm Submission',
                html: 'You have selected the following Employee Numbers:<br><strong>' + selectedEmpNosArray.join(', ') + '</strong>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, submit',
                cancelButtonText: 'No, cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Serialize selected EmpNos and set to hidden input
                    $('#selected_empnos').val(selectedEmpNosArray.join(','));
                    $('#form').submit();
                }
            });
        } else {
            Swal.fire('No items selected', 'Please select at least one employee before submitting.', 'error');
        }
    });
});
</script> -->

<script>
// Initialize an object to track selected EmpNos
let selectedEmpNos = {};

// Maximum allowed selections
const MAX_SELECTIONS = 8;

// Initialize DataTable
$(document).ready(function() {
    const table = $('#trainingrequest').DataTable();

    // On each draw (when the page changes)
    table.on('draw', function() {
        // Restore the checkbox state based on the selectedEmpNos
        $('input[name="row_checkbox[]"]').each(function() {
            const empNo = $(this).val();
            if (selectedEmpNos[empNo]) {
                $(this).prop('checked', true);
            }
        });
    });

    // Toggle individual checkboxes
    $('body').on('change', 'input[name="row_checkbox[]"]', function() {
        const empNo = $(this).val();
        if ($(this).is(':checked')) {
            if (Object.keys(selectedEmpNos).length < MAX_SELECTIONS) {
                selectedEmpNos[empNo] = true;
            } else {
                $(this).prop('checked', false);
                Swal.fire('Selection Limit Reached', 'You can select a maximum of ' + MAX_SELECTIONS + ' employees.', 'warning');
            }
        } else {
            delete selectedEmpNos[empNo];
        }
    });

    // Handle select all toggle
    $('#selectAll').on('click', function() {
        const isChecked = $(this).is(':checked');
        if (isChecked) {
            if (Object.keys(selectedEmpNos).length + $('input[name="row_checkbox[]"]:not(:checked)').length > MAX_SELECTIONS) {
                $(this).prop('checked', false);
                Swal.fire('Selection Limit Reached', 'You can select a maximum of ' + MAX_SELECTIONS + ' employees.', 'warning');
                return;
            }
        }

        $('input[name="row_checkbox[]"]').each(function() {
            const empNo = $(this).val();
            $(this).prop('checked', isChecked);
            if (isChecked) {
                selectedEmpNos[empNo] = true;
            } else {
                delete selectedEmpNos[empNo];
            }
        });
    });

    // Handle form submission with SweetAlert confirmation
    $('#submitButton').on('click', function(e) {
        e.preventDefault();

        // Check if all required dropdowns have been selected (AND condition: all must be filled)
        const requiredFields = [
           '#rank','#targetdate', '#sectionspv', '#sectionmgr', '#petrainingpic', '#pespv', '#pemgr'
        ];

        let missingFields = requiredFields.filter(function(selector) {
            return $(selector).val() === "" || $(selector).val() === null;
        });

        // If any required field is missing, show missing info alert
        if (missingFields.length > 0) {
            Swal.fire('Missing Information', 'Please fill out all required fields.', 'error');
            return; // Prevent submission if any required field is missing
        }

        let selectedEmpNosArray = Object.keys(selectedEmpNos);

        // If no employees are selected, show the "No items selected" alert
        if (selectedEmpNosArray.length === 0) {
            Swal.fire('No items selected', 'Please select at least one employee before submitting.', 'error');
            return;
        }

        // If all fields are filled and employees are selected, show the confirmation
        Swal.fire({
            title: 'Confirm Submission',
            html: 'You have selected the following Employee Numbers:<br><strong>' + selectedEmpNosArray.join(', ') + '</strong>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, submit',
            cancelButtonText: 'No, cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Serialize selected EmpNos and set to hidden input
                $('#selected_empnos').val(selectedEmpNosArray.join(','));
                $('#form').submit();  // Submit the form
            }
        });
    });
});
</script>




 
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
                    .columns([1,2,3,4])
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
        { orderable: false, targets: [0,1,2,3,4] }
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
  function selectComboBox() {
      var selectedTopic = document.getElementById('topic').value;
      var rankSelect = document.getElementById('rank'); // Add this to define the rankSelect variable
   

      // Hide or show elements based on the selected topic
      if (selectedTopic == 'Manual Soldering') {
        // Enable certain elements for Manual Soldering
        document.getElementById('rank').disabled = false;
        document.getElementById('reason').disabled = false;
        document.getElementById('generate').style.visibility = "hidden";
        document.getElementById('go').style.visibility = "visible";
        document.getElementById('delete').style.visibility = "visible";

       
      } 
      else if (selectedTopic == 'New Staff Training') {
        // Disable certain elements for New Staff Training
        document.getElementById('reason').disabled = true;
        document.getElementById('urgent').disabled = true;
        document.getElementById('generate').style.visibility = "visible";
        document.getElementById('go').style.visibility = "hidden";
        document.getElementById('delete').style.visibility = "hidden";

        // Hide "New Leader" and "New Staff" options
        newLeaderOption.style.display = 'block';
        newStaffOption.style.display = 'block';
      } 
      else {
        // Enable other elements if needed
        document.getElementById('reason').disabled = false;
        document.getElementById('generate').style.visibility = "hidden";


      }
  }
</script>



<script>
                    function clickSend()
                    {
                 Swal.fire({
                    title: "Are you sure you want to Submit?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    denyButtonText: `No`
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        // Swal.fire("Successfully Enlist!", "", "success");
                        document.getElementbyId("btnSubmit").click();
                    
                        
                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                    });
                }
</script>


<script>
                    function clickDelete()
                    {
                      Swal.fire({
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire({
      title: "Deleted!",
      text: "Your file has been deleted.",
      icon: "success"
    });
  }
});
                }
</script>


<script>
    function clickApproved() {
        // Get all checked checkboxes
        const selectedItems = Array.from(document.querySelectorAll('#trainingrequest input[name="row_checkbox[]"]:checked'))
            .map(checkbox => checkbox.value) // Use the value attribute to get the employee number
            .join(', '); // Join the values with commas

        Swal.fire({
            title: "Are you sure you want to Submit?",
            html: `You have selected:<br>${selectedItems.replace(/,/g, '<br>')}`,
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Yes",
            denyButtonText: `No`
        }).then((result) => {
            if (result.isConfirmed) {
                // Set the value of the hidden input field
                document.getElementById('selectedItems').value = selectedItems;

                // Trigger the form submission
                document.getElementById('form').submit();
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        });
    }
</script>

<script>
    function toggle(source) {
        var checkboxes = document.querySelectorAll('tr input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = source.checked;
        });
    }
</script>



<script>
    $(document).ready(function(){
        $('#employeelist').click(function(){

     
        var selectedTopic = $('#topic').val();

        var section = '<?php echo $section?>';
         
            $.ajax({
                url: 'display_tableEMS.php',
                method: 'POST',
                data: { 
                  section: section,
                        topic: selectedTopic
                },
                
                success: function(response){


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






</body>

</html>