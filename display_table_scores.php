<?php 




include 'Connection/connection.php';


// Retrieve selected common training from AJAX request
$selectedOption = $_POST['option'];
$userfullname = $_GET['fullname'];
$userposition = $_GET['position'];

// Perform database query based on the selected option
if ($selectedOption === 'Manual Soldering') {
 ?>   
   
                <table id="example23" class="display" style="width:100%">
                        <thead>
                        
                            <tr>
                                <th style=" width: 5px;">Select</th>
                                <th style=" text-align: center;">Transaction Number</th>
                                <th style=" text-align: center;" >Training Topic</th>
                                <th style=" text-align: center;" >Training Type</th>
                                <th style=" text-align: center;">Target Date</th>
                                <th style=" text-align: center;">Requestor Name</th>
                                <th style=" text-align: center;">Section</th>
                                <th style=" text-align: center;">Status</th>
                                <th style=" text-align: center;">Action</th>
                            </tr>
                            <tr>
                                <th style=" width: 5px;">Select</th>
                                <th style=" text-align: center;">Transaction Number</th>
                                <th style=" text-align: center;" >Training Topic</th>
                                <th style=" text-align: center;" >Training Type</th>
                                <th style=" text-align: center;">Target Date</th>
                                <th style=" text-align: center;">Requestor Name</th>
                                <th style=" text-align: center;">Section</th>
                                <th style=" text-align: center;">Status</th>
                                <th style=" text-align: center;"></th>
                            </tr>
                        </thead>
                        <tbody>

                        
                    <?php
                        $query_trainingrequest = "
                                    WITH CTE AS (
                                        SELECT *,
                                            ROW_NUMBER() OVER (PARTITION BY RequestNumber ORDER BY (SELECT NULL)) AS RowNum
                                        FROM [dbo].[tbl_trainingrequest]
                                        WHERE StatusRequestNumber = 'Approved' -- Adding filter for Status column
                                    )
                                    SELECT *
                                    FROM CTE
                                    WHERE RowNum = 1";




                        $stmt_trainingrequest = sqlsrv_query($conn,$query_trainingrequest);
                                        while($row = sqlsrv_fetch_array($stmt_trainingrequest, SQLSRV_FETCH_ASSOC)) {
                                            $id = $row['ID'];
                                            $requestnumber = $row['RequestNumber'];
                                            $requestdate= $row['Request Date'];
                                            $transactionnumber= $row['Transaction Number'];
                                            $topic = $row['Topic'];
                                            $typeoftraining = $row['Type of Training'];
                                            $requestorname = $row['Requestor Name'];
                                            $section = $row['Section'];
                                            $rank = $row['Rank'];
                                            $urgent = $row['Urgent'];
                                            $reasonurgent = $row['Reason of Urgency'];
                                            $targetdate = $row['Target'];
                                            $employeenumber =  $row['Employee Number'];
                                            $employeename =  $row['Employee Name'];
                                            $status = $row['StatusTransaction'];
                        

                                            // Add a class to highlight row green if status is "PASSED"
                                            $rowClass = ($status === 'PASSED') ? 'passed-row' : '';
                                            
                                            
                                            

                                            echo

                                            '<tr class="' . $rowClass . '">
                                                <td style="width: 5px; text-align: center;"> <input type="checkbox" name="selected[]" class="single-checkbox" id="selected" value="'.$id.'"></td>
                                                <td style=" text-align: center;">'  . $row['RequestNumber'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Topic'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Type of Training'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Target'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Requestor Name'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Section'] .'</td>
                                                <td style=" text-align: center;">'  . $row['StatusTransaction'] .'</td>
                                            
                                                
                                                
                                                
                                                
                                            
                                            ';
                                            ?>
                                            
                                            <td>
                                            <div style="display: inline-block;">
                                            <?php
                                            
                                    
                                        
                                            if ($requestorname === $userfullname && $typeoftraining === 'E-LEARNING') {
                                                if ($status !== 'PASSED') {
                                                                    echo '<a href="scoring_soldering.php?TrainingrequestID='.$requestnumber.'&TrainingTopic='.$topic.'"  class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                                            <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Click to fill-up scores">
                                                                        </a>';
                                                                } else {
                                                                    echo '<button onclick="alert(\'You have already passed the exam.\')" class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                                            <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Already filled-out scores">
                                                                        </button>';
                                                                }
                                                        }
                                                        //will change condition to all PE Training PIC
                                                        elseif($userposition === 'Senior Engineer' && $typeoftraining === 'FACE TO FACE'){
                                                            echo '<a href="scoring_soldering.php?TrainingrequestID='.$requestnumber.'&TrainingTopic='.$topic.'"  class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                            <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Click to fill-up scores">
                                                        </a>';

                                                        }
                                                        
                                                        
                                                        else {
                                                            echo '<a href="#" onclick="alert(\'You have no permission to fill-out scores.\')" class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                                    <img src="assets/img/quizbw.png" style="width: 35px; height: 35px; border: none;" title="No Permission to fill-up scores">
                                                                </a>';
                                                        }
                                            ?>
                                        </div>
                                    
                                        <!-- Additional button -->
                                        <div style="display: inline-block;">
                                        <a href="soldering_scoring_view.php?TransactionNumber=<?php echo $requestnumber; ?>&TrainingTopic=<?php echo $topic; ?>" class="btn btn-info" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                <img src="assets/img/pdf.png" style="width: 35px; height: 35px; border: none;" title="View">
                                            </a>
                                        </div>

                                        
                                            
                                            
                                            </td>

                                            
                                                

                                
                                        
                                        <!-- Modal container -->
                                        <div id="myModal" class="modal fade"></div>

                                    <?php
                                        
                                        }
                                        
                                        
                        
                        ?>
                        
                        
                        
                        
                        
                        </tbody>
                    
                    </table>
                       
                        <?php
    

} elseif ($selectedOption === 'Quality Analysis') {

    ?>   
   
                <table id="example23" class="display"  style="width:100%; overflow-x: auto;  white-space: nowrap;   display: block;">
                        <thead>
                        
                            <tr>
                                <th style=" width: 5px;">Select</th>
                                <th style=" text-align: center;">Transaction Number</th>
                                <th style=" text-align: center;" >Training Topic</th>
                                <th style=" text-align: center;" >Training Type</th>
                                <th style=" text-align: center;">Target Date</th>
                                <th style=" text-align: center;">End Date</th>
                                <th style=" text-align: center;">Requestor Name</th>
                                <th style=" text-align: center;">Section</th>
                                <th style=" text-align: center;">Status</th>
                                <th style=" text-align: center;">Action</th>
                            </tr>
                            <tr>
                                <th style=" width: 5px;">Select</th>
                                <th style=" text-align: center;">Transaction Number</th>
                                <th style=" text-align: center;" >Training Topic</th>
                                <th style=" text-align: center;" >Training Type</th>
                                <th style=" text-align: center;">Target Date</th>
                                <th style=" text-align: center;">End Date</th>
                                <th style=" text-align: center;">Requestor Name</th>
                                <th style=" text-align: center;">Section</th>
                                <th style=" text-align: center;">Status</th>
                                <th style=" text-align: center;"></th>
                            </tr>
                        </thead>
                        <tbody>

                        
                    <?php
                        $query_trainingrequest = "
                                    WITH CTE AS (
                                        SELECT *,
                                            ROW_NUMBER() OVER (PARTITION BY RequestNumber ORDER BY (SELECT NULL)) AS RowNum
                                        FROM [dbo].[tbl_topic_LIST_qualityanalysis_MAINREQUEST]
                        
                                    )
                                    SELECT *
                                    FROM CTE
                                    WHERE RowNum = 1";




                        $stmt_trainingrequest = sqlsrv_query($conn,$query_trainingrequest);
                                        while($row = sqlsrv_fetch_array($stmt_trainingrequest, SQLSRV_FETCH_ASSOC)) {
                                            $id = $row['ID'];
                                            $requestnumber = $row['RequestNumber'];
                                            $requestdate= $row['Date_Requested'];
                                         
                                            $topic = $row['Topic'];
                                            $typeoftraining = $row['Type of Training'];
                                            $requestorname = $row['Requestor_Name'];
                                            $section = $row['Section'];
                                         
                                        
                                            $startdate = $row['Start Date'];
                                            $end = $row['End Date'];
                                            $employeenumber =  $row['Employee_Number'];
                                            $employeename =  $row['Employee_Name'];
                                            $statusrequestnumber = $row['StatusRequestNumber'];
                                            $status = $row['Status'];
                                         
                        

                                            // Add a class to highlight row green if status is "PASSED"
                                            $rowClass = ($status === 'DONE') ? 'passed-row' : '';
                                            
                                            
                             

                                            echo

                                            '<tr class="' . $rowClass . '">
                                                <td style="width: 5px; text-align: center;"> <input type="checkbox" name="selected[]" class="single-checkbox" id="selected" value="'.$id.'"></td>
                                                <td style=" text-align: center;">'  . $row['RequestNumber'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Topic'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Type of Training'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Start Date'] .'</td>
                                                <td style=" text-align: center;">'  . $row['End Date'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Requestor_Name'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Section'] .'</td>
                                                <td style=" text-align: center;">'  . $row['StatusRequestNumber'] .'</td>
                                            
                                                
                                                
                                                
                                                
                                            
                                            ';
                                            ?>
                                            
                                            <td>
                                            <div style="display: inline-block;">
                                            <?php
                                            
                                    
                                        
                                            if ($requestorname === $userfullname && $typeoftraining === 'E-LEARNING') {
                                                if ($status !== 'DONE') {
                                                                    echo '<a href="scoring_qualityanalysis.php?TrainingrequestID='.$requestnumber.'&TrainingTopic='.$topic.'"  class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                                            <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Click to fill-up scores">
                                                                        </a>';
                                                                } else {
                                                                    echo '<button onclick="alert(\'You have already passed the exam.\')" class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                                            <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Already filled-out scores">
                                                                        </button>';
                                                                }
                                                        }
                                                        //will change condition to all PE Training PIC
                                                        elseif($userposition === 'Senior Engineer' && $typeoftraining === 'FACE TO FACE'){
                                                            echo '<a href="scoring_qualityanalysis.php?TrainingrequestID='.$requestnumber.'&TrainingTopic='.$topic.'"  class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                            <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Click to fill-up scores">
                                                        </a>';

                                                        }
                                                        
                                                        
                                                        else {
                                                            echo '<a href="#" onclick="alert(\'You have no permission to fill-out scores.\')" class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                                    <img src="assets/img/quizbw.png" style="width: 35px; height: 35px; border: none;" title="No Permission to fill-up scores">
                                                                </a>';
                                                        }
                                            ?>
                                        </div>
                                    
                                        <!-- Additional button -->
                                        <div style="display: inline-block;">
                                        <a href="soldering_scoring_view.php?TransactionNumber=<?php echo $requestnumber; ?>&TrainingTopic=<?php echo $topic; ?>" class="btn btn-info" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                <img src="assets/img/pdf.png" style="width: 35px; height: 35px; border: none;" title="View">
                                            </a>
                                        </div>

                                        
                                            
                                            
                                            </td>

                                            
                                                

                                
                                        
                                        <!-- Modal container -->
                                        <div id="myModal" class="modal fade"></div>

                                    <?php
                                        
                                        }
                                        
                                        
                        
                        ?>
                        
                        
                        
                        
                        
                        </tbody>
                    
                    </table>
                       
                        <?php








} elseif ($selectedOption === 'Work Standard') {



    
    ?>   
   
                <table id="example23" class="display"  style="width:100%; overflow-x: auto;  white-space: nowrap;   display: block;">
                        <thead>
                        
                            <tr>
                                <th style=" width: 5px;">Select</th>
                                <th style=" text-align: center;">Transaction Number</th>
                                <th style=" text-align: center;" >Training Topic</th>
                                <th style=" text-align: center;" >Training Type</th>
                                <th style=" text-align: center;">Target Date</th>
                                <th style=" text-align: center;">End Date</th>
                                <th style=" text-align: center;">Requestor Name</th>
                                <th style=" text-align: center;">Section</th>
                                <th style=" text-align: center;">Status</th>
                                <th style=" text-align: center;">Action</th>
                            </tr>
                            <tr>
                                <th style=" width: 5px;">Select</th>
                                <th style=" text-align: center;">Transaction Number</th>
                                <th style=" text-align: center;" >Training Topic</th>
                                <th style=" text-align: center;" >Training Type</th>
                                <th style=" text-align: center;">Target Date</th>
                                <th style=" text-align: center;">End Date</th>
                                <th style=" text-align: center;">Requestor Name</th>
                                <th style=" text-align: center;">Section</th>
                                <th style=" text-align: center;">Status</th>
                                <th style=" text-align: center;"></th>
                            </tr>
                        </thead>
                        <tbody>

                        
                    <?php
                        $query_trainingrequest = "
                                    WITH CTE AS (
                                        SELECT *,
                                            ROW_NUMBER() OVER (PARTITION BY RequestNumber ORDER BY (SELECT NULL)) AS RowNum
                                        FROM [dbo].[tbl_topic_LIST_workstandard_MAINREQUEST]
                        
                                    )
                                    SELECT *
                                    FROM CTE
                                    WHERE RowNum = 1";




                        $stmt_trainingrequest = sqlsrv_query($conn,$query_trainingrequest);
                                        while($row = sqlsrv_fetch_array($stmt_trainingrequest, SQLSRV_FETCH_ASSOC)) {
                                            $id = $row['ID'];
                                            $requestnumber = $row['RequestNumber'];
                                            $requestdate= $row['Date_Requested'];
                                         
                                            $topic = $row['Topic'];
                                            $typeoftraining = $row['Type of Training'];
                                            $requestorname = $row['Requestor_Name'];
                                            $section = $row['Section'];
                                         
                                        
                                            $startdate = $row['Start Date'];
                                            $end = $row['End Date'];
                                            $employeenumber =  $row['Employee_Number'];
                                            $employeename =  $row['Employee_Name'];
                                            $statusrequestnumber = $row['StatusRequestNumber'];
                                            $status = $row['Status'];
                                         
                        

                                            // Add a class to highlight row green if status is "PASSED"
                                            $rowClass = ($status === 'DONE') ? 'passed-row' : '';
                                            
                                            
                             

                                            echo

                                            '<tr class="' . $rowClass . '">
                                                <td style="width: 5px; text-align: center;"> <input type="checkbox" name="selected[]" class="single-checkbox" id="selected" value="'.$id.'"></td>
                                                <td style=" text-align: center;">'  . $row['RequestNumber'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Topic'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Type of Training'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Start Date'] .'</td>
                                                <td style=" text-align: center;">'  . $row['End Date'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Requestor_Name'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Section'] .'</td>
                                                <td style=" text-align: center;">'  . $row['StatusRequestNumber'] .'</td>
                                            
                                                
                                                
                                                
                                                
                                            
                                            ';
                                            ?>
                                            
                                            <td>
                                            <div style="display: inline-block;">
                                            <?php
                                            
                                    
                                        
                                            if ($requestorname === $userfullname && $typeoftraining === 'E-LEARNING') {
                                                if ($status !== 'DONE') {
                                                                    echo '<a href="scoring_workstandard.php?TrainingrequestID='.$requestnumber.'&TrainingTopic='.$topic.'"  class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                                            <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Click to fill-up scores">
                                                                        </a>';
                                                                } else {
                                                                    echo '<button onclick="alert(\'You have already passed the exam.\')" class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                                            <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Already filled-out scores">
                                                                        </button>';
                                                                }
                                                        }
                                                        //will change condition to all PE Training PIC
                                                        elseif($userposition === 'Senior Engineer' && $typeoftraining === 'FACE TO FACE'){
                                                            echo '<a href="scoring_workstandard.php?TrainingrequestID='.$requestnumber.'&TrainingTopic='.$topic.'"  class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                            <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Click to fill-up scores">
                                                        </a>';

                                                        }
                                                        
                                                        
                                                        else {
                                                            echo '<a href="#" onclick="alert(\'You have no permission to fill-out scores.\')" class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                                    <img src="assets/img/quizbw.png" style="width: 35px; height: 35px; border: none;" title="No Permission to fill-up scores">
                                                                </a>';
                                                        }
                                            ?>
                                        </div>
                                    
                                        <!-- Additional button -->
                                        <div style="display: inline-block;">
                                        <a href="soldering_scoring_view.php?TransactionNumber=<?php echo $requestnumber; ?>&TrainingTopic=<?php echo $topic; ?>" class="btn btn-info" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                <img src="assets/img/pdf.png" style="width: 35px; height: 35px; border: none;" title="View">
                                            </a>
                                        </div>

                                        
                                            
                                            
                                            </td>

                                            
                                                

                                
                                        
                                        <!-- Modal container -->
                                        <div id="myModal" class="modal fade"></div>

                                    <?php
                                        
                                        }
                                        
                                        
                        
                        ?>
                        
                        
                        
                        
                        
                        </tbody>
                    
                    </table>
                       
                        <?php















}
elseif($selectedOption === 'Mgt Group Regulation'){



    
    
    ?>   
   
                <table id="example23" class="display"  style="width:100%; overflow-x: auto;  white-space: nowrap;   display: block;">
                        <thead>
                        
                            <tr>
                                <th style=" width: 5px;">Select</th>
                                <th style=" text-align: center;">Transaction Number</th>
                                <th style=" text-align: center;" >Training Topic</th>
                                <th style=" text-align: center;" >Training Type</th>
                                <th style=" text-align: center;">Target Date</th>
                                <th style=" text-align: center;">End Date</th>
                                <th style=" text-align: center;">Requestor Name</th>
                                <th style=" text-align: center;">Section</th>
                                <th style=" text-align: center;">Status</th>
                                <th style=" text-align: center;">Action</th>
                            </tr>
                            <tr>
                                <th style=" width: 5px;">Select</th>
                                <th style=" text-align: center;">Transaction Number</th>
                                <th style=" text-align: center;" >Training Topic</th>
                                <th style=" text-align: center;" >Training Type</th>
                                <th style=" text-align: center;">Target Date</th>
                                <th style=" text-align: center;">End Date</th>
                                <th style=" text-align: center;">Requestor Name</th>
                                <th style=" text-align: center;">Section</th>
                                <th style=" text-align: center;">Status</th>
                                <th style=" text-align: center;"></th>
                            </tr>
                        </thead>
                        <tbody>

                        
                    <?php
                        $query_trainingrequest = "
                                    WITH CTE AS (
                                        SELECT *,
                                            ROW_NUMBER() OVER (PARTITION BY RequestNumber ORDER BY (SELECT NULL)) AS RowNum
                                        FROM [dbo].[tbl_topic_LIST_mgtgroupregulation_MAINREQUEST]
                        
                                    )
                                    SELECT *
                                    FROM CTE
                                    WHERE RowNum = 1";




                        $stmt_trainingrequest = sqlsrv_query($conn,$query_trainingrequest);
                                        while($row = sqlsrv_fetch_array($stmt_trainingrequest, SQLSRV_FETCH_ASSOC)) {
                                            $id = $row['ID'];
                                            $requestnumber = $row['RequestNumber'];
                                            $requestdate= $row['Date_Requested'];
                                         
                                            $topic = $row['Topic'];
                                            $typeoftraining = $row['Type of Training'];
                                            $requestorname = $row['Requestor_Name'];
                                            $section = $row['Section'];
                                         
                                        
                                            $startdate = $row['Start Date'];
                                            $end = $row['End Date'];
                                            $employeenumber =  $row['Employee_Number'];
                                            $employeename =  $row['Employee_Name'];
                                            $statusrequestnumber = $row['StatusRequestNumber'];
                                            $status = $row['Status'];
                                         
                        

                                            // Add a class to highlight row green if status is "PASSED"
                                            $rowClass = ($status === 'DONE') ? 'passed-row' : '';
                                            
                                            
                             

                                            echo

                                            '<tr class="' . $rowClass . '">
                                                <td style="width: 5px; text-align: center;"> <input type="checkbox" name="selected[]" class="single-checkbox" id="selected" value="'.$id.'"></td>
                                                <td style=" text-align: center;">'  . $row['RequestNumber'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Topic'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Type of Training'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Start Date'] .'</td>
                                                <td style=" text-align: center;">'  . $row['End Date'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Requestor_Name'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Section'] .'</td>
                                                <td style=" text-align: center;">'  . $row['StatusRequestNumber'] .'</td>
                                            
                                                
                                                
                                                
                                                
                                            
                                            ';
                                            ?>
                                            
                                            <td>
                                            <div style="display: inline-block;">
                                            <?php
                                            
                                    
                                        
                                            if ($requestorname === $userfullname && $typeoftraining === 'E-LEARNING') {
                                                if ($status !== 'DONE') {
                                                                    echo '<a href="scoring_mgtgroupregulation.php?TrainingrequestID='.$requestnumber.'&TrainingTopic='.$topic.'"  class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                                            <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Click to fill-up scores">
                                                                        </a>';
                                                                } else {
                                                                    echo '<button onclick="alert(\'You have already passed the exam.\')" class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                                            <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Already filled-out scores">
                                                                        </button>';
                                                                }
                                                        }
                                                        //will change condition to all PE Training PIC
                                                        elseif($userposition === 'Senior Engineer' && $typeoftraining === 'FACE TO FACE'){
                                                            echo '<a href="scoring_mgtgroupregulation.php?TrainingrequestID='.$requestnumber.'&TrainingTopic='.$topic.'"  class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                            <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Click to fill-up scores">
                                                        </a>';

                                                        }
                                                        
                                                        
                                                        else {
                                                            echo '<a href="#" onclick="alert(\'You have no permission to fill-out scores.\')" class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                                    <img src="assets/img/quizbw.png" style="width: 35px; height: 35px; border: none;" title="No Permission to fill-up scores">
                                                                </a>';
                                                        }
                                            ?>
                                        </div>
                                    
                                        <!-- Additional button -->
                                        <div style="display: inline-block;">
                                        <a href="soldering_scoring_view.php?TransactionNumber=<?php echo $requestnumber; ?>&TrainingTopic=<?php echo $topic; ?>" class="btn btn-info" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                <img src="assets/img/pdf.png" style="width: 35px; height: 35px; border: none;" title="View">
                                            </a>
                                        </div>

                                        
                                            
                                            
                                            </td>

                                            
                                                

                                
                                        
                                        <!-- Modal container -->
                                        <div id="myModal" class="modal fade"></div>

                                    <?php
                                        
                                        }
                                        
                                        
                        
                        ?>
                        
                        
                        
                        
                        
                        </tbody>
                    
                    </table>
                       
                        <?php








}

elseif($selectedOption === 'Common Training'){



    
    
    ?>   
   
                <table id="example23" class="display"  style="width:100%; overflow-x: auto;  white-space: nowrap;   display: block;">
                        <thead>
                        
                            <tr>
                                <th style=" width: 5px;">Select</th>
                                <th style=" text-align: center;">Transaction Number</th>
                                <th style=" text-align: center;" >Training Topic</th>
                                <th style=" text-align: center;" >Training Type</th>
                                <th style=" text-align: center;">Target Date</th>
                                <th style=" text-align: center;">End Date</th>
                                <th style=" text-align: center;">Requestor Name</th>
                                <th style=" text-align: center;">Section</th>
                                <th style=" text-align: center;">Status</th>
                                <th style=" text-align: center;">Action</th>
                            </tr>
                            <tr>
                                <th style=" width: 5px;">Select</th>
                                <th style=" text-align: center;">Transaction Number</th>
                                <th style=" text-align: center;" >Training Topic</th>
                                <th style=" text-align: center;" >Training Type</th>
                                <th style=" text-align: center;">Target Date</th>
                                <th style=" text-align: center;">End Date</th>
                                <th style=" text-align: center;">Requestor Name</th>
                                <th style=" text-align: center;">Section</th>
                                <th style=" text-align: center;">Status</th>
                                <th style=" text-align: center;"></th>
                            </tr>
                        </thead>
                        <tbody>

                        
                    <?php
                        $query_trainingrequest = "
                                    WITH CTE AS (
                                        SELECT *,
                                            ROW_NUMBER() OVER (PARTITION BY RequestNumber ORDER BY (SELECT NULL)) AS RowNum
                                        FROM [dbo].[tbl_topic_LIST_commontraining_MAINREQUEST]
                        
                                    )
                                    SELECT *
                                    FROM CTE
                                    WHERE RowNum = 1";




                        $stmt_trainingrequest = sqlsrv_query($conn,$query_trainingrequest);
                                        while($row = sqlsrv_fetch_array($stmt_trainingrequest, SQLSRV_FETCH_ASSOC)) {
                                            $id = $row['ID'];
                                            $requestnumber = $row['RequestNumber'];
                                            $requestdate= $row['Date_Requested'];
                                         
                                            $topic = $row['Topic'];
                                            $typeoftraining = $row['Type of Training'];
                                            $requestorname = $row['Requestor_Name'];
                                            $section = $row['Section'];
                                         
                                        
                                            $startdate = $row['Start Date'];
                                            $end = $row['End Date'];
                                            $employeenumber =  $row['Employee_Number'];
                                            $employeename =  $row['Employee_Name'];
                                            $statusrequestnumber = $row['StatusRequestNumber'];
                                            $status = $row['Status'];
                                         
                        

                                            // Add a class to highlight row green if status is "PASSED"
                                            $rowClass = ($status === 'DONE') ? 'passed-row' : '';
                                            
                                            
                             

                                            echo

                                            '<tr class="' . $rowClass . '">
                                                <td style="width: 5px; text-align: center;"> <input type="checkbox" name="selected[]" class="single-checkbox" id="selected" value="'.$id.'"></td>
                                                <td style=" text-align: center;">'  . $row['RequestNumber'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Topic'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Type of Training'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Start Date'] .'</td>
                                                <td style=" text-align: center;">'  . $row['End Date'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Requestor_Name'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Section'] .'</td>
                                                <td style=" text-align: center;">'  . $row['StatusRequestNumber'] .'</td>
                                            
                                                
                                                
                                                
                                                
                                            
                                            ';
                                            ?>
                                            
                                            <td>
                                            <div style="display: inline-block;">
                                            <?php
                                            
                                    
                                        
                                            if ($requestorname === $userfullname && $typeoftraining === 'E-LEARNING') {
                                                if ($status !== 'DONE') {
                                                                    echo '<a href="scoring_commontraining.php?TrainingrequestID='.$requestnumber.'&TrainingTopic='.$topic.'"  class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                                            <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Click to fill-up scores">
                                                                        </a>';
                                                                } else {
                                                                    echo '<button onclick="alert(\'You have already passed the exam.\')" class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                                            <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Already filled-out scores">
                                                                        </button>';
                                                                }
                                                        }
                                                        //will change condition to all PE Training PIC
                                                        elseif($userposition === 'Senior Engineer' && $typeoftraining === 'FACE TO FACE'){
                                                            echo '<a href="scoring_commontraining.php?TrainingrequestID='.$requestnumber.'&TrainingTopic='.$topic.'"  class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                            <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Click to fill-up scores">
                                                        </a>';

                                                        }
                                                        
                                                        
                                                        else {
                                                            echo '<a href="#" onclick="alert(\'You have no permission to fill-out scores.\')" class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                                    <img src="assets/img/quizbw.png" style="width: 35px; height: 35px; border: none;" title="No Permission to fill-up scores">
                                                                </a>';
                                                        }
                                            ?>
                                        </div>
                                    
                                        <!-- Additional button -->
                                        <div style="display: inline-block;">
                                        <a href="soldering_scoring_view.php?TransactionNumber=<?php echo $requestnumber; ?>&TrainingTopic=<?php echo $topic; ?>" class="btn btn-info" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                <img src="assets/img/pdf.png" style="width: 35px; height: 35px; border: none;" title="View">
                                            </a>
                                        </div>

                                        
                                            
                                            
                                            </td>

                                            
                                                

                                
                                        
                                        <!-- Modal container -->
                                        <div id="myModal" class="modal fade"></div>

                                    <?php
                                        
                                        }
                                        
                                        
                        
                        ?>
                        
                        
                        
                        
                        
                        </tbody>
                    
                    </table>
                       
                        <?php








}


elseif($selectedOption === 'Prod. Hashira'){



    
    
    ?>   
   
                <table id="example23" class="display"  style="width:100%; overflow-x: auto;  white-space: nowrap;   display: block;">
                        <thead>
                        
                            <tr>
                                <th style=" width: 5px;">Select</th>
                                <th style=" text-align: center;">Transaction Number</th>
                                <th style=" text-align: center;" >Training Topic</th>
                                <th style=" text-align: center;" >Training Type</th>
                                <th style=" text-align: center;">Target Date</th>
                                <th style=" text-align: center;">End Date</th>
                                <th style=" text-align: center;">Requestor Name</th>
                                <th style=" text-align: center;">Section</th>
                                <th style=" text-align: center;">Status</th>
                                <th style=" text-align: center;">Action</th>
                            </tr>
                            <tr>
                                <th style=" width: 5px;">Select</th>
                                <th style=" text-align: center;">Transaction Number</th>
                                <th style=" text-align: center;" >Training Topic</th>
                                <th style=" text-align: center;" >Training Type</th>
                                <th style=" text-align: center;">Target Date</th>
                                <th style=" text-align: center;">End Date</th>
                                <th style=" text-align: center;">Requestor Name</th>
                                <th style=" text-align: center;">Section</th>
                                <th style=" text-align: center;">Status</th>
                                <th style=" text-align: center;"></th>
                            </tr>
                        </thead>
                        <tbody>

                        
                    <?php
                        $query_trainingrequest = "
                                    WITH CTE AS (
                                        SELECT *,
                                            ROW_NUMBER() OVER (PARTITION BY RequestNumber ORDER BY (SELECT NULL)) AS RowNum
                                        FROM [dbo].[tbl_topic_LIST_hashira_MAINREQUEST]
                        
                                    )
                                    SELECT *
                                    FROM CTE
                                    WHERE RowNum = 1";




                        $stmt_trainingrequest = sqlsrv_query($conn,$query_trainingrequest);
                                        while($row = sqlsrv_fetch_array($stmt_trainingrequest, SQLSRV_FETCH_ASSOC)) {
                                            $id = $row['ID'];
                                            $requestnumber = $row['RequestNumber'];
                                            $requestdate= $row['Date_Requested'];
                                         
                                            $topic = $row['Topic'];
                                            $typeoftraining = $row['Type of Training'];
                                            $requestorname = $row['Requestor_Name'];
                                            $section = $row['Section'];
                                         
                                        
                                            $startdate = $row['Start Date'];
                                            $end = $row['End Date'];
                                            $employeenumber =  $row['Employee_Number'];
                                            $employeename =  $row['Employee_Name'];
                                            $statusrequestnumber = $row['StatusRequestNumber'];
                                            $status = $row['Status'];
                                         
                        

                                            // Add a class to highlight row green if status is "PASSED"
                                            $rowClass = ($status === 'DONE') ? 'passed-row' : '';
                                            
                                            
                             

                                            echo

                                            '<tr class="' . $rowClass . '">
                                                <td style="width: 5px; text-align: center;"> <input type="checkbox" name="selected[]" class="single-checkbox" id="selected" value="'.$id.'"></td>
                                                <td style=" text-align: center;">'  . $row['RequestNumber'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Topic'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Type of Training'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Start Date'] .'</td>
                                                <td style=" text-align: center;">'  . $row['End Date'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Requestor_Name'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Section'] .'</td>
                                                <td style=" text-align: center;">'  . $row['StatusRequestNumber'] .'</td>
                                            
                                                
                                                
                                                
                                                
                                            
                                            ';
                                            ?>
                                            
                                            <td>
                                            <div style="display: inline-block;">
                                            <?php
                                            
                                    
                                        
                                            if ($requestorname === $userfullname && $typeoftraining === 'E-LEARNING') {
                                                if ($status !== 'DONE') {
                                                                    echo '<a href="scoring_prodhashira.php?TrainingrequestID='.$requestnumber.'&TrainingTopic='.$topic.'"  class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                                            <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Click to fill-up scores">
                                                                        </a>';
                                                                } else {
                                                                    echo '<button onclick="alert(\'You have already passed the exam.\')" class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                                            <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Already filled-out scores">
                                                                        </button>';
                                                                }
                                                        }
                                                        //will change condition to all PE Training PIC
                                                        elseif($userposition === 'Senior Engineer' && $typeoftraining === 'FACE TO FACE'){
                                                            echo '<a href="scoring_prodhashira.php?TrainingrequestID='.$requestnumber.'&TrainingTopic='.$topic.'"  class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                            <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Click to fill-up scores">
                                                        </a>';

                                                        }
                                                        
                                                        
                                                        else {
                                                            echo '<a href="#" onclick="alert(\'You have no permission to fill-out scores.\')" class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                                    <img src="assets/img/quizbw.png" style="width: 35px; height: 35px; border: none;" title="No Permission to fill-up scores">
                                                                </a>';
                                                        }
                                            ?>
                                        </div>
                                    
                                        <!-- Additional button -->
                                        <div style="display: inline-block;">
                                        <a href="soldering_scoring_view.php?TransactionNumber=<?php echo $requestnumber; ?>&TrainingTopic=<?php echo $topic; ?>" class="btn btn-info" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                <img src="assets/img/pdf.png" style="width: 35px; height: 35px; border: none;" title="View">
                                            </a>
                                        </div>

                                        
                                            
                                            
                                            </td>

                                            
                                                

                                
                                        
                                        <!-- Modal container -->
                                        <div id="myModal" class="modal fade"></div>

                                    <?php
                                        
                                        }
                                        
                                        
                        
                        ?>
                        
                        
                        
                        
                        
                        </tbody>
                    
                    </table>
                       
                        <?php








}




elseif($selectedOption === 'Technical Standard'){



    
    
    ?>   
   
                <table id="example23" class="display"  style="width:100%; overflow-x: auto;  white-space: nowrap;   display: block;">
                        <thead>
                        
                            <tr>
                                <th style=" width: 5px;">Select</th>
                                <th style=" text-align: center;">Transaction Number</th>
                                <th style=" text-align: center;" >Training Topic</th>
                                <th style=" text-align: center;" >Training Type</th>
                                <th style=" text-align: center;">Target Date</th>
                                <th style=" text-align: center;">End Date</th>
                                <th style=" text-align: center;">Requestor Name</th>
                                <th style=" text-align: center;">Section</th>
                                <th style=" text-align: center;">Status</th>
                                <th style=" text-align: center;">Action</th>
                            </tr>
                            <tr>
                                <th style=" width: 5px;">Select</th>
                                <th style=" text-align: center;">Transaction Number</th>
                                <th style=" text-align: center;" >Training Topic</th>
                                <th style=" text-align: center;" >Training Type</th>
                                <th style=" text-align: center;">Target Date</th>
                                <th style=" text-align: center;">End Date</th>
                                <th style=" text-align: center;">Requestor Name</th>
                                <th style=" text-align: center;">Section</th>
                                <th style=" text-align: center;">Status</th>
                                <th style=" text-align: center;"></th>
                            </tr>
                        </thead>
                        <tbody>

                        
                    <?php
                        $query_trainingrequest = "
                                    WITH CTE AS (
                                        SELECT *,
                                            ROW_NUMBER() OVER (PARTITION BY RequestNumber ORDER BY (SELECT NULL)) AS RowNum
                                        FROM [dbo].[tbl_topic_LIST_technicalstandard_MAINREQUEST]
                        
                                    )
                                    SELECT *
                                    FROM CTE
                                    WHERE RowNum = 1";




                        $stmt_trainingrequest = sqlsrv_query($conn,$query_trainingrequest);
                                        while($row = sqlsrv_fetch_array($stmt_trainingrequest, SQLSRV_FETCH_ASSOC)) {
                                            $id = $row['ID'];
                                            $requestnumber = $row['RequestNumber'];
                                            $requestdate= $row['Date_Requested'];
                                         
                                            $topic = $row['Topic'];
                                            $typeoftraining = $row['Type of Training'];
                                            $requestorname = $row['Requestor_Name'];
                                            $section = $row['Section'];
                                         
                                        
                                            $startdate = $row['Start Date'];
                                            $end = $row['End Date'];
                                            $employeenumber =  $row['Employee_Number'];
                                            $employeename =  $row['Employee_Name'];
                                            $statusrequestnumber = $row['StatusRequestNumber'];
                                            $status = $row['Status'];
                                         
                        

                                            // Add a class to highlight row green if status is "PASSED"
                                            $rowClass = ($status === 'DONE') ? 'passed-row' : '';
                                            
                                            
                             

                                            echo

                                            '<tr class="' . $rowClass . '">
                                                <td style="width: 5px; text-align: center;"> <input type="checkbox" name="selected[]" class="single-checkbox" id="selected" value="'.$id.'"></td>
                                                <td style=" text-align: center;">'  . $row['RequestNumber'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Topic'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Type of Training'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Start Date'] .'</td>
                                                <td style=" text-align: center;">'  . $row['End Date'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Requestor_Name'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Section'] .'</td>
                                                <td style=" text-align: center;">'  . $row['StatusRequestNumber'] .'</td>
                                            
                                                
                                                
                                                
                                                
                                            
                                            ';
                                            ?>
                                            
                                            <td>
                                            <div style="display: inline-block;">
                                            <?php
                                            
                                    
                                        
                                            if ($requestorname === $userfullname && $typeoftraining === 'E-LEARNING') {
                                                if ($status !== 'DONE') {
                                                                    echo '<a href="scoring_techstandard.php?TrainingrequestID='.$requestnumber.'&TrainingTopic='.$topic.'"  class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                                            <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Click to fill-up scores">
                                                                        </a>';
                                                                } else {
                                                                    echo '<button onclick="alert(\'You have already passed the exam.\')" class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                                            <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Already filled-out scores">
                                                                        </button>';
                                                                }
                                                        }
                                                        //will change condition to all PE Training PIC
                                                        elseif($userposition === 'Senior Engineer' && $typeoftraining === 'FACE TO FACE'){
                                                            echo '<a href="scoring_techstandard.php?TrainingrequestID='.$requestnumber.'&TrainingTopic='.$topic.'"  class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                            <img src="assets/img/quiz.png" style="width: 35px; height: 35px; border: none;" title="Click to fill-up scores">
                                                        </a>';

                                                        }
                                                        
                                                        
                                                        else {
                                                            echo '<a href="#" onclick="alert(\'You have no permission to fill-out scores.\')" class="btn btn-warning" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                                    <img src="assets/img/quizbw.png" style="width: 35px; height: 35px; border: none;" title="No Permission to fill-up scores">
                                                                </a>';
                                                        }
                                            ?>
                                        </div>
                                    
                                        <!-- Additional button -->
                                        <div style="display: inline-block;">
                                        <a href="soldering_scoring_view.php?TransactionNumber=<?php echo $requestnumber; ?>&TrainingTopic=<?php echo $topic; ?>" class="btn btn-info" style="background-color: transparent; border: none; text-align: center; align-items: center; display: flex; color: white;">
                                                <img src="assets/img/pdf.png" style="width: 35px; height: 35px; border: none;" title="View">
                                            </a>
                                        </div>

                                        
                                            
                                            
                                            </td>

                                            
                                                

                                
                                        
                                        <!-- Modal container -->
                                        <div id="myModal" class="modal fade"></div>

                                    <?php
                                        
                                        }
                                        
                                        
                        
                        ?>
                        
                        
                        
                        
                        
                        </tbody>
                    
                    </table>
                       
                        <?php








}
else {
    // Handle invalid selection
    echo "Please select a valid option.";
    exit;
}


?>



<script>
       new DataTable('#example23', {
            initComplete: function () {
                this.api()
                    .columns([1,2,3,4,5,6,7,8])
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
        { orderable: false, targets: [1,2,3,4,5,6,7,8,9] }
        ]
        });


  </script>








