<?php
include 'Connection/connection.php';


$table = $_GET['table'] ?? '';

if ($table === 'qualityanalysis') {
    $query = "SELECT * FROM [dbo].[tbl_topic_qualityanalysis]";
} elseif ($table === 'workstandard') {
    $query = "SELECT * FROM [dbo].[tbl_topic_workstandard]";
} elseif($table === 'mgtgroupregulation'){
    $query = "SELECT * FROM [dbo].[tbl_topic_mgtgroupregulation]";
} elseif($table === 'commontraining'){
    $query = "SELECT * FROM [dbo].[tbl_topic_commontraining]";
} elseif($table === 'prodhashira'){
    $query = "SELECT * FROM [dbo].[tbl_topic_hashira]";
} elseif($table === 'technicalstandard'){
    $query = "SELECT * FROM [dbo].[tbl_topic_technicaltandard]";
} elseif($table === 'commonbusinessskills'){
    $query = "SELECT * FROM [dbo].[tbl_topic_commonbusinessskills]";
}elseif($table === 'companyfundamentals'){
    $query = "SELECT * FROM [dbo].[tbl_topic_companyfundamentals]";
}else {
    echo '';
    exit;
}

$stmt = sqlsrv_query($conn, $query);

$options = '';
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $options .= '<option value="'.$row['Topic'].'">'.$row['Topic'].'</option>';
}

echo $options;
?>