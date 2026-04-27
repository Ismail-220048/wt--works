<?php
session_start();

require __DIR__ . '/vendor/autoload.php';

// Load .env variables if .env file exists
if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

$mongoUri = isset($_ENV['MONGODB_URI']) && !empty($_ENV['MONGODB_URI']) ? $_ENV['MONGODB_URI'] : "mongodb://localhost:27017";

try {
    
    $client = new MongoDB\Client($mongoUri);

    
    $db = $client->gmailclone;

    
    $usersCollection = $db->users;
    $mailsCollection = $db->mails;

    
} catch (Exception $e) {
    die("MongoDB Connection Failed: " . $e->getMessage());
}
?>