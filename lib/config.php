<?php
    $DB_HOST="localhost";
    $DB_PORT=3306;
    $DB_USER="root";
    $DB_PASS="";
    $DB_NAME="qwerty";

    $conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>