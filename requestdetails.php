<!DOCTYPE html>
<html lang="en">

<?php

session_start();


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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>



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
.button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #04AA6D;
}

.button1:hover {
  background-color: #04AA6D;
  color: white;
}

.button2 {
  background-color: white; 
  color: black; 
  border: 2px solid #f44336;
}

.button2:hover {
  background-color: #f44336;
  color: white;
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
        <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
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
        <a class="nav-link collapsed " href="index.php">
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
        <ul id="forms-nav" class="nav-content collapse  collapse show" data-bs-parent="#sidebar-nav">
          <li>
            <a href="trainingrequest.php" >
              <i class="bi bi-circle"></i><span>Training Request</span>
            </a>
          </li>
          <li>
            <a href="requestapproval.php"  class="active">
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
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="uploading.php">
              <i class="bi bi-circle"></i><span>Uploading</span>
            </a>
          </li>
          <li>
            <a href="exam.php">
              <i class="bi bi-circle"></i><span>Training Examination</span>
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



      <li class="nav-heading"></li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="skillmap.php">
          <i class="bi bi-person"></i>
          <span>Skill Map</span>
        </a>
      </li><!-- End Profile Page Nav -->


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
          <span>Logout</span>
        </a>
      </li><!-- End Login Page Nav -->

      

    
    </ul>

  </aside><!-- End Sidebar-->


<main id="main" class="main">

<div class="pagetitle">
  <!-- <h1>Common Training</h1> -->
 
</div><!-- End Page Title -->


<div class="card">



            <div class="card-body">
          
             <h5 class="card-title">Training Request Details</h5>

             <?php 
                     $reqID = $_GET['reqID'];
                    
                     
                     $sql =   "SELECT  * from tbl_trainingrequest WHERE [Transaction Number] = '$reqID'";
                                
                     $result = sqlsrv_query($conn, $sql);

                     while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                         $ID = $row['ID'];
                         $transno = $row['Transaction Number'];
                         $topic = $row['Topic'];
                         $typeoftraining = $row['Type of Training'];
                         $requestorname = $row['Requestor Name'];
                        $employeeno = $row['Employee Number'];
                         $fullname = $row['Employee Name'];
                        $section = $row['Section'];
                        $position = $row['Position'];
                        $datehired = $row['Date Hired'];
                         $urgent = $row['Urgent'];
                         $reason = $row['Reason of Urgency'];
                          $target = $row['Target'];
                                
                        
                     
                        }
                    
                ?>


             

             <div class="row">
                <div class="col-md-6"> 
                <div class="form-floating" >
                  </div>
                  <input type="text" class="form-control" id="floatingName" placeholder="Transaction Number: <?php echo $transno?>" disabled style="font-weight: bold; border-width:2px; border-style:solid; border-color:#9BD4E4; padding: 10px; background-color: #FFF7DA; ">
                </div>
                <div class="col-6" style="display:flex; justify-content:right; align-items:left;">
                <input type="text" class="form-control" id="floatingName" placeholder="Status: For Approval" disabled style=" font-weight: bold; border-width:2px; border-style:solid; border-color:#9BD4E4; padding: 10px; background-color: #FFF7DA; ">
                </div>
               
              </div>
             
              <br>

              <!-- Floating Labels Form -->
              <form class="row g-3">
                <div class="col-md-6">
                <button type="button" class="button button1" onclick="clickApproved()" style="width: 250px;">APPROVED</button>

                <button type="button" class="button button2" onclick="clickDeclined()" style="width: 250px;">DECLINED</button>
                </div>

              
               
       
              </form><!-- End floating Labels Form -->

         
        <br>
   


              <table id="example24" class="display" style="width:100%">
        <thead>
            <tr>
                <th style=" width: 5px;">Select</th>
                <th style=" text-align: center;">Transaction Number</th>
                <th style=" text-align: center;" >Topic</th>
                <th style=" text-align: center;">Section</th>
                <th style=" text-align: center;">Requestor</th>
                <th style=" text-align: center;">Target Date</th>
             
            </tr>
            <tr>
            <th style=" width: 5px;">Select</th>
                <th style=" text-align: center;">Transaction Number</th>
                <th style=" text-align: center;" >Topic</th>
                <th style=" text-align: center;">Section</th>
                <th style=" text-align: center;">Requestor</th>
                <th style=" text-align: center;">Target Date</th>
            </tr>
        </thead>
        <tbody>

        <?php
               $trequest = "SELECT  * FROM [dbo].[tbl_trainingrequest]";
               $stmt3 = sqlsrv_query($conn,$trequest);
                              while($row = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
                                  $id = $row['ID'];
                                  $transno = $row['Transaction Number'];
                                  $topic= $row['Topic'];
                                  $typeoftraining = $row['Type of Training'];
                                  $requestorname = $row['Requestor Name'];
                                  $employeeno = $row['Employee Number'];
                                  $fullname = $row['Employee Name'];
                                  $section = $row['Section'];
                                  $position = $row['Position'];
                        
                                  $datehired = $row['Date Hired'];
                                  $urgent = $row['Urgent'];
                                  $reason = $row['Reason of Urgency'];
                                  $target = $row['Target'];
                                
                                
                                  

                                  echo

                                  '<tr>
                                      <td style="width: 5px; text-align: center;"> <input type="checkbox" name="selected[]" class="single-checkbox" id="selected" value="'.$employeeno.'"></td>
                                      <td style=" text-align: center;">'  . $row['Transaction Number'] .'</td>
                                      <td style=" text-align: center;">'  . $row['Topic'] .'</td>
                                      <td style=" text-align: center;">'  . $row['Section'] .'</td>
                                      <td style=" text-align: center;">'  . $row['Requestor Name'] .'</td>
                                      <td style=" text-align: center;">'  . $row['Target'] .'</td>
                                     
                                  ';
                            
                              }

              
              ?>

            
        </tbody>
       
    </table>

<br>
             

<div class="row">
              
              <div class="col-12" style="display:flex; justify-content:right; align-items:left;">
            <button type="submit" class="btn btn-primary" style = "justify-content:left; color:black; font-weight: bold;justify-content:left;  margin-left: 20px; background-color: #F3EA9C; border-color:#FF0000;" id="edit">Edit</button>
            <button type="submit" class="btn btn-primary" style = "justify-content:left; margin-left: 5px; color:black; font-weight: bold;justify-content:left;  margin-left: 20px; background-color: #F3EA9C; border-color:#FF0000;" id="add">Add</button>
            <button type="submit" class="btn btn-primary" style = "justify-content:left;  margin-left: 5px; color:black; font-weight: bold;justify-content:left;  margin-left: 20px; background-color: #F3EA9C; border-color:#FF0000;" id="submit">Save</button>

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




<script>
                    function clickApproved()
                    {
                 Swal.fire({
                    title: "Are you sure you want to Approved?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    denyButtonText: `No`
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        Swal.fire("Successfully Approved!", "", "success");
                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                    });
                }

</script>

<script>
                    function clickDeclined()
                    {
                 Swal.fire({
                    title: "Are you sure you want to declined?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    denyButtonText: `No`
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        Swal.fire("Successfully Declined!", "", "success");
                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                    });
                }

</script>
</body>

</html>