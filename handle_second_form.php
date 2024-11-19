

<?php
if(isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
    $title = isset($_GET['title']) ? $_GET['title'] : ''; // Retrieve title from the query parameters
    $fileTmpPath = $_FILES['fileToUpload']['tmp_name'];
    $fileExtension = strtolower(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));

    // Validate file type
    if ($fileExtension !== 'pptx' && $fileExtension !== 'ppt') {
        die('Invalid file type. Please upload a PowerPoint file.');
    }

    // Process the file upload as needed
    // Your code to handle the file upload for the second form goes here
    echo "Second form submitted successfully.";
} else {
    echo 'Error uploading file for second form.';
}
?>
