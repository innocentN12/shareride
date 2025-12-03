<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to access page
    header("Location: access.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        
        .user-info {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
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
        
        .logout-btn {
            background-color: #f44336 !important;
        }
        
        .logout-btn:hover {
            background-color: #d32f2f !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard</h1>
        
        <div class="user-info">
            <p>Well logged in</p>
            <p>Hello, <?php echo htmlspecialchars($_SESSION['user_first_name'] . ' ' . $_SESSION['user_last_name']); ?>!</p>
        </div>
        
        <div class="welcome-message">
            <p>Welcome to your dashboard. This is a protected page that only logged-in users can access.</p>
        </div>
        
        <div class="nav-links">
            <a href="home.php">Home</a>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>
</body>
</html>