<?php
 session_start();

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $authenticated = false;

    $sql = "SELECT *From users WHERE username = '$username'";

    require("lib/config.php");
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
<!DOCTYPE html>
<html>

<?php 
    include("components/head.php");
    render_head("Login");
?>

<body class="bg-gray-100">
    <div class="flex flex-col gap-4 justify-center items-center h-screen">
        <a href="index.php">
            <h1 class='text-2xl font-bold'>QWERTY</h1>
        </a>
        <div class="bg-white p-8 rounded shadow-md">
            <h2 class="text-2xl mb-4">Login</h2>
            <?php if (isset($error)) { ?>
                <p class="text-red-500 mb-4"><?php echo $error; ?></p>
            <?php } ?>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 mb-1">Username:</label>
                    <input type="text" id="username" name="username" required class="border border-gray-300 rounded px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 mb-1">Password:</label>
                    <input type="password" id="password" name="password" required class="border border-gray-300 rounded px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <input type="submit" value="Login" class="bg-blue-500 text-white px-4 py-2 rounded">
                </div>
            </form>

            <p class="text-gray-500 text-sm">Don't have an account? <a href="register.php" class="text-blue-500">Register</a></p>
        </div>
    </div>
</body>

</html>