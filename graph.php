
 <div class="circle-container">
   

<?php
        
        //fetch data array
        // Query for target employees
        $query_count = "SELECT Title, Section, SUM(TotalNumber_Target) AS TargetCount 
        FROM [dbo].[tbl_elearningstatus] 
        GROUP BY Title, Section";
        $result_count = sqlsrv_query($conn, $query_count);

        // Fetch target data
        $targetData = [];
        if ($result_count !== false) {
            while ($row = sqlsrv_fetch_array($result_count, SQLSRV_FETCH_ASSOC)) {
                $targetData[] = $row;
            }
        } else {
            die("Query execution failed: " . sqlsrv_errors());
        }

        // Query for finished employees
        $query_count_finish = "SELECT Title, Section, SUM(TotalNumber_Finished) AS FinishedCount 
        FROM [dbo].[tbl_elearningstatus] 
        GROUP BY Title, Section";
        $result_count_finish = sqlsrv_query($conn, $query_count_finish);

        // Fetch finished data
        $finishedData = [];
        if ($result_count_finish !== false) {
            while ($row = sqlsrv_fetch_array($result_count_finish, SQLSRV_FETCH_ASSOC)) {
                $finishedData[] = $row;
            }
        } else {
            die("Query execution failed: " . sqlsrv_errors());
        }

        // Close the connection
        sqlsrv_close($conn);

        // Encode data in JSON format
        $targetJson = json_encode($targetData);
        $finishedJson = json_encode($finishedData);
    ?>
    <canvas id="myChart" width="400" height="200"></canvas>
    <script>
                    // Parse JSON data
                    var targetData = <?php echo $targetJson; ?>;
                    var finishedData = <?php echo $finishedJson; ?>;

                    // Prepare data for the chart
                    var labels = [];
                    var targetCounts = [];
                    var finishedCounts = [];

                    targetData.forEach(function(item) {
                        labels.push(item.Title + ' - ' + item.Section);
                        targetCounts.push(item.TargetCount);
                    });

                    finishedData.forEach(function(item) {
                        var index = labels.indexOf(item.Title + ' - ' + item.Section);
                        if (index !== -1) {
                            finishedCounts[index] = item.FinishedCount;
                        }
                    });

                    // Chart.js configuration
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Target Employees',
                                data: targetCounts,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }, {
                                label: 'Finished Employees',
                                data: finishedCounts,
                                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                borderColor: 'rgba(153, 102, 255, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>


            </div>
        </div>
    </div>

</div>