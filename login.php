<?php
 session_start();

 if($_SERVER['REQUSET METHOD'] === 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $authenticated = false;

    $sql = "SELECT *From users WHERE username = '$username'";

    require("lib/cofig.php");
    $result = $conn ->query($sql);

    if ($result -> num_rows > 0){
        $user = $result -> fetch_assoc();

        if(password_verify($password,$user['password'])){
            $authenticated = true;
        }
    }

    if ($authenticated) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header('Location: app/index.php');
    } else {
        $error = 'Invalid username or password.';
    }
    
 }
?>