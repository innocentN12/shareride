<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // User is already logged in, redirect to dashboard
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Required</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 600px;
            margin: 100px auto;
            background-color: white;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        
        .message {
            font-size: 18px;
            color: #666;
            margin-bottom: 30px;
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
        
        .login-link {
            background-color: #2196F3 !important;
        }
        
        .login-link:hover {
            background-color: #0b7dda !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Access Required</h1>
        
        <div class="message">
            <p>You need to be logged in to access this page.</p>
            <p>Please login or register to continue.</p>
        </div>
        
        <div class="nav-links">
            <a href="register.php">Register</a>
            <a href="login.php" class="login-link">Login</a>
            <a href="home.php">Home</a>
        </div>
    </div>
</body>
</html>