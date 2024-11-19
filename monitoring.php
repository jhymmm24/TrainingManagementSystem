

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

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .table-container {
            width: 100%; /* Adjust as necessary */
            height: 400px; /* Set the height for vertical scrolling */
            overflow: auto; /* Enables scrolling */
            border: 1px solid #ccc; /* Optional: adds a border around the container */
            border-radius: 5px; /* Optional: rounded corners */
        }

        table {
            width: 100%; /* Makes the table responsive */
            border-collapse: collapse; /* Ensures no gaps between cells */
        }

        th, td {
            padding: 8px; /* Space around the text */
            text-align: left; /* Align text to the left */
            border: 1px solid #ddd; /* Adds a grid line between cells */
        }

        th {
            background-color: #f2f2f2; /* Header background color */
        }

        .button-custom1 {
            display: inline-block;
            outline: 0;
            border: 0;
            cursor: pointer;
            transition: box-shadow 0.15s ease, transform 0.15s ease;
            will-change: box-shadow, transform;
            background: #FCFCFD;
            box-shadow: 0px 2px 4px rgb(45 35 66 / 40%), 0px 7px 13px -3px rgb(45 35 66 / 30%), inset 0px -3px 0px #d6d6e7;
            height: 48px;
            padding: 0 32px;
            font-size: 18px;
            border-radius: 6px;
            color: #36395a;
        }

        /* Hover state */
        .button-custom1:hover {
            box-shadow: 0px 4px 8px rgb(45 35 66 / 40%), 0px 7px 13px -3px rgb(45 35 66 / 30%), inset 0px -3px 0px #d6d6e7;
            transform: translateY(-2px);
        }

        /* Active state */
        .button-custom1:active {
            box-shadow: inset 0px 3px 7px #d6d6e7;
            transform: translateY(2px);
        }


</style>

<body>

   


  <?php


    include 'header.php';


    include 'sidebar.php';


?>
<main id="main" class="main">


    <h1 class="custom-font" style="color:white; font-size: 48px;">E-Learning</h1>
    <div class="pagetitle">
      <!-- <h1>Common Training</h1> -->

  </div><!-- End Page Title -->





</div>
</div>

<div class="card">


    <div class="card-body">


      
      <h5 class="card-title">Summary of E-Learning</h5>

      <!-- Hidden input to store the PHP $section value -->
<input type="hidden" id="sectionValue" value="<?php echo htmlspecialchars($section); ?>">


      <div class="row" >
        <div class="col-md-3 offset-md-9">
            <fieldset>
              <legend> 

                  <a id="followup_link" href="email/FollowupEmail.php?title=&section=<?php echo urlencode($section); ?>" style="text-decoration: none;">
                    <button onclick="return checkSelectedOption()" style="background-color: transparent; border: none; font-size: 20px;">
                        <img src="assets/img/megaphone.gif" alt="Image Description" style="width: 50px;"> Follow up
                    </button>
                </a>

                <a id="export" href="monitoringexcel.php?title=" style="text-decoration: none;">
                    <button onclick="return exportSelectedOption()" style="background-color: transparent; border: none; font-size: 20px;">
                        <img src="assets/img/excel.png" alt="Image Description" style="width: 50px;"> Export
                    </button>
                </a>

            </legend>
 

            <form action="" method="POST">
    <label for="month">Select Month:</label>
    <select name="month" id="month">
        <?php
        // Array of months
        $months = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        // Get selected month from POST (if any)
        $selectedMonth = isset($_POST['month']) ? $_POST['month'] : null;

        // Loop through the months and create an option for each
        foreach ($months as $index => $month) {
            $value = $index + 1; // Month value (1-12)
            $selected = ($value == $selectedMonth) ? 'selected' : ''; // Check if the month is selected
            echo "<option value=\"$value\" $selected>$month</option>";
        }
        ?>
    </select>
    <button type="submit">Filter</button>
</form>


            <select class="form-control" id="comboBoxELEARNING">
    <option value="">Select an E-Learning</option>
    <?php
    // Prepare the SQL query with filtering by month
    $sql_fetch = "
        SELECT DISTINCT Title 
        FROM [dbo].[tbl_elearningstatus] 
        WHERE Section = ? 
        AND MONTH(TRY_CONVERT(DATE, Target_Date, 120)) = ?
    ";

    // Prepare the statement with section and selected month as parameters
    $stmt = sqlsrv_prepare($conn, $sql_fetch, array($section, $selectedMonth));

    if ($stmt) {
        // Execute the query
        $exec = sqlsrv_execute($stmt);
        if ($exec) {
            // Fetch and display each row
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $title = $row['Title'];
                // Escape title for safe HTML attribute use
                $escapedTitle = htmlspecialchars($title, ENT_QUOTES);
                echo "<option value='" . $escapedTitle . "' data-title='" . $escapedTitle . "'>" . $escapedTitle . "</option>";
            }
        } else {
            echo "<option value=''>Error fetching data</option>";
        }
        // Free the statement resource
        sqlsrv_free_stmt($stmt);
    } else {
        echo "<option value=''>Error preparing query</option>";
    }
    ?>
</select>

            <br>
            
        </fieldset>
    </div>

    <script>
function exportSelectedOption() {
    var comboBox = document.getElementById('comboBoxELEARNING');
    var selectedValue = comboBox.value;

    if (!selectedValue) {
        alert('Please select an E-Learning title before exporting.');
        return false;
    }

    // Set the href to the PHP script with the selected value
    var exportLink = document.getElementById('export');
    exportLink.href = 'monitoringexcel.php?title=' + encodeURIComponent(selectedValue);

    return true;
}
</script>
      
<div class="row">
    <div class="col-md-3 offset-md-9 text-end">
        <?php if ($category === 'Admin'): ?>
            <button type="button" class="button-custom1" id="sendEmailBtn">
                <img src="assets/img/email.ico" alt="Send Email" style="width: 30px; height: 30px; vertical-align: middle; margin-right: 5px;">
                Send Daily Email
            </button>
            <br><br>
        <?php endif; ?>
    </div>
</div>



</div>

</div>



<div class="card">
    <div class="card-body">
        <h5 class="card-title"></h5>

        <!-- Month Selection Dropdown -->


        <?php
        // Check if a month is selected and get the selected month
    // Check if a month is selected and get the selected month
            $selectedMonth = isset($_POST['month']) ? $_POST['month'] : null;

            $whereClause = '';
            if ($selectedMonth) {
                $whereClause = "WHERE TRY_CONVERT(DATE, Target_Date, 120) IS NOT NULL 
                                AND MONTH(TRY_CONVERT(DATE, Target_Date, 120)) = $selectedMonth";
            }
            $query = "
            WITH TargetCounts AS (
                SELECT Title, Section, SUM(TotalNumber_Target) AS TargetCount 
                FROM [dbo].[tbl_elearningstatus] 
                $whereClause
                GROUP BY Title, Section
            ),
            FinishedCounts AS (
                SELECT Title, Section, SUM(TotalNumber_Finished) AS FinishedCount 
                FROM [dbo].[tbl_elearningstatus] 
                $whereClause
                GROUP BY Title, Section
            )
            SELECT 
                tc.Title, 
                tc.Section, 
                tc.TargetCount, 
                COALESCE(fc.FinishedCount, 0) AS FinishedCount,
                CASE 
                    WHEN tc.TargetCount > 0 THEN (CAST(COALESCE(fc.FinishedCount, 0) AS FLOAT) / tc.TargetCount) * 100
                    ELSE 0
                END AS Percentage
            FROM 
                TargetCounts tc
            LEFT JOIN 
                FinishedCounts fc 
            ON 
                tc.Title = fc.Title AND tc.Section = fc.Section;
            ";
            

        // Database connection and query execution
        $stmt = sqlsrv_query($conn, $query);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        // Fetch all results
        $results = [];
        $titles = []; // Initialize titles array
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $results[] = $row;
            // Store the titles for later use
            $titles[] = $row['Title'];
        }
        sqlsrv_free_stmt($stmt);

        // Remove duplicates from titles
        $titles = array_unique($titles);

        // Fetch Topic Codes for the titles
        $topicCodes = [];
        foreach ($titles as $title) {
            $topicQuery = "SELECT Topic_Code FROM tbl_topic_code WHERE Topic = ?";
            $params = [$title];
            $topicStmt = sqlsrv_query($conn, $topicQuery, $params);

            if ($topicStmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            if ($topicRow = sqlsrv_fetch_array($topicStmt, SQLSRV_FETCH_ASSOC)) {
                // Check if Topic_Code is NULL or blank
                $topicCode = $topicRow['Topic_Code'];
                $topicCodes[$title] = (empty($topicCode)) ? '' : $topicCode; // Use NTC if NULL or blank
            } else {
                $topicCodes[$title] = ''; // Handle case where no Topic_Code is found
            }
            sqlsrv_free_stmt($topicStmt);
        }

        ?>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th rowspan="2">Section</th>
                        <th colspan="<?php echo count($titles); ?>" style='color:white; text-align:center; background-color:#5D73BF;'>Target</th>
                        <th colspan="<?php echo count($titles); ?>" style='color:white; text-align:center; background-color:#AADCC0;'>Done</th>
                        <th colspan="<?php echo count($titles); ?>" style='color:black; text-align:center;  background-color:#FFECB3;'>Percentage</th>
                        <th rowspan="2">E-LEARNING  COMPLETION RATE</th>
                    </tr>
                    <tr>
                        <?php 
                        // Dynamically create headers for Topic_Codes for Target Count
                        foreach ($titles as $title) {
                            $topicCode = !empty($topicCodes[$title]) ? $topicCodes[$title] : $title;
                            echo "<th style='color:#3AB050'>{$topicCode} - {$title}</th>";
                        }
                        
                        // Dynamically create headers for Topic_Codes for Finished Count
                        foreach ($titles as $title) {
                            $topicCode = !empty($topicCodes[$title]) ? $topicCodes[$title] : $title;
                            echo "<th style='color:#3AB050'>{$topicCode} - {$title}</th>";
                        }

                        // Dynamically create headers for Topic_Codes for Percentage
                        foreach ($titles as $title) {
                            $topicCode = !empty($topicCodes[$title]) ? $topicCodes[$title] : $title;
                            echo "<th style='color:#3AB050'>{$topicCode} - {$title}</th>";
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Group results by section for display
                    $groupedResults = [];
                    foreach ($results as $row) {
                        $groupedResults[$row['Section']][] = $row;
                    }

                    foreach ($groupedResults as $section => $data) {
                        echo "<tr>";
                        // Display the Section Name
                        echo "<td>{$section}</td>"; // Include the Section column

                        $totalPercentage = 0; // To accumulate percentage per section
                        $count = 0; // To count the number of titles for percentage calculation

                        // First part: Target Counts
                        foreach ($titles as $title) {
                            $targetCount = 0;

                            foreach ($data as $row) {
                                if ($row['Title'] === $title) {
                                    $targetCount = $row['TargetCount'];
                                }
                            }

                            echo "<td>{$targetCount}</td>";
                        }

                        // Second part: Finished Counts
                        foreach ($titles as $title) {
                            $finishedCount = 0;

                            foreach ($data as $row) {
                                if ($row['Title'] === $title) {
                                    $finishedCount = $row['FinishedCount'];
                                }
                            }

                            echo "<td>{$finishedCount}</td>";
                        }

                        // Last part: Percentages
                        foreach ($titles as $title) {
                            $percentage = 0;

                            foreach ($data as $row) {
                                if ($row['Title'] === $title) {
                                    $percentage = $row['Percentage'];
                                }
                            }

                            // Accumulate total percentage and count valid percentages
                            $totalPercentage += $percentage;
                            if ($percentage > 0) {
                                $count++;
                            }

                            echo "<td>" . number_format($percentage, 2) . "%</td>";
                        }

                        // Calculate the average percentage for the section
                        $averagePercentage = $count > 0 ? $totalPercentage / $count : 0; // Avoid division by zero

                        // Display the average percentage
                        echo "<td><strong>" . number_format($averagePercentage, 2) . "%</strong></td>";

                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>




<div id="status"></div> <!-- For displaying success or error messages -->
<script>
    $('#sendEmailBtn').click(function() {
        $.ajax({
            url: 'email/monitoringnotif.php', // PHP file that handles the email sending
            type: 'POST',
            data: { monitoringnotif: true }, // Data sent to PHP
            success: function(response) {
                // Display the server's response
                $('#status').html(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Show more detailed error information
                $('#status').html('An error occurred: ' + textStatus + ' ' + errorThrown + ' - ' + jqXHR.responseText);
            }
        });
    });
</script>



</main><!-- End #main -->








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

<script>
    document.addEventListener('DOMContentLoaded', function () {
      var table = new simpleDatatables.DataTable('#example23', {
        initComplete: function () {
            this.api().columns([0, 1, 2, 3]).every(function () {
                var column = this;
                var select = document.createElement('select');
                select.classList.add('form-control');
                select.innerHTML = '<option value=""></option>';
                column.data().unique().sort().each(function (d, j) {
                    select.innerHTML += '<option value="' + d + '">' + d + '</option>'
                });
                select.addEventListener('change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                });
                $('select', this.header()).replaceWith(select);
            });

            
        }
    });
  });
</script> 


<script>
  document.addEventListener('DOMContentLoaded', function () {
     
     // Function to submit the form with title, start date, and end date
     function submitFormWithData() {
        // Show loading
        

        // Get title, start date, and end date values
        var title = document.getElementById("selectedComboType").value;
        var startDate = document.getElementById("startdate").value;
        var endDate = document.getElementById("enddate").value;

        // Set hidden input field values
        document.getElementById("title_hidden").value = title;
        document.getElementById("start_date_hidden").value = startDate;
        document.getElementById("end_date_hidden").value = endDate;

        // Submit the form
        document.getElementById("display_form").submit();
        
    }

    
});

</script>

<script>
  
    function confirm_approve() {
        var inputElems = document.getElementsByTagName("input"),
        count = 0;

        for (var i = 0; i < inputElems.length; i++) {
            if (inputElems[i].type == "checkbox" && inputElems[i].checked == true) {
                count++;
            }
        }

        var checkboxes = document.getElementsByName('selected_rows[]');
        var vals = "";
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            if (checkboxes[i].checked) {
              vals += checkboxes[i].value + "<br>";
          }
      }

      if (count <= 0) {
        Swal.fire({
            title: 'Kindly check Employee Number',
            text: 'No selected values detected!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK',
            timer: null // Prevent automatic closing
        });
    } else {
        Swal.fire({
            title: 'Are you sure you want to target below Employee Number?',
            html: '<div><br>' + vals + '</div>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit it!',
            timer: null // Prevent automatic closing
        }).then((result) => {
            if (result.isConfirmed) {

              document.getElementById("myForm").submit();
              
          }
      });
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
    // Get the select element
// Get the select element
const comboBox = document.getElementById('comboBoxELEARNING');
// Get the follow-up link
const followupLink = document.getElementById('followup_link');
// Get the section value dynamically inside the event listener
const sectionInput = document.getElementById('sectionValue'); // Assuming sectionValue is an input field

// Add event listener to the select element
comboBox.addEventListener('change', function() {
    // Get the selected option's title using the data-title attribute
    const selectedTitle = comboBox.options[comboBox.selectedIndex].getAttribute('data-title');
    
    // Dynamically get the current section value (if it changes dynamically)
    const sectionValue = sectionInput.value;

    // Update the href attribute of the follow-up link with the selected title and section value
    followupLink.href = `email/FollowupEmail.php?title=${encodeURIComponent(selectedTitle)}&section=${encodeURIComponent(sectionValue)}`;
});

console.log("Selected Section: ", sectionValue);

</script>


<!-- 
<script>
    // Get the select element
    const comboBox = document.getElementById('comboBox');
    // Get the follow-up link
    const followupLink = document.getElementById('followup_link');

    // Add event listener to the select element
    comboBox.addEventListener('change', function() {
        // Get the selected option's title using the data-title attribute
        const selectedTitle = comboBox.options[comboBox.selectedIndex].getAttribute('data-title');
        // Update the href attribute of the follow-up link with the selected title
        followupLink.href = `email/FollowupEmail.php?title=${encodeURIComponent(selectedTitle)}`;
    });
</script> -->



<script>
    function checkSelectedOption() {
        var comboBox = document.getElementById("comboBoxELEARNING");
        var selectedIndex = comboBox.selectedIndex;
        if (selectedIndex === 0 ) {
            alert("No elearning selected");
            return false; // Prevents the default action (following the link)
        }
        return true; // Allow following the link
    }
</script>





<script>
    $(document).ready(function(){
        $('#employeelist').click(function(){

        // Show loading GIF
        $('#loading').show();
        
        $.ajax({
            url: 'display_tableEMS.php',
            method: 'POST',
            
            success: function(response){

                   // Hide loading GIF
                   $('#loading').hide();


                   $('#table-container').html(response);
               },
               error: function(){
                    // Hide loading GIF on error
                    $('#loading').hide();

                    // Display an error message or handle the error appropriately
                    $('#table-container').html("An error occurred while fetching data.");
                }
                
            });
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


</body>

</html>