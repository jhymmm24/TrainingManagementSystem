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
  <link href="assets/img/TMS3D.png" rel="icon">
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

  
table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }
   
  



</style>

<body>



 <?php

include 'header.php';
 
 include 'sidebar.php';
 
 ?>

    <main id="main" class="main">

    <div class="pagetitle">

      <h1 class="custom-font" style="color:white; font-size: 48px;">DEVELOPMENT ON-GOING . . .</h1>

    
    </div><!-- End Page Title -->



<section class="section">




<div class="card">



            <div class="card-body">
          
             <h5 class="card-title">Section Employee List</h5>


             
<div class="row">
    <br>

 <form>
    <table id="example24" class="display" style="width:100%;  overflow-x: auto;  white-space: nowrap;   display: block;">
        <thead>
            <tr>
                <th style="text-align: center;">Select</th>
                <th style="text-align: center;">Employee Number</th>
                <th style="text-align: center;">Full Name</th>
                <th style="text-align: center;">Section</th>
               
              
            </tr>
           
        </thead>
        <tbody>
        <?php
               $selectcommon = 
               "
               SELECT DISTINCT Employee_Number, Employee_Name, Section
FROM [dbo].[tbl_topic_LIST_commonbusinesskill]
WHERE Section = '$section'

UNION

SELECT DISTINCT Employee_Number, Employee_Name, Section
FROM [dbo].[tbl_topic_LIST_commontraining]
WHERE Section = '$section'

UNION

SELECT DISTINCT Employee_Number, Employee_Name, Section
FROM [dbo].[tbl_topic_LIST_companyfundamentals]
WHERE Section = '$section'

UNION

SELECT DISTINCT Employee_Number, Employee_Name, Section
FROM [dbo].[tbl_topic_LIST_hashira]
WHERE Section = '$section'

UNION

SELECT DISTINCT Employee_Number, Employee_Name, Section
FROM [dbo].[tbl_topic_LIST_mgtgroupregulation]
WHERE Section = '$section'

UNION

SELECT DISTINCT Employee_Number, Employee_Name, Section
FROM [dbo].[tbl_topic_LIST_qualityanalysis]
WHERE Section = '$section'

UNION

SELECT DISTINCT Employee_Number, Employee_Name, Section
FROM [dbo].[tbl_topic_LIST_technicalskill]
WHERE Section = '$section'

UNION

SELECT DISTINCT Employee_Number, Employee_Name, Section
FROM [dbo].[tbl_topic_LIST_technicalstandard]
WHERE Section = '$section'

UNION

SELECT DISTINCT Employee_Number, Employee_Name, Section
FROM [dbo].[tbl_topic_LIST_workstandard]
WHERE Section = '$section';



               
               
               
               ";
               $stmt3 = sqlsrv_query($conn,$selectcommon);
                              while($row = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
                               
                                  $employeeno = $row['Employee_Number'];
                                  $fullname = $row['Employee_Name'];
                            
                             
                                
                              
                                  $section = $row['Section'];
                          
                                                                        

                                  echo

                                  '<tr>
                                    <td style="width: 5px;"> <input type="checkbox" name="selected[]" class="single-checkbox2" id="selected" value="'.$fullname.'"></td>
                                     
                                      <td style=" font-size: 12px;">'  . $row['Employee_Number'] .'</td>
                                      <td style=" font-size: 12px;">'  . $row['Employee_Name'] .'</td>
                                   
                                      <td style=" font-size: 12px;">'  . $row['Section'] .'</td>
                                  
                                   
                                  ';
                              

                              }

              
              ?>
        </tbody>
       
    </table>
<br>
    <div class="row">
              
              <div class="col-12" style="display:flex; justify-content:right; align-items:left; ">
            <button type="button"  class="button-cus3" role="button" style = "justify-content:left; margin-right:15px;" onclick="return confirm_remove()">Remove</button>
            <button type="button"  class="button-cus1" role="button" style = "justify-content:left;" onclick="return confirm_edit()">Edit</button>
              </div>

     </div>

   </form>




</div>
</div>




 

</section>

</main><!-- End #main -->

    

    



  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer" style="color:white;">
    <div class="copyright" style="color:white;">
      &copy; Copyright <strong><span>BPS</span></strong>. All Rights Reserved
    </div>
    <div class="credits" style="color:white;">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="" style="color:white;">JM MACARAIG</a>
    </div>
  </footer><!-- End Footer -->

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
        new DataTable('#example24', {
          pageLength: 100,
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




<script>
          function confirm_remove() {
  var inputElems = document.getElementsByTagName("input"),
      count = 0;

  for (var i = 0; i < inputElems.length; i++) {
    if (inputElems[i].type == "checkbox" && inputElems[i].checked == true) {
      count++;
    }
  }

  var checkboxes = document.getElementsByName('selected[]');
  var vals = [];

  for (var i = 0, n = checkboxes.length; i < n; i++) {
    if (checkboxes[i].checked) {
      vals.push(checkboxes[i].value); // Push the value into the array
    }
  }

  if (count <= 0) {
    Swal.fire({
      title: 'Kindly check desired Employee',
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
    Swal.fire({
      title: 'Are you sure you want to remove selected Employee?',
      text: 'Employee Name: ' + (vals.length > 0 ? vals.join(', ') : ''),
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, remove it!'
    }).then((result) => {
      if (result.isConfirmed) {
        //document.getElementById("myForm").submit();
        window.location.href = 'forms/sqlupdates.php?action=RemoveTrainingPIC&selectedItemId=' + vals.join(',');
      }
    });
  }
}
           
              
</script>


<script>
  function confirm_edit() {
    var checkboxes = document.getElementsByName('selected[]');
    var vals = [];

    for (var i = 0, n = checkboxes.length; i < n; i++) {
      if (checkboxes[i].checked) {
        vals.push(checkboxes[i].value);
      }
    }

    if (vals.length <= 0) {
      Swal.fire({
        title: 'Kindly check desired Employee to Edit',
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
    } else if (vals.length > 1) {
      Swal.fire({
        title: 'Select only one Employee',
        text: 'You have selected more than one employee!',
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
      Swal.fire({
        title: 'Are you sure you want to edit selected Employee?',
        text: 'Employee Name: ' + vals[0],
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, edit it!'
      }).then((result) => {
        if (result.isConfirmed) {
          fetchEmployeeDetails(vals[0]).then(employeeDetails => {
            Swal.fire({
              title: 'Edit Employee Details',
              html: `
        <div style="margin-bottom: 10px;">
            <label for="fullname" class="form-label" style="color: black; display: block; text-align:left; font-size:12px;">Employee Name</label>
            <input type="text" name="fullname" class="form-control" id="fullname" value="${employeeDetails.Employee_Name}" readonly>
        </div>
        <div style="margin-bottom: 10px;">
            <label for="empno" class="form-label" style="color: black; display: block; text-align:left; font-size:12px;">Employee Number</label>
            <input type="text" name="empno" class="form-control" id="empno" value="${employeeDetails.Employee_Number}" readonly>
        </div>
        <div style="margin-bottom: 10px;">
            <label for="section" class="form-label" style="color: black; display: block; text-align:left; font-size:12px;">Transfer to other Section</label>
            <select class="form-select" aria-label="Select section" id="section" name="section">
                <option value="TN" ${employeeDetails.Section === 'TN' ? 'selected' : ''}>TN</option>
                <option value="PE" ${employeeDetails.Section === 'PE' ? 'selected' : ''}>PE</option>
                <option value="TC" ${employeeDetails.Section === 'TC' ? 'selected' : ''}>TC</option>
                <option value="PR2" ${employeeDetails.Section === 'PR2' ? 'selected' : ''}>PR2</option>
                <option value="PR1" ${employeeDetails.Section === 'PR1' ? 'selected' : ''}>PR1</option>
                <option value="PT" ${employeeDetails.Section === 'PT' ? 'selected' : ''}>PT</option>
                <option value="IH" ${employeeDetails.Section === 'IH' ? 'selected' : ''}>IH</option>
                <option value="BPS" ${employeeDetails.Section === 'BPS' ? 'selected' : ''}>BPS</option>
                <option value="PCBA" ${employeeDetails.Section === 'PCBA' ? 'selected' : ''}>PCBA</option>
            </select>
        </div>
    `,
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Save',
              preConfirm: () => {
                const Full_Name = Swal.getPopup().querySelector('#fullname').value;
          
                const Empno = Swal.getPopup().querySelector('#empno').value;
                const Section = Swal.getPopup().querySelector('#section').value;
                if (!Full_Name || !Empno ||!Section)  {
                  Swal.showValidationMessage(`Please enter all details`);
                }
                return { Full_Name: Full_Name,  Empno : Empno, Section : Section };
              }
            }).then((result) => {
              if (result.isConfirmed) {
                const { Full_Name, Empno, Section } = result.value;
                window.location.href = `forms/sqlupdates.php?action=EditTrainingPIC&selectedItemId=${vals[0]}&fullname=${encodeURIComponent(Full_Name)}&Empno=${encodeURIComponent(Empno)}&section=${encodeURIComponent(Section)}`;
              }
            });
          });
        }
      });
    }
  }

  function fetchEmployeeDetails(selectedId) {
    return new Promise((resolve, reject) => {
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "fetch_sectionemployee_details.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          try {
            var response = JSON.parse(xhr.responseText);
            resolve(response);
          } catch (e) {
            reject(e);
          }
        }
      };
      xhr.send("selectedItemId=" + selectedId);
    });
  }
</script>



</body>

</html>