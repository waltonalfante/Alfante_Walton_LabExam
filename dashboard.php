<?php
// dashboard.php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - University of Mindanao</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }
        
        .header {
            background: linear-gradient(90deg, #000 0%, #1a4d2e 100%);
            color: white;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header h1 {
            font-size: 24px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .logout-btn {
            background: white;
            color: #1a4d2e;
            padding: 8px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s;
        }
        
        .logout-btn:hover {
            background: #f0f0f0;
        }
        
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }
        
        .welcome-card {
            background: white;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .welcome-card h2 {
            font-size: 32px;
            margin-bottom: 10px;
            color: #1a4d2e;
        }
        
        .welcome-card p {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
        }
        
        .user-details {
            background: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
            text-align: left;
        }
        
        .user-details h3 {
            margin-bottom: 15px;
            color: #333;
        }
        
        .detail-row {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 600;
            width: 120px;
            color: #666;
        }
        
        .detail-value {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <h1>University of Mindanao - Dashboard</h1>
            <div class="user-info">
                <span>Welcome, <?php echo htmlspecialchars($user['first_name']); ?>!</span>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="welcome-card">
            <h2>Welcome to Your Dashboard!</h2>
            <p>You have successfully logged in to the University of Mindanao College of Computing Education portal.</p>
            
            <div class="user-details">
                <h3>Your Account Information</h3>
                <div class="detail-row">
                    <div class="detail-label">Name:</div>
                    <div class="detail-value"><?php echo htmlspecialchars($user['first_name']); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Username:</div>
                    <div class="detail-value"><?php echo htmlspecialchars($user['username']); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Email:</div>
                    <div class="detail-value"><?php echo htmlspecialchars($user['email']); ?></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
