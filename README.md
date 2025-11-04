# ShareRide Application

This is a web application for sharing rides in Rwanda. It allows users to register and login to the system.

## Features
- User registration
- User login

## Prerequisites
- Docker and Docker Compose

## How to Run
1. Clone this repository
2. Navigate to the project directory
3. Run `docker-compose up -d`
4. Access the application at http://localhost:8080
5. Access phpMyAdmin at http://localhost:8081

## Services
- Web application: http://localhost:8080
- Database: MySQL on port 3306
- phpMyAdmin: http://localhost:8081

## Database
- Database name: 25RP18225_shareride_db
- Table: tbl_users
- Credentials: root/root