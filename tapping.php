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


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  

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

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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

@font-face {
    font-family: 'Eraser';
    src: url('assets/fonts/Eraser.ttf'); /* Replace 'path/to/chalkboard-font.ttf' with the actual path to your font file */
}

.custom-font {
    font-family: 'Eraser', sans-serif; /* Apply your custom font */
    /* Add any other styles you want to apply */
    
  
}

.no-border-radius {
        border-radius: 0 !important;
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


</style>

<body>

  
<?php


include 'header.php';


include 'sidebar.php';


?>


<main id="main" class="main">
<h1 class="custom-font" style="color:white; font-size: 48px;">ID Tapping (Under Development, wait for a while...)</h1>
<div class="pagetitle">
  <!-- <h1>Common Training</h1> -->
 
</div><!-- End Page Title -->
         
         

<div class="card">



            <div class="card-body">
          
             <h5 class="card-title">Attendee's Details</h5>


             
<div class="row">
    <br>

 

    <!-- Floating Labels Form -->
    <form action="upload.php" id="form1" method="post" enctype="multipart/form-data">
        <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text no-border-radius" style="width:170px; background-color:#E9ECEF; font-weight:bold;">Tap Here 🡆</span>
                            </div>
                            <input type="password" class="form-control no-border-radius" id="rfid" name="rfid" style="background-color: black;">
                       

                        </div>
                    </div>

   


                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text no-border-radius" style="width:150px; background-color:white; font-weight:bold;">Position</span>
                            </div>
                            <input type="text" class="form-control no-border-radius" id="position" name="position" style="background-color: #E9ECEF; color: #868E96;" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text no-border-radius" style="width:170px; background-color:white; font-size:16px; font-weight:bold;">Employee Number</span>
                            </div>
                            <input type="text" class="form-control no-border-radius" id="empno" name="empno" style="background-color: #E9ECEF; color: #868E96;" >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text no-border-radius" style="width:150px; background-color:white; font-weight:bold;">Section</span>
                            </div>
                            <input type="text" class="form-control no-border-radius" id="section" name="section" style="background-color: #E9ECEF; color: #868E96;" readonly>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text no-border-radius" style="width:170px; background-color:white; font-size:16px; font-weight:bold;">Employee Name</span>
                            </div>
                            <input type="text" class="form-control no-border-radius" id="fullname" name="fullname" style="background-color: #E9ECEF; color: #868E96;" readonly>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text no-border-radius" style="width:150px; background-color:white; font-weight:bold;">Department</span>
                            </div>
                            <input type="text" class="form-control no-border-radius" id="department" name="department" style="background-color: #E9ECEF; color: #868E96;" readonly>
                        </div>
                    </div>
            </div>
        
    </form>



    <div class="row">
              
              <div class="col-12" style="display:flex; justify-content:right; align-items:left;">
              <button type="button" class="button-cus1 float-right mt-3 " id="btn-submit" role="button">Generate</button>
              </div>
    </div>

    <div class="col-md-6">
    <!-- <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text no-border-radius" style="width:150px; background-color:white; font-weight:bold;">trial</span>
        </div>
        <input type="text" class="form-control no-border-radius" id="trial" name="trial" style="background-color: #E9ECEF; color: #868E96;">
    </div> -->
</div>
<!-- 
<script>
document.getElementById('trial').addEventListener('input', function() {
    this.value = 'Done';
});
</script> -->




<script>

document.addEventListener('DOMContentLoaded', () => {
    const topicField = document.getElementById('trial');
    const compareField = document.getElementById('rfid');

    topicField.addEventListener('input', () => {
        // Get values from both inputs
        const topicValue = topicField.value;
        const compareValue = compareField.value;

        // Check if both fields are not empty
        if (topicValue && compareValue) {
            // Compare the values and log a message
            if (topicValue === compareValue) {
                console.log('Values match');
            } else {
                console.log('Values do not match');
            }
        }
    });
});



</script>







    <br>
    <br>
    <br>

    <div id="response-container"></div>

    <script>

    document.getElementById('btn-submit').addEventListener('click', function() {
        var empnoElement = document.querySelector('#empno');
        var empnoValue = empnoElement.value.trim();
        var rfidElement = document.querySelector('#rfid');
        var rfidValue = rfidElement.value.trim();
        
        if (empnoValue === "") {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please enter an employee number.',
            }).then(() => {
                empnoElement.focus();
            });
        } else {
            Swal.fire({
                icon: 'success',
                title: 'Processing',
                text: 'Employee Number is valid. Kindly wait for the process...',
            }).then(() => {
                sideProcess(empnoValue, rfidValue);
            });
        }
    });

    function sideProcess(empno, rfid) {
        // Replace 'fetch_RFID_employee_enlist.php' with the actual path to your PHP script
        fetch('fetch_RFID_employee_enlist.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'empno=' + encodeURIComponent(empno) + '&rfid=' + encodeURIComponent(rfid)
        })
        .then(response => response.text())
        .then(data => {
            // console.log("Response from server:", data);
            // Update the response-container element with the response data
            document.getElementById('response-container').innerHTML = data;
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while processing the request.'
            });
        });
    }
</script>

<script>

    // This will correctly set the rfid variable with the current value
    var rfidElement = document.getElementById('rfid');

    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM fully loaded and parsed');
        
        // Function to set up input event listeners for topic fields
        function setupInputListeners() {
            var fields = document.querySelectorAll('.topic-field');
            console.log('Found topic fields:', fields);

            fields.forEach(function(input) {
                input.addEventListener('input', function() {
                    var topicValue = this.value.trim();
                    var rfidValue = rfidElement.value.trim();  // Get the current RFID value
                    console.log('Input value:', topicValue);
                    console.log('RFID value:', rfidValue);

                    if (topicValue === rfidValue) {
                        console.log('Match found!');
                        this.value = 'PASSED';
                    }
                     else {
                   
                     
                        
                      
                        // console.log('No match.');
                    }
                });
            });
        }

        // Initial setup
        setupInputListeners();

        // Set up mutation observer to detect changes in the DOM
        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.addedNodes.length) {
                    setupInputListeners();  // Re-setup event listeners for new nodes
                }
            });
        });

        // Observe changes in the response container
        var responseContainer = document.getElementById('response-container');
        observer.observe(responseContainer, { childList: true, subtree: true });
    });
</script>




<div class="row">
              
              <div class="col-12" style="display:flex; justify-content:right; align-items:left;">
              <button type="button" class="button-cus1 float-right mt-3 " id="btn-save" role="button">Save</button>
              </div>
    </div>





    <script>
    
    document.getElementById('btn-save').addEventListener('click', function() {
  Swal.fire({
    title: 'Are you sure?',
    text: 'Do you want to save the changes?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, save it!'
  }).then((result) => {
    if (result.isConfirmed) {
      // Collect table data including headers
      const table = document.querySelector('table');
      const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.textContent.trim());
    
      const rows = Array.from(table.querySelectorAll('tbody tr'))
        .map(row => {
          const cells = Array.from(row.querySelectorAll('td'));
          const rowData = {};
          cells.forEach((cell, index) => {
            const input = cell.querySelector('input');
            const title = headers[index]; // Get the title from headers
            rowData[title] = input ? input.value.trim() : cell.textContent.trim();
          });
          return rowData; // Return the entire row as an object
        })
        .filter(row => Object.keys(row).length > 0 && Object.values(row).some(cell => cell.trim() !== '')); // Remove empty rows

      // Ensure rows are correctly logged
      console.log('Rows:', rows); // Debugging: log rows

      // Get the value of the Employee Number input
      const empNo = document.getElementById('empno').value.trim();

      // Log the data being sent
      console.log('Sending Rows:', JSON.stringify({ rows: rows, empno: empNo }));

      fetch('fetch_RFID_employee_enlist_save.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ rows: rows, empno: empNo }) // Send rows and empno directly
      })
      .then(response => {
          if (!response.ok) {
              throw new Error('Network response was not ok');
          }
          return response.json(); // Ensure we parse the JSON response here
      })
      .then(data => {
          console.log('Response:', data);
          if (data.status === 'success') {
                    Swal.fire('Saved!', 'Your data has been saved.', 'success').then(() => {
                setTimeout(() => {
                    window.location.reload();
                }, 1000); // Adjust the delay time (in milliseconds) as needed
            });
          } else {
              Swal.fire('Error!', data.message || 'There was an error saving your data.', 'error');
          }
      })
      .catch(error => {
          console.error('Fetch Error:', error);
          Swal.fire('Error!', 'There was an error saving your data.', 'error');
      });
    }
  });
});


</script>








    
       
    <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.getElementById('rfid').addEventListener('change', function() {
            var rfid = this.value;
    if (rfid) {
        // Convert the RFID value from decimal to hexadecimal
        var outputHex = parseInt(rfid, 10).toString(16).toUpperCase(); // Decimal to hexadecimal
        
        // Characters to remove from the start of the hexadecimal string
        var charsToRemove = ['F', '8'];
        
        // Remove the specified characters from the start of the string
        var newString = outputHex;
        for (var i = 0; i < charsToRemove.length; i++) {
            while (newString.startsWith(charsToRemove[i])) {
                newString = newString.slice(charsToRemove[i].length);
            }
        }

        // Convert the new hexadecimal string back to decimal
        var decValue = parseInt(newString, 16);

        // Convert from integer to string
        var rfidData2 = decValue.toString();
        
        // Log or use the rfidData2 value
        console.log(rfidData2);

        // Call your fetchEmployeeDetails function with the processed RFID data
        fetchEmployeeDetails(rfidData2);
    }
        });
    });

    function fetchEmployeeDetails(rfidData2) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'fetch_RFID_employee_details.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    document.getElementById('position').value = response.data.position;
                    document.getElementById('empno').value = response.data.empno;
                    document.getElementById('section').value = response.data.section;
                    document.getElementById('fullname').value = response.data.fullname;
                    document.getElementById('department').value = response.data.department;
                } else {
                    alert('No details found for this RFID.');
                }
            }
        };
        xhr.send('rfid2=' + encodeURIComponent(rfidData2));
    }
</script>

    <!-- End floating Labels Form -->

    <script>
        $(function() {
            $("#datePicker").datepicker({
                dateFormat: "yy-mm-dd" // format the date as YYYY-MM-DD
            });
        });
    </script>
</div>







</div>
</div>


  

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

</body>

</html>

