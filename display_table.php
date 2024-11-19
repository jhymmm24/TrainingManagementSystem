<?php 




include 'Connection/connection.php';


// Retrieve selected common training from AJAX request
$selectedOption = $_POST['option'];

// Perform database query based on the selected option
if ($selectedOption === 'Common Training') {
 ?>   
   
                    <table id="example23" class="display" style="width:100%; overflow-x: auto;  white-space: nowrap;   display: block;">
                    <thead>
                    <thead>

                            
                        <tr>
                            <th style="text-align: center;"><input type="checkbox" id="all" name="all" onclick="toggle(this);" style="width: 15px;">Select All</th>
                            <th style="text-align: center;">Date</th>
                            <th style="text-align: center;">Type of Training</th>
                            <th style="text-align: center;">Topic</th>
                            <th style="text-align: center;">Employee Number</th>
                            <th style="text-align: center;">Employee Name</th>
                            <th style="text-align: center;">Date Hired</th>
                            <th style="text-align: center;">Position</th>
                            <th style="text-align: center;">Room</th>
                            <th style="text-align: center;">Traning Status</th>
                        
                        </tr>
                    
                    </thead>
                    </thead>

                    <tbody>
                    <?php
                        $gettrainings = "SELECT * FROM [dbo].[tbl_commontraining_main]";
                        $stmt2 = sqlsrv_query($conn,$gettrainings);
                                        while($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
                                            $id = $row['ID'];
                                            $employeeno = $row['Employee Number'];
                                            $fullname = $row['Employee Name'];
                                            $section = $row['Section'];
                                            $position = $row['Position'];
                                            $topic = $row['Topic'];
                                            $email = $row['Email'];
                                            $datehired = $row['Date Hired'];
                                            $wsPPCC = $row['Work Standard PPCC'];
                                            $wsAT = $row['Work Standard AT'];
                                            $wsJSP = $row['Work Standard JSP'];
                                            $topic = $row['Topic'];
                                            $typeoftraining = $row['Type of Training'];
                                            $startdate = $row['Start Date'];
                                            $enddate = $row['End Date'];
                                            $starttime = $row['Start Time'];
                                            $endtime = $row['End Time'];
                                            $room = $row['Meeting Room'];
                                            $status = $row['Training Status'];
                                            

                                            echo

                                            '<tr>
                                                <td style="width: 5px;"> <input type="checkbox" name="selected[]" class="single-checkbox" id="selected" value="'.$id.'"></td>
                                                <td>'  . $row['Start Date'] .'</td>
                                                <td>'  . $row['Type of Training'] .'</td>
                                                <td>'  . $row['Topic'] .'</td>
                                                <td>'  . $row['Employee Number'] .'</td>
                                                <td>'  . $row['Employee Name'] .'</td>
                                                <td>'  . $row['Date Hired'] .'</td>
                                                <td>'  . $row['Position'] .'</td>
                                                <td>'  . $row['Meeting Room'] .'</td>
                                                <td>'  . $row['Training Status'] .'</td>
                                            ';
                                        

                                        }

                        
                        ?>
                        </tbody>
                        </table>
                        <?php
    

} elseif ($selectedOption === 'option2') {
    $query = "SELECT * FROM data_table WHERE column_name = 'value2'";
} elseif ($selectedOption === 'option3') {
    $query = "SELECT * FROM data_table WHERE column_name = 'value3'";
} else {
    // Handle invalid selection
    echo "Please select a valid option.";
    exit;
}


?>



<script>
       new DataTable('#example23', {
            initComplete: function () {
                this.api()
                    .columns([1,2,3,4,5,6,7])
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
        { orderable: false, targets: [0,1,2,3,4,5,6,7,8,9] }
        ]
        });


  </script>








