<?php
// Database configuration
$host = 'localhost';
$user = 'your_db_user';
$pass = 'your_db_password';
$dbname = 'your_database_name';

// Create connection
$conn = new mysqli($host, $user, $pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS `$dbname`";
if ($conn->query($sql) === FALSE) {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($dbname);

// Create Courses table
$sql = "
CREATE TABLE IF NOT EXISTS Courses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(50),
    description TEXT,
    level VARCHAR(30),
    created_at DATETIME
)";
if ($conn->query($sql) === FALSE) {
    die("Error creating Courses table: " . $conn->error);
}

// Insert initial data into Courses
$sql = "
INSERT INTO Courses (title, description, level, created_at) VALUES
('title1','Lorem Lorem','Débutant','2025-12-01 11:42:03'),
('title2','Lorem Lorem','Intermédiaire','2025-12-01 11:45:03'),
('title3','Lorem Lorem','Intermédiaire','2025-12-01 13:26:28')
";
if ($conn->query($sql) === FALSE) {
    echo "Error inserting into Courses (might already exist): " . $conn->error . "\n";
}

// Create Sections table
$sql = "
CREATE TABLE IF NOT EXISTS Sections (
    id INT PRIMARY KEY AUTO_INCREMENT,
    courses_id INT NOT NULL,
    title VARCHAR(30),
    content TEXT,
    position INT,
    created_at DATETIME,
    FOREIGN KEY (courses_id) REFERENCES Courses(id)
)";
if ($conn->query($sql) === FALSE) {
    die("Error creating Sections table: " . $conn->error);
}

// Insert initial data into Sections
$sql = "
INSERT INTO Sections (courses_id, title, content, position, created_at) VALUES
(2,'title1','LOREM LOREM LOREM',1,'2025-12-01 12:21:55'),
(1,'title2','LOREM LOREM LOREM',1,'2025-12-01 12:28:55')
";
if ($conn->query($sql) === FALSE) {
    echo "Error inserting into Sections (might already exist): " . $conn->error . "\n";
}

echo "Database and tables initialized successfully.";

$conn->close();
?>
