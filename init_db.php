<?php
// Database configuration
$host = 'localhost';
$dbname = 'your_database_name';
$user = 'your_db_user';
$pass = 'your_db_password';

try {
    // Create PDO instance
    $pdo = new PDO("mysql:host=$host;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create database if not exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname`");
    $pdo->exec("USE `$dbname`");

    // Create Courses table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS Courses (
            id INT PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(50),
            description TEXT,
            level VARCHAR(30),
            created_at DATETIME
        )
    ");

    // Insert initial data into Courses
    $pdo->exec("
        INSERT INTO Courses (title, description, level, created_at) VALUES
        ('title1','Lorem Lorem','Débutant','2025-12-01 11:42:03'),
        ('title2','Lorem Lorem','Intermédiaire','2025-12-01 11:45:03'),
        ('title3','Lorem Lorem','Intermédiaire','2025-12-01 13:26:28')
    ");

    // Create Sections table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS Sections (
            id INT PRIMARY KEY AUTO_INCREMENT,
            courses_id INT NOT NULL,
            title VARCHAR(30),
            content TEXT,
            position INT,
            created_at DATETIME,
            FOREIGN KEY (courses_id) REFERENCES Courses(id)
        )
    ");

    // Insert initial data into Sections
    $pdo->exec("
        INSERT INTO Sections (courses_id, title, content, position, created_at) VALUES
        (2,'title1','LOREM LOREM LOREM',1,'2025-12-01 12:21:55'),
        (1,'title2','LOREM LOREM LOREM',1,'2025-12-01 12:28:55')
    ");

    echo "Database and tables initialized successfully.";

} catch (PDOException $e) {
    die("DB ERROR: " . $e->getMessage());
}
?>
