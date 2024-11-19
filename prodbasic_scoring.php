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




  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
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

table th {
  background-color: #FFCCCC;
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
    background-color: #95B3D7;
}

td:nth-child(6) {
  background-color: #8DB4E2; /* Change this to your desired background color */
}

td:nth-child(8) {
  background-color: #C4D79B; /* Change this to your desired background color */
}
td:nth-child(9) {
  background-color: #C4D79B; /* Change this to your desired background color */
}
td:nth-child(10) {
  background-color: #FABF8F; /* Change this to your desired background color */
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
              <h5 class="card-title"></h5>

           

              <?php

                    
             $PBS_id = $_GET['PBSID'];
           

                echo $PBS_id;

                

            ?>

            <select id="columnDropdown">
              <option value="-">-</option>
              <option value="screwing">Screwing</option>
              <option value="harnessing">Harnessing</option>
              <option value="labelling">Labelling</option>
              <option value="ffc">FFC Harnessing</option>
              <option value="greasing">Greasing</option>
              <option value="tube">Tube Insertion</option>
            </select>
             
             <table id="example23" class="display" style="width:100%; overflow-x: auto;  white-space: nowrap;   display: block;">
                
                    <thead>
                    

                    <tr>
                           
                           <th style="text-align: center; background-color: #FFFFFF;" colspan="2"></th>
                           <th style="text-align: center; background-color: #CCFFCC;" colspan="8" id="greasingHeader">Greasing</th>
                           <th style="text-align: center; background-color: #FF9999;" colspan="8" id="screwingHeader">Screwing</th>
                           <th style="text-align: center; background-color: #B7DEE8;" colspan="8"  id="harnessingHeader">Harnessing</th>
                           <th style="text-align: center; background-color: #CCFFCC;" colspan="8" id="labellingHeader">Labelling</th>
                           <th style="text-align: center; background-color: #FF9999;" colspan="8"  id="ffcHeader">FFC Harnessing</th>
                           <th style="text-align: center; background-color: #B7DEE8;" colspan="8" id="tubeHeader">Tube Insertion</th>

                           

                       </tr>
                      

                        <tr>
                         
                           
                            <th style="text-align: center;">Employee Number</th>
                            <th style="text-align: center;">Employee Name</th>
                
                            <th style="text-align: center;">Greasing_Trial_1</th>
                            <th style="text-align: center;">Greasing_Trial_2</th>
                            <th style="text-align: center;">Greasing_Trial_3</th>
                            <th style="text-align: center;">Greasing_Average</th>
                           
                            <th style="text-align: center;">Greasing_Retake</th>
                            <th style="text-align: center;">Greasing_Average_retake</th>
                            <th style="text-align: center;">Greasing_Remarks</th>
                            <th style="text-align: center;">Greasing_Rank</th>
                     


                            <th style="text-align: center;">Screwing_Trial_1</th>
                            <th style="text-align: center;">Screwing_Trial_2</th>
                            <th style="text-align: center;">Screwing_Trial_3</th>
                            <th style="text-align: center;">Screwing_Average</th>
                            <th style="text-align: center;">Screwing_Retake</th>
                            <th style="text-align: center;">Screwing_Average_retake</th>
                            <th style="text-align: center;">Screwing_Remarks</th>
                            <th style="text-align: center;">Screwing_Rank</th>

                            <th style="text-align: center;">Harnessing_Trial_1</th>
                            <th style="text-align: center;">Harnessing_Trial_2</th>
                            <th style="text-align: center;">Harnessing_Trial_3</th>
                            <th style="text-align: center;">Harnessing_Average</th>
                            <th style="text-align: center;">Harnessing_Retake</th>
                            <th style="text-align: center;">Harnessing_Average_retake</th>
                            <th style="text-align: center;">Harnessing_Remarks</th>
                            <th style="text-align: center;">Harnessing_Rank</th>

                            <th style="text-align: center;">Labelling_Trial_1</th>
                            <th style="text-align: center;">Labelling_Trial_2</th>
                            <th style="text-align: center;">Labelling_Trial_3</th>
                            <th style="text-align: center;">Labelling_Average</th>
                            <th style="text-align: center;">Labelling_Retake</th>
                            <th style="text-align: center;">Labelling_Average_retake</th>
                            <th style="text-align: center;">Labelling_Remarks</th>
                            <th style="text-align: center;">Labelling_Rank</th>

                            <th style="text-align: center;">FFC_Trial_1</th>
                            <th style="text-align: center;">FFC_Trial_2</th>
                            <th style="text-align: center;">FFC_Trial_3</th>
                            <th style="text-align: center;">FFC_Average</th>
                            <th style="text-align: center;">FFC_Retake</th>
                            <th style="text-align: center;">FFC_Average_retake</th>
                            <th style="text-align: center;">FFC_Remarks</th>
                            <th style="text-align: center;">FFC_Rank</th>

                            <th style="text-align: center;">TubeInsertion_Trial_1</th>
                            <th style="text-align: center;">TubeInsertion_Trial_2</th>
                            <th style="text-align: center;">TubeInsertion_Trial_3</th>
                            <th style="text-align: center;">TubeInsertion_Average</th>
                            <th style="text-align: center;">TubeInsertion_Retake</th>
                            <th style="text-align: center;">TubeInsertion_Average_retake</th>
                            <th style="text-align: center;">TubeInsertion_Remarks</th>
                            <th style="text-align: center;">TubeInsertion_Rank</th>
                            
                            
                            

                            

                          
               
                        </tr>
                    
                    </thead>
                   

                    <tbody>


                    <?php
                        $gettrainings = "SELECT * FROM [dbo].[tbl_prodbasic_alllist] WHERE PBS_Number = '$PBS_id'";
                        $stmt2 = sqlsrv_query($conn, $gettrainings);

                        while ($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
                            echo '<tr>';

                            // Loop through each column in the row
                            foreach ($row as $columnName => $value) {
                                // Skip PBS_Number, ID, Requestor_Name, Start_Date, End_Date columns
                                if ($columnName === 'PBS_Number' || $columnName === 'ID' || $columnName === 'Requestor_Name' || $columnName === 'Start_Date'|| $columnName === 'End_Date') {
                                    continue;
                                }

                                // Check if the column is Employee_Number or Employee_Name
                                if ($columnName === 'Employee_Number' || $columnName === 'Employee_Name') {
                                    // Output a read-only input field for Employee_Number and Employee_Name
                                    echo '<td><input type="text" name="' . $columnName . '" value="' . $value . '" readonly></td>';
                                } else {
                                    // Output an editable input field for other columns
                                    echo '<td><input type="text" name="' . $columnName . '" value="' . $value . '"></td>';
                                }
                            }

                            echo '</tr>';
                        }
                    ?>
                        </tbody>
                        </table>
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
$(document).ready(function(){
    var dataTable = $('#example23').DataTable({
        initComplete: function () {
            this.api();
        }
    });

    $("#columnDropdown").change(function(){
        var selectedColumn = $(this).val();
        if(selectedColumn === 'greasing') {
            // Hide all table headers initially
            // $("#example23 th").hide();
            
            // Show only the relevant Greasing headers and columns
            $("#greasingHeader, #example23 th:nth-child(n+1):nth-child(-n+2), #example23 th:nth-child(n+3):nth-child(-n+10)").show();

            // Hide other columns
            dataTable.columns().visible(false);
            dataTable.columns([0, 1, 2, 3, 4, 5, 6, 7, 8, 9]).visible(true); // Show Employee Number, Employee Name, and Greasing columns

        } else if(selectedColumn === 'screwing'){
        
        //  // Hide all table headers initially
        //     $("#example23 th").hide();
            
            // Show only the relevant Greasing headers and columns
            $("#screwingHeader, #example23 th:nth-child(n+1):nth-child(-n+2), #example23 th:nth-child(n+11):nth-child(-n+18)").show();

            // Hide other columns
            dataTable.columns().visible(false);
            dataTable.columns([0, 1, 10,11,12,13,14,15,16,17]).visible(true); // Show Employee Number, Employee Name, and Greasing columns
        
        } else if(selectedColumn === 'harnessing'){
        
        //  // Hide all table headers initially
        //     $("#example23 th").hide();
            
            // Show only the relevant Greasing headers and columns **
            $("#harnessingHeader, #example23 th:nth-child(n+1):nth-child(-n+2), #example23 th:nth-child(n+19):nth-child(-n+26)").show();

            // Hide other columns
            dataTable.columns().visible(false);
            dataTable.columns([0, 1, 18,19,20,21,22,23,24,25]).visible(true); // Show Employee Number, Employee Name, and Greasing columns
        
        
        } else if(selectedColumn === 'labelling'){

             
            // Show only the relevant Greasing headers and columns **
            $("#labellingHeader, #example23 th:nth-child(n+1):nth-child(-n+2), #example23 th:nth-child(n+26):nth-child(-n+33)").show();

            // Hide other columns
            dataTable.columns().visible(false);
            dataTable.columns([0, 1, 26,27,28,29,30,31,32,33]).visible(true); // Show Employee Number, Employee Name, and Greasing columns
          
        } else if(selectedColumn === 'ffc'){

            
            // Show only the relevant Greasing headers and columns **
            $("#ffcHeader, #example23 th:nth-child(n+1):nth-child(-n+2), #example23 th:nth-child(n+33):nth-child(-n+40)").show();

            // Hide other columns
            dataTable.columns().visible(false);
            dataTable.columns([0, 1,34,35,36,37,38,39,40,41]).visible(true); // Show Employee Number, Employee Name, and Greasing columns

        } else if(selectedColumn === 'tube'){

             // Show only the relevant Greasing headers and columns **
             $("#tubeHeader, #example23 th:nth-child(n+1):nth-child(-n+2), #example23 th:nth-child(n+40):nth-child(-n+47)").show();

// Hide other columns
            dataTable.columns().visible(false);
            dataTable.columns([0, 1, 42,43,44,45,46,47,48,49]).visible(true); // Show Employee Number, Employee Name, and Greasing columns

        } else {
            // Show all headers
            $("#example23 th").show();
            
            // Show all columns
            dataTable.columns().visible(true);
        }
    });
});
</script>

</body>

</html>