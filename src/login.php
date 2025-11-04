<?php
session_start();
// Database connection
$conn = new mysqli("25rp18225_db", "root", "root", "25RP18225_shareride_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// Handle form submission
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT user_id, user_firstname, user_lastname, user_gender, user_email, user_password FROM tbl_users WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if ($row && password_verify($password, $row['user_password'])) {
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['user_email'] = $row['user_email'];
        $message = "Login successful!";
        // Redirect to home page or dashboard
        // header("Location: index.php");
    } else {
        $message = "Invalid email or password!";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
  <h2>User Login</h2>
  <?php if (!empty($message)) echo "<p>$message</p>"; ?>
  <form method="post" action="">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit" name="login">Login</button>
  </form>
  <p><a href="index.php">Back to Home</a></p>
</body>
</html>