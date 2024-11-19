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
          
             <h5 class="card-title">Training Request Status</h5>


             

             <div class="row">
              
                <div class="col-6" style="display:flex; justify-content:right; align-items:left;">
               
              
              <button type="button" id="go"class="btn btn-primary" style = "color:black; font-weight: bold;justify-content:left;  background-color: #F3EA9C; border-color:#FF0000;" hidden>GENERATE</button>
              <button type="button" id="generate" name= "generate"class="btn btn-primary" style = "color:black; font-weight: bold;justify-content:left;  margin-left: 20px; background-color: #F3EA9C; border-color:#FF0000; visibility: hidden;"  >Generate</button>
                </div>
              </div>
              <br>

              <!-- Floating Labels Form -->
              <form class="row g-3">
                <!-- <div class="col-md-6">
                <button type="button" class="button button1" onclick="clickApproved()" style="width: 250px;">APPROVED</button>

                <button type="button" class="button button2" onclick="clickDeclined()" style="width: 250px;">DECLINED</button>
                </div> -->

              
               
       
              </form><!-- End floating Labels Form -->

         
        <br>
   


              <table id="example24" class="display" style="width:100%; overflow-x: auto;  white-space: nowrap;   display: block;">
        <thead>
            <tr>
                <th style=" width: 5px;">Select</th>
                <th style=" text-align: center;">Transaction Number</th>
                <th style=" text-align: center;" >Topic</th>
                <th style=" text-align: center;">Section</th>
                <th style=" text-align: center;">Requestor Name</th>
                <th style=" text-align: center;">Request Status</th>
                <th style=" text-align: center;">Section SPV Approver</th>
                <th style=" text-align: center;">Section MGR Approver</th>
                <th style=" text-align: center;">PE Training PIC Approver</th>
                <th style=" text-align: center;">PE SPV Approver</th>
                <th style=" text-align: center;">PE MGR Approver</th>
                <th style=" text-align: center;">Request Date</th>
                <th style=" text-align: center;">Target Date</th>
                <th style=" text-align: center;">View</th>
            </tr>
           
        </thead>
        <tbody>
      <?php
        
        $trequest = "WITH CTE AS (
          SELECT *,
                ROW_NUMBER() OVER (PARTITION BY RequestNumber ORDER BY (SELECT NULL)) AS RowNum
          FROM [dbo].[tbl_trainingrequest] WHERE Section = '$section'
        )
        SELECT *
        FROM CTE
        WHERE RowNum = 1";
        
               $stmt3 = sqlsrv_query($conn,$trequest);
                              while($row = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
                                  $id = $row['ID'];
                                  $transno = $row['RequestNumber'];
                                  $topic= $row['Topic'];
                                  $typeoftraining = $row['Type of Training'];
                                  $requestorname = $row['Requestor Name'];
                                  $employeeno = $row['Employee Number'];
                                  $fullname = $row['Employee Name'];
                                  $section = $row['Section'];
                                  $requeststatus = $row['StatusRequestNumber'];
                                  $position = $row['Position'];
                                  $datehired = $row['Date Hired'];
                                  $urgent = $row['Urgent'];
                                  $reason = $row['Reason of Urgency'];
                                  $target = $row['Target'];
                                  $firstApprover = $row['Section SPV Approver'];
                                  $secondApprover = $row['Section MGR Approver'];
                                  $thirdApprover = $row['PE Training PIC Approver'];
                                  $fourthApprover = $row['PE SPV Approver'];
                                  $fifth = $row['PE MGR Approver'];
                                  $requestdate=  $row['Request Date'];
                                
                                
                                  

                                  echo

                                  '<tr>
                                      <td style="width: 5px; text-align: center;"> <input type="checkbox" name="selected[]" class="single-checkbox" id="selected" value="'.$employeeno.'"></td>
                                      <td style=" text-align: center;">'  . $row['RequestNumber'] .'</td>
                                      <td style=" text-align: center;">'  . $row['Topic'] .'</td>
                                      <td style=" text-align: center;">'  . $row['Section'] .'</td>
                                      <td style=" text-align: center;">'  . $row['Requestor Name'] .'</td>
                                      <td style=" text-align: center;">'  . $row['StatusRequestNumber'] .'</td>
                                      <td style=" text-align: center;">'  . $row['Section SPV Approver'] .'</td>
                                      <td style=" text-align: center;">'  . $row['Section MGR Approver'] .'</td>
                                      <td style=" text-align: center;">'  . $row['PE Training PIC Approver'] .'</td>
                                      <td style=" text-align: center;">'  . $row['PE SPV Approver'] .'</td>
                                      <td style=" text-align: center;">'  . $row['PE MGR Approver'] .'</td>
                                      <td style=" text-align: center;">'  . $row['Request Date'] .'</td>
                                      <td style=" text-align: center;">'  . $row['Target'] .'</td>
                                        <td style=" text-align: center;">'; ?><button  type="button" class="openModalBtn" style="border:none;  background-color: transparent;" id="openModalBtn" data-id="<?php echo $transno?>"> <img src="assets/img/find.png" style ="width:35px; height:35px; border:none;" title="View Checking History"> </button>  <div id="myModal" class="modal fade"></div><?php '</td>
                                      
                                  
                                  ';
                             
                              }


          ?>
        </tbody>
       
    </table>


    <script>
$(document).ready(function(){
    // Button click event handler for all buttons with class openModalBtn
    $('table tbody').on('click', '.openModalBtn', function() {
   
        // Get the ID from the button's data attribute
        var id = $(this).data("id");
        // AJAX request to load modal content with ID parameter
        $.ajax({
            url: "requestlogs.php?id=" + id, // PHP file that generates modal content with ID parameter
            success: function(response){
                // Display modal with loaded content
                $("#myModal").html(response);
                $("#myModal").modal('show'); // Show Bootstrap modal
            }
        });
    });
});
</script>




   


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
  function selectRequestDate()
  {
      var selectedTopic = document.getElementById('selectRequestDate').value;
      if (selectedTopic == 'OCTOBER 2023') {

        
        
      }
      else if (selectedTopic  == 'NOVEMBER 2023') {
       
      }
      else{
       
        
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