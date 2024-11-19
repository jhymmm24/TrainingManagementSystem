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
          
             <h5 class="card-title">Production Basic Skill Enlistment</h5>


             
<div class="row">
    <br>

    <!-- Floating Labels Form -->
    <form action="upload_prodbasic.php" method="post" enctype="multipart/form-data">
        <div class="row">
       

            <div class="col-md-3">
                <div class="form-floating">
                    <label for="floatingPassword" style="margin-top:-10px;  font-size: 12px; color:#7F7F7F;">Start Date</label>
                    <input type="date" class="form-control" id="startdate" name="startdate" placeholder="Start Date">      
                </div>
                <br>
            </div>

            <div class="col-md-3">
                <div class="form-floating">
                    <label for="floatingPassword" style="margin-top:-10px;  font-size: 12px; color:#7F7F7F;">End Date</label>
                    <input type="date" class="form-control" id="enddate" name="enddate" placeholder="End Date">      
                </div>
                <br>
            </div>

         
                <div class="col-md-3">
                    <div class="form-floating">
                        <label for="floatingPassword" style="margin-top:-10px;  font-size: 12px; color:#7F7F7F;">Requestor Name:</label>
                 
                        

                      <input type="search" list="brow1" name="requestorname" class="form-control" id="requestorname" required>
                      <datalist id="brow1">
                      <?php
                              $sql2 = "SELECT Full_Name, ADID FROM tbl_accounts";
                              $stmt2 = sqlsrv_query($conn,$sql2);
                              while($row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
                                echo '<option value="'.$row2['Full_Name'].'">'.$row2['ADID'].'</option>';
                              }
                              ?>
                       </datalist>
                        


                    </div>


                    <br>
                </div>
          

           

            

            <div class="col-md-3">
                <div class="form-floating">
                    <input class="form-control" type="file" id="formFile2" name="file" accept=".xlsx, .xls" style="display: none;">
                    <button type="submit" class="button-89" name="submit1">Submit</button>
                </div>
            </div>
        </div>
        <!-- end class row -->
    </form>
    <!-- End floating Labels Form -->

    <script>
        $(function() {
            $("#datePicker").datepicker({
                dateFormat: "yy-mm-dd" // format the date as YYYY-MM-DD
            });
        });
    </script>
</div>
    
    
       
<form id="uploadForm" action="process_upload_prodbasic.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-3">
            <input class="form-control" type="file" id="formFile1" name="file" accept=".xlsx, .xls" required>
        </div>

        <div class="col-md-3" style="margin-left: -50px; margin-top: -8px;">
            <button type="button" class="btn" id="viewButton"style="background-color:transparent;border:none;height: 50px; width: 50px; ">
            <img src="assets/img/view.png" alt="View" style ="width:35px; height:35px; border:none;" title="View Excel File" ></button>
        </div>
    </div>
</form>
   <script>
   document.getElementById("viewButton").addEventListener("click", function() {
    var form = document.getElementById("uploadForm");
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", form.action, true);
    xhr.onload = function() {
        // Display the response in some container
        document.getElementById("tableContainer").innerHTML = xhr.responseText;

        // Initialize DataTables on the received table
        new DataTable('#example23', {
            initComplete: function () {
                // Your existing DataTables initialization code
            },
            columnDefs: [
                { orderable: false, targets: [0,1,2] }
            ]
        });
    };
    xhr.send(formData);
});
    </script>

    <!-- Container to display the table -->
    <div id="tableContainer"></div>



            
       
        



</div>
</div>



   
<div class="card">
            <div class="card-body">
              <h5 class="card-title"> Production Basic Skill Schedule</h5>


              <table id="example24" class="display" style="width:100%">
        <thead>
            <tr>
                <th style=" width: 5px;">Select</th>
                <th style=" text-align: center;">PBS Number</th>
                <th style=" text-align: center;" >Start_Date</th>
                <th style=" text-align: center;">End_Date</th>
       
                <th style=" text-align: center;">Status</th>
                <th style=" text-align: center;">Action</th>
               

            </tr>
            <tr>
            <th style=" width: 5px;">Select</th>
                <th style=" text-align: center;">PBS Number</th>
                <th style=" text-align: center;" >Start_Date</th>
                <th style=" text-align: center;">End_Date</th>
              
                <th style=" text-align: center;">Status</th>
                <th style=" text-align: center;"></th>
            </tr>
        </thead>
        <tbody>

        
    <?php
           $query_PBS = "           
                WITH CTE AS (
                  SELECT *,
                      ROW_NUMBER() OVER (PARTITION BY PBS_Number ORDER BY (SELECT NULL)) AS RowNum
                  FROM [dbo].[tbl_prodbasic_list]

                )
                SELECT *
                FROM CTE
                WHERE RowNum = 1";
           $stmt_PBS = sqlsrv_query($conn,$query_PBS);
                          while($row = sqlsrv_fetch_array($stmt_PBS, SQLSRV_FETCH_ASSOC)) {
                              $id = $row['ID'];
                              $pbsno = $row['PBS_Number'];
                              $employeenumber =  $row['Employee_Number'];
                              $employeename =  $row['Employee_Name'];
                              $status = $row['Status'];
                              $requestorname = $row['Requestor_Name'];
           

                               // Add a class to highlight row green if status is "PASSED"
                               $rowClass = ($status === 'DONE') ? 'passed-row' : '';
                            
                            
                              

                              echo

                              '<tr class="' . $rowClass . '">
                                  <td style="width: 5px; text-align: center;"> <input type="checkbox" name="selected[]" class="single-checkbox" id="selected" value="'.$id.'"></td>
                                  <td style=" text-align: center;">'  . $row['PBS_Number'] .'</td>
                                  <td style=" text-align: center;">'  . $row['Start_Date'] .'</td>
                                  <td style=" text-align: center;">'  . $row['End_Date'] .'</td>
                                  <td style=" text-align: center;">'  . $row['Status'] .'</td>
                               
                               
                                  
                                  
                                
                                 
                              
                              ';
                              ?>
                              
                              <td>
                              <div style="display: inline-block;">
                              <?php
                              
                       
                         
                              if ($requestorname === $fullname) {
                                  if ($status !== 'DONE') {
                                      echo '<a href="prodbasic_scoring.php?PBSID='.$pbsno.'"  class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                              <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Click to fill-up scores">
                                          </a>';
                                  } else {
                                      echo '<button onclick="alert(\'You have already passed the exam.\')" class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                              <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Already filled-out scores">
                                          </button>';
                                  }
                              } else {
                                  echo '<a href="#" onclick="alert(\'You have no permission to fill-out scores.\')" class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                          <img src="assets/img/quizbw.png" style="width: 35px; height: 35px; border: none;" title="No Permission to fill-up scores">
                                      </a>';
                              }
                              ?>
                          </div>
                      
                          <!-- Additional button -->
                          <div style="display: inline-block;">
                          <a href="soldering_scoring_view.php?TransactionNumber=<?php echo $pbsno; ?>" class="btn btn-info" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                <img src="assets/img/pdf.png" style="width: 35px; height: 35px; border: none;" title="View">
                            </a>
                          </div>

                          
                             
                              
                              </td>

                              
                                

                   
                          
                          <!-- Modal container -->
                          <div id="myModal" class="modal fade"></div>

                      <?php
                         
                          }
                          
                        
          
          ?>
         
           
           
          
         
        </tbody>
       
    </table>






  

  

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
              
              function confirm_approve() {
            
            
                var inputElems = document.getElementsByTagName("input"),
                    count = 0;
            
                    for (var i=0; i<inputElems.length; i++) {       
                       if (inputElems[i].type == "checkbox" && inputElems[i].checked == true){
                           count++;
                       }
            
                    }
                    
            
                var checkboxes = document.getElementsByName('selected[]');
                var vals = "";
                for (var i=0, n=checkboxes.length;i<n;i++) 
                {
                  if (checkboxes[i].checked) 
                  {
                    vals += ", "+checkboxes[i].value;
                  }
                }
                    
                    if(count <=0){
            
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
            
                                                                                                        
                                                                                                    }
                                                                                                    })
                     
                    }
                    else{
            
                      Swal.fire({
                                                                                                    title: 'Are you sure you want to target?',
                                                                                            
                                                                                                   text:'Employee Number:'+vals+'',
                                                                                                  
                                                                                                    icon: 'warning',
                                                                                                    showCancelButton: true,
                                                                                                    confirmButtonColor: '#3085d6',
                                                                                                    cancelButtonColor: '#d33',
                                                                                                    confirmButtonText: 'Yes, submit it!'
                                                                                                    }).then((result) => {
                                                                                                    if (result.isConfirmed) {
            
                                                                                                      document.getElementById("myFormTarget").submit();
            
                                                                                                       
                                                                                                    }
                                                                                                    })
                     
                    
                }
                    
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
    // Function to mirror file input from form 1 to form 2
    function mirrorFile() {
        var fileInput1 = document.getElementById('formFile1');
        var fileInput2 = document.getElementById('formFile2');

        // Check if a file has been selected in form 1
        if (fileInput1.files.length > 0) {
            // Clone the selected file from form 1 to form 2
            fileInput2.files = fileInput1.files;
        }
    }

    // Trigger the mirroring function when a file is selected in form 1
    document.getElementById('formFile1').addEventListener('change', mirrorFile);
</script>



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
        { orderable: false, targets: [0,1,2] }
        ]
        });



  </script>

</body>

</html>


