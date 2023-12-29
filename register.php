<?php
// Check if form is submitted
if ($_SERVER['METHOD'] === 'POST') {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if username already exists
    $existing_usernames = ['john', 'jane', 'doe']; // Replace with your existing usernames array
    if (in_array($username, $existing_usernames)) {
        $error = 'Username already exists. Please choose a different username.';
        exit;
    }

    // TODO: Add code to register the user
    // ...

    // Redirect to success page
    header('Location: success.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include("components/head.php"); ?>

<body class="bg-gray-100">
    <div class="flex flex-col gap-4 justify-center items-center h-screen">
        <a href="index.php">
            <h1 class='text-2xl font-bold'>QWERTY</h1>
        </a>
        <div class="bg-white p-8 rounded shadow-md">
            <h2 class="text-2xl mb-4">Register</h2>
            <?php if (isset($error)) { ?>
                <p class="text-red-500 mb-4"><?php echo $error; ?></p>
            <?php } ?>
            <form method="POST" action="register.php">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700">Username:</label>
                    <input type="text" id="username" name="username" required class="border border-gray-300 rounded px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password:</label>
                    <input type="password" id="password" name="password" required class="border border-gray-300 rounded px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="confirm_password" class="block text-gray-700">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required class="border border-gray-300 rounded px-4 py-2 w-full">
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