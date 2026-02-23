<?php
include "config.php";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    
    $user = $usersCollection->findOne(['email' => $email]);

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user'] = $user['name'];
        $_SESSION['email'] = $user['email'];

        header("Location: inbox.php");
        exit();

    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Gmail Clone</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #1a73e8, #4285f4);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-card {
            background: white;
            padding: 40px;
            width: 350px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
        }

        .login-card h2 {
            margin-bottom: 25px;
            color: #202124;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            outline: none;
            font-size: 14px;
            transition: 0.3s;
        }

        input:focus {
            border-color: #1a73e8;
            box-shadow: 0 0 5px rgba(26,115,232,0.4);
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #1a73e8;
            color: white;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #1669c1;
        }

        .google-btn {
            background: white;
            color: #444;
            border: 1px solid #ccc;
            margin-top: 10px;
        }

        .google-btn:hover {
            background: #f1f1f1;
        }

        .signup-link {
            margin-top: 15px;
            display: block;
            font-size: 14px;
        }

        .signup-link a {
            color: #1a73e8;
            text-decoration: none;
        }

        .error {
            color: red;
            margin-bottom: 15px;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="login-card">
    <h2>Sign In</h2>

    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="login">Login</button>
    </form>

    <a href="google-login.php">
        <button class="google-btn">Login with Google</button>
    </a>

    <div class="signup-link">
        Don’t have an account? <a href="signup.php">Create Account</a>
    </div>
</div>

</body>
</html>
