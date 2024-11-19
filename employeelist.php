
            
            <?php


if (isset($_POST['display_table'])) {

    // Database connection
    if ($conn) {
        $sql = "SELECT * FROM [dbo].[tbl_accounts]";
        $params = array();
        $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
        $stmt = sqlsrv_query($conn, $sql, $params, $options);
        $row_count = sqlsrv_num_rows($stmt);

        if ($row_count > 0) {
            echo "<div class='table-responsive'><form method='post' action='mainProcess.php?function=UploadAttendees' name='myForm' id='myForm'><table id='example23' class='display' style='width:100%; font-size: 12px;'>";
            echo "<thead><tr><th>Select</th><th>Employee Number</th><th>Full Name</th><th>Section</th><th>Email</th></tr></thead>";
            // output data of each row
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td><input type='checkbox' name='selected_rows[]' value='" . $row["EmployeeNumber"] . "'></td>";
                echo "<td>" . $row["EmployeeNumber"] . "</td><td>" . $row["Full_Name"] . "</td><td>" . $row["Section"] . "</td><td>" . $row["Email"] . "</td>";
                echo "</tr>";
            }
            echo "<input  id='title_hidden' name='title' value=''>";
            echo "<input  id='start_date_hidden' name='startdate' value=''>";
            echo "<input  id='end_date_hidden' name='enddate' value=''>";
            

            echo "</table>";
            echo "<button type='button' onclick='confirm_approve()' class='button-88' style='margin-left:20px; margin-bottom:20px;'>Enlist</button>";
          
        } else {
            echo "0 results";
        }
    } else {
        echo "Connection could not be established.";
    }

    
}



 ?>

 
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Function to submit the form with title, start date, and end date
    function submitFormWithData() {
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

    // Event listener for Employee List button click
    document.getElementById("display_table_button").addEventListener("click", function () {
        submitFormWithData();
    });
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
            vals += ", " + checkboxes[i].value;
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
            title: 'Are you sure you want to target?',
            text: 'Employee Number:' + vals,
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


