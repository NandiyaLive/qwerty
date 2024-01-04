<!DOCTYPE html>
<html lang="en">

<?php
    require_once("../lib/config.php");
    require("../lib/auth.php");

    $username = $_SESSION['username'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    $user_id = $user['id'];
    $email = $user['email'];
    $name = $user['name'];
    $dp_path = $user['dp_path'];
?>

<?php
    include("../components/head.php");
    render_head("Account");
?>

<body>
    <header>
        <?php
        include("../components/navbar.php")
        ?>
    </header>


    <main class="container max-w-7xl">
        <div class="flex justify-between items-center">
            <h1 class="text-5xl font-bold">Account</h1>

            <a href="../account/edit.php">
                <div class="bg-black text-white py-2 px-6 rounded-md" role="button">
                    Edit
                </div>
            </a>
        </div>

        <div class="flex flex-col gap-4 mt-8">
            <div class="flex gap-4">
                <div class="flex-shrink-0">
                    <img src="../<?php echo $dp_path; ?>" alt="Profile Picture" class="rounded-full w-32 h-32">
                </div>
                <div>
                    <p class="text-2xl font-bold"><?php echo $name; ?></p>
                    <p class="text-gray-500 ">@<?php echo $username; ?></p>

                    <p class="mt-8">
                        <span class="text-gray-500">User ID: </span>
                        <span><?php echo $user_id; ?></span>
                    </p>
                    <p>
                        <span class="text-gray-500">Email : </span>
                        <span><?php echo $email; ?></span>
                    </p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>