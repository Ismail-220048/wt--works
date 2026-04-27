<?php
include "config.php";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    
    $user = $usersCollection->findOne(['email' => $email]);

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user'] = $user['name'];
        $_SESSION['email'] = $user['email'];

        header("Location: index.php?success=Logged+in+successfully");
        exit();

    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - IS-mail</title>
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

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 50px 40px;
            width: 400px;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            text-align: center;
            border: 1px solid rgba(255,255,255,0.5);
        }

        .login-card h2 {
            margin-bottom: 5px;
            color: #102a43;
            font-size: 28px;
            font-weight: 700;
        }
        
        .login-card p.subtitle {
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
        }

        button.primary-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(26, 115, 232, 0.4);
        }

        .google-btn {
            background: white;
            color: #486581;
            border: 1px solid #d9e2ec;
            margin-top: 15px;
            width: 100%;
            padding: 15px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .google-btn:hover {
            background: #f0f4f8;
            color: #102a43;
        }

        .signup-link {
            margin-top: 25px;
            display: block;
            font-size: 15px;
            color: #627d98;
        }

        .signup-link a {
            color: #1a73e8;
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link a:hover {
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
        
        .divider {
            margin: 20px 0;
            display: flex;
            align-items: center;
            color: #9fb3c8;
            font-size: 14px;
        }
        .divider::before, .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #d9e2ec;
        }
        .divider span { padding: 0 10px; }
    </style>
</head>

<body>

<div class="login-card">
    <h2>Welcome Back</h2>
    <p class="subtitle">Sign in to IS-mail to continue</p>

    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login" class="primary-btn">Sign In</button>
    </form>
    
    <div class="divider"><span>or</span></div>

    <a href="google-login.php" style="text-decoration:none;">
        <button class="google-btn">
            <svg width="18" height="18" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
            Continue with Google
        </button>
    </a>

    <div class="signup-link">
        Don’t have an account? <a href="signup.php">Create Account</a>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<script>
    const toastContainer = document.createElement('div');
    toastContainer.style.cssText = "position:fixed;bottom:30px;right:30px;z-index:9999;display:flex;flex-direction:column;gap:15px;pointer-events:none;";
    document.body.appendChild(toastContainer);

    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        let color = type === 'success' ? '#4ECDC4' : '#ff5252';
        let iconClass = type === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation';
        
        toast.style.cssText = `background:white;color:#333;padding:15px 25px;border-radius:12px;box-shadow:0 10px 40px rgba(0,0,0,0.1);display:flex;align-items:center;gap:15px;font-weight:500;font-size:15px;border-left:5px solid ${color};transition:all 0.4s;opacity:1;transform:translateY(0)`;
        toast.innerHTML = `<i class="fa-solid ${iconClass}" style="color:${color}"></i> <span>${message}</span>`;
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

</body>
</html>
