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
    border-color: #BD9057;
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
.button-cus1{
    display: inline-block;
                outline: 0;
                cursor: pointer;
                border-radius: 6px;
                border: 2px solid #C0FFC0;
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
                border: 2px solid #FFE0C0;
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
                    background-color: #FFE0C0;
                    color: BLACK;
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
                  
                   <h1 class="card-title" style="font-size: 36px;"><?php echo  "[$section Section] Skill Map - Hashira ";?></h1>




                   <br>

    <form id="skillmapform" method="post" action="forms/sqlupdates.php?action=update">
    <table id="example23" class="display" style="width:100%; overflow-x: auto; white-space: nowrap; display: block;">
    <thead>
        <tr>
            <?php
            // Query to fetch column names
            $sql_getcolumn = "SELECT COLUMN_NAME
                              FROM INFORMATION_SCHEMA.COLUMNS
                              WHERE TABLE_NAME = 'tbl_topic_LIST_hashira'";

       
            // Execute the query
            $stmt = sqlsrv_query($conn, $sql_getcolumn);

            // Fetch column names and store them in an array
            $columns = array();
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $columns[] = $row['COLUMN_NAME'];
            }

            // Output column names as <th> elements
            foreach ($columns as $column) {
                echo "<th>$column</th>";
            }
            // echo "<th>Action</th>"; // Add column for action (Edit button)
           
            ?>
        </tr>
    </thead>
    <tbody>
        <!-- Populate table body as needed -->
        <?php
        
        // Query to fetch data
        $sql_getdata = "SELECT * FROM tbl_topic_LIST_hashira WHERE Section = '$section'";

       // Execute the query
       $stmt = sqlsrv_query($conn, $sql_getdata);

       // Fetch and populate table data
       while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
           echo "<tr>";
           foreach ($columns as $column) {
               echo "<td data-column-name='$column'>{$row[$column]}</td>";
           }

           echo "</tr>";
       }
    
        ?>
        
     
    </tbody>
</table>
<button class="button-cus3" id="editButton" type="button">Edit</button>
<button class="button-cus1" id="saveButton" type="button" onclick="updateTableData('tbl_topic_LIST_hashira')">Save</button>
<button class="button-cus3" id="exportButton" type="button">Export</button>
</form>
</form>



<!-- JavaScript code -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Get the button elements
    var editButton = document.getElementById("editButton");
    var saveButton = document.getElementById("saveButton");

    saveButton.addEventListener("click", function (event) {
    event.preventDefault(); // Prevent default form submission

    // Show SweetAlert confirmation dialog
    Swal.fire({
        title: "Do you want to save the changes?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Save",
        denyButtonText: `Don't save`
    }).then((result) => {
        if (result.isConfirmed) {
            // Call function to update table data
            updateTableData(tableName); // Pass tableName variable as an argument
        } else if (result.isDenied) {
            Swal.fire("Changes are not saved", "", "info");
        }
    });
});


  // Inside the editButton event listener
  editButton.addEventListener("click", function () {
    alert("Edit function enabled");
    var cells = document.querySelectorAll("#example23 tbody td");
    cells.forEach(function (cell) {
        cell.addEventListener("dblclick", function () {
            var currentValue = this.textContent.trim();
            var columnName = this.getAttribute("data-column-name"); // Get column name
            this.innerHTML = `<input type='text' value='${currentValue}' data-column-name='${columnName}'>`;
        });
    });
});


    
// Function to update table data
// Function to update table data
var tableName = "tbl_topic_LIST_hashira"; // Define table name

function updateTableData(tableName) {
    // Get all the table rows
    var rows = document.querySelectorAll("#example23 tbody tr");

rows.forEach(function (row) {
    var employeeNumber = row.cells[1].textContent; // Assuming employee number is in the first column
    var inputs = row.querySelectorAll("td input"); // Get all input elements in the row

    inputs.forEach(function(input) {
        var updatedValue = input.value; // Get the updated value from the input
        var columnName = input.getAttribute("data-column-name"); // Get column name from input

       
        var url = "forms/sqlupdates.php?action=update";

        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
            }
        };

        var postData = "action=update" + 
                       "&employee_number=" + encodeURIComponent(employeeNumber) + 
                       "&updated_value=" + encodeURIComponent(updatedValue) +
                       "&column_name=" + encodeURIComponent(columnName)+
                    
                       "&table_name=" + encodeURIComponent(tableName); // Corrected concatenation
                       

        xhr.send(postData);
    });
});

Swal.fire("Changes are saved", "", "success");

setTimeout(function(){ window.location='skillmap_prodhash.php'; }, 2000);

     
       
   
}


});



</script>




</div>
</div>






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


<!-- DataTables and Buttons CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">

<!-- JSZip (for Excel export) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<!-- pdfMake (for PDF export) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<!-- DataTables Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>

<!-- DataTables Buttons Export to Excel -->
<script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {
    var table = $('#example23').DataTable({
        initComplete: function() {
            this.api().columns([]).every(function() {
                let column = this;
                // Create select element for filtering
                let select = $('<select><option></option></select>')
                    .appendTo($(column.header()))
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                    });

                // Populate options
                column.data().unique().sort().each(function(d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>');
                });
            });
        },
        columnDefs: [{
            orderable: false,
            targets: [2, 3, 4]
        }],
        dom: 'Bfrtip', // This enables the buttons
        buttons: [{
            extend: 'excelHtml5',
            title: function() {
                // Grab the title from the <h1> element and use it as the filename
                return $("h1.card-title").text().trim();
            },
            filename: function() {
                // Remove non-alphanumeric characters and spaces for a clean filename
                return $("h1.card-title").text().replace(/[^a-zA-Z0-9]/g, '_');
            }
        }]
    });

    // Custom button click event for export
    $('#exportButton').on('click', function() {
        console.log(table); // Debugging the table instance
        table.button(0).trigger();  // Trigger export to Excel
    });
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
