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
        border-color: #5BB4DD;
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
th{
    background-color: rgb(255, 204, 204);
}

td:nth-child(7){
    background-color: rgb(141, 180, 226);

}
td:nth-child(9){
    background-color: rgb(196, 215, 155);

}
td:nth-child(10){
    background-color: rgb(250, 191, 143);

}
td:nth-child(14){
    background-color: rgb(141, 180, 226);

}
td:nth-child(16){
    background-color: rgb(196, 215, 155);

}
td:nth-child(17){
    background-color: rgb(191, 191, 191);

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
          
             <h5 class="card-title">PE Section Training - PROD. Basic Skill Training</h5>



              <!-- Floating Labels Form -->
              <form class="row ">
                <div class="col-md-6">
                  <div class="form-floating">
                  <label for="floatingSelect" style="background-color:F3EA9C; margin-top:-10px">Section :</label>

                <select class="form-select"  onchange="selectComboBox()" id="selectedCombo" aria-label="State" style="font-weight: bold; border-width:3px; border-style:solid; border-color:#FF0000; padding: 10px; background-color: #F3EA9C; padding-top:25px;">
                    <option selected>-</option>
                    <option value="1">Printer Mini</option>
                    <option value="2">PE</option>
                   
                    </select>
                </div>
                <br>
             
                </div>
               

                <div class="col md-6">
                  <div class="form-floating">
                  <button type="button" class="btn btn-primary" onclick="clickSend()" style="display:flex;  justify-content: right; align-items:right; font-weight: bold;  ">Generate</button>
                </div>
                <br>
             
            
                </div>
               
               

               
              
       
              </form><!-- End floating Labels Form -->

            </div>
          </div>


          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>


              <table id="example24" class="display" style="width:100%; overflow-x: auto;  white-space: nowrap;   display: block;">
        <thead>
            <tr>
                <th style=" width: 5px;">No</th>
                <th style=" text-align: center;">Name</th>
                <th style=" text-align: center;" >Setion</th>
                <th style=" text-align: center;" >Trial 1</th>
                <th style=" text-align: center;">Trial 2</th>
                <th style=" text-align: center;">Trial 3</th>
                <th style=" text-align: center; ">Ave</th>
                <th style=" text-align: center;">Retake</th>
                <th style=" text-align: center;">Ave after Retake</th>
                <th style=" text-align: center;">Rank</th>
                <th style=" text-align: center;" >Trial 1</th>
                <th style=" text-align: center;">Trial 2</th>
                <th style=" text-align: center;">Trial 3</th>
                <th style=" text-align: center;">Ave</th>
                <th style=" text-align: center;">Retake</th>
                <th style=" text-align: center;">Ave after Retake</th>
                <th style=" text-align: center;">Rank</th>
        
        
            </tr>
            <tr>
                <th style=" width: 5px;">No</th>
                <th style=" text-align: center;">Name</th>
                <th style=" text-align: center;" >Setion</th>
                <th style=" text-align: center;" >Trial 1</th>
                <th style=" text-align: center;">Trial 2</th>
                <th style=" text-align: center;">Trial 3</th>
                <th style=" text-align: center;">Ave</th>
                <th style=" text-align: center;">Retake</th>
                <th style=" text-align: center;">Ave after Retake</th>
                <th style=" text-align: center;">Rank</th>
                <th style=" text-align: center;" >Trial 1</th>
                <th style=" text-align: center;">Trial 2</th>
                <th style=" text-align: center;">Trial 3</th>
                <th style=" text-align: center;">Ave</th>
                <th style=" text-align: center;">Retake</th>
                <th style=" text-align: center;">Ave after Retake</th>
                <th style=" text-align: center;">Rank</th>
        
        
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="  text-align: center; width: 5px;"><input type="checkbox" name="checkbox_name" value="checkox_value"></td>
                <td style=" text-align: center;" >Palmas, John Llyod Maullon</td>
                <td style=" text-align: center;">Printer</td>
                <td style=" text-align: center;">30</td>
                <td style=" text-align: center;">32</td>
                <td style=" text-align: center;">42</td>
                <td style=" text-align: center;">34.67</td>
                <td style=" text-align: center;">-</td>
                <td style=" text-align: center;">-</td>
                <td style=" text-align: center;">9</td>
                <td style=" text-align: center;">8</td>
                <td style=" text-align: center;">6</td>
                <td style=" text-align: center;">8</td>
                <td style=" text-align: center;">7.33</td>
                <td style=" text-align: center;">6.00</td>
                <td style=" text-align: center;">7.33</td>
                <td style=" text-align: center;">-</td>
              
              
             
    
            </tr>

            <tr>
            <td style="  text-align: center; width: 5px;"><input type="checkbox" name="checkbox_name" value="checkox_value"></td>
                <td style=" text-align: center;" >Palmas, John Llyod Maullon</td>
                <td style=" text-align: center;">Printer</td>
                <td style=" text-align: center;">30</td>
                <td style=" text-align: center;">32</td>
                <td style=" text-align: center;">42</td>
                <td style=" text-align: center;">34.67</td>
                <td style=" text-align: center;">-</td>
                <td style=" text-align: center;">-</td>
                <td style=" text-align: center;">9</td>
                <td style=" text-align: center;">8</td>
                <td style=" text-align: center;">6</td>
                <td style=" text-align: center;">8</td>
                <td style=" text-align: center;">7.33</td>
                <td style=" text-align: center;">6.00</td>
                <td style=" text-align: center;">7.33</td>
                <td style=" text-align: center;">-</td>
              
            </tr>
            <tr>
            <td style="  text-align: center; width: 5px;"><input type="checkbox" name="checkbox_name" value="checkox_value"></td>
                <td style=" text-align: center;" >Palmas, John Llyod Maullon</td>
                <td style=" text-align: center;">Printer</td>
                <td style=" text-align: center;">30</td>
                <td style=" text-align: center;">32</td>
                <td style=" text-align: center;">42</td>
                <td style=" text-align: center;">34.67</td>
                <td style=" text-align: center;">-</td>
                <td style=" text-align: center;">-</td>
                <td style=" text-align: center;">9</td>
                <td style=" text-align: center;">8</td>
                <td style=" text-align: center;">6</td>
                <td style=" text-align: center;">8</td>
                <td style=" text-align: center;">7.33</td>
                <td style=" text-align: center;">6.00</td>
                <td style=" text-align: center;">7.33</td>
                <td style=" text-align: center;">-</td>
             
            </tr>
            <tr>
            <td style="  text-align: center; width: 5px;"><input type="checkbox" name="checkbox_name" value="checkox_value"></td>
                <td style=" text-align: center;" >Palmas, John Llyod Maullon</td>
                <td style=" text-align: center;">Printer</td>
                <td style=" text-align: center;">30</td>
                <td style=" text-align: center;">32</td>
                <td style=" text-align: center;">42</td>
                <td style=" text-align: center;">34.67</td>
                <td style=" text-align: center;">-</td>
                <td style=" text-align: center;">-</td>
                <td style=" text-align: center;">9</td>
                <td style=" text-align: center;">8</td>
                <td style=" text-align: center;">6</td>
                <td style=" text-align: center;">8</td>
                <td style=" text-align: center;">7.33</td>
                <td style=" text-align: center;">6.00</td>
                <td style=" text-align: center;">7.33</td>
                <td style=" text-align: center;">-</td>
              
            </tr>

            <tr>
            <td style="  text-align: center; width: 5px;"><input type="checkbox" name="checkbox_name" value="checkox_value"></td>
                <td style=" text-align: center;" >Palmas, John Llyod Maullon</td>
                <td style=" text-align: center;">Printer</td>
                <td style=" text-align: center;">30</td>
                <td style=" text-align: center;">32</td>
                <td style=" text-align: center;">42</td>
                <td style=" text-align: center;">34.67</td>
                <td style=" text-align: center;">-</td>
                <td style=" text-align: center;">-</td>
                <td style=" text-align: center;">9</td>
                <td style=" text-align: center;">8</td>
                <td style=" text-align: center;">6</td>
                <td style=" text-align: center;">8</td>
                <td style=" text-align: center;">7.33</td>
                <td style=" text-align: center;">6.00</td>
                <td style=" text-align: center;">7.33</td>
                <td style=" text-align: center;">-</td>
              
            </tr>

          
         
        </tbody>
       
    </table>
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
        new DataTable('#example24', {
            initComplete: function () {
                this.api()
                    .columns([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16])
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
        { orderable: false, targets: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16] }
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
                    function clickSend()
                    {
                 Swal.fire({
                    title: "Are you sure you want to Send?",
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
                    function clickExport()
                    {
                 Swal.fire({
                    title: "Are you sure you want to Export?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    denyButtonText: `No`
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        Swal.fire("Successfully Exported!", "", "success");
                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                    });
                }

</script>
</body>

</html>