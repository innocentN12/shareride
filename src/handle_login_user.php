<?php
session_start();

// Include the database connection file
require_once 'db_connection.php';

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    // Validate input
    if (empty($email) || empty($password)) {
        $_SESSION['message'] = "Please fill in all fields.";
        $_SESSION['message_type'] = "error";
        header("Location: login.php");
        exit();
    } else {
        try {
            // Prepare a select statement
            $stmt = $pdo->prepare("SELECT id, first_name, last_name, email, password FROM users WHERE email = ?");
            $stmt->execute([$email]);
            
            // Check if user exists
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch();
                
                // Verify password
                if (password_verify($password, $user['password'])) {
                    // Password is correct, start a new session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['user_first_name'] = $user['first_name'];
                    $_SESSION['user_last_name'] = $user['last_name'];
                    
                    // Set success message
                    $_SESSION['message'] = "Welcome back, " . $user['first_name'] . "!";
                    $_SESSION['message_type'] = "success";
                    
                    // Redirect to home page
                    header("Location: home.php");
                    exit();
                } else {
                    $_SESSION['message'] = "Invalid email or password.";
                    $_SESSION['message_type'] = "error";
                    header("Location: login.php");
                    exit();
                }
            } else {
                $_SESSION['message'] = "Invalid email or password.";
                $_SESSION['message_type'] = "error";
                header("Location: login.php");
                exit();
            }
        } catch (PDOException $e) {
            $_SESSION['message'] = "An error occurred. Please try again later.";
            $_SESSION['message_type'] = "error";
            header("Location: login.php");
            exit();
        }
    }
} else {
    // If not a POST request, redirect to login page
    header("Location: login.php");
    exit();
}
?>