<?php
include 'Connection/connection.php';

$target_dir = "//apbiphbpsts01/htdocs/TMS/uploaded_elearning/PDF/";

$GETtitle = $_GET['title'];

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (file_exists($target_file)) {
    echo "<script>alert('Sorry, file already exists.');</script>";
    $uploadOk = 0;
}

if($fileType != "pdf") {
    echo "<script>alert('Sorry, only PDF files are allowed.');</script>";
    $uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 5000000) { // 5 MB limit
    echo "<script>alert('Sorry, your file is too large.');</script>";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "<script>alert('Sorry, your file was not uploaded.');</script>";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<script>alert('The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded and saved.');</script>";

        // Insert into database
        $title = htmlspecialchars(basename($_FILES["fileToUpload"]["name"])); // Get the full file name with extension

        $sql_updatepdf = "UPDATE [dbo].[tbl_question] SET [PDF] = ? WHERE [Title] = ?";
        $params = array($title, $GETtitle);
        $stmt = sqlsrv_query($conn, $sql_updatepdf, $params);

        if($stmt) {
            echo "<script>alert('Record inserted successfully.'); window.location.href = 'questionnaire.php';</script>";
        } else {
            echo "<script>alert('Error inserting record.'); window.location.href = 'questionnaire.php';</script>";
        }

    } else {
        echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
    }
}
?>
