<?php

if (isset($_POST['monitoringnotif'])) {
    require("../PhpMailer/src/PHPMailer.php");
    require("../PhpMailer/src/SMTP.php");
    require("../PhpMailer/src/Exception.php");
    include '../Connection/connection.php';

    // Initialize PHPMailer
    $mail = new \PHPMailer\PHPMailer\PHPMailer();
    $mail->SMTPKeepAlive = true;
    $mail->setFrom('TMS@brother-biph.com.ph', 'TMS');
    $mail->Subject = '[BIPH_BPS] TMS - Elearning Daily Summary';
    $mail->AltBody = 'Please do not reply to this email. Thank you!';
    $mail->isSMTP();
    $mail->Host = 'smtp.brother.co.jp';
    $mail->SMTPAuth = false;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Username = 'ZZPYPH04';
    $mail->Password = '.p&55worD';
    $mail->Port = 25;
    $mail->isHTML(true); // Set email format to HTML
    $mail->CharSet = 'utf-8';
    $mail->AddEmbeddedImage('../assets/img/phishingalert.png', 'image');

    // Query to fetch data from the database
    $query = "
    WITH TargetCounts AS (
        SELECT Title, Section, SUM(TotalNumber_Target) AS TargetCount 
        FROM [dbo].[tbl_elearningstatus] 
        GROUP BY Title, Section
    ),
    FinishedCounts AS (
        SELECT Title, Section, SUM(TotalNumber_Finished) AS FinishedCount 
        FROM [dbo].[tbl_elearningstatus] 
        GROUP BY Title, Section
    )
    SELECT 
        tc.Title, 
        tc.Section, 
        tc.TargetCount, 
        COALESCE(fc.FinishedCount, 0) AS FinishedCount,
        CASE 
            WHEN tc.TargetCount > 0 THEN (CAST(COALESCE(fc.FinishedCount, 0) AS FLOAT) / tc.TargetCount) * 100
            ELSE 0
        END AS Percentage
    FROM 
        TargetCounts tc
    LEFT JOIN 
        FinishedCounts fc 
    ON 
        tc.Title = fc.Title AND tc.Section = fc.Section;
    ";

    $stmt = sqlsrv_query($conn, $query);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch results
    $results = [];
    $titles = [];
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $results[] = $row;
        $titles[] = $row['Title'];
    }
    sqlsrv_free_stmt($stmt);

    // Remove duplicate titles
    $titles = array_unique($titles);

    // Fetch topic codes for each title
    $topicCodes = [];
    foreach ($titles as $title) {
        $topicQuery = "SELECT Topic_Code FROM tbl_topic_code WHERE Topic = ?";
        $params = [$title];
        $topicStmt = sqlsrv_query($conn, $topicQuery, $params);
    
        if ($topicStmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    
        if ($topicRow = sqlsrv_fetch_array($topicStmt, SQLSRV_FETCH_ASSOC)) {
            $topicCode = $topicRow['Topic_Code'];
            $topicCodes[$title] = (empty($topicCode)) ? '' : $topicCode;
        } else {
            $topicCodes[$title] = ''; // Default value if no record found
        }
        sqlsrv_free_stmt($topicStmt);
    }
    
    $currentdate = date('F j, Y, g:i A'); // Format the current date and time
    
    // Email content generation
    $emailContent = "
    <html>
    <head>
       <style>
            table { 
                width: 100%; 
                border-collapse: collapse; 
            }
            th, td { 
                border: 1px solid #ddd; 
                padding: 8px; /* Consistent padding for both th and td */
                text-align: center; 
             white-space: nowrap;
                min-width: 250px; /* Minimum width for columns */
                font-size: 14px; /* Set consistent font size for both th and td */
                line-height: 1.5; /* Line height for better readability */
            }
            th { 
                background-color: #3AB050; 
                color: white;
                font-weight: bold; /* Make header text bold */
            }
            .date { 
                color: blue; 
            } 
            .table-container {
                font-family: 'Century Gothic', sans-serif;
            }
            .email-text {
                font-size: 16px;
                font-family: 'Century Gothic', sans-serif;
            }
            .note {
                color: red;
            }
            .footer {
                text-align: center;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
    <p class='email-text'>Dear ALL,</p>
    <p class='email-text'>Good day, this is a daily summary of e-learning completion rates as of <span class='date'>$currentdate</span>.</p>

    <div class='table-container'>
    <table>
        <thead>
            <tr>
                <th rowspan='2'>Section</th>
                <th colspan='" . count($titles) . "'>Target</th>
                <th colspan='" . count($titles) . "'>Done</th>
                <th colspan='" . count($titles) . "'>Percentage</th>
                <th rowspan='2'>E-LEARNING COMPLETION RATE</th>
            </tr>
            <tr>";

    // Generate headers for Topic Codes
    foreach ($titles as $title) {
        $topicCode = $topicCodes[$title] ?? 'N/A';
        $emailContent .= "<th>{$topicCode} Target Count</th>";
    }
    foreach ($titles as $title) {
        $topicCode = $topicCodes[$title] ?? 'N/A';
        $emailContent .= "<th>{$topicCode} Finished Count</th>";
    }
    foreach ($titles as $title) {
        $topicCode = $topicCodes[$title] ?? 'N/A';
        $emailContent .= "<th>{$topicCode} Percentage</th>";
    }

    $emailContent .= "
            </tr>
        </thead>
        <tbody>";

    // Group results by section
    $groupedResults = [];
    foreach ($results as $row) {
        $section = $row['Section'];
        if (!isset($groupedResults[$section])) {
            $groupedResults[$section] = [];
        }
        $groupedResults[$section][] = $row;
    }

    foreach ($groupedResults as $section => $data) {
        $emailContent .= "<tr><td>{$section}</td>"; // Section column

        // Target Counts
        foreach ($titles as $title) {
            $targetCount = 0;
            foreach ($data as $row) {
                if ($row['Title'] === $title) {
                    $targetCount = $row['TargetCount'];
                }
            }
            $emailContent .= "<td>{$targetCount}</td>";
        }

        // Finished Counts
        foreach ($titles as $title) {
            $finishedCount = 0;
            foreach ($data as $row) {
                if ($row['Title'] === $title) {
                    $finishedCount = $row['FinishedCount'];
                }
            }
            $emailContent .= "<td>{$finishedCount}</td>";
        }

        // Percentages
        foreach ($titles as $title) {
            $percentage = 0;
            foreach ($data as $row) {
                if ($row['Title'] === $title) {
                    $percentage = $row['Percentage'];
                }
            }
            $emailContent .= "<td>" . number_format($percentage, 2) . "%</td>";
        }

        $averagePercentage = 0; // Fix the average calculation logic
        $emailContent .= "<td><strong>" . number_format($averagePercentage, 2) . "%</strong></td>";

        $emailContent .= "</tr>";
    }

    $emailContent .= "
        </tbody>
    </table>

    <p class='email-text'>Click this link and Login with your credentials: <a href='http://apbiphbpsts01:8080/TMS/login.php'>Training Management System</a>.</p>

    <h4 class='note'>**Note: This is a system generated email. Please do not reply to this message. ***</h4>
    <h4 class='footer'>🌐[TMS] - Training Management System🌐</h4><img src='cid:image'>

    </div>
    </body>
    </html>";

    // Set the email body
    $mail->Body = $emailContent;


    $sql_sectionpic = "SELECT * FROM [dbo].[tbl_accounts] WHERE Category = 'Section Training PIC'";
    $results_sectionpic = sqlsrv_query($conn, $sql_sectionpic);
    
    // Fetch all rows into an array
    $rows = [];
    while ($row = sqlsrv_fetch_array($results_sectionpic, SQLSRV_FETCH_ASSOC)) {
        $rows[] = $row;
    }
    
    // Loop through the array using foreach
    foreach ($rows as $row) {
        try {
            $mail->addAddress($row['Email'], $row['Full_Name']); // Use addAddress instead of addTo
        } catch (Exception $e) {
            echo 'Invalid address skipped: ' . htmlspecialchars($row['Email']) . '<br>';
            continue;
        }
    }
    
    // Add BCC recipients
    $mail->addBCC('jilltherese.garcia@brother-biph.com.ph');
    $mail->addBCC('bradly.mateo@brother-biph.com.ph');
    try {
        $mail->addBCC('johnmichael.macaraig@brother-biph.com.ph');
    } catch (Exception $e) {
        echo 'Invalid BCC address: ' . htmlspecialchars('johnmichael.macaraig@brother-biph.com.ph') . '<br>';
    }
    
    // Send email
    try {
        if ($mail->send()) {
            echo 'Email has been sent successfully to all recipients.';
        } else {
            echo 'Error in sending email: ' . $mail->ErrorInfo;
        }
    } catch (Exception $e) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    
    // Clear recipient lists after sending
    $mail->clearAddresses();
    $mail->clearBCCs();
}
?>
