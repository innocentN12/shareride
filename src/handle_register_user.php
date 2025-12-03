<?php
// Include the database connection file
require_once 'db_connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $firstName = $_POST['first_name'] ?? '';
    $lastName = $_POST['last_name'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Validate input
    if (empty($firstName) || empty($lastName) || empty($gender) || empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long.";
    } else {
        try {
            // Check if email already exists
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->rowCount() > 0) {
                $error = "Email already registered. Please use a different email.";
            } else {
                // Hash the password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                
                // Insert the user into the database
                $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, gender, email, password) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$firstName, $lastName, $gender, $email, $hashedPassword]);
                
                // Success message
                $success = "Registration successful! You can now login.";
            }
        } catch (PDOException $e) {
            // More detailed error message for debugging
            $error = "Database error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 500px;
            margin: 100px auto;
            background-color: white;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        .success {
            color: #4CAF50;
        }
        
        .error {
            color: #f44336;
        }
        
        .links {
            margin-top: 20px;
        }
        
        .links a {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            margin: 5px;
        }
        
        .links a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($error)): ?>
            <h1 class="error">Registration Failed</h1>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php elseif (isset($success)): ?>
            <h1 class="success">Registration Successful</h1>
            <p class="success"><?php echo htmlspecialchars($success); ?></p>
        <?php else: ?>
            <h1>Registration Result</h1>
            <p>No registration attempt made.</p>
        <?php endif; ?>
        
        <div class="links">
            <a href="register.php">Try Again</a>
            <a href="login.php">Login</a>
            <a href="home.php">Go to Home</a>
        </div>
    </div>
</body>
</html>