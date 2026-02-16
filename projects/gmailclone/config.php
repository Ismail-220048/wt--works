<?php
session_start();

$conn = new mysqli("localhost", "gmailuser", "1234", "gmailclone");


if ($conn->connect_error) {
    die("Database connection failed");
}
?>
