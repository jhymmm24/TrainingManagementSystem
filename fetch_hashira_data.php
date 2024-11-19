


<?php 



// Fetch data from tbl_hashira
$sql = "SELECT * FROM tbl_hashira";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Output data as HTML table rows
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo '<tr>';
    echo '<td>' . $row['Employee_Number'] . '</td>';
    echo '<td>' . $row['Employee_Name'] . '</td>';
    echo '<td>' . $row['Section'] . '</td>';
    echo '<td>' . $row['Position'] . '</td>';
    echo '</tr>';
}


?>