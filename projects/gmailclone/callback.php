<?php
include "config.php";

$client_id = "26266432132-4tv5r1kd1ieprj6mcbj33ktt1q9mkd4d.apps.googleusercontent.com";
$client_secret = "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";
$redirect_uri = "http://localhost:8000/callback.php";

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

$check = $conn->prepare("SELECT id FROM users WHERE email=?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows == 0) {
    $stmt = $conn->prepare("INSERT INTO users (name, email, oauth_provider) VALUES (?, ?, 'google')");
    $stmt->bind_param("ss", $name, $email);
    $stmt->execute();
}

$_SESSION['user'] = $name;
$_SESSION['email'] = $email;

header("Location: inbox.php");
exit();
