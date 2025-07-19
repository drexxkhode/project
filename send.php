<?php
// inbox.php

// Gmail IMAP config
$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'devhub66@gmail.com'; // Replace with your Gmail
$password = 'rkxgvepehchfhfhy'; // Use App Password

// Connect to Gmail
$inbox = imap_open($hostname, $username, $password) or die('IMAP connection failed: ' . imap_last_error());

// Search for replies related to your auto-reply subject
$emails = imap_search($inbox, 'ALL ');

echo "<h2>Client Replies to Nanamon Farms</h2>";
echo "<hr>";

if ($emails) {
    rsort($emails); // Newest first

    foreach ($emails as $email_number) {
        $overview = imap_fetch_overview($inbox, $email_number, 0)[0];
        $message = imap_fetchbody($inbox, $email_number, 1);
        $subject = htmlspecialchars($overview->subject);
        $from = htmlspecialchars($overview->from);
        $date = htmlspecialchars($overview->date);
        $body = nl2br(htmlentities($message));

        echo "<div style='border:1px solid #ccc; padding:10px; margin-bottom:15px'>";
        echo "<strong>From:</strong> $from<br>";
        echo "<strong>Subject:</strong> $subject<br>";
        echo "<strong>Date:</strong> $date<br><br>";
        echo "<div style='background:#f9f9f9; padding:10px'>$body</div>";
        echo "</div>";
    }
} else {
    echo "<p><em>No client replies found.</em></p>";
}

imap_close($inbox);
?>
