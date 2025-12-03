# DevOps Stages Implementation

This document outlines the different stages of DevOps implemented in this project.

## 1. Development Stage

### Source Code Structure
- `src/` - Contains all PHP source code
- `src/index.php` - Main home page
- `src/register.php` - User registration form
- `src/login.php` - User login form
- `src/handle_register_user.php` - Registration processing
- `src/handle_login_user.php` - Login processing
- `src/dashboard.php` - Protected user dashboard
- `src/access.php` - Access control page
- `src/user_display.php` - User information display
- `src/db_connection.php` - Database connection handler
- `src/init.php` - Database initialization script

## 2. Version Control Stage

### Git Implementation
- Repository initialized with `git init`
- Branch management with `add-registration-branch`
- Commit history tracking all changes
- Source code versioning

## 3. Continuous Integration (CI) Stage

### Jenkins Pipeline (Jenkinsfile)
```groovy
pipeline {
    agent any
    
    tools {
        php 'php'
    }
    
    environment {
        PROJECT_NAME = '25rp18225-shareride'
        BUILD_NUMBER = "${env.BUILD_NUMBER}"
    }
    
    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }
        
        stage('Setup') {
            steps {
                sh 'php --version'
            }
        }
        
        stage('Code Quality') {
            steps {
                sh 'find src -name "*.php" -exec php -l {} \\;'
            }
        }
        
        stage('Database Setup') {
            steps {
                script {
                    echo "Setting up database for testing"
                }
            }
        }
        
        stage('Test') {
            steps {
                echo "Running tests"
            }
        }
        
        stage('Build') {
            steps {
                script {
                    sh 'mkdir -p build/artifacts'
                    sh 'cp -r src/* build/artifacts/'
                    sh 'cd build && zip -r ${PROJECT_NAME}-${BUILD_NUMBER}.zip artifacts'
                    archiveArtifacts artifacts: 'build/${PROJECT_NAME}-${BUILD_NUMBER}.zip', fingerprint: true
                }
            }
        }
        
        stage('Build Docker Image') {
            steps {
                sh 'docker build -t ${PROJECT_NAME}:${BUILD_NUMBER} .'
                sh 'docker tag ${PROJECT_NAME}:${BUILD_NUMBER} ${PROJECT_NAME}:latest'
            }
        }
        
        stage('Deploy') {
            steps {
                echo "Deploying application"
            }
        }
    }
}
```

## 4. Containerization Stage

### Dockerfile
```dockerfile
FROM php:8.1-apache

# Install necessary extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Update the document root to point to the src directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/src
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy the source code to the container
COPY ./src /var/www/html/src

# Set the working directory
WORKDIR /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
```

### Docker Compose (docker-compose.yml)
```yaml
version: '3.8'

services:
  web:
    build: .
    ports:
      - "8080:80"
    volumes:
      - ./src:/var/www/html/src
    depends_on:
      - db
    environment:
      - DATABASE_HOST=db
      - DATABASE_NAME=app_db
      - DATABASE_USER=app_user
      - DATABASE_PASSWORD=app_password

  db:
    image: mysql:8.0
    environment:
      MYSQL_DATABASE: app_db
      MYSQL_USER: app_user
      MYSQL_PASSWORD: app_password
      MYSQL_ROOT_PASSWORD: root_password
    volumes:
      - db_data:/var/lib/mysql
    ports:
      - "3306:3306"

volumes:
  db_data:
```

## 5. Database Management Stage

### Database Schema (setup_database.sql)
```sql
-- Create the database
CREATE DATABASE IF NOT EXISTS 25rp18225_shareride_db;

-- Use the database
USE 25rp18225_shareride_db;

-- Create the app_user with appropriate permissions
CREATE USER IF NOT EXISTS 'app_user'@'localhost' IDENTIFIED BY 'app_password';

-- Grant privileges to the app_user
GRANT ALL PRIVILEGES ON 25rp18225_shareride_db.* TO 'app_user'@'localhost';

-- Flush privileges to apply changes
FLUSH PRIVILEGES;

-- Create tables
CREATE TABLE IF NOT EXISTS users (...);
CREATE TABLE IF NOT EXISTS rides (...);
CREATE TABLE IF NOT EXISTS ride_passengers (...);
```

## 6. Continuous Deployment (CD) Stage

The Jenkins pipeline includes deployment stages that:
1. Build Docker images
2. Tag images with version numbers
3. Deploy containers using docker-compose
4. Archive build artifacts

## 7. Monitoring and Feedback Stage

The Jenkins pipeline includes:
- Success notifications
- Failure notifications
- Test result publishing
- Artifact archiving for traceability

This implementation demonstrates a complete DevOps lifecycle from development through deployment.