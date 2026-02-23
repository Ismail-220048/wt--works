<?php
session_start();

require __DIR__ . '/vendor/autoload.php';

try {
    
    $client = new MongoDB\Client("mongodb://localhost:27017");

    
    $db = $client->gmailclone;

    
    $usersCollection = $db->users;
    $mailsCollection = $db->mails;

    
} catch (Exception $e) {
    die("MongoDB Connection Failed: " . $e->getMessage());
}
?>