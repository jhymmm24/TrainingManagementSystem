<?php 




include 'Connection/connection.php';



// Retrieve selected common training from AJAX request
//

// Perform database query based on the selected option
// $section = $_POST['section'];
$section = isset($_POST['section']) ? $_POST['section'] : 'Unknown Section';
$topic = isset($_POST['topic']) ? $_POST['topic'] : 'Unknown Topic';
$topicDropdown = isset($_POST['topicDropdown']) ? $_POST['topicDropdown'] : 'Unknown topicDropdown';




//   // Safely echo the selected topic and section
//   echo "The selected section is: " . htmlspecialchars($section). "<br>";
//   echo "The selected topic category is: " . htmlspecialchars($topic). "<br>";
//   echo "The selected Dropdown topic is: " . htmlspecialchars($topicDropdown);
  



   
   // Check if $topic is 'commontraining'
if ($topic == 'commontraining') {
   
       
    if (isset($_POST['section']) && isset($_POST['topicDropdown'])) {
        $section = $_POST['section'];
        $topicDropdown = $_POST['topicDropdown'];
        

    
        // Define the columns to display based on the selected topic
        $defaultColumns = array('Employee_Number', 'Employee_Name', 'Position','Email'); // Default columns
        $topicSpecificColumns = array();
    
        // Add topic-specific columns
        if ($topicDropdown == 'Train the Trainers') {
            $topicSpecificColumns[] = 'Train_the_Trainers';
        }
        elseif ($topicDropdown == 'IE Techniques') {
            $topicSpecificColumns[] = 'IE_Techniques';
        }
        elseif ($topicDropdown == 'TWI -JR') {
            $topicSpecificColumns[] = 'TWI_JR';
        }
        elseif ($topicDropdown == 'TWI -JR') {
            $topicSpecificColumns[] = 'TWI_JI';
        }
        elseif ($topicDropdown == 'ISO90001 (QMS)') {
            $topicSpecificColumns[] = 'ISO90001_QMS';
        }
        elseif ($topicDropdown == 'QCC Basic Knowledge (QC 7 Tools)') {
            $topicSpecificColumns[] = 'QCC_Basic_Knowledge_QC_7_Tools';
        }
        elseif ($topicDropdown == 'Proposal Activity') {
            $topicSpecificColumns[] = 'Proposal_Activity';
        }
        elseif ($topicDropdown == 'Excel Macro Training') {
            $topicSpecificColumns[] = 'Excel_Macro_Training';
        }
        elseif ($topicDropdown == 'Safety Training') {
            $topicSpecificColumns[] = 'Safety_Training';
        }
        elseif ($topicDropdown == 'Quality Education') {
            $topicSpecificColumns[] = 'Quality_Education';
        }
        elseif ($topicDropdown == 'Fundamentals of Acceptance Sampling') {
            $topicSpecificColumns[] = 'Fundamentals_of_Acceptance_Sampling';
        }
        elseif ($topicDropdown == 'Zero Defects Through Poka Yoke') {
            $topicSpecificColumns[] = 'Zero_Defects_Through_Poka_Yoke';
        }
        elseif ($topicDropdown == 'Advanced Pull Manufacturing with Heijunka') {
            $topicSpecificColumns[] = 'Advanced_Pull_Manufacturing_with_Heijunka';
        }
        elseif ($topicDropdown == 'Achieving High Results Through People') {
            $topicSpecificColumns[] = 'Achieving_High_Results_Through_People';
        }
        else{
            echo "Column not found in database...";
        }
    
    
    
    
        $columnsToDisplay = array_merge($defaultColumns, $topicSpecificColumns);
    
        // Query to fetch data based on section and selected columns
        $sql_getdata = "SELECT " . implode(', ', $columnsToDisplay) . " FROM [dbo].[tbl_topic_LIST_commontraining] WHERE Section = ?";
        $params = array($section);
        $stmt = sqlsrv_query($conn, $sql_getdata, $params);
    
        if ($stmt === false) {
            echo "Error in executing query.<br/>";
            die(print_r(sqlsrv_errors(), true));
        }
    
        // Build the table header
        echo '<table id="example23" class="display" style="width:100%; overflow-x: auto; white-space: nowrap; display: block;">
              <thead>
                  <tr>
                      <th><input type="checkbox" id="all" name="selected[]" onclick="toggle(this);" style="width: 30px; height: 20px; accent-color: green;">Select Low Skill Map Score</th>';
        foreach ($columnsToDisplay as $column) {
            echo "<th>$column</th>";
        }
        echo '</tr>
              </thead>
              <tbody>';
    
        // Fetch and populate table data
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            // Check if any value in topicSpecificColumns is greater than 3
            $greaterThan3 = false;
            foreach ($topicSpecificColumns as $topicColumn) {
                if ($row[$topicColumn] <= 1) {
                    $greaterThan3 = true;
                    break;
                }
            }
    
            // Set row style based on the condition
            $rowStyle = $greaterThan3 ? " style='background-color: #C53224;'" : "";
    
            echo "<tr$rowStyle>";
            echo "<td><input type='checkbox'  style='width: 50px; height: 20px;' class='row-checkbox' name='row_checkbox[]' value='" . $row['Employee_Number'] . "'></td>";
            foreach ($columnsToDisplay as $column) {
                echo "<td data-column-name='$column'>{$row[$column]}</td>";
            }
            echo "</tr>";
        }
        echo '</tbody>
              </table>';
    }
    


    }
    // Check if $topic is 'qualityanalysis'
 elseif ($topic == 'qualityanalysis') {


   
    if (isset($_POST['section']) && isset($_POST['topicDropdown'])) {
        $section = $_POST['section'];
        $topicDropdown = $_POST['topicDropdown'];
    
        // Define the columns to display based on the selected topic
        $defaultColumns = array('Employee_Number', 'Employee_Name', 'Position','Email'); // Default columns
        $topicSpecificColumns = array();
    
        // Add topic-specific columns
        if ($topicDropdown == 'Product Introduction') {
            $topicSpecificColumns[] = 'Product_Introduction';
        } elseif ($topicDropdown == 'Quality Criteria (Defects)') {
            $topicSpecificColumns[] = 'Quality_Criteria_Defects';
        } elseif ($topicDropdown == 'Basic Cassette Troubleshooting') {
            $topicSpecificColumns[] = 'Basic_Cassette_Troubleshooting';
        }
    
        $columnsToDisplay = array_merge($defaultColumns, $topicSpecificColumns);
    
        // Query to fetch data based on section and selected columns
        $sql_getdata = "SELECT " . implode(', ', $columnsToDisplay) . " FROM tbl_topic_LIST_qualityanalysis WHERE Section = ?";
        $params = array($section);
        $stmt = sqlsrv_query($conn, $sql_getdata, $params);
    
        if ($stmt === false) {
            echo "Error in executing query.<br/>";
            die(print_r(sqlsrv_errors(), true));
        }
    
        // Build the table header
        echo '<table id="example23" class="display" style="width:100%; overflow-x: auto; white-space: nowrap; display: block;">
              <thead>
                  <tr>
                      <th><input type="checkbox"  id="all" name="selected[]" onclick="toggle(this);" style="width: 30px; height: 20px; accent-color: green;">Select Low Skill Map Score</th>';
        foreach ($columnsToDisplay as $column) {
            echo "<th>$column</th>";
        }
        echo '</tr>
              </thead>
              <tbody>';
    
        // Fetch and populate table data
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            // Check if any value in topicSpecificColumns is greater than 3
            $greaterThan3 = false;
            foreach ($topicSpecificColumns as $topicColumn) {
                if ($row[$topicColumn] <= 1) {
                    $greaterThan3 = true;
                    break;
                }
            }
    
            // Set row style based on the condition
            $rowStyle = $greaterThan3 ? " style='background-color: #C53224;'" : "";
    
            echo "<tr$rowStyle>";
            echo "<td><input type='checkbox'    style='width: 50px; height: 20px;' class='row-checkbox' name='row_checkbox[]' value='" . $row['Employee_Number'] . "'></td>";
            foreach ($columnsToDisplay as $column) {
                echo "<td data-column-name='$column'>{$row[$column]}</td>";
            }
            echo "</tr>";
        }
        echo '</tbody>
              </table>';
    }
  
    
                   
         
        
     // Check if $topic is 'workstandard'
 }elseif ($topic == 'workstandard') {
 
    
    if (isset($_POST['section']) && isset($_POST['topicDropdown'])) {
        $section = $_POST['section'];
        $topicDropdown = $_POST['topicDropdown'];
        
       
    
        // Define the columns to display based on the selected topic
        $defaultColumns = array('Employee_Number', 'Employee_Name', 'Position','Email'); // Default columns
        $topicSpecificColumns = array();
    
        // Add topic-specific columns
        if ($topicDropdown == 'Work Standard for Preparing Process Control Charts') {
            $topicSpecificColumns[] = 'Work_Standard_for_Preparing_Process_Control_Charts';
        } elseif ($topicDropdown == 'Work Standard for Analysis Techniques') {
            $topicSpecificColumns[] = 'Work_Standard_for_Analysis_Techniques';
        } elseif ($topicDropdown == 'Standard for Intermediate_Materials Production Quantity Comparison') {
            $topicSpecificColumns[] = 'Standard_for_Intermediate_Materials_Production_Quantity_Comparison';
        }elseif ($topicDropdown == 'Standard for Determining Standard Times for Assembly Processes') {
            $topicSpecificColumns[] = 'Standard_for_Determining_Standard_Times_for_Assembly_Processes';
        }elseif ($topicDropdown == 'Work Standard for Jig Specification Preparation') {
            $topicSpecificColumns[] = 'Work_Standard_for_Jig_Specification_Preparation';
        }elseif ($topicDropdown == 'Work Standard for Preparing Job Instruction Sheets') {
            $topicSpecificColumns[] = 'Work Standard for Preparing Job Instruction Sheets';
        }elseif ($topicDropdown == 'Work Standard for Specification Kanban') {
            $topicSpecificColumns[] = 'Work_Standard_for_Specification_Kanban';

        }elseif ($topicDropdown === 'Work Standard for Man-hour control') {
            $topicSpecificColumns[] = 'Work_Standard_for_Man_hour_control';




        }elseif ($topicDropdown == 'Work Standard for Process Design') {
            $topicSpecificColumns[] = 'Work_Standard_for_Process_Design';
        }elseif ($topicDropdown == 'Work Standard for Learning Curve and Line Establishment') {
            $topicSpecificColumns[] = 'Work_Standard_for_Learning_Curve_and_Line_Establishment';
        }elseif ($topicDropdown == 'Work Standard for Prevention of Total_Defect') {
            $topicSpecificColumns[] = 'Work_Standard_for_Prevention_of_Total_Defect';
        }elseif ($topicDropdown == 'Work Standard for Preparation of New Jig Models') {
            $topicSpecificColumns[] = 'Work_Standard_for_Preparation_of_New_Jig_Models';
        }elseif ($topicDropdown == 'Work Standard for Assembly Lines') {
            $topicSpecificColumns[] = 'Work_Standard_for_Assembly_Lines';
        }elseif ($topicDropdown == 'Work Standard for Training to Improve Abilities of Inspectors') {
            $topicSpecificColumns[] = 'Work_Standard_for_Training_to_Improve_Abilities_of_Inspectors';
        }elseif ($topicDropdown == 'Work Standard for Container Inspection before Loading') {
            $topicSpecificColumns[] = 'Work_Standard_for_Container_Inspection_before_Loading';
        }
        elseif ($topicDropdown == 'Work Standard for Part Distribution') {
            $topicSpecificColumns[] = 'Work_Standard_for_Part_Distribution';
        }
        elseif ($topicDropdown == 'Work Standard for Warehouse Layout') {
            $topicSpecificColumns[] = 'Work_Standard_for_Warehouse_Layout';
        }
        elseif ($topicDropdown == 'Work Standard for PS Processes') {
            $topicSpecificColumns[] = 'Work_Standard_for_PS_Processes';
        }
        elseif ($topicDropdown == 'Work Standard for Parts Acceptance Inspection') {
            $topicSpecificColumns[] = 'Work_Standard_for_Parts_Acceptance_Inspection';
        }
        elseif ($topicDropdown == 'Work Standard for Factory Efficiency Manhour_Management') {
            $topicSpecificColumns[] = 'Work_Standard_for_Factory_Efficiency_Manhour_Management';
        }
        elseif ($topicDropdown == 'Work Standard for Direct and Indirect Operation Optimization Activities') {
            $topicSpecificColumns[] = 'Work_Standard_for_Direct_and_Indirect_Operation_Optimization_Activities';
        }
        elseif ($topicDropdown == 'Work Standard for Factory Concurrency Progress') {
            $topicSpecificColumns[] = 'Work_Standard_for_Factory_Concurrency_Progress';
        }
        elseif ($topicDropdown == 'Work Standard for Production Loss Debit Invoicing') {
            $topicSpecificColumns[] = 'Work_Standard_for_Production_Loss_Debit_Invoicing';
        }
        elseif ($topicDropdown == 'Work Standard for Assembly Fixtures') {
            $topicSpecificColumns[] = 'Work_Standard_for_Assembly_Fixtures';
        }
        elseif ($topicDropdown == 'Work Standard for Establishing New Models') {
            $topicSpecificColumns[] = 'Work_Standard_for_Establishing_New_Models';
        }
        elseif ($topicDropdown == 'Work Standard for Handling Belt Conveyors') {
            $topicSpecificColumns[] = 'Work_Standard_for_Handling_Belt_Conveyors';
        }
    
    
    
    
        $columnsToDisplay = array_merge($defaultColumns, $topicSpecificColumns);
    
        // Query to fetch data based on section and selected columns
        $sql_getdata = "SELECT " . implode(', ', $columnsToDisplay) . " FROM [dbo].[tbl_topic_LIST_workstandard] WHERE Section = ?";
        $params = array($section);
        $stmt = sqlsrv_query($conn, $sql_getdata, $params);
    
        if ($stmt === false) {
            echo "Error in executing query.<br/>";
            die(print_r(sqlsrv_errors(), true));
        }
    
        // Build the table header
        echo '<table id="example23" class="display" style="width:100%; overflow-x: auto; white-space: nowrap; display: block;">
              <thead>
                  <tr>
                  
                      <th><input type="checkbox" id="all" name="selected[]" onclick="toggle(this);" style="width: 30px; height: 20px; accent-color: green;">Select Low Skill Map Score</th>';
        foreach ($columnsToDisplay as $column) {
            echo "<th>$column</th>";
        }
        echo '</tr>
              </thead>
              <tbody>';
    
        // Fetch and populate table data
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            // Check if any value in topicSpecificColumns is greater than 3
            $greaterThan3 = false;
            foreach ($topicSpecificColumns as $topicColumn) {
                if ($row[$topicColumn] <= 1) {
                    $greaterThan3 = true;
                    break;
                }
            }
    
            // Set row style based on the condition
            $rowStyle = $greaterThan3 ? " style='background-color: #C53224;'" : "";
    
            echo "<tr$rowStyle>";
            echo "<td><input type='checkbox' class='row-checkbox' style='width: 50px; height: 20px;' name='row_checkbox[]' value='" . $row['Employee_Number'] . "'></td>";
            foreach ($columnsToDisplay as $column) {
                echo "<td data-column-name='$column'>{$row[$column]}</td>";
            }
            echo "</tr>";
        }
        echo '</tbody>
              </table>';
    }
  
               
              
                  
     
}

elseif ($topic == 'mgtgroupregulation') {
       
    if (isset($_POST['section']) && isset($_POST['topicDropdown'])) {
        $section = $_POST['section'];
        $topicDropdown = $_POST['topicDropdown'];
        
       
    
        // Define the columns to display based on the selected topic
        $defaultColumns = array('Employee_Number', 'Employee_Name', 'Position','Email'); // Default columns
        $topicSpecificColumns = array();
    
        // Add topic-specific columns
        if ($topicDropdown == 'Measuring instruments management procedure') {
            $topicSpecificColumns[] = 'Measuring_instruments_management_procedure';
        }
        elseif ($topicDropdown == 'Product Incident Handling Regulation') {
            $topicSpecificColumns[] = 'Product_Incident_Handling_Regulation';
        }
        elseif ($topicDropdown == 'Parts Storage Regulations') {
            $topicSpecificColumns[] = 'Parts_Storage_Regulations';
        }
        elseif ($topicDropdown == 'Regulations for process quality control') {
            $topicSpecificColumns[] = 'Regulations_for_process_quality_control';
        }
        elseif ($topicDropdown == 'Procedure for quality-related failure costs indicator management') {
            $topicSpecificColumns[] = 'Procedure_for_quality_related_failure_costs_indicator_management';
        }
        elseif ($topicDropdown == 'Regulation for Handling Critical Quality Problems') {
            $topicSpecificColumns[] = 'Regulation_for_Handling_Critical_Quality_Problems';
        }
        elseif ($topicDropdown == 'Product Safety Rules') {
            $topicSpecificColumns[] = 'Product_Safety_Rules';
        }
        elseif ($topicDropdown == 'Regulation for Quality Assurance') {
            $topicSpecificColumns[] = 'Regulation_for_Quality_Assurance';
        }
        elseif ($topicDropdown == 'Regulation for production daily control management') {
            $topicSpecificColumns[] = 'Regulation_for_production_daily_control_management';
        }
        else{
            echo "Column not found in database...";
        }
    
    
    
    
        $columnsToDisplay = array_merge($defaultColumns, $topicSpecificColumns);
    
        // Query to fetch data based on section and selected columns
        $sql_getdata = "SELECT " . implode(', ', $columnsToDisplay) . " FROM [dbo].[tbl_topic_LIST_mgtgroupregulation] WHERE Section = ?";
        $params = array($section);
        $stmt = sqlsrv_query($conn, $sql_getdata, $params);
    
        if ($stmt === false) {
            echo "Error in executing query.<br/>";
            die(print_r(sqlsrv_errors(), true));
        }
    
        // Build the table header
        echo '<table id="example23" class="display" style="width:100%; overflow-x: auto; white-space: nowrap; display: block;">
              <thead>
                  <tr>
                      <th><input type="checkbox"  id="all" name="selected[]" onclick="toggle(this);" style="width: 30px; height: 20px; accent-color: green;">Select Low Skill Map Score</th>';
        foreach ($columnsToDisplay as $column) {
            echo "<th>$column</th>";
        }
        echo '</tr>
              </thead>
              <tbody>';
    
        // Fetch and populate table data
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            // Check if any value in topicSpecificColumns is greater than 3
            $greaterThan3 = false;
            foreach ($topicSpecificColumns as $topicColumn) {
                if ($row[$topicColumn] <= 1) {
                    $greaterThan3 = true;
                    break;
                }
            }
    
            // Set row style based on the condition
            $rowStyle = $greaterThan3 ? " style='background-color: #C53224;'" : "";
    
            echo "<tr$rowStyle>";
            echo "<td><input type='checkbox' style='width: 50px; height: 20px;' class='row-checkbox' name='row_checkbox[]' value='" . $row['Employee_Number'] . "'></td>";
            foreach ($columnsToDisplay as $column) {
                echo "<td data-column-name='$column'>{$row[$column]}</td>";
            }
            echo "</tr>";
        }
        echo '</tbody>
              </table>';
    }
}


elseif ($topic == 'commonbusinessskills') {
       
    if (isset($_POST['section']) && isset($_POST['topicDropdown'])) {
        $section = $_POST['section'];
        $topicDropdown = $_POST['topicDropdown'];
        
       
    
        // Define the columns to display based on the selected topic
        $defaultColumns = array('Employee_Number', 'Employee_Name', 'Position','Email'); // Default columns
        $topicSpecificColumns = array();
    
        // Add topic-specific columns
        if ($topicDropdown == 'Instruction skills') {
            $topicSpecificColumns[] = 'Instruction_skills';
        }
        elseif ($topicDropdown == 'Problem handling skills') {
            $topicSpecificColumns[] = 'Problem_handling_skills';
        }
        elseif ($topicDropdown == 'Logical thinking') {
            $topicSpecificColumns[] = 'Logical_thinking';
        }
        elseif ($topicDropdown == 'Basic leadership') {
            $topicSpecificColumns[] = 'Basic_leadership';
        }
        elseif ($topicDropdown == 'Communication skills') {
            $topicSpecificColumns[] = 'Communication_skills';
        }
        elseif ($topicDropdown == 'Horenso') {
            $topicSpecificColumns[] = 'Horenso';
        }
        elseif ($topicDropdown == 'Time management') {
            $topicSpecificColumns[] = 'Time_management';
        }
        elseif ($topicDropdown == 'Writing skills') {
            $topicSpecificColumns[] = 'Writing_skills';
        }
        elseif ($topicDropdown == 'Illustration skills') {
            $topicSpecificColumns[] = 'Illustration_skills';
        }
        elseif ($topicDropdown == 'Presentation skills') {
            $topicSpecificColumns[] = 'Presentation_skills';
        }
        else{
            echo "Column not found in database...";
        }
    
    
    
    
        $columnsToDisplay = array_merge($defaultColumns, $topicSpecificColumns);
    
        // Query to fetch data based on section and selected columns
        $sql_getdata = "SELECT " . implode(', ', $columnsToDisplay) . " FROM [dbo].[tbl_topic_LIST_commonbusinesskill] WHERE Section = ?";
        $params = array($section);
        $stmt = sqlsrv_query($conn, $sql_getdata, $params);
    
        if ($stmt === false) {
            echo "Error in executing query.<br/>";
            die(print_r(sqlsrv_errors(), true));
        }
    
        // Build the table header
        echo '<table id="example23" class="display" style="width:100%; overflow-x: auto; white-space: nowrap; display: block;">
              <thead>
                  <tr>
                      <th><input type="checkbox" id="all" name="selected[]" onclick="toggle(this);" style="width: 30px; height: 20px; accent-color: green;">Select Low Skill Map Score</th>';
        foreach ($columnsToDisplay as $column) {
            echo "<th>$column</th>";
        }
        echo '</tr>
              </thead>
              <tbody>';
    
        // Fetch and populate table data
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            // Check if any value in topicSpecificColumns is greater than 3
            $greaterThan3 = false;
            foreach ($topicSpecificColumns as $topicColumn) {
                if ($row[$topicColumn] <= 1) {
                    $greaterThan3 = true;
                    break;
                }
            }
    
            // Set row style based on the condition
            $rowStyle = $greaterThan3 ? " style='background-color: #C53224;'" : "";
    
            echo "<tr$rowStyle>";
            echo "<td><input type='checkbox'  style='width: 50px; height: 20px;' class='row-checkbox' name='row_checkbox[]' value='" . $row['Employee_Number'] . "'></td>";
            foreach ($columnsToDisplay as $column) {
                echo "<td data-column-name='$column'>{$row[$column]}</td>";
            }
            echo "</tr>";
        }
        echo '</tbody>
              </table>';
    }
}



elseif ($topic == 'companyfundamentals') {
       
    if (isset($_POST['section']) && isset($_POST['topicDropdown'])) {
        $section = $_POST['section'];
        $topicDropdown = $_POST['topicDropdown'];
        
       
    
        // Define the columns to display based on the selected topic
        $defaultColumns = array('Employee_Number', 'Employee_Name', 'Position','Email'); // Default columns
        $topicSpecificColumns = array();
    
        // Add topic-specific columns
        if ($topicDropdown == 'Budgeting forecasting skills') {
            $topicSpecificColumns[] = 'Budgeting_forecasting_skills';
        }
        elseif ($topicDropdown == 'Financial reporting skills') {
            $topicSpecificColumns[] = 'Financial reporting skills';
        }
        elseif ($topicDropdown == 'Management skills') {
            $topicSpecificColumns[] = 'Management_skills';
        }
        elseif ($topicDropdown == 'Group improvement skills') {
            $topicSpecificColumns[] = 'Group_improvement_skills';
        }
        elseif ($topicDropdown == 'Individual improvement skills') {
            $topicSpecificColumns[] = 'Individual_improvement_skills';
        }
        
        else{
            echo "Column not found in database...";
        }
    
    
    
    
        $columnsToDisplay = array_merge($defaultColumns, $topicSpecificColumns);
    
        // Query to fetch data based on section and selected columns
        $sql_getdata = "SELECT " . implode(', ', $columnsToDisplay) . " FROM [dbo].[tbl_topic_LIST_commonbusinesskill] WHERE Section = ?";
        $params = array($section);
        $stmt = sqlsrv_query($conn, $sql_getdata, $params);
    
        if ($stmt === false) {
            echo "Error in executing query.<br/>";
            die(print_r(sqlsrv_errors(), true));
        }
    
        // Build the table header
        echo '<table id="example23" class="display" style="width:100%; overflow-x: auto; white-space: nowrap; display: block;">
              <thead>
                  <tr>
                      <th><input type="checkbox" id="all" name="selected[]" onclick="toggle(this);" style="width: 30px; height: 20px; accent-color: green;">Select Low Skill Map Score</th>';
        foreach ($columnsToDisplay as $column) {
            echo "<th>$column</th>";
        }
        echo '</tr>
              </thead>
              <tbody>';
    
        // Fetch and populate table data
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            // Check if any value in topicSpecificColumns is greater than 3
            $greaterThan3 = false;
            foreach ($topicSpecificColumns as $topicColumn) {
                if ($row[$topicColumn] <= 1) {
                    $greaterThan3 = true;
                    break;
                }
            }
    
            // Set row style based on the condition
            $rowStyle = $greaterThan3 ? " style='background-color: #C53224;'" : "";
    
            echo "<tr$rowStyle>";
            echo "<td><input type='checkbox'  style='width: 50px; height: 20px;' class='row-checkbox' name='row_checkbox[]' value='" . $row['Employee_Number'] . "'></td>";
            foreach ($columnsToDisplay as $column) {
                echo "<td data-column-name='$column'>{$row[$column]}</td>";
            }
            echo "</tr>";
        }
        echo '</tbody>
              </table>';
    }
}




  // Check if $topic is 'commontraining'
  elseif ($topic == 'prodhashira') {
    


    
    if (isset($_POST['section']) && isset($_POST['topicDropdown'])) {
        $section = $_POST['section'];
        $topicDropdown = $_POST['topicDropdown'];
        
       
    
        // Define the columns to display based on the selected topic
        $defaultColumns = array('Employee_Number', 'Employee_Name', 'Position','Email'); // Default columns
        $topicSpecificColumns = array();
    
        // Add topic-specific columns
        if ($topicDropdown == 'Observation Standard Operation') {
            $topicSpecificColumns[] = 'ObservationStandardOperation';
        }
        elseif ($topicDropdown == 'Limit Sample') {
            $topicSpecificColumns[] = 'LimitSample';
        }
        elseif ($topicDropdown == 'Quality Check Status by Supervisor') {
            $topicSpecificColumns[] = 'QualityCheckStatusBySupervisor';
        }
        elseif ($topicDropdown == 'Assembly Basic Action Check Status by Supervisor') {
            $topicSpecificColumns[] = 'AssemblyBasicActionCheckStatusBySupervisor';
        }
        elseif ($topicDropdown == 'Specification Change Work') {
            $topicSpecificColumns[] = 'SpecificationChangeWork';
        }
        elseif ($topicDropdown == 'First In First Out') {
            $topicSpecificColumns[] = 'FirstInFirstOut';
        }
        elseif ($topicDropdown == 'Maintain and control equipment, jig, tool and measuring instrument') {
            $topicSpecificColumns[] = 'MaintainAndControlEquipmentJigToolAndMeasuringInstrument';
        }
        elseif ($topicDropdown == 'Maintain and control work environment') {
            $topicSpecificColumns[] = 'MaintainAndControlWorkEnvironment';
        }
        elseif ($topicDropdown == 'Understanding Change point: Design Change') {
            $topicSpecificColumns[] = 'UnderstandingChangePointDesignChange';
        }
        elseif ($topicDropdown == 'Understanding Change point: Man') {
            $topicSpecificColumns[] = 'UnderstandingChangePointMan';
        }
        elseif ($topicDropdown == 'Understanding Change point: Awareness') {
            $topicSpecificColumns[] = 'UnderstandingChangePointAwareness';
        }
        elseif ($topicDropdown == 'Preparation for a change and quality Check method') {
            $topicSpecificColumns[] = 'PreparationForAChangeAndQualityCheckMethod';
        }
        elseif ($topicDropdown == 'Production Line stop in case of abnormality') {
            $topicSpecificColumns[] = 'ProductionLineStopInCaseOfAbnormality';
        }
        elseif ($topicDropdown == 'Recurrence prevention of in-process defect outflow') {
            $topicSpecificColumns[] = 'RecurrencePreventionOfInProcessDefectOutflow';
        }
        elseif ($topicDropdown == 'Recurrence prevention of in-process defect') {
            $topicSpecificColumns[] = 'RecurrencePreventionOfInProcessDefect';
        }
        elseif ($topicDropdown == 'Recurrence prevention from outflow to post process') {
            $topicSpecificColumns[] = 'RecurrencePreventionFromOutflowToPostProcess';
        }
        elseif ($topicDropdown == 'Important process control') {
            $topicSpecificColumns[] = 'ImportantProcessControl';
        }
        elseif ($topicDropdown == 'Control of Fabrication condition') {
            $topicSpecificColumns[] = 'ControlOfFabricationCondition';
        }
        elseif ($topicDropdown == 'Trend Control') {
            $topicSpecificColumns[] = 'TrendControl';
        }
        elseif ($topicDropdown == 'Quality Kiken Yochi') {
            $topicSpecificColumns[] = 'QualityKikenYochi';
        }
        elseif ($topicDropdown == 'Development of quality oriented personnel') {
            $topicSpecificColumns[] = 'DevelopmentOfQualityOrientedPersonnel';
        }
        elseif ($topicDropdown == 'Work Instruction Sheet') {
            $topicSpecificColumns[] = 'WorkInstructionSheet';
        }
        elseif ($topicDropdown == 'Process Organization Table: Inlne operation') {
            $topicSpecificColumns[] = 'ProcessOrganizationTableInlineOperation';
        }
        elseif ($topicDropdown == 'Process Organization Table: Offline Operation') {
            $topicSpecificColumns[] = 'ProcessOrganizationTableOfflineOperation';
        }
        elseif ($topicDropdown == 'Rules in Automated Operation') {
            $topicSpecificColumns[] = 'RulesInAutomatedOperation';
        }
        elseif ($topicDropdown == 'Understanding Production Progress') {
            $topicSpecificColumns[] = 'UnderstandingProductionProgress';
        }
        elseif ($topicDropdown == 'Root cause investigation') {
            $topicSpecificColumns[] = 'RootCauseInvestigation';
        }
        elseif ($topicDropdown == 'Implementation of Recovery measures') {
            $topicSpecificColumns[] = 'ImplementationOfRecoveryMeasures';
        }
        elseif ($topicDropdown == 'Proper Stock in Production Site') {
            $topicSpecificColumns[] = 'ProperStockInProductionSite';
        }
        elseif ($topicDropdown == 'Securing Manpower') {
            $topicSpecificColumns[] = 'SecuringManpower';
        }
        elseif ($topicDropdown == 'Human Resource Development') {
            $topicSpecificColumns[] = 'HumanResourceDevelopment';
        }
        elseif ($topicDropdown == 'Kitting') {
            $topicSpecificColumns[] = 'Kitting';
        }
        elseif ($topicDropdown == 'Cost Education and Reduction Activity') {
            $topicSpecificColumns[] = 'CostEducationAndReductionActivity';
        }
        elseif ($topicDropdown == 'Usage Control/Understanding Energy Cost') {
            $topicSpecificColumns[] = 'UsageControlUnderstandingEnergyCost';
        }
        elseif ($topicDropdown == 'Usage/Cost Control') {
            $topicSpecificColumns[] = 'UsageCostControl';
        }
        elseif ($topicDropdown == 'First-In, First-Out') {
            $topicSpecificColumns[] = 'FirstInFirstOut';
        }
        elseif ($topicDropdown == 'Labor Cost') {
            $topicSpecificColumns[] = 'LaborCost';
        }
        elseif ($topicDropdown == 'Control of Fixed Assets') {
            $topicSpecificColumns[] = 'ControlOfFixedAssets';
        }
        elseif ($topicDropdown == 'Used space in Production area') {
            $topicSpecificColumns[] = 'UsedSpaceInProductionArea';
        }
        elseif ($topicDropdown == 'Accuracy of Budget Control') {
            $topicSpecificColumns[] = 'AccuracyOfBudgetControl';
        }
        elseif ($topicDropdown == 'Reduction of Cost of Poor Quality') {
            $topicSpecificColumns[] = 'ReductionOfCostOfPoorQuality';
        }
        else{
            echo "Column not found in database...";
        }
    
    
    
    
        $columnsToDisplay = array_merge($defaultColumns, $topicSpecificColumns);
    
        // Query to fetch data based on section and selected columns
        $sql_getdata = "SELECT " . implode(', ', $columnsToDisplay) . " FROM [dbo].[tbl_topic_LIST_hashira] WHERE Section = ?";
        $params = array($section);
        $stmt = sqlsrv_query($conn, $sql_getdata, $params);
    
        if ($stmt === false) {
            echo "Error in executing query.<br/>";
            die(print_r(sqlsrv_errors(), true));
        }
    
        // Build the table header
        echo '<table id="example23" class="display" style="width:100%; overflow-x: auto; white-space: nowrap; display: block;">
              <thead>
                  <tr>
                      <th><input type="checkbox" id="all"  name="selected[]" onclick="toggle(this);" style="width: 30px; height: 20px; accent-color: green;">Select Low Skill Map Score</th>';
        foreach ($columnsToDisplay as $column) {
            echo "<th>$column</th>";
        }
        echo '</tr>
              </thead>
              <tbody>';
    
        // Fetch and populate table data
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            // Check if any value in topicSpecificColumns is greater than 3
            $greaterThan3 = false;
            foreach ($topicSpecificColumns as $topicColumn) {
                if ($row[$topicColumn] <= 1) {
                    $greaterThan3 = true;
                    break;
                }
            }
    
            // Set row style based on the condition
            $rowStyle = $greaterThan3 ? " style='background-color: #C53224;'" : "";
    
            echo "<tr$rowStyle>";
            echo "<td><input type='checkbox'  style='width: 50px; height: 20px;'  class='row-checkbox' name='row_checkbox[]' value='" . $row['Employee_Number'] . "'></td>";
            foreach ($columnsToDisplay as $column) {
                echo "<td data-column-name='$column'>{$row[$column]}</td>";
            }
            echo "</tr>";
        }
        echo '</tbody>
              </table>';
    }
}





  // Check if $topic is 'commontraining'
  elseif ($topic == 'PCBAprodhashira') {
    
    if (isset($_POST['section'])) {
        $section = $_POST['section'];
    
        // Check if section is 'PCBA' before querying the database
        if ($section == 'PCBA') {
            
            // Prepare the SQL query to fetch the required data
            $sql = "SELECT EmpNo, Full_Name, Position, Email 
                    FROM tbl_ems 
                    WHERE Section = ? AND Email IS NOT NULL";
    
            // Prepare and execute the query using parameterized statements
            $stmt = sqlsrv_query($conn, $sql, array($section));
    
            // Check if the query execution is successful
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
    
            // Build the table header
            echo '<table id="example23" class="display" style="width:100%; overflow-x: auto; white-space: nowrap; display: block;">
                  <thead>
                    <tr>
                    <th>Select</th>
                        <th>Employee Number</th>
                        <th>Employee Name</th>
                        <th>Position</th>
                        <th>Email</th>
                    </tr>
                  </thead>
                  <tbody>';
    
            // Fetch and populate table data
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                echo "<tr>
                         <td><input type='checkbox' class='row-checkbox' name='row_checkbox[]' value='" . $row['EmpNo'] . "'></td>
                        <td>" . htmlspecialchars($row['EmpNo']) . "</td>
                        <td>" . htmlspecialchars($row['Full_Name']) . "</td>
                        <td>" . htmlspecialchars($row['Position']) . "</td>
                        <td>" . htmlspecialchars($row['Email']) . "</td>
                      </tr>";
            }
    
            echo '</tbody>
                  </table>';
        } else {
            echo "Section is not PCBA.";
        }
    }

}









  // Check if $topic is 'techstandard'
  elseif ($topic == 'techstandard') {


    
    
    if (isset($_POST['section']) && isset($_POST['topicDropdown'])) {
        $section = $_POST['section'];
        $topicDropdown = $_POST['topicDropdown'];
        
       
    
        // Define the columns to display based on the selected topic
        $defaultColumns = array('Employee_Number', 'Employee_Name', 'Position','Email'); // Default columns
        $topicSpecificColumns = array();
    
        // Add topic-specific columns
        if ($topicDropdown == 'Standard for proces control chart') {
            $topicSpecificColumns[] = 'Standard_for_proces_control_chart';
        }
        elseif ($topicDropdown == 'Standard for Electronic Component Packaging and Storage') {
            $topicSpecificColumns[] = 'Standard_for_Electronic_Component_Packaging_and_Storage';
        }
        elseif ($topicDropdown == 'Air blow selection and installation work standard') {
            $topicSpecificColumns[] = 'Air_blow_selection_and_installation_work_standard';
        }
        elseif ($topicDropdown == 'Air blow work standard') {
            $topicSpecificColumns[] = 'Air_blow_work_standard';
        }
        elseif ($topicDropdown == 'Cleaning work standard in product assembling') {
            $topicSpecificColumns[] = 'Cleaning_work_standard_in_product_assembling';
        }
        elseif ($topicDropdown == 'Clean Bench Standard') {
            $topicSpecificColumns[] = 'Clean_Bench_Standard';
        }
        elseif ($topicDropdown == 'Screw tightening Equipment Selection/ Installation Standard') {
            $topicSpecificColumns[] = 'Screw_tightening_Equipment_Selection_Installation_Standard';
        }
        elseif ($topicDropdown == 'Electric Screwdriver work standard') {
            $topicSpecificColumns[] = 'Electric_Screwdriver_work_standard';
        }
        elseif ($topicDropdown == 'Standard for the operations carried out for preventing damage to the external parts operation') {
            $topicSpecificColumns[] = 'Standard_for_the_operations_carried_out_for_preventing_damage_to_the_external_parts_operation';
        }
        elseif ($topicDropdown == 'Standard for selection and installation ionizers') {
            $topicSpecificColumns[] = 'Standard_for_selection_and_installation_ionizers';
        }
        elseif ($topicDropdown == 'Work standard for installing ionizers') {
            $topicSpecificColumns[] = 'Work_standard_for_installing_ionizers';
        }
        elseif ($topicDropdown == 'Visual Appearance work standard') {
            $topicSpecificColumns[] = 'Visual_Appearance_work_standard';
        }
        elseif ($topicDropdown == 'Standard for appearance and visual check with limit samples') {
            $topicSpecificColumns[] = 'Standard_for_appearance_and_visual_check_with_limit_samples';
        }
        elseif ($topicDropdown == 'Production Equipments Maintenance Standard') {
            $topicSpecificColumns[] = 'Production_Equipments_Maintenance_Standard';
        }
        elseif ($topicDropdown == 'Lever-type Dial Gauge Handling Standard') {
            $topicSpecificColumns[] = 'Levertype_Dial_Gauge_Handling_Standard';
        }
        elseif ($topicDropdown == 'Standard for determining standard times for assembly processes') {
            $topicSpecificColumns[] = 'Standard_for_determining_standard_times_for_assembly_processes';
        }
        elseif ($topicDropdown == 'Standard for Standard Time Settings for Machining Operations') {
            $topicSpecificColumns[] = 'Standard_for_Standard_Time_Settings_for_Machining_Operations';
        }
        elseif ($topicDropdown == 'Basic Standardfor implementation of countermeasure against electrostatic damage') {
            $topicSpecificColumns[] = 'Basic_Standardfor_implementation_of_countermeasure_against_electrostatic_damge';
        }
        elseif ($topicDropdown == 'Standard for handling wrist strap') {
            $topicSpecificColumns[] = 'Standard_for_handling_wrist_strap';
        }
        elseif ($topicDropdown == 'Standard for handling conductive mat') {
            $topicSpecificColumns[] = 'Standard_for_handling_conductive_mat';
        }
        elseif ($topicDropdown == 'Standard for handling anti static shoes') {
            $topicSpecificColumns[] = 'Standard_for_handling_anti_static_shoes';
        }
        elseif ($topicDropdown == 'Standard for job instruction sheets') {
            $topicSpecificColumns[] = 'Standard_for_job_instruction_sheets';
        }
        elseif ($topicDropdown == 'Standard for Part Delivery Packaging') {
            $topicSpecificColumns[] = 'Standard_for_Part_Delivery_Packaging';
        }
        elseif ($topicDropdown == 'Standard for Preparing Process Analysis Tree Sheets') {
            $topicSpecificColumns[] = 'Standard_for_Preparing_Process_Analysis_Tree_Sheets';
        }
        elseif ($topicDropdown == 'Standard for Safety Tests in Production Processes') {
            $topicSpecificColumns[] = 'Standard_for_Safety_Tests_in_Production_Processes';
        }
        elseif ($topicDropdown == 'Torque Driver Work Standard ') {
            $topicSpecificColumns[] = 'Torque_Driver_Work_Standard';
        }
        elseif ($topicDropdown == 'Preparation and managerial standards of hand soldering tools ') {
            $topicSpecificColumns[] = 'Preparation_and_managerial_standards_of_hand_soldering_tools';
        }
        elseif ($topicDropdown == 'Hand Soldering Work Standard ') {
            $topicSpecificColumns[] = 'Hand_Soldering_Work_Standard';
        }
        elseif ($topicDropdown == 'Standards of Adhesion ') {
            $topicSpecificColumns[] = 'Standards_of_Adhesion';
        }
        elseif ($topicDropdown == 'Standard for Grease and Oil Applying Operation ') {
            $topicSpecificColumns[] = 'Standard_for_Grease_and_Oil_Applying_Operation';
        }
        elseif ($topicDropdown == 'Standard for Product Safety Risk Assessment ') {
            $topicSpecificColumns[] = 'Standard_for_Product_Safety_Risk_Assessment';
        }
        elseif ($topicDropdown == 'Standard for Determining Product Safety Markings ') {
            $topicSpecificColumns[] = 'Standard_for_Determining_Product_Safety_Markings';
        }
        elseif ($topicDropdown == 'Standard for Product Safety Information in Instruction Manuals ') {
            $topicSpecificColumns[] = 'Standard_for_Product_Safety_Information_in_Instruction_Manuals';
        }
        elseif ($topicDropdown == 'Standard for Safety Assurance Indications on Products ') {
            $topicSpecificColumns[] = 'Standard_for_Safety_Assurance_Indications_on_Products';
        }
        elseif ($topicDropdown == 'Air Cleanliness Measurement Standard') {
            $topicSpecificColumns[] = 'Air_Cleanliness_Measurement_Standard';
        }
        else{
            echo "Column not found in database...";
        }
    
    
    
    
        $columnsToDisplay = array_merge($defaultColumns, $topicSpecificColumns);
    
        // Query to fetch data based on section and selected columns
        $sql_getdata = "SELECT " . implode(', ', $columnsToDisplay) . " FROM [dbo].[tbl_topic_LIST_technicalstandard] WHERE Section = ?";
        $params = array($section);
        $stmt = sqlsrv_query($conn, $sql_getdata, $params);
    
        if ($stmt === false) {
            echo "Error in executing query.<br/>";
            die(print_r(sqlsrv_errors(), true));
        }
    
        // Build the table header
        echo '<table id="example23" class="display" style="width:100%; overflow-x: auto; white-space: nowrap; display: block;">
              <thead>
                  <tr>
                      <th><input type="checkbox" id="all" name="selected[]" onclick="toggle(this);" style="width: 30px; height: 20px; accent-color: green;">Select Low Skill Map Score</th>';
        foreach ($columnsToDisplay as $column) {
            echo "<th>$column</th>";
        }
        echo '</tr>
              </thead>
              <tbody>';
    
        // Fetch and populate table data
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            // Check if any value in topicSpecificColumns is greater than 3
            $greaterThan3 = false;
            foreach ($topicSpecificColumns as $topicColumn) {
                if ($row[$topicColumn] <= 1) {
                    $greaterThan3 = true;
                    break;
                }
            }
    
            // Set row style based on the condition
            $rowStyle = $greaterThan3 ? " style='background-color: #C53224;'" : "";
    
            echo "<tr$rowStyle>";
            echo "<td><input type='checkbox' style='width: 50px; height: 20px;'  class='row-checkbox' name='row_checkbox[]' value='" . $row['Employee_Number'] . "'></td>";
            foreach ($columnsToDisplay as $column) {
                echo "<td data-column-name='$column'>{$row[$column]}</td>";
            }
            echo "</tr>";
        }
        echo '</tbody>
              </table>';
    }
   

}





  // Check if $topic is 'Manual Soldering'
  elseif ($topic == 'Manual Soldering') {

    ?>
    <table id="trainingrequest" class="display">
        <thead>
                    
                         <tr>
                            <th style="text-align: center;"><input type="checkbox" id="all" name="all" onclick="toggle(this);" style="width: 15px;">Select All</th>
                        
                    
                            <th style="text-align: center;">Employee Number</th>
                            <th style="text-align: center;">Employee Name</th>
                            <th style="text-align: center;">Date Hired</th>
                            <th style="text-align: center;">Position</th>
                  
                        
                        
                        </tr>
         
        </thead>
        <tbody>
            <!-- Populate table body as needed -->
            <?php
            
            // Query to fetch data
            $sql_getdata = "SELECT * FROM  View_MasterList WHERE Section = '$section'";
    
        // Execute the query
        $stmt = sqlsrv_query($conn, $sql_getdata);
    
        // Fetch and populate table data
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            echo

            '<tr>
                <td style="width: 5px;"><input type="checkbox" name="row_checkbox[]" value="'. $row['EmpNo'] . '"></td>
                <td style="text-align: center;">'  . $row['EmpNo'] .'</td>
                <td style="text-align: center;">'  . $row['First_Name'] .' '  . $row['Family_Name'] .'</td>
                <td style="text-align: center;">'  . $row['Date_Hired'] .'</td>
                <td style="text-align: center;">'  . $row['Position'] .'</td>
            
               
            ';
        
        }
    
    
        
            ?>
            
        
                </tbody>
            </table>
        <?php

}











    
    



?>

<script>
new DataTable('#example23', {
    pageLength: 10000, 
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




<!-- <script>
  function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i] !== source) {
        checkboxes[i].checked = source.checked;
      }
    }
  }
</script> -->


<script>
function toggle(selectAllCheckbox) {
    // Select all checkboxes in the table
    const checkboxes = document.querySelectorAll('#example23 tbody .row-checkbox'); // Select only the checkboxes with the class 'row-checkbox'
    const rows = document.querySelectorAll('#example23 tbody tr'); // Get all rows

    checkboxes.forEach((checkbox, index) => {
        // Get the value of the Work_Standard_for_Man_hour_control column (5th column, zero-based index)
        const workStandardValue = rows[index].children[5].textContent.trim(); // Index 4 for 5th column
        
        // If the "Select All" checkbox is checked, check the row's checkbox if column 5 (index 4) is '1'
        if (selectAllCheckbox.checked) {
            if ((workStandardValue === '1')||(workStandardValue === '0')) {
                checkbox.checked = true; // Check the box if '1' is found
            } else {
                checkbox.checked = false; // Ensure it's unchecked if not '1'
            }
        } else {
            checkbox.checked = false; // Uncheck all if "Select All" is unchecked
        }
    });
}
</script>




<script>
new DataTable('#trainingrequest', {
    pageLength: 10000, 
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





