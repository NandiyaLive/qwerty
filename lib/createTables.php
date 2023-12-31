<?php
    require_once("config.php");
    
    $sql = "CREATE TABLE users (
                id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                username VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                dp_path VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";

    if (mysqli_query($conn, $sql)) {
        echo "Table users created successfully<br>";
    } else {
        echo "Error creating table: " . mysqli_error($conn) . "<br>";
    }

    $sql = "CREATE TABLE notes (
                id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                user_id INT(6) NOT NULL,
                title VARCHAR(255) NOT NULL,
                content TEXT NOT NULL,
                banner_path VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id)
            )";

    if (mysqli_query($conn, $sql)) {
        echo "Table notes created successfully<br>";
    } else {
        echo "Error creating table: " . mysqli_error($conn) . "<br>";
    }
?>