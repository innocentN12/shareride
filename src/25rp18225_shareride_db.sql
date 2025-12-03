-- Database: 25rp18225_shareride_db

-- Drop database if it exists
DROP DATABASE IF EXISTS 25rp18225_shareride_db;

-- Create database
CREATE DATABASE 25rp18225_shareride_db;

-- Use database
USE 25rp18225_shareride_db;

-- Table: users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    gender ENUM('male', 'female', 'other') NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: rides
CREATE TABLE rides (
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
);

-- Table: ride_passengers
CREATE TABLE ride_passengers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ride_id INT NOT NULL,
    passenger_id INT NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ride_id) REFERENCES rides(id) ON DELETE CASCADE,
    FOREIGN KEY (passenger_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_ride_passenger (ride_id, passenger_id)
);

-- Insert sample data
INSERT INTO users (first_name, last_name, gender, email, password, phone) VALUES
('John', 'Doe', 'male', 'john.doe@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1234567890'),
('Jane', 'Smith', 'female', 'jane.smith@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0987654321');

INSERT INTO rides (driver_id, origin, destination, departure_time, seats_available, price, description) VALUES
(1, 'Kigali', 'Nairobi', '2023-12-10 08:00:00', 3, 50.00, 'Shared ride to Nairobi'),
(2, 'Nairobi', 'Kigali', '2023-12-12 14:00:00', 2, 45.00, 'Returning to Kigali');

INSERT INTO ride_passengers (ride_id, passenger_id, status) VALUES
(1, 2, 'confirmed');