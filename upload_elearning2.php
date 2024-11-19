

<!DOCTYPE html>
<html lang="en">

<?php

session_start();


include 'Connection/connection.php';
include 'forms/overall.php';

//require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;


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
            <a href="uploading.php"  >
              <i class="bi bi-circle"></i><span>Uploading</span>
            </a>
          </li>
          <li>
            <a href="exam.php">
              <i class="bi bi-circle"></i><span>Training Examination</span>
            </a>
          </li>
          <li>
            <a href="upload_elearning2.php" class="active">
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
          
             <h5 class="card-title">Upload Elearning</h5>

             <?php

// Include the PhpSpreadsheet library


// Function to parse Excel file and extract questions, choices, and correct answers
function parseExcel($file)
{
    // Load the Excel file
    $spreadsheet = IOFactory::load($file);

    // Get the first and second sheets
    $questionsSheet = $spreadsheet->getSheet(0);
    $answersSheet = $spreadsheet->getSheet(1);

    $questions = [];
    $choices = [];
    $correctAnswers = [];

    // Iterate over rows to extract questions, choices, and correct answers
    foreach ($questionsSheet->getRowIterator() as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);

        $rowData = [];
        foreach ($cellIterator as $cell) {
            $rowData[] = $cell->getValue();
        }

        // Assuming the first column contains questions, second to fifth contain choices, and sixth column contains correct answers
        $questions[] = $rowData[0];
        $choices[] = array_slice($rowData, 1, 4);
    }

    foreach ($answersSheet->getRowIterator() as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);

        $rowData = [];
        foreach ($cellIterator as $cell) {
            $rowData[] = $cell->getValue();
        }

        // Assuming the first column contains questions and the second column contains correct answers
        $correctAnswers[] = $rowData[0];
    }

    return ['questions' => $questions, 'choices' => $choices, 'correctAnswers' => $correctAnswers];
}

// Sample usage
if (isset($_FILES['excel_file'])) {
    $excelData = parseExcel($_FILES['excel_file']['tmp_name']);

    // Use $excelData['questions'], $excelData['choices'], and $excelData['correctAnswers'] to generate quiz
}

?>

<!-- HTML form for uploading Excel file -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Excel File</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="excel_file" accept=".xlsx, .xls">
        <button type="submit">Upload</button>
    </form>
</body>
</html>

           

            </div>
 </div>


<br>
  


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

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<link rel="stylesheet" type="text/css" href="/jquery.datetimepicker.css">
<script src="/jquery.js"></script>
<script src="/build/jquery.datetimepicker.full.min.js"></script>



                <script>
                $(document).ready(function() {
                $('#uploadForm').submit(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                    url: 'generate_quizzes.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#quizContainer').html(response);
                    }
                    });
                });
                });
                </script>




  <script>
        new DataTable('#example24', {
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
</body>

</html>