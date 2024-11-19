<?php
// Assuming you have established a database connection


include 'Connection/connection.php';

if(isset($_POST['search_term'])) {

    $searchTerm = $_POST['search_term'];

    ?>

<table id="example24" class="display" style="width:100%">
    <thead>
        <tr>
            <th style=" width: 5px;">Select</th>
            <th style=" text-align: center;">E-LEARNING TITLE</th>
            <th style=" text-align: center;" >Full Name</th>
            <th style=" text-align: center;">Section</th>
            <th style=" text-align: center;">Upload Date</th>
            <th style=" text-align: center;">Target Date</th>
            <th style=" text-align: center;">View</th>
         
        </tr>
        <tr>
        <th style=" width: 5px;"></th>
            <th style=" text-align: center;">E-LEARNING TITLE</th>
            <th style=" text-align: center;" >Full Name</th>
            <th style=" text-align: center;">Section</th>
            <th style=" text-align: center;">Upload Date</th>
            <th style=" text-align: center;">Target Date</th>
            <th style=" text-align: center;"></th>
        </tr>
    </thead>
    <tbody>

    <?php
           $trequest = "SELECT  * FROM [dbo].[tbl_elearningstatus] WHERE [Target Employee] LIKE :searchTerm";
           $stmt3 = sqlsrv_query($conn,$trequest);
           $stmt3->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
           $stmt3->execute();
           
                          while($row = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
                              $id = $row['ID'];
                              $title = $row['Title'];
                              $targetemployee= $row['Target Employee'];
                              $uploaddate = $row['Upload Date'];
                              $targetdate = $row['Target Date'];
                              $status = $row['Status'];
                              $section = $row['Section'];
                              //$employeeno = $row['EmployeeNumber'];
                            
                            
                              

                              echo

                              '<tr>
                                  <td style="width: 5px; text-align: center;"> <input type="checkbox" name="selected[]" class="single-checkbox" id="selected" value="'.$id.'"></td>
                                  <td style=" text-align: center;">'  . $row['Title'] .'</td>
                                  <td style=" text-align: center;">'  . $row['Title'] .'</td>
                                  <td style=" text-align: center;">'  . $row['Target Employee'] .'</td>
                                  <td style=" text-align: center;">'  . $row['Upload Date'] .'</td>
                                  <td style=" text-align: center;">'  . $row['Target Date'] .'</td>
                                  <td style=" text-align: center;">'; ?><button  type="button" class="openModalBtn" style="border:none;  background-color: transparent;" id="openModalBtn" data-id="<?php echo $transno?>"> <img src="assets/img/find.png" style ="width:35px; height:35px; border:none;" title="View Checking History"> </button>  <div id="myModal" class="modal fade"></div><?php '</td>
                                  
                              
                              ';
                         
                          }
                        
          
          ?>
                <!-- Modal container -->
              

              
          </tbody>
        
      </table>
      <?php

    


    

    // Perform database query with WHERE clause based on the search term
    // Replace 'your_table' with your actual table name and 'column_name' with the column you want to search
    $query = "SELECT  * FROM [dbo].[tbl_elearningstatus] WHERE [Target Employee] LIKE :searchTerm";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
    $statement->execute();
    
    // Build the HTML for the table
    $html = '<table border="1"><tr><th>ID</th><th>Name</th><th>Email</th></tr>';
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $html .= '<tr>';
        $html .= '<td>' . $row['Title'] . '</td>';
        $html .= '<td>' . $row['Section'] . '</td>';
        $html .= '<td>' . $row['Status'] . '</td>';
        // Add more columns as needed
        $html .= '</tr>';
    }
    $html .= '</table>';


    

    // Return the HTML table
    echo $html;
}
?>
