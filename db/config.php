<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portal"; 

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$queries = [
    "CREATE TABLE IF NOT EXISTS admin_login (
        Id INT NOT NULL AUTO_INCREMENT,
        Name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        Password VARCHAR(100) NOT NULL,
        PRIMARY KEY (Id)
    ) ENGINE=InnoDB",

    "CREATE TABLE IF NOT EXISTS announcements (
        id INT NOT NULL AUTO_INCREMENT,
        title VARCHAR(255) NOT NULL,
        content TEXT NOT NULL,
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        is_active TINYINT(1) DEFAULT NULL,
        PRIMARY KEY (id)
    ) ENGINE=InnoDB",

    "CREATE TABLE IF NOT EXISTS news (
        id INT NOT NULL AUTO_INCREMENT,
        title VARCHAR(255) NOT NULL,
        summary TEXT DEFAULT NULL,
        content LONGTEXT NOT NULL,
        category ENUM('Academic', 'Events', 'Sports', 'Exams') NOT NULL,
        status ENUM('published', 'draft', 'pending') DEFAULT 'draft',
        featured_image VARCHAR(255) DEFAULT NULL,
        views INT DEFAULT 0,
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) ENGINE=InnoDB"
];

foreach ($queries as $sql) {
    if (!$conn->query($sql)) {
        echo "Error creating table: " . $conn->error . "<br>";
    }
}

?>