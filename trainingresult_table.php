<?php 




include 'Connection/connection.php';


// Retrieve selected common training from AJAX request
$selectedOption = $_POST['option'];

// Perform database query based on the selected option
if ($selectedOption === 'Manual Soldering') {
 ?>   
   
                    <table id="example23" class="display" style="width:100%; overflow-x: auto;  white-space: nowrap;   display: block;">
                    <thead>
                    <thead>

                            
                        <tr>
                            <th style="text-align: center;"><input type="checkbox" id="all" name="all" onclick="toggle(this);" style="width: 15px;">Select All</th>
                            <th style="text-align: center;">Date</th>
                            <th style="text-align: center;">Type of Training</th>
                            <th style="text-align: center;">Topic</th>
                            <th style="text-align: center;">Section</th>
                            <th style="text-align: center;">Employee Number</th>
                            <th style="text-align: center;">Employee Name</th>
                            <th style="text-align: center;">Date Hired</th>
                            <th style="text-align: center;">Position</th>
                            <th style="text-align: center;">Requestor Name</th>
                            <th style="text-align: center;">Traning Status</th>
                        
                        </tr>
                    
                    </thead>
                    </thead>

                    <tbody>
                    <?php


                        //get training status
                        $get_solderingtraining = "SELECT * FROM [dbo].[tbl_trainingrequest] WHERE StatusRequestNumber ='Approved' ";
                        $stmt1 = sqlsrv_query($conn,$get_solderingtraining);
                                        while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {
                                            $id = $row['ID'];
                                            $RequestNumber= $row['RequestNumber'];
                                            $TransactionNumber = $row['Transaction Number'];
                                            $Topic = $row['Topic'];
                                            $TypeofTraining = $row['Type of Training'];
                                            $Section = $row['Section'];
                                            $RequestorName = $row['Requestor Name'];
                                            $Target = $row['Target'];
                                            $DateHired = $row['Date Hired'];
                                            $StatusTransaction = $row['StatusTransaction'];
                                        
                                        



                                        
                                        echo

                                        '<tr>
                                            <td style="width: 5px;"> <input type="checkbox" name="selected[]" class="single-checkbox" id="selected" value="'.$id.'"></td>
                                            <td>'  . $Target .'</td>
                                            <td>'  . $row['Type of Training'] .'</td>
                                            <td>'  . $row['Topic'] .'</td>
                                            <td>'  . $row['Section'] .'</td>
                                            <td>'  . $row['Employee Number'] .'</td>
                                            <td>'  . $row['Employee Name'] .'</td>
                                            <td>'  . $row['Date Hired'] .'</td>
                                            <td>'  . $row['Position'] .'</td>
                                            <td>'  . $row['Requestor Name'] .'</td>
                                            <td>'  . $row['StatusTransaction'] .'</td>
                                        ';
                                        }

                        
                        ?>
                        </tbody>
                        </table>
                        <?php
    

} elseif ($selectedOption === 'New Staff') {
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
                    .columns([1,2,3,4,5,6,7,8,9,10])
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
        { orderable: false, targets: [0,1,2,3,4,5,6,7,8,9,10] }
        ]
        });


  </script>

<script>
    function toggle(source) {
        var checkboxes = document.querySelectorAll('tr input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = source.checked;
        });
    }
</script>








