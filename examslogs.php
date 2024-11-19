<!DOCTYPE html>
<html lang="en">

<?php
include 'Connection/connection.php';
//include 'forms/overall.php';
?>


<?php
// Generate modal content here

$id = $_GET['id'] ?? '';

$sql =   "SELECT  * from [dbo].[tbl_elearningstatus] WHERE [ElearningTransID] = '$id'";
                                
$result = sqlsrv_query($conn, $sql);

while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $ID = $row['ID'];
    $controlnumber = $row['ElearningTransID'];
    $elearning_title = $row['Title'];
    $target_employee = $row['Target_Employee'];
    $section = $row['Section'];
    $target_date = $row['Target_Date'];
    $upload_date = $row['Upload_Date'];
    $elearning_status = $row['Elearning_Status'];


}



?>
<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" style="font-size:18px;">E-Learning ID: <?php echo $controlnumber; ?></h4>
            <button type="button" style="color:red; border:none; background-color:white;"class="close" data-bs-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          

        <form class="row g-3">

              <div class="col-md-3">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="elearningID" name="elearningID" placeholder="Elearning Title" autocomplete="off" value="<?php echo $elearning_title; ?>"disabled>
                    <label for="floatingName">E-Learning Title</label>
                  </div>
                </div>
               
                <div class="col-md-3">
                  <div class="form-floating">
                  <input type="text" class="form-control" id="employeename" name="employeename" placeholder="Employee Name" autocomplete="off" value="<?php echo $target_employee; ?>"disabled>
                    <label for="floatingName">Full Name: </label>
                  </div>
                  <br>
                </div>

                          
                <div class="col-md-3">
                  <div class="form-floating">
                  <input type="text" class="form-control" id="section" name="section" placeholder="section Name" autocomplete="off" value="<?php echo $section; ?>"disabled>
                    <label for="floatingName">Section: </label>
                  </div>
                  <br>
                </div>

                             
                <div class="col-md-3">
                  <div class="form-floating">
                  <input type="text" class="form-control" id="elearningstatus" name="elearningstatus" placeholder="status" autocomplete="off" value="<?php echo $elearning_status; ?>"disabled>
                    <label for="floatingName">Status: </label>
                  </div>
                  <br>
                </div>


                <?php 
                
                
                
                
                ?>
               
               
         



             

            
            
                
         
              
       
              </form><!-- End floating Labels Form -->

 

     
         </div> 
    </div> 
</div>

