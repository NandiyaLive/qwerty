<!DOCTYPE html>
<html lang="en">

<?php
    require("../lib/auth.php");
    require_once("../lib/config.php");

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
            <div class="flex gap-16 md:flex-col">
                <?php if($user["dp_path"] === null) { ?>
                    <div class="bg-[radial-gradient(ellipse_at_bottom_right,_var(--tw-gradient-stops))] from-red-200 via-red-300 to-yellow-200 rounded-full w-64 h-64 sm:mx-auto"></div>
                <?php } else { ?>
                    <img src="../<?php echo $dp_path; ?>" alt="Profile Picture" class="rounded-full w-64 h-64 md:mx-auto">
                <?php } ?>
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