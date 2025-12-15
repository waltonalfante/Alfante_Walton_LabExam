<?php
// register.php
session_start();

// Initialize users file if it doesn't exist
$usersFile = 'users.json';
if (!file_exists($usersFile)) {
    file_put_contents($usersFile, json_encode([]));
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['first_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    // Basic validation
    if (empty($firstName) || empty($email) || empty($username) || empty($password)) {
        $error = 'All fields are required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters';
    } else {
        // Load existing users
        $users = json_decode(file_get_contents($usersFile), true);
        
        // Check if username or email already exists
        $userExists = false;
        foreach ($users as $user) {
            if ($user['username'] === $username) {
                $error = 'Username already exists';
                $userExists = true;
                break;
            }
            if ($user['email'] === $email) {
                $error = 'Email already registered';
                $userExists = true;
                break;
            }
        }
        
        if (!$userExists) {
            // Add new user
            $users[] = [
                'first_name' => $firstName,
                'email' => $email,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ];
            
            file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
            $success = 'Registration Successful!';
            
            // Redirect to login after 2 seconds
            header("refresh:2;url=login.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - University of Mindanao</title>
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
        <div class="tagline">We've got totally got you learning journey!</div>
        
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="success"><?php echo htmlspecialchars($success); ?> Redirecting to login...</div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="first_name" placeholder="Enter your full name" required value="<?php echo htmlspecialchars($_POST['first_name'] ?? ''); ?>">
            </div>
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter your email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            </div>
            
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Create a username" required value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Create a password" required>
            </div>
            
            <button type="submit">Register</button>
        </form>
        
        <div class="links">
            Already have an account? <a href="login.php">Login here</a>
        </div>
        
        <div class="footer">
            © 2025 University of Mindanao. All rights reserved.
        </div>
    </div>
</body>
</html>