<?php
include "config.php";
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$clientID = $_ENV['GOOGLE_CLIENT_ID'];
$clientSecret = $_ENV['GOOGLE_CLIENT_SECRET'];
$redirectUri = $_ENV['GOOGLE_REDIRECT_URI'];

$code = $_GET['code'];

$token_url = "https://oauth2.googleapis.com/token";

$data = [
    'code' => $code,
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'redirect_uri' => $redirect_uri,
    'grant_type' => 'authorization_code'
];

$options = [
    'http' => [
        'method' => 'POST',
        'header' => "Content-Type: application/x-www-form-urlencoded",
        'content' => http_build_query($data)
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($token_url, false, $context);
$token = json_decode($response, true);

$user_info = file_get_contents(
    "https://www.googleapis.com/oauth2/v2/userinfo?access_token=" . $token['access_token']
);

$user_data = json_decode($user_info, true);

$name = $user_data['name'];
$email = $user_data['email'];

 $existingUser = $usersCollection->findOne(['email' => $email]);
 if ($existingUser) {
   if (!isset($_SESSION['user'])) {
        $_SESSION['user'] = $existingUser['name'];
        $_SESSION['email'] = $existingUser['email'];
    }
    header("Location: inbox.php");
    exit();
} else {
    $usersCollection->insertOne([
        'name' => $name,
        'email' => $email,
        'password' => null,
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ]);
 }

$_SESSION['user'] = $name;
$_SESSION['email'] = $email;

header("Location: inbox.php");
exit();
