<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        h1 {
            color: #333;
            margin-bottom: 30px;
        }
        
        .welcome-message {
            font-size: 18px;
            color: #666;
            margin-bottom: 40px;
        }
        
        .nav-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        
        .nav-links a {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        
        .nav-links a:hover {
            background-color: #45a049;
        }
        
        .user-info {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
        
        .logout-btn {
            background-color: #f44336 !important;
        }
        
        .logout-btn:hover {
            background-color: #d32f2f !important;
        }
        
        .date-display {
            color: #777;
            font-style: italic;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Our Website</h1>
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- User is logged in -->
            <div class="user-info">
                <p>Well logged in</p>
                <p>Hello, <?php echo htmlspecialchars($_SESSION['user_first_name'] . ' ' . $_SESSION['user_last_name']); ?>!</p>
            </div>
            
            <div class="welcome-message">
                <p>You are successfully logged in. Welcome back!</p>
            </div>
            
            <div class="nav-links">
                <a href="dashboard.php">Dashboard</a>
                <a href="logout.php">Logout</a>
            </div>
        <?php else: ?>
            <!-- User is not logged in -->
            <div class="welcome-message">
                <p>We're glad you're here! Please login or register to continue.</p>
            </div>
            
            <div class="nav-links">
                <a href="register.php">Registration Page</a>
                <a href="login.php">Login Page</a>
            </div>
        <?php endif; ?>
        
        <?php
        echo "<p class='date-display'>Current date and time: " . date("Y-m-d H:i:s") . "</p>";
        ?>
    </div>
</body>
</html>