

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

.button-88{
  
                    outline: 0;
                    grid-gap: 8px;
                    align-items: center;
                    background-color: #97BF77;
                    color: #000;
                    border: 1px solid #000;
                    border-radius: 4px;
                    cursor: pointer;
                    display: inline-flex;
                    flex-shrink: 0;
                    font-size: 16px;
                    gap: 8px;
                    justify-content: center;
                    line-height: 1.5;
                    overflow: hidden;
                    padding: 12px 12px;
                    text-decoration: none;
                    text-overflow: ellipsis;
                    transition: all .14s ease-out;
                    white-space: nowrap;
                    width: 100px;
}
.button-88:hover {
                        box-shadow: 4px 4px 0 #000;
                        transform: translate(-4px,-4px);
                    }

.button-88:focus-visible{
                        outline-offset: 1px;
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
/* Style for the fieldset */
fieldset {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }

        /* Style for the legend */
legend {
            font-weight: bold;
            color: #333;
            font-size: 14px;
        }

        @font-face {
    font-family: 'Eraser';
    src: url('assets/fonts/Eraser.ttf'); /* Replace 'path/to/chalkboard-font.ttf' with the actual path to your font file */
}

.custom-font {
    font-family: 'Eraser', sans-serif; /* Apply your custom font */
    /* Add any other styles you want to apply */
    
  
}
.equal-height-row {
    display: flex;
    align-items: stretch; /* Ensure all columns are the same height */
    gap: 10px; /* Adds spacing between columns */
}

.col {
    font-weight: bold;
    border-width: 2px;
    border-style: solid;
    border-color: #B45309;
    text-align: center;
    padding: 10px; /* Ensure padding is consistent */
    background-color: #FEF3C7;
    flex: 1; /* Make each column take equal width space */
    box-sizing: border-box;
}


.dropdown-container {
    margin-top: 10px;
}
.form-select {
    margin-bottom: 10px; /* Space between dropdowns */
}
  
    
.add-dropdown {
    display: inline-block;
    margin-top: 10px;
    background-color: green;
    color: white;
    font-weight: bold;
    font-size: 16px;
    padding: 5px 10px;
    border: none;
    cursor: pointer;
    border-radius: 4px;
}
</style>

<body>

 


  <?php


include 'header.php';


include 'sidebar.php';


?>
<main id="main" class="main">


<h1 class="custom-font" style="color:white; font-size: 48px;">Topic Setting</h1>







<div class="card">


<div class="card-body">
          
          <h5 class="card-title">Month</h5>



           <!-- Floating Labels Form -->
           <form id="topicForm">

             
            
             <div class="col-md-3">
               <div class="form-floating">
               <label for="floatingSelect" style="background-color:F3EA9C; margin-top:-10px">Select Month :</label>

               <select class="form-select"   id="selectedComboType" aria-label="State" style="font-weight: bold; border-width:2px; border-style:solid; border-color:#B45309; padding: 10px; background-color: #FEF3C7; padding-top:25px;">
                    <option selected>-</option>
                    <option value="July 2024">July 2024</option>
                    <option value="August 2024">August 2024</option>
                     <option value="September 2024">September 2024</option>
                     <option value="October 2024">October 2024</option>
                     <option value="November 2024">November 2024</option>    
                     <option value="December 2024">December 2024</option>          
                </select>
               </div>
             </div>

            
    
        

<br>




<div class="row equal-height-row">

                    <div class="col" id="col1" value ="Quality Analysis">  
                        <span>Quality Analysis</span>
                        <div class="dropdown-container"></div>
                    </div>


                    <div class="col" id="col2" value ="Work Standard">
                        <span>Work Standard</span>
                        <div class="dropdown-container"></div>
                    </div>


                    <div class="col" id="col3" value ="Mgt Group Regulation"> 
                        <span>Mgt Group Regulation</span>
                        <div class="dropdown-container"></div>
                    </div>

                    <div class="col" id="col4" value ="Common Training">
                        <span>Common Training</span>
                        <div class="dropdown-container"></div>
                    </div>

                    <div class="col" id="col5" value ="Prod. Hashira">
                        <span>Prod. Hashira</span>
                        <div class="dropdown-container"></div>
                    </div>

                    <div class="col" id="col6" value ="Technical Standard"> 
                        <span>Technical Standard</span>
                        <div class="dropdown-container"></div>
                    </div>

                    <div class="col" id="col7" value ="Common Business Skills"> 
                        <span>Common Business Skills</span>
                        <div class="dropdown-container"></div>
                    </div>


                    <div class="col" id="col8" value ="Company Fundamentals"> 
                        <span>Company Fundamentals</span>
                        <div class="dropdown-container"></div>
                    </div>

                </div>

      
      
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                
<script>
$(document).ready(function() {
    $('.col').each(function() {

        $(this).css({
    display: 'flex',
    flexDirection: 'column',
    justifyContent: 'space-between',
    height: '100%'
    }).append('<button type="button" class="btn btn-primary btn-sm mt-2 add-dropdown" >+</button>');

        
        $(this).find('.add-dropdown').click(function() {
            var colId = $(this).parent().attr('id');
            var categoryValue = $(this).parent().attr('value');
            var table = '';
            if (colId === 'col1') {
                table = 'qualityanalysis';
            } else if (colId === 'col2') {
                table = 'workstandard';
            } else if (colId === 'col3') {
                table = 'mgtgroupregulation';
            } else if (colId === 'col4') {
                table = 'commontraining';
            } else if (colId === 'col5') {
                table = 'prodhashira';
            } else if (colId === 'col6') {
                table = 'technicalstandard';
            }else if (colId === 'col7') {
                table = 'commonbusinessskills';
            }else if (colId === 'col8') {
                table = 'companyfundamentals';
            }

            if (table !== '') {
                $.ajax({
                    url: 'fetch_topicsetting.php',
                    method: 'GET',
                    data: { table: table },
                    success: function(response) {
                        $('#' + colId).append('<select class="form-select mt-2" name="available_topic[]" data-category="' + categoryValue + '" required>' + response + '</select>');
                    },
                    error: function() {
                        alert('Failed to fetch dropdown options.');
                    }
                });
            } else {
                $(this).before('<select class="form-select mt-2" name="available_topic[]" data-category="' + categoryValue + '" required><option>Select Option</option><option>Option 1</option><option>Option 2</option></select>');
            }
        });
    });

    $('#topicForm').submit(function(e) {
        e.preventDefault();

        var month = $('#selectedComboType').val();
        if (month === '-') {
            alert('Please select a month.');
            return;
        }

        var data = [];
        $('select[name="available_topic[]"]').each(function() {
            var category = $(this).data('category');
            var topic = $(this).val();
            data.push({ category: category, available_topic: topic });
        });

        $.ajax({
            url: 'save_topicsetting.php',
            method: 'POST',
            data: {
                month: month,
                data: JSON.stringify(data)
            },
            success: function(response) {
                alert(response);
                location.reload();
            },
            error: function() {
                alert('Failed to save data.');
            }
        });
    });
});
</script>




<button type="submit" class="button-cus1 float-right mt-3 " name="save">Save</button>
  </form>
         </div>
       </div>

       

</div>


    

    



  <!-- ======= Footer ======= -->
  <?php 

include 'footer.php';


?>
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


<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.24/api/sum().js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">




   


<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.24/api/sum().js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">


</body>

</html>