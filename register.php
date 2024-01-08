<!DOCTYPE html>
<html lang="en">

<?php
    // Check if form is submitted
    function isValidPassword($password) {
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            return false;
        } else{
            return true;
        }
    }

    function isValidUsername($username) {       
        if(preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
            require("lib/config.php");
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = $conn->query($sql);

            if($result->num_rows > 0) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    function isValidEmail($email) {
        require("lib/config.php");
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            return false;
        } else {
            return true;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        $dp_path = null;
        $run_sql = true;

        if (!isValidUsername($username)) {
            $_SESSION["error"] = "Username already exists.";
            $run_sql = false;
        }

        if($password !== $confirm_password) {
            $_SESSION["error"] = "Passwords do not match.";
            $run_sql = false;
        } 

        if(!isValidPassword($password)) {
            $_SESSION["error"] = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
            $run_sql = false;
        }

        if(isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["name"] !== "") { 
            $profile_picture = $_FILES["profile_picture"];
            $target_file_name = $username . "_dp." . strtolower(pathinfo($profile_picture["name"],PATHINFO_EXTENSION));

            require("lib/uploadImage.php");
            $upload_status = uploadImage($profile_picture, "uploads/profile_images/", $target_file_name);
    
            if($upload_status["status"] === "success") {
                $dp_path = $upload_status["file_path"];
            } else {
                $_SESSION["error"] = $upload_status["message"];
                $run_sql = false;
            }
        }

        if($run_sql) {
            $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

            require("lib/config.php");
            $sql = "INSERT INTO users (name, email, username, password, dp_path) VALUES ('$username', '$email', '$username', '$encrypted_password', '$dp_path')";

            if ($conn->query($sql) === TRUE) {
                header("Location: login.php");
            } else {
                $_SESSION["error"] = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
?>

<?php 
    include("components/head.php");
    render_head("Register");
?>

<body class="bg-gray-100">
    <div class="flex flex-col gap-4 justify-center items-center h-screen">
        <a href="index.php">
            <h1 class='text-2xl font-bold'>QWERTY</h1>
        </a>
        <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
            <h2 class="text-2xl mb-4">Register</h2>
            <?php if (isset($_SESSION["error"])) { ?>
                <p class="text-red-500 mb-4">
                    <?php
                        echo $_SESSION["error"];
                        unset($_SESSION["error"]);
                    ?>
                </p>
            <?php } ?>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 mb-1">Name:</label>
                    <input type="text" id="name" name="name" required class="border border-gray-300 rounded px-4 py-2 w-full">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 mb-1">Email:</label>
                    <input type="email" id="email" name="email" required class="border border-gray-300 rounded px-4 py-2 w-full">
                </div>

                <div class="mb-4">
                    <label for="username" class="block text-gray-700 mb-1">Username:</label>
                    <input type="text" id="username" name="username" required class="border border-gray-300 rounded px-4 py-2 w-full">
                </div>
                
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 mb-1">Password:</label>
                    <input type="password" id="password" name="password" required class="border border-gray-300 rounded px-4 py-2 w-full">
                </div>

                <div class="mb-4">
                    <label for="confirm_password" class="block text-gray-700 mb-1">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required class="border border-gray-300 rounded px-4 py-2 w-full">
                </div>

                <div class="mb-4">
                    <label for="profile_picture" class="block text-gray-700 mb-1">Profile Picture:</label>
                    <input type="file" id="profile_picture" name="profile_picture" class="border border-gray-300 rounded px-4 py-2 w-full">
                </div>

                <div class="mb-4">
                    <input type="submit" value="Register" class="bg-blue-500 text-white px-4 py-2 rounded">
                </div>
            </form>

            <p class="text-gray-500 text-sm">Already have an account? <a href="login.php" class="text-blue-500">Login</a></p>
        </div>
    </div>
</body>

</html>