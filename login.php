<?php
 session_start();

 if($_SERVER['REQUSET METHOD'] === 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $authenticated = false;

    $sql = "SELECT *From users WHERE username = '$username'";

    require("lib/cofig.php");
    $result = $conn ->query($sql);

    
 }
?>