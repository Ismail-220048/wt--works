<?php
include "config.php";

header('Content-Type: application/json');

if (!isset($_SESSION['email'])) {
    echo json_encode(['error' => 'not_logged_in']);
    exit();
}

$userEmail = $_SESSION['email'];
$lastCheckTimestamp = isset($_GET['last_check']) ? (int)$_GET['last_check'] : time();

// Fetch emails received strictly after the last check time
$cursor = $mailsCollection->find([
    'to' => $userEmail,
    'created_at' => ['$gt' => new MongoDB\BSON\UTCDateTime($lastCheckTimestamp * 1000)]
]);

$newMails = iterator_to_array($cursor);
$count = count($newMails);

$subjects = [];
$senders = [];
foreach ($newMails as $mail) {
    if ($mail['sender_email'] !== $userEmail) {
        $subjects[] = $mail['subject'];
        $senders[] = $mail['sender_name'];
    }
}

// Update the last check to current time
echo json_encode([
    'count' => count($subjects),
    'last_check' => time(),
    'senders' => $senders
]);
?>
