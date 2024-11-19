<!DOCTYPE html>
<html lang="en">

<?php
include 'Connection/connection.php';

?>


<?php
// Generate modal content here



$id = $_GET['id'] ?? '';

$sql = "SELECT * FROM tbl_trainingrequest WHERE [RequestNumber] = '$id'";

$result = sqlsrv_query($conn, $sql);

?>
<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" style="font-size: 16px;">Transaction ID: <?php echo $id; ?></h4>
            <button type="button" style="color:red; border:none; background-color:white;" class="close" data-bs-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <table style="width: 100%; border-collapse: collapse; border: 2px solid black;">
                <thead>
                    <tr>
                        <th style="border: 1px solid black; text-align:center;">Status</th>
                        <th style="border: 1px solid black; text-align:center;">Requestor</th>
                        <th style="border: 1px solid black; text-align:center;">Target Employee</th>
                        <th style="border: 1px solid black; text-align:center;">Position</th>
                        <th style="border: 1px solid black; text-align:center;">Section</th>
                        <th style="border: 1px solid black; text-align:center;">Topic</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        $employeeName = $row['Employee Name'];
                        $section = $row['Section'];
                        $topic = $row['Topic'];
                        $requestor = $row['Requestor Name'];
                        $position = $row['Position'];
                        $statusrequestnumber = $row['StatusRequestNumber'];
                    ?>
                    <tr>
                        <td style="border: 1px solid black;"><?php echo htmlspecialchars($statusrequestnumber); ?></td>
                        <td style="border: 1px solid black;"><?php echo htmlspecialchars($requestor); ?></td>
                        <td style="border: 1px solid black;"><?php echo htmlspecialchars($employeeName); ?></td>
                        <td style="border: 1px solid black;"><?php echo htmlspecialchars($position); ?></td>
                        <td style="border: 1px solid black;"><?php echo htmlspecialchars($section); ?></td>
                        <td style="border: 1px solid black;"><?php echo htmlspecialchars($topic); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
