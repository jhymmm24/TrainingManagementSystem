<?php




// Path to your PowerPoint file
$pptx_file = '/path/to/your/pptx_file.pptx'; // Replace with your actual file path

// Check if the file exists
if (file_exists($pptx_file)) {
    // Set headers to prevent automatic download and specify filename
    header('Content-Type: application/vnd.openxmlformats-officedocument.presentationml.presentation');
    header('Content-Disposition: inline; filename="presentation.pptx"');
    header('Content-Length: ' . filesize($pptx_file));

    // Output the file
    readfile($pptx_file);
} else {
    // File not found error handling
    http_response_code(404);
    die('File not found.');
}
?>
