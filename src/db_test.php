<?php
// Include the database connection file
require_once 'db_connection.php';

try {
    // Test the connection
    echo "Database connection successful!\n";
    
    // Check if the database exists
    $stmt = $pdo->query("SHOW DATABASES LIKE '25rp18225_shareride_db'");
    if ($stmt->rowCount() > 0) {
        echo "Database '25rp18225_shareride_db' exists.\n";
        
        // Select the database
        $pdo->query("USE 25rp18225_shareride_db");
        
        // Check if the users table exists
        $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
        if ($stmt->rowCount() > 0) {
            echo "Table 'users' exists.\n";
        } else {
            echo "Table 'users' does not exist.\n";
            
            // Try to create the users table
            $sql = "CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                first_name VARCHAR(50) NOT NULL,
                last_name VARCHAR(50) NOT NULL,
                gender ENUM('male', 'female', 'other') NOT NULL,
                email VARCHAR(100) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                phone VARCHAR(20),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
            
            $pdo->exec($sql);
            echo "Table 'users' created successfully.\n";
        }
    } else {
        echo "Database '25rp18225_shareride_db' does not exist.\n";
        
        // Try to create the database
        $pdo->exec("CREATE DATABASE 25rp18225_shareride_db");
        echo "Database '25rp18225_shareride_db' created successfully.\n";
        
        // Select the database
        $pdo->query("USE 25rp18225_shareride_db");
        
        // Create the users table
        $sql = "CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(50) NOT NULL,
            last_name VARCHAR(50) NOT NULL,
            gender ENUM('male', 'female', 'other') NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            phone VARCHAR(20),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        
        $pdo->exec($sql);
        echo "Table 'users' created successfully.\n";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>