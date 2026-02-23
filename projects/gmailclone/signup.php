<?php
include "config.php";

$error = "";
$check = false;

if (isset($_POST['signup'])) {

    $name  = trim($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password1 = $_POST['password'];

    // Password validation
    if (empty($password1) || strlen($password1) < 6) {
        $check = true;
        $error = "Password must be at least 6 characters long!";
    } else {

        $password = password_hash($password1, PASSWORD_DEFAULT);

        // Check existing user
        $existingUser = $usersCollection->findOne(['email' => $email]);

        if ($existingUser) {
            $error = "Email already exists!";
            $check = true;
        } else {

            $usersCollection->insertOne([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'created_at' => new MongoDB\BSON\UTCDateTime()
            ]);

            header("Location: login.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    
    <title>Signup - Gmail Clone</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #34a853, #0f9d58);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .signup-card {
            background: white;
            padding: 40px;
            width: 350px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
        }

        .signup-card h2 {
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
            border-color: #34a853;
            box-shadow: 0 0 5px rgba(52,168,83,0.4);
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #34a853;
            color: white;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #2c8c46;
        }

        .login-link {
            margin-top: 15px;
            display: block;
            font-size: 14px;
        }

        .login-link a {
            color: #34a853;
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

<div class="signup-card">
    <h2>Create Account</h2>

    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
<div id="strengthMessage"></div>
        <?php if ($check) echo "<div class='error'>$error</div>"; ?>
        <button name="signup">Signup</button>
    </form>

    <div class="login-link">
        Already have an account? <a href="login.php">Login</a>
    </div>
    <script>
const passwordInput = document.getElementById("password");
const strengthMessage = document.getElementById("strengthMessage");

passwordInput.addEventListener("keyup", function() {
    const password = passwordInput.value;
    let strength = 0;

    if (password.length >= 6) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[a-z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;

    switch (strength) {
        case 0:
        case 1:
            strengthMessage.innerHTML = "Weak Password";
            strengthMessage.style.color = "red";
            break;
        case 2:
        case 3:
            strengthMessage.innerHTML = "Medium Password";
            strengthMessage.style.color = "orange";
            break;
        case 4:
        case 5:
            strengthMessage.innerHTML = "Strong Password";
            strengthMessage.style.color = "green";
            break;
    }
});
</script>
</div>

</body>
</html>
