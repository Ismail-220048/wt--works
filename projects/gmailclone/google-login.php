<?php
$client_id = "26266432132-4tv5r1kd1ieprj6mcbj33ktt1q9mkd4d.apps.googleusercontent.com";
$redirect_uri = "http://localhost:8000/callback.php";

$scope = "email profile";

$auth_url = "https://accounts.google.com/o/oauth2/v2/auth?" . http_build_query([
    'client_id' => $client_id,
    'redirect_uri' => $redirect_uri,
    'response_type' => 'code',
    'scope' => $scope,
    'access_type' => 'offline',
    'prompt' => 'consent'
]);

header("Location: $auth_url");
exit();
