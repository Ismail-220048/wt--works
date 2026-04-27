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

            header("Location: login.php?success=Account+created+successfully!+Please+log+in.");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup - IS-mail</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .signup-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 50px 40px;
            width: 400px;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            text-align: center;
            border: 1px solid rgba(255,255,255,0.5);
        }

        .signup-card h2 {
            margin-bottom: 5px;
            color: #102a43;
            font-size: 28px;
            font-weight: 700;
        }
        
        .signup-card p.subtitle {
            color: #627d98;
            margin-bottom: 30px;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 15px 18px;
            margin-bottom: 18px;
            border-radius: 12px;
            border: 1px solid #d9e2ec;
            background: #f8fbff;
            outline: none;
            font-size: 15px;
            transition: all 0.3s;
            box-sizing: border-box;
            color: #334e68;
        }

        input:focus {
            border-color: #4ECDC4;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(78, 205, 196, 0.15);
        }

        button.primary-btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #1a73e8, #4ECDC4);
            color: white;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 4px 15px rgba(26, 115, 232, 0.3);
            margin-top: 10px;
        }

        button.primary-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(26, 115, 232, 0.4);
        }

        .login-link {
            margin-top: 25px;
            display: block;
            font-size: 15px;
            color: #627d98;
        }

        .login-link a {
            color: #1a73e8;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .error {
            color: #e53e3e;
            background: #fff5f5;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            border: 1px solid #fed7d7;
            font-weight: 500;
        }

        #strengthMessage {
            font-size: 13px;
            font-weight: 500;
            text-align: left;
            margin-top: -10px;
            margin-bottom: 15px;
            margin-left: 5px;
            min-height: 16px;
        }
    </style>
</head>

<body>

<div class="signup-card">
    <h2>Create Account</h2>
    <p class="subtitle">Get your very own IS-mail inbox</p>

    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" id="password" placeholder="Password (Min 6 Chars)" required>
        <div id="strengthMessage"></div>
        <button type="submit" name="signup" class="primary-btn">Sign Up</button>
    </form>

    <div class="login-link">
        Already have an account? <a href="login.php">Log In</a>
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

        if (password.length === 0) {
            strengthMessage.innerHTML = "";
            return;
        }

        switch (strength) {
            case 0:
            case 1:
                strengthMessage.innerHTML = "Weak Password";
                strengthMessage.style.color = "#e53e3e";
                break;
            case 2:
            case 3:
                strengthMessage.innerHTML = "Medium Password";
                strengthMessage.style.color = "#dd6b20";
                break;
            case 4:
            case 5:
                strengthMessage.innerHTML = "Strong Password";
                strengthMessage.style.color = "#38a169";
                break;
        }
    });

    // Toast Notifications
    const toastContainer = document.createElement('div');
    toastContainer.style.cssText = "position:fixed;bottom:30px;right:30px;z-index:9999;display:flex;flex-direction:column;gap:15px;pointer-events:none;";
    document.body.appendChild(toastContainer);

    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        let color = type === 'success' ? '#4ECDC4' : '#ff5252';
        let icon = type === 'success' ? '✓' : '⚠';
        
        toast.style.cssText = `background:white;color:#333;padding:15px 25px;border-radius:12px;box-shadow:0 10px 40px rgba(0,0,0,0.1);display:flex;align-items:center;gap:15px;font-weight:500;font-size:15px;border-left:5px solid ${color};transition:all 0.4s;opacity:1;transform:translateY(0)`;
        toast.innerHTML = `<span style="color:${color};font-weight:bold">${icon}</span> <span>${message}</span>`;
        toastContainer.appendChild(toast);
        
        setTimeout(() => toast.style.opacity = '0', 4500);
        setTimeout(() => { if(toast.parentElement) toast.remove(); }, 5000);
    }

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('success')) {
        showToast(urlParams.get('success'), 'success');
        window.history.replaceState({}, document.title, window.location.pathname);
    } else if (urlParams.has('error')) {
        showToast(urlParams.get('error'), 'error');
        window.history.replaceState({}, document.title, window.location.pathname);
    }
    </script>
</div>

</body>
</html>
