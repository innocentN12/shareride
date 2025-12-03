<?php
// Include the database connection file
require_once 'db_connection.php';

try {
    // Create the users table
    $sql = "CREATE TABLE IF NOT EXISTS users (
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
    
    // Create the rides table
    $sql = "CREATE TABLE IF NOT EXISTS rides (
        id INT AUTO_INCREMENT PRIMARY KEY,
        driver_id INT NOT NULL,
        origin VARCHAR(255) NOT NULL,
        destination VARCHAR(255) NOT NULL,
        departure_time DATETIME NOT NULL,
        seats_available INT NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (driver_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    
    $pdo->exec($sql);
    
    // Create the ride_passengers table
    $sql = "CREATE TABLE IF NOT EXISTS ride_passengers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ride_id INT NOT NULL,
        passenger_id INT NOT NULL,
        status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (ride_id) REFERENCES rides(id) ON DELETE CASCADE,
        FOREIGN KEY (passenger_id) REFERENCES users(id) ON DELETE CASCADE,
        UNIQUE KEY unique_ride_passenger (ride_id, passenger_id)
    )";
    
    $pdo->exec($sql);
    
    echo "Database tables created successfully!";
    
} catch (PDOException $e) {
    echo "Error creating tables: " . $e->getMessage();
}
?>