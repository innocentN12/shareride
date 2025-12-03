<?php
// Database configuration - using more common default values for local development
$host = getenv('DATABASE_HOST') ?: 'localhost';
$dbname = getenv('DATABASE_NAME') ?: '25rp18225_shareride_db';
$username = getenv('DATABASE_USER') ?: 'root';  // Changed from 'app_user' to 'root'
$password = getenv('DATABASE_PASSWORD') ?: '';   // Changed from 'app_password' to empty string

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Uncomment the line below for debugging purposes
    // echo "Connected successfully";
} catch(PDOException $e) {
    // Handle connection errors
    die("Connection failed: " . $e->getMessage());
}
?>