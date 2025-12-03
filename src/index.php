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
        <div class="welcome-message">
            <p>We're glad you're here! Please login or register to continue.</p>
        </div>
        <div class="nav-links">
            <a href="register.php">Registration Page</a>
            <a href="login.php">Login Page</a>
        </div>
        
        <?php
        echo "<p class='date-display'>Current date and time: " . date("Y-m-d H:i:s") . "</p>";
        ?>
    </div>
</body>
</html>