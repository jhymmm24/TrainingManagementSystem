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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
table tr:hover td {
  background-color: #C6F1F8;
}

#prc th{
    background-color: #F1C3DA;
}

iframe{
                display: block;       /* iframes are inline by default */
                background: #000;
                border: none;         /* Reset default border */
                height: 50vh;        /* Viewport-relative units */
                width: 78vw;
                        
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


<section>
<div class="pagetitle">

 
</div><!-- End Page Title -->


<div class="card">



            <div class="card-body">
          
             <h5 class="card-title"><?php echo $section;?> Skill Map Summary</h5>

             <div class ="row">


       <?php
       //select coloumn as th


 
    
       ?>
       <table id="example23" class="display" style="width:100%; overflow-x: auto; white-space: nowrap; display: block;">
           <thead>
               <th colspan="1" style="text-align: center;"></th>
               <th colspan="4" style="text-align: center;">Production Skills</th>
               <tr>
                   <th style="text-align: center;">Employee Name</th>
                   <th style="text-align: center;">Assembly Hashira</th>
                   <th style="text-align: center;">Technical Standards</th>
                   <th style="text-align: center;">Work Standards</th>
                   <th style="text-align: center;">Work Mgt. Group Regulations</th>
                   <th style="text-align: center;">Common Business Skills</th>
                   <th style="text-align: center;">Common Training</th>
                   <th style="text-align: center;">Company Fundamentals</th>
                   <th style="text-align: center;">Quality Analysis</th>
                   <th style="text-align: center;">Technical Skills</th>

               </tr>
           </thead>
           <tbody>
               <?php
               // Get distinct employees from all relevant tables where Section matches
               $get_masterlist = "SELECT DISTINCT Employee_Name 
                                  FROM [dbo].[tbl_topic_LIST_workstandard] 
                                  WHERE Section = ?
                                  UNION
                                  SELECT DISTINCT Employee_Name 
                                  FROM [dbo].[tbl_topic_LIST_technicalstandard]
                                  WHERE Section = ?
                                  UNION
                                  SELECT DISTINCT Employee_Name 
                                  FROM [dbo].[tbl_topic_LIST_hashira]
                                  WHERE Section = ?
                                  UNION
                                  SELECT DISTINCT Employee_Name 
                                  FROM [dbo].[tbl_topic_LIST_mgtgroupregulation]
                                  WHERE Section = ?

                                  UNION
                                  SELECT DISTINCT Employee_Name 
                                  FROM [dbo].[tbl_topic_LIST_commonbusinesskill]
                                  WHERE Section = ?

                                  UNION
                                  SELECT DISTINCT Employee_Name 
                                  FROM [dbo].[tbl_topic_LIST_commontraining]
                                  WHERE Section = ?


                                    UNION
                                  SELECT DISTINCT Employee_Name 
                                  FROM [dbo].[tbl_topic_LIST_companyfundamentals]
                                  WHERE Section = ?


                                       UNION
                                  SELECT DISTINCT Employee_Name 
                                  FROM [dbo].[tbl_topic_LIST_qualityanalysis]
                                  WHERE Section = ?
                                  

                                  
                                       UNION
                                  SELECT DISTINCT Employee_Name 
                                  FROM [dbo].[tbl_topic_LIST_technicalskill]
                                  WHERE Section = ?
                                  
                                  
                                  
                                  
                                  
                                  
                                  ";
               $params_master = array($section, $section, $section, $section,$section, $section, $section, $section, $section);
               $stmt_master = sqlsrv_query($conn, $get_masterlist, $params_master);
       
               while ($master_row = sqlsrv_fetch_array($stmt_master, SQLSRV_FETCH_ASSOC)) {
                   $employee_name = $master_row['Employee_Name'];
       
                   // Fetch Work Standards average for the same section
                   $get_workstandard = "SELECT Average FROM [dbo].[tbl_topic_LIST_workstandard] WHERE Employee_Name = ? AND Section = ?";
                   $params_workstandard = array($employee_name, $section);
                   $stmt_workstandard = sqlsrv_query($conn, $get_workstandard, $params_workstandard);
                   $row_workstandard = sqlsrv_fetch_array($stmt_workstandard, SQLSRV_FETCH_ASSOC);
                   $average_workstandard = $row_workstandard['Average'] ?? 'N/A';
       
                   // Fetch Technical Standards average for the same section
                   $get_technicalstandard = "SELECT Average FROM [dbo].[tbl_topic_LIST_technicalstandard] WHERE Employee_Name = ? AND Section = ?";
                   $params_technicalstandard = array($employee_name, $section);
                   $stmt_technicalstandard = sqlsrv_query($conn, $get_technicalstandard, $params_technicalstandard);
                   $row_technicalstandard = sqlsrv_fetch_array($stmt_technicalstandard, SQLSRV_FETCH_ASSOC);
                   $average_technicalstandard = $row_technicalstandard['Average'] ?? 'N/A';
       
                   // Fetch Assembly Hashira average for the same section
                   $get_hashira = "SELECT Average FROM [dbo].[tbl_topic_LIST_hashira] WHERE Employee_Name = ? AND Section = ?";
                   $params_hashira = array($employee_name, $section);
                   $stmt_hashira = sqlsrv_query($conn, $get_hashira, $params_hashira);
                   $row_hashira = sqlsrv_fetch_array($stmt_hashira, SQLSRV_FETCH_ASSOC);
                   $average_hashira = $row_hashira['Average'] ?? 'N/A';
       
                   // Fetch Mgt. Group Regulations average for the same section
                   $get_mgtgroupregulation = "SELECT Average FROM [dbo].[tbl_topic_LIST_mgtgroupregulation] WHERE Employee_Name = ? AND Section = ?";
                   $params_mgtgroupregulation = array($employee_name, $section);
                   $stmt_mgtgroupregulation = sqlsrv_query($conn, $get_mgtgroupregulation, $params_mgtgroupregulation);
                   $row_mgtgroupregulation = sqlsrv_fetch_array($stmt_mgtgroupregulation, SQLSRV_FETCH_ASSOC);
                   $average_mgtgroupregulation = $row_mgtgroupregulation['Average'] ?? 'N/A';


                                      // Fetch Mgt. Group Regulations average for the same section
                                      $get_commonbusinessskills = "SELECT Average FROM [dbo].[tbl_topic_LIST_commonbusinesskill] WHERE Employee_Name = ? AND Section = ?";
                                      $params_commonbusinessskills = array($employee_name, $section);
                                      $stmt_commonbusinessskills = sqlsrv_query($conn, $get_commonbusinessskills, $params_commonbusinessskills);
                                      $row_commonbusinessskills = sqlsrv_fetch_array($stmt_commonbusinessskills, SQLSRV_FETCH_ASSOC);
                                      $average_commonbusinesskill = $row_commonbusinessskills['Average'] ?? 'N/A';

                                                         // Fetch Mgt. Group Regulations average for the same section
                   $get_commontraining= "SELECT Average FROM [dbo].[tbl_topic_LIST_commontraining] WHERE Employee_Name = ? AND Section = ?";
                   $params_commontraining = array($employee_name, $section);
                   $stmt_commontraining = sqlsrv_query($conn, $get_commontraining, $params_commontraining);
                   $row_commontraining = sqlsrv_fetch_array($stmt_commontraining, SQLSRV_FETCH_ASSOC);
                   $average_commontraining = $row_commontraining['Average'] ?? 'N/A';


                                      // Fetch Mgt. Group Regulations average for the same section
                                      $get_companyfundamentals = "SELECT Average FROM [dbo].[tbl_topic_LIST_companyfundamentals] WHERE Employee_Name = ? AND Section = ?";
                                      $params_companyfundamentals = array($employee_name, $section);
                                      $stmt_companyfundamentals = sqlsrv_query($conn, $get_companyfundamentals, $params_companyfundamentals);
                                      $row_companyfundamentals = sqlsrv_fetch_array($stmt_companyfundamentals, SQLSRV_FETCH_ASSOC);
                                      $average_companyfundamentals = $row_companyfundamentals['Average'] ?? 'N/A';


                                                         // Fetch Mgt. Group Regulations average for the same section
                   $get_qualityanalysis = "SELECT Average FROM [dbo].[tbl_topic_LIST_qualityanalysis] WHERE Employee_Name = ? AND Section = ?";
                   $params_qualityanalysis = array($employee_name, $section);
                   $stmt_qualityanalysis = sqlsrv_query($conn, $get_qualityanalysis, $params_qualityanalysis);
                   $row_qualityanalysis = sqlsrv_fetch_array($stmt_qualityanalysis, SQLSRV_FETCH_ASSOC);
                   $average_qualityanalysis = $row_qualityanalysis['Average'] ?? 'N/A';


                                                                        // Fetch Mgt. Group Regulations average for the same section
                                                                        $get_technicalskill = "SELECT Average FROM [dbo].[tbl_topic_LIST_technicalskill] WHERE Employee_Name = ? AND Section = ?";
                                                                        $params_technicalskill = array($employee_name, $section);
                                                                        $stmt_technicalskill = sqlsrv_query($conn, $get_technicalskill, $params_technicalskill);
                                                                        $row_technicalskill = sqlsrv_fetch_array($stmt_technicalskill, SQLSRV_FETCH_ASSOC);
                                                                        $average_technicalskill = $row_technicalskill['Average'] ?? 'N/A';
       
                   echo '<tr>';
                   echo '<td>' . htmlspecialchars($employee_name) . '</td>';
                   echo '<td>' . htmlspecialchars($average_hashira) . '</td>';
                   echo '<td>' . htmlspecialchars($average_technicalstandard) . '</td>';
                   echo '<td>' . htmlspecialchars($average_workstandard) . '</td>';
                   echo '<td>' . htmlspecialchars($average_mgtgroupregulation) . '</td>';
                   echo '<td>' . htmlspecialchars($average_commonbusinesskill) . '</td>';
                   echo '<td>' . htmlspecialchars($average_commontraining) . '</td>';
                   echo '<td>' . htmlspecialchars($average_companyfundamentals) . '</td>';
                   echo '<td>' . htmlspecialchars($average_qualityanalysis) . '</td>';
                   echo '<td>' . htmlspecialchars($average_technicalskill) . '</td>';

                   echo '</tr>';
               }
               ?>
           </tbody>
       </table>
       

  




      </div>

</section>

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



<script>
       new DataTable('#example23', {
        pageLength: 100, // Show all rows (no pagination)
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

<script type="text/javascript">
  function toggle(source) {
    var checkboxes = document.querySelectorAll('input[class="single-checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
</script>
