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



if($position == 'Supervisor' || $position == 'Junior Supervisor' || $position == 'Senior Supervisor'){
  $pos = 'For Section SPV Approval';
}elseif($position == 'Manager' || $position == 'Junior Manager' || $position == 'Senior Manager'){
  $pos = 'For Section MGR Approval';
}elseif($position =='Senior Engineer' && $section=='PE'){
  $pos = 'For PE Training PIC Approval';
 
}elseif(($position == 'Supervisor' || $position == 'Junior Supervisor' || $position == 'Senior Supervisor') && $section=='PE'){
  $pos = 'For PE SPV Approval';

}elseif(($position == 'Manager' || $position == 'Junior Manager' || $position == 'Senior Manager') && $section == 'PE'){
  $pos = 'For PE MGR Approval';
}else{

}



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


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


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
        border-color: #B45309;
    }
.button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #04AA6D;
}

.button1:hover {
  background-color: #04AA6D;
  color: white;
}

#view{
  background-color: white; 
  color: black; 
  
}

#view:hover {
  background-color: #F3EA9C;
  color: white;
}

.button2 {
  background-color: white; 
  color: black; 
  border: 2px solid #f44336;
}

.button2:hover {
  background-color: #f44336;
  color: white;
}
table tr:hover td {
  background-color: #C6F1F8;
}

.btn {
  background-color: DodgerBlue;
  border: none;
  color: white;
  padding: 12px 30px;
  cursor: pointer;
  font-size: 17px;
}


</style>

<body>

<?php


include 'header.php';


include 'sidebar.php';


?>


<main id="main" class="main">




<div class="card">



            <div class="card-body">
          
             <h5 class="card-title">Training Request Approval</h5>


     

    
             
                <div class="col-md-6">
                <button type="button" class="button button1" onclick="clickApproved()" style="width: 250px;">APPROVED</button>

                <button type="button" class="button button2" onclick="clickDeclined()" style="width: 250px;">DECLINED</button>
                </div>    
             <br>
<section class="section">     
   <form  method="POST"  id="myForm" name="myForm" action="forms/sqlupdates.php?action=trainingrequestApprove&position=<?php echo $position;?>&section=<?php echo $section;?>&fname=<?php echo $fullname;?>">
          

      
            
             
          
   


              <table id="example24" class="display" style="width:100%; overflow-x: auto;  white-space: nowrap;   display: block;">
        <thead>
            <tr>
                <th style=" width: 5px;">Select</th>
                <th style=" text-align: center;">Training Request Number</th>
                <th style=" text-align: center;" >Topic</th>
                <th style=" text-align: center;">Section</th>
                <th style=" text-align: center;">Rank</th>

                <th style=" text-align: center;">Requestor</th>
                <th style=" text-align: center;">Target Date</th>
                <th style=" text-align: center;">Training Request Status</th>
                <th style=" text-align: center;">View</th>
             
            </tr>
            <tr>
            <th style=" width: 5px;"></th>
                <th style=" text-align: center;">Training Request Number</th>
                <th style=" text-align: center;" >Topic</th>
                <th style=" text-align: center;">Section</th>
                <th style=" text-align: center;">Rank</th>

                <th style=" text-align: center;">Requestor</th>
                <th style=" text-align: center;">Target Date</th>
                <th style=" text-align: center;">Training Request Status</th>
                <th style=" text-align: center;"></th>
            </tr>
        </thead>
        <tbody>
          

        <?php




            // $trequest = "WITH CTE AS (
            //   SELECT *,
            //         ROW_NUMBER() OVER (PARTITION BY RequestNumber ORDER BY (SELECT NULL)) AS RowNum
            //   FROM [dbo].[tbl_trainingrequest] WHERE Section = '$section' and StatusRequestNumber = '$pos';
            // )
            // SELECT *
            // FROM CTE
            // WHERE RowNum = 1";

            if(($position == 'Senior Engineer' && $section == 'PE') || ($position == 'Engineer' && $section == 'PE')) {
            $pos = 'For PE Training PIC Approval';


            


          $trequest = "WITH CTE AS (
            SELECT *,
                  ROW_NUMBER() OVER (PARTITION BY RequestNumber ORDER BY (SELECT NULL)) AS RowNum
            FROM [dbo].[tbl_trainingrequest]
            WHERE StatusRequestNumber = '$pos'
          )
          SELECT *
          FROM CTE
          WHERE RowNum = 1";
                      

                  
                  // $trequest =  "SELECT * FROM [dbo].[tbl_trainingrequest] WHERE Section = 'TN' AND StatusRequestNumber ='$pos' ";

                    $stmt3 = sqlsrv_query($conn,$trequest);
                                    while($row = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
                                        $id = $row['ID'];
                                        $reqno = $row['RequestNumber'];
                                        $transno = $row['Transaction Number'];
                                        $topic= $row['Topic'];
                                        $typeoftraining = $row['Type of Training'];
                                        $requestorname = $row['Requestor Name'];
                                        $employeeno = $row['Employee Number'];
                                        $fullnameTargetEmployee = $row['Employee Name'];
                                        $sectionTargetEmployee = $row['Section'];
                                        $position = $row['Position'];
                                        $datehired = $row['Date Hired'];
                                        $urgent = $row['Urgent'];
                                        $reason = $row['Reason of Urgency'];
                                        $target = $row['Target'];
                                        $statusrequestnumber = $row['StatusRequestNumber'];
                                        $rank = $row['Rank'];
                                      
                                      
                                        

                                        echo

                                        '<tr>
                                            <td style="width: 5px; text-align: center;"> <input type="checkbox" name="selected[]" class="single-checkbox" id="selected" value="'.$reqno.'"></td>
                                            <td style=" text-align: center;">'  . $row['RequestNumber'] .'</td>
                                            <td style=" text-align: center;">'  . $row['Topic'] .'</td>
                                            <td style=" text-align: center;">'  . $row['Section'] .'</td>
                                            <td style=" text-align: center;">'  . $row['Rank'] .'</td>
                                            
                                            <td style=" text-align: center;">'  . $row['Requestor Name'] .'</td>
                                            <td style=" text-align: center;">'  . $row['Target'] .'</td>
                                            <td style=" text-align: center;">'  . $row['StatusRequestNumber'] .'</td>
                                            <td style=" text-align: center;">'; ?><button  type="button" class="openModalBtn" style="border:none;  background-color: transparent;" id="openModalBtn" data-id="<?php echo $reqno?>"> <img src="assets/img/find.png" style ="width:35px; height:35px; border:none;" title="View Checking History"> </button>  <div id="myModal" class="modal fade"></div><?php '</td>
                                            
                                        
                                        ';
                                  
                                    }
                                  
                                  
                    
                    ?>

                    <!-- Modal container -->
                  

                    <?php
          
          
          }

        
          
          
          elseif(($position == 'Supervisor' || $position == 'Junior Supervisor' || $position == 'Senior Supervisor') && $section=='PE'){


            $pos = "('For PE SPV Approval', 'For Section SPV Approval')";

            $trequest = "WITH CTE AS (
                SELECT *,
                      ROW_NUMBER() OVER (PARTITION BY RequestNumber ORDER BY (SELECT NULL)) AS RowNum
                FROM [dbo].[tbl_trainingrequest]
                WHERE StatusRequestNumber IN $pos
            )
            SELECT *
            FROM CTE
            WHERE RowNum = 1";

                  
                  // $trequest =  "SELECT * FROM [dbo].[tbl_trainingrequest] WHERE Section = 'TN' AND StatusRequestNumber ='$pos' ";

                    $stmt3 = sqlsrv_query($conn,$trequest);
                                    while($row = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
                                        $id = $row['ID'];
                                        $reqno = $row['RequestNumber'];
                                        $transno = $row['Transaction Number'];
                                        $topic= $row['Topic'];
                                        $typeoftraining = $row['Type of Training'];
                                        $requestorname = $row['Requestor Name'];
                                        $employeeno = $row['Employee Number'];
                                        $fullnameTargetEmployee = $row['Employee Name'];
                                        $sectionTargetEmployee = $row['Section'];
                                        $position = $row['Position'];
                                        $datehired = $row['Date Hired'];
                                        $urgent = $row['Urgent'];
                                        $reason = $row['Reason of Urgency'];
                                        $target = $row['Target'];
                                        $statusrequestnumber = $row['StatusRequestNumber'];
                                      
                                        $rank = $row['Rank'];
                                        

                                        echo

                                        '<tr>
                                            <td style="width: 5px; text-align: center;"> <input type="checkbox" name="selected[]" class="single-checkbox" id="selected" value="'.$reqno.'"></td>
                                            <td style=" text-align: center;">'  . $row['RequestNumber'] .'</td>
                                            <td style=" text-align: center;">'  . $row['Topic'] .'</td>
                                            <td style=" text-align: center;">'  . $row['Section'] .'</td>
                                             <td style=" text-align: center;">'  . $row['Rank'] .'</td>
                                            <td style=" text-align: center;">'  . $row['Requestor Name'] .'</td>
                                            <td style=" text-align: center;">'  . $row['Target'] .'</td>
                                            <td style=" text-align: center;">'  . $row['StatusRequestNumber'] .'</td>
                                            <td style=" text-align: center;">'; ?><button  type="button" class="openModalBtn" style="border:none;  background-color: transparent;" id="openModalBtn" data-id="<?php echo $reqno?>"> <img src="assets/img/find.png" style ="width:35px; height:35px; border:none;" title="View Checking History"> </button>  <div id="myModal" class="modal fade"></div><?php '</td>
                                            
                                        
                                        ';
                                  
                                    }
                                  
                                  
                    
                    ?>

                    

                    <!-- Modal container -->
            

                    <?php





          }

          elseif(($position == 'Supervisor' || $position == 'Junior Supervisor' || $position == 'Senior Supervisor')){

            
            $pos = 'For Section SPV Approval';
                


          $trequest = "WITH CTE AS (
            SELECT *,
                  ROW_NUMBER() OVER (PARTITION BY RequestNumber ORDER BY (SELECT NULL)) AS RowNum
            FROM [dbo].[tbl_trainingrequest]
            WHERE StatusRequestNumber = '$pos' and Section = '$section'
          )
          SELECT *
          FROM CTE
          WHERE RowNum = 1";
                      

                  
                  // $trequest =  "SELECT * FROM [dbo].[tbl_trainingrequest] WHERE Section = 'TN' AND StatusRequestNumber ='$pos' ";

                    $stmt3 = sqlsrv_query($conn,$trequest);
                                    while($row = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
                                        $id = $row['ID'];
                                        $reqno = $row['RequestNumber'];
                                        $transno = $row['Transaction Number'];
                                        $topic= $row['Topic'];
                                        $typeoftraining = $row['Type of Training'];
                                        $requestorname = $row['Requestor Name'];
                                        $employeeno = $row['Employee Number'];
                                        $fullnameTargetEmployee = $row['Employee Name'];
                                        $sectionTargetEmployee = $row['Section'];
                                        $position = $row['Position'];
                                        $datehired = $row['Date Hired'];
                                        $urgent = $row['Urgent'];
                                        $reason = $row['Reason of Urgency'];
                                        $target = $row['Target'];
                                        $statusrequestnumber = $row['StatusRequestNumber'];
                                        $rank = $row['Rank'];
                                      
                                        

                                        echo

                                        '<tr>
                                            <td style="width: 5px; text-align: center;"> <input type="checkbox" name="selected[]" class="single-checkbox" id="selected" value="'.$reqno.'"></td>
                                            <td style=" text-align: center;">'  . $row['RequestNumber'] .'</td>
                                            <td style=" text-align: center;">'  . $row['Topic'] .'</td>
                                            <td style=" text-align: center;">'  . $row['Section'] .'</td>
                                             <td style=" text-align: center;">'  . $row['Rank'] .'</td>
                                            <td style=" text-align: center;">'  . $row['Requestor Name'] .'</td>
                                            <td style=" text-align: center;">'  . $row['Target'] .'</td>
                                            <td style=" text-align: center;">'  . $row['StatusRequestNumber'] .'</td>
                                            <td style=" text-align: center;">'; ?><button  type="button" class="openModalBtn" style="border:none;  background-color: transparent;" id="openModalBtn" data-id="<?php echo $reqno?>"> <img src="assets/img/find.png" style ="width:35px; height:35px; border:none;" title="View Checking History"> </button>  <div id="myModal" class="modal fade"></div><?php '</td>
                                            
                                        
                                        ';
                                  
                                    }
                                  
                                  
                    
                    ?>

                    

                    <!-- Modal container -->
            

                    <?php





          }
          elseif(($position == 'Manager' || $position == 'Junior Manager' || $position == 'Senior Manager') && $section == 'PE'){

            $pos = 'For PE MGR Approval';
            

          $trequest = "WITH CTE AS (
            SELECT *,
                  ROW_NUMBER() OVER (PARTITION BY RequestNumber ORDER BY (SELECT NULL)) AS RowNum
            FROM [dbo].[tbl_trainingrequest]
            WHERE StatusRequestNumber = '$pos'
          )
          SELECT *
          FROM CTE
          WHERE RowNum = 1";
                      

                  
                  // $trequest =  "SELECT * FROM [dbo].[tbl_trainingrequest] WHERE Section = 'TN' AND StatusRequestNumber ='$pos' ";

                    $stmt3 = sqlsrv_query($conn,$trequest);
                                    while($row = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
                                        $id = $row['ID'];
                                        $reqno = $row['RequestNumber'];
                                        $transno = $row['Transaction Number'];
                                        $topic= $row['Topic'];
                                        $typeoftraining = $row['Type of Training'];
                                        $requestorname = $row['Requestor Name'];
                                        $employeeno = $row['Employee Number'];
                                        $fullnameTargetEmployee = $row['Employee Name'];
                                        $sectionTargetEmployee = $row['Section'];
                                        $position = $row['Position'];
                                        $datehired = $row['Date Hired'];
                                        $urgent = $row['Urgent'];
                                        $reason = $row['Reason of Urgency'];
                                        $target = $row['Target'];
                                        $statusrequestnumber = $row['StatusRequestNumber'];
                                        $rank = $row['Rank'];
                                      
                                        

                                        echo

                                        '<tr>
                                            <td style="width: 5px; text-align: center;"> <input type="checkbox" name="selected[]" class="single-checkbox" id="selected" value="'.$reqno.'"></td>
                                            <td style=" text-align: center;">'  . $row['RequestNumber'] .'</td>
                                            <td style=" text-align: center;">'  . $row['Topic'] .'</td>
                                            <td style=" text-align: center;">'  . $row['Section'] .'</td>
                                             <td style=" text-align: center;">'  . $row['Rank'] .'</td>
                                            <td style=" text-align: center;">'  . $row['Requestor Name'] .'</td>
                                            <td style=" text-align: center;">'  . $row['Target'] .'</td>
                                            <td style=" text-align: center;">'  . $row['StatusRequestNumber'] .'</td>
                                            <td style=" text-align: center;">'; ?><button  type="button" class="openModalBtn" style="border:none;  background-color: transparent;" id="openModalBtn" data-id="<?php echo $reqno?>"> <img src="assets/img/find.png" style ="width:35px; height:35px; border:none;" title="View Checking History"> </button>  <div id="myModal" class="modal fade"></div><?php '</td>
                                            
                                        
                                        ';
                                  
                                    }
                                  
                                  
                    
                    ?>

                    <!-- Modal container -->
                  

                    <?php






          }
          elseif($position == 'Supervisor' || $position == 'Junior Supervisor' || $position == 'Senior Supervisor'){
          $pos = 'For Section SPV Approval';

                    

            $trequest = "WITH CTE AS (
              SELECT *,
                    ROW_NUMBER() OVER (PARTITION BY RequestNumber ORDER BY (SELECT NULL)) AS RowNum
              FROM [dbo].[tbl_trainingrequest]
              WHERE Section = '$section' AND (StatusRequestNumber = '$pos' OR StatusRequestNumber = 'Declined')
            )
            SELECT *
            FROM CTE
            WHERE RowNum = 1";
                        

                    
                    // $trequest =  "SELECT * FROM [dbo].[tbl_trainingrequest] WHERE Section = 'TN' AND StatusRequestNumber ='$pos' ";

                      $stmt3 = sqlsrv_query($conn,$trequest);
                                      while($row = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
                                          $id = $row['ID'];
                                          $reqno = $row['RequestNumber'];
                                          $transno = $row['Transaction Number'];
                                          $topic= $row['Topic'];
                                          $typeoftraining = $row['Type of Training'];
                                          $requestorname = $row['Requestor Name'];
                                          $employeeno = $row['Employee Number'];
                                          $fullnameTargetEmployee = $row['Employee Name'];
                                          $sectionTargetEmployee = $row['Section'];
                                          $positionTargetEmployee = $row['Position'];
                                          $datehired = $row['Date Hired'];
                                          $urgent = $row['Urgent'];
                                          $reason = $row['Reason of Urgency'];
                                          $target = $row['Target'];
                                          $statusrequestnumber = $row['StatusRequestNumber'];
                                        
                                          $rank = $row['Rank'];
                                          

                                          echo

                                          '<tr>
                                              <td style="width: 5px; text-align: center;"> <input type="checkbox" name="selected[]" class="single-checkbox" id="selected" value="'.$reqno.'"></td>
                                              <td style=" text-align: center;">'  . $row['RequestNumber'] .'</td>
                                              <td style=" text-align: center;">'  . $row['Topic'] .'</td>
                                              <td style=" text-align: center;">'  . $row['Section'] .'</td>
                                               <td style=" text-align: center;">'  . $row['Rank'] .'</td>
                                              <td style=" text-align: center;">'  . $row['Requestor Name'] .'</td>
                                              <td style=" text-align: center;">'  . $row['Target'] .'</td>
                                              <td style=" text-align: center;">'  . $row['StatusRequestNumber'] .'</td>
                                              <td style=" text-align: center;">'; ?><button  type="button" class="openModalBtn" style="border:none;  background-color: transparent;" id="openModalBtn" data-id="<?php echo $reqno?>"> <img src="assets/img/find.png" style ="width:35px; height:35px; border:none;" title="View Checking History"> </button>      <div id="myModal" class="modal fade" tabindex="-1" role="dialog"></div><?php '</td>
                                              
                                          
                                          ';
                                    
                                      }
              

          }
          
          elseif( $position ==='Assistant Manager' || $position == 'Adviser' || $position == 'Manager' || $position == 'Junior Manager' || $position == 'Senior Manager'){
            $pos = 'For Section MGR Approval';
  
                      
  
              $trequest = "WITH CTE AS (
                SELECT *,
                      ROW_NUMBER() OVER (PARTITION BY RequestNumber ORDER BY (SELECT NULL)) AS RowNum
                FROM [dbo].[tbl_trainingrequest]
                WHERE Section = '$section' AND StatusRequestNumber = '$pos'
              )
              SELECT *
              FROM CTE
              WHERE RowNum = 1";
                          
  
                      
                      // $trequest =  "SELECT * FROM [dbo].[tbl_trainingrequest] WHERE Section = 'TN' AND StatusRequestNumber ='$pos' ";
  
                        $stmt3 = sqlsrv_query($conn,$trequest);
                                        while($row = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
                                            $id = $row['ID'];
                                            $reqno = $row['RequestNumber'];
                                            $transno = $row['Transaction Number'];
                                            $topic= $row['Topic'];
                                            $typeoftraining = $row['Type of Training'];
                                            $requestorname = $row['Requestor Name'];
                                            $employeeno = $row['Employee Number'];
                                            $fullnameTargetEmployee = $row['Employee Name'];
                                            $sectionTargetEmployee = $row['Section'];
                                            $positionTargetEmployee = $row['Position'];
                                            $datehired = $row['Date Hired'];
                                            $urgent = $row['Urgent'];
                                            $reason = $row['Reason of Urgency'];
                                            $target = $row['Target'];
                                            $statusrequestnumber = $row['StatusRequestNumber'];
                                          
                                            $rank = $row['Rank'];
                                            
  
                                            echo
  
                                            '<tr>
                                                <td style="width: 5px; text-align: center;"> <input type="checkbox" name="selected[]" class="single-checkbox" id="selected" value="'.$reqno.'"></td>
                                                <td style=" text-align: center;">'  . $row['RequestNumber'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Topic'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Section'] .'</td>
                                                 <td style=" text-align: center;">'  . $row['Rank'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Requestor Name'] .'</td>
                                                <td style=" text-align: center;">'  . $row['Target'] .'</td>
                                                <td style=" text-align: center;">'  . $row['StatusRequestNumber'] .'</td>
                                                <td style=" text-align: center;">'; ?><button  type="button" class="openModalBtn" style="border:none;  background-color: transparent;" id="openModalBtn" data-id="<?php echo $reqno?>"> <img src="assets/img/find.png" style ="width:35px; height:35px; border:none;" title="View Checking History"> </button>  <div id="myModal" class="modal fade"></div><?php '</td>
                                                
                                            
                                            ';
                                      
                                        }
                
  
            }
          
          
          else{


         
         
         
         
         
          }




                            
                            
              
              ?>
                    <!-- Modal container -->
                  

                  
              </tbody>
            
          </table>

      <br>






        <button type="submit" name="btnSubmit" id="btnSubmit" hidden>Submit</button>


  </form>
   </section>

</div>



</main><!-- End #main -->

    

    

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
  
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>



<link rel="stylesheet" type="text/css" href="/jquery.datetimepicker.css">
<script src="/jquery.js"></script>
<script src="/build/jquery.datetimepicker.full.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  <script>
        new DataTable('#example24', {
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
        { orderable: false, targets: [] }
        ]
        });



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
                    function clickApproved()
                    {
                 Swal.fire({
                    title: "Are you sure you want to Approved?",
                    html: 'Item Code: <br>' + vals.join('<br>'),
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    denyButtonText: `No`
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                     
                      document.getElementById("btnSubmit").click();
                      // window.location.href = "forms/sqlupdates.php?action=trainingrequestApprove"
                       
                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                    });
                }

</script>





<script>
function clickApproved() {
    var checkboxes = document.getElementsByClassName('single-checkbox');
    var vals = [];

    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            vals.push(checkboxes[i].value);
        }
    }

    if (vals.length === 0) {
        Swal.fire({
            title: 'Kindly select Training Request Number',
            text: 'No Training Request Number detected!',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
    } else {
        Swal.fire({
            title: 'Are you sure you want to approved the selected Training Request Number?',
            html: 'Training Request Number: <br>' + vals.join('<br>'),
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, approved it'
        }).then((result) => {
            if (result.isConfirmed) {
              document.getElementById("btnSubmit").click();
            }
        });
    }
}


</script>





<script>
function clickDeclined() {
    var checkboxes = document.getElementsByClassName('single-checkbox');
    var vals = [];

    // Collect all checked checkbox values
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            vals.push(checkboxes[i].value);
        }
    }

    if (vals.length === 0) {
        // Show warning if no checkboxes are selected
        Swal.fire({
            title: 'Kindly select Training Request Number',
            text: 'No Training Request Number detected!',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
    } else {
        // Show confirmation before proceeding with decline action
        Swal.fire({
            title: 'Are you sure you want to decline the selected Training Request Number?',
            html: 'Training Request Number: <br>' + vals.join('<br>') + '<br><br><input id="declineReason" style="font-size:12px;" class="swal2-input" placeholder="Reason for declining">',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, decline it',
            preConfirm: () => {
                const reason = Swal.getPopup().querySelector('#declineReason').value;
                if (!reason) {
                    Swal.showValidationMessage('Please enter a reason');
                }
                return reason;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const reason = result.value; // get the reason from the input field
                
                // Build URL with selected training request numbers and reason for decline
                window.location.href = "forms/sqlupdates.php?action=trainingrequestDeclined" +
                    "&declinedby=<?php echo $fullname; ?>" +
                    "&section=<?php echo $section; ?>" +
                    "&position=Supervisor" +
                    "&selected=" + encodeURIComponent(vals.join(',')) + // Encode the selected values
                    "&reason=" + encodeURIComponent(reason);  // Encode the decline reason
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        });
    }
}


</script>





<script>
$(document).ready(function(){
    // Button click event handler for all buttons with class openModalBtn
    $('table tbody').on('click', '.openModalBtn', function() {
   
        // Get the ID from the button's data attribute
        var id = $(this).data("id");
        // AJAX request to load modal content with ID parameter
        $.ajax({
            url: "requestlogs.php?id=" + id, // PHP file that generates modal content with ID parameter
            success: function(response){
                // Display modal with loaded content
                $("#myModal").html(response);
                $("#myModal").modal('show'); // Show Bootstrap modal
            }
        });
    });
});
</script>


<!-- 
<script>
                    function clickSend()
                    {
                 Swal.fire({
                    title: "Are you sure you want to Submit?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    denyButtonText: `No`
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        // Swal.fire("Successfully Enlist!", "", "success");
                        
                    
                        
                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                    });
                }
</script> -->

<!-- <script>
        $(document).ready(function(){
            $('#myForm').submit(function(e){
                e.preventDefault(); // Prevent default form submission
                
                // Show Swal.fire confirmation dialog
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Are you sure you want to submit?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, submit!'
                }).then((result) => {
                    // If user confirms, proceed with form submission
                    if (result.isConfirmed) {
                        $('#myForm').unbind('submit').submit(); // Unbind previous submit event and submit form
                    }
                });
            });
        });
    </script> -->




</body>

</html>