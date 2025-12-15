<?php
// login.php
session_start();

$usersFile = 'users.json';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    // Basic validation
    if (empty($username) || empty($password)) {
        $error = 'Both fields are required';
    } else {
        // Load users
        if (file_exists($usersFile)) {
            $users = json_decode(file_get_contents($usersFile), true);
            
            $loginSuccess = false;
            foreach ($users as $user) {
                if ($user['username'] === $username) {
                    if (password_verify($password, $user['password'])) {
                        // Login successful
                        $_SESSION['user'] = [
                            'username' => $user['username'],
                            'first_name' => $user['first_name'],
                            'email' => $user['email']
                        ];
                        $success = 'Login Successful!';
                        $loginSuccess = true;
                        
                        // Redirect to dashboard
                        header("refresh:2;url=dashboard.php");
                        break;
                    }
                }
            }
            
            if (!$loginSuccess) {
                $error = 'Invalid username or password';
            }
        } else {
            $error = 'No users registered yet';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - University of Mindanao</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(180deg, #000 0%, #1a4d2e 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 8px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .logo img {
            width: 120px;
            height: 120px;
            object-fit: contain;
        }
        
        h1 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 10px;
        }
        
        .subtitle {
            text-align: center;
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }
        
        .tagline {
            text-align: center;
            font-size: 12px;
            color: #999;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: 500;
        }
        
        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        input:focus {
            outline: none;
            border-color: #1a4d2e;
        }
        
        button {
            width: 100%;
            padding: 12px;
            background: #000;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        button:hover {
            background: #333;
        }
        
        .links {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
        
        .links a {
            color: #1a4d2e;
            text-decoration: none;
        }
        
        .links a:hover {
            text-decoration: underline;
        }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #999;
        }
        
        .error {
            background: #fee;
            color: #c33;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .success {
            background: #efe;
            color: #3c3;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .page-title {
            color: #999;
            font-size: 14px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="photos/CCE LOGO.png" alt="University of Mindanao" />
        </div>
        
        <h1>University of Mindanao</h1>
        <div class="subtitle">College of Computing Education</div>
        <div class="tagline">Welcome back, login to your account</div>
        
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="success"><?php echo htmlspecialchars($success); ?> Redirecting...</div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter your username" required value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            
            <button type="submit">Login</button>
        </form>
        
        <div class="links">
            Don't have an account? <a href="register.php">Register here</a>
        </div>
        
        <div class="footer">
            © 2025 University of Mindanao. All rights reserved.
        </div>
    </div>
</body>
</html>