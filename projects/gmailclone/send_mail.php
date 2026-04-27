<?php
include "config.php";

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = filter_var($_POST['to'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    $sender_email = $_SESSION['email'];
    $sender_name = $_SESSION['user'];

    $uploadDir = "uploads/";
    $filePath = "";
    $fileNameOriginal = "";

    if (!empty($_FILES['file']['name'])) {
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $fileNameOriginal = basename($_FILES['file']['name']);
        $targetFile = $uploadDir . time() . "_" . preg_replace("/[^a-zA-Z0-9.-]/", "_", $fileNameOriginal);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
            $filePath = $targetFile;
        }
    }

    // Check if the to user exists
    $toUser = $usersCollection->findOne(['email' => $to]);
    if ($toUser || true) { // Even if not in our DB, we simulate sending it
        $mailsCollection->insertOne([
            'sender_email' => $sender_email,
            'sender_name' => $sender_name,
            'to' => $to,
            'subject' => $subject,
            'message' => $message,
            'file_path' => $filePath,
            'file_name' => $fileNameOriginal,
            'created_at' => new MongoDB\BSON\UTCDateTime(),
            'read' => false
        ]);
        header("Location: index.php?success=Mail Sent Successfully!");
    } else {
        header("Location: index.php?error=User not found!");
    }
    exit();
}
?>
