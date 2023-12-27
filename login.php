<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the username and password are valid
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform authentication logic here
    // ...

    // If authentication is successful, redirect to the home page
    if ($authenticated) {
        $_SESSION['username'] = $username;
        header('Location: app');
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - QWERTY App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex justify-center items-center h-screen">
        <div class="bg-white p-8 rounded shadow-md">
            <h2 class="text-2xl mb-4">Login - QWERTY App</h2>
            <?php if (isset($error)) { ?>
                <p class="text-red-500 mb-4"><?php echo $error; ?></p>
            <?php } ?>
            <form method="POST" action="">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700">Username:</label>
                    <input type="text" id="username" name="username" required class="border border-gray-300 rounded px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password:</label>
                    <input type="password" id="password" name="password" required class="border border-gray-300 rounded px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <input type="submit" value="Login" class="bg-blue-500 text-white px-4 py-2 rounded">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
