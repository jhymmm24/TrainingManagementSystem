<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<?php
include 'Connection/connection.php';


?>


<table id="example23" class="display" style="width:100%; overflow-x: auto;  white-space: nowrap;   display: block;">


<br>

<form id="hashira_form" method="post">

<table id="hashira_table">
    <thead>
        <tr>
            <th style="text-align: center;">Employee Number</th>
            <th style="text-align: center;">Employee Name</th>
            <th style="text-align: center;">Section</th>
            <th style="text-align: center;">Position</th>
            <th class="dropdown" style="position: relative;">
                Topic
                <div class="dropdown-content">
                    <select>
                  <?php 
                  
                      // Query to retrieve data from tbl_Hashira
                        $query = "SELECT Topic FROM [dbo].[tbl_topic_hashira]";
                        $stmt = sqlsrv_query($conn, $query);

                        if ($stmt === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }

                        // Populate options based on the query result
                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                            echo "<option value='" . $row['Topic'] . "'>" . $row['Topic'] . "</option>";
                        }

                  
                  ?>
                    </select>
                </div>
                </th>
                        



        </tr>
    </thead>
    
    <tbody>
    


        <?php
        $get_data = "SELECT * FROM [dbo].[tbl_masterlist]";
        $stmt = sqlsrv_query($conn, $get_data);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        // Display data rows
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row['Employee_Number'] . '</td>';
            echo '<td>' . $row['Employee_Name'] . '</td>';
            echo '<td>' . $row['Section'] . '</td>';
            echo '<td>' . $row['Position'] . '</td>';

            echo '<td><input style="width:50px;" type="text"></td>';
            echo '</tr>';
        }
        ?>
    </tbody>
    <?php



?>


</table>


<button type="submit">Submit</button>
    </form>


<script>
    $(document).ready(function() {
        // Hide all table columns initially
        $("#hashira_table th").hide();
        
        // Event handler for dropdown change
        $("#hashira_dropdown").change(function() {
            // Get the selected value
            var selectedTopic = $(this).val();
            
            // Hide all table columns initially
            $("#hashira_table th").hide();
            
            // Show only the selected column
            $("#hashira_table th:contains(" + selectedTopic + ")").show();
        });
    });
</script>


<script>
    $(document).ready(function() {
        // Event handler for form submission
        $("#hashira_form").submit(function(event) {
            // Prevent default form submission
            event.preventDefault();

            // Serialize form data
            var formData = $(this).serialize();

            // AJAX request to submit form data
            $.ajax({
                type: "POST",
                url: "submit_data.php", // Replace with your server-side script URL
                data: formData,
                success: function(response) {
                    // Handle success response
                    console.log("Data submitted successfully!");
                    // Optionally, you can display a success message or perform other actions.
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error("Error occurred while submitting data:", error);
                    // Optionally, you can display an error message or perform other actions.
                }
            });
        });
    });
</script>


