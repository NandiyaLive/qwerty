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


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["remove_dp"])) {
            $dp_path = null;
        }

        if(isset($_POST["name"]) && $_POST["name"] !== "") {
            $name = $_POST["name"];
        }

        if(isset($_POST["email"]) && $_POST["email"] !== "") {
            $email = $_POST["email"];
        }

        if(isset($_POST["username"]) && $_POST["username"] !== "") {
            $username = $_POST["username"];

            if (!isValidUsername($username)) {
                $_SESSION["error"] = "Username already exists.";
                $run_sql = false;
            }
        }

        if(isset($_POST["old_password"]) && $_POST["old_password"] !== "") {
            $old_password = $_POST["old_password"];
        }

        if(isset($_POST["password"]) && $_POST["password"] !== "") {
            $password = $_POST["password"];
        }

        if(isset($_POST["confirm_password"]) && $_POST["confirm_password"] !== "") {
            $confirm_password = $_POST["confirm_password"];
        }

        if($password !== $confirm_password) {
            $_SESSION["error"] = "Passwords do not match.";
            $run_sql = false;
        } 

        if(!isValidPassword($password)) {
            $_SESSION["error"] = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
            $run_sql = false;
        }
    }
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


    <main class="container max-w-7xl mb-16">
        <h1 class="text-5xl font-bold">Edit Account</h1>

        <form action="../lib/edit.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="flex flex-col gap-4 mt-8">
                <div class="flex gap-16">
                    <div class="flex flex-col items-center gap-4">
                        <div class="flex-shrink-0">
                            <img src="../<?php echo $dp_path; ?>" alt="Profile Picture" class="rounded-full w-64 h-64">
                        </div>

                        <button class="bg-black text-white py-2 px-6 rounded-md" name="remove_dp" value="true" role="button">Remove Profile Picture</button>
                    </div>

                    <div class="flex flex-col gap-4">
                        <div class="flex flex-col gap-1">
                            <label class="text-stone-600" for="name">Name : </label>
                            <input type="text" id="name" name="name" required class="border border-gray-300 rounded px-4 py-2" value="<?php echo $name; ?>">
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="text-stone-600" for="email">Email : </label>
                            <input type="email" id="email" name="email" required class="border border-gray-300 rounded px-4 py-2" value="<?php echo $email; ?>">
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="text-stone-600" for="username">Username : </label>
                            <input type="text" id="username" name="username" required class="border border-gray-300 rounded px-4 py-2" value="<?php echo $username; ?>">
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="text-stone-600" for="profile_picture">New Profile Picture : </label>
                            <input type="file" id="profile_picture" name="profile_picture" class="border border-gray-300 rounded px-4 py-2">
                        </div>

                        <h3 class="text-2xl font-bold mt-8">Change Password</h3>

                        <div class="flex flex-col gap-1">
                            <label class="text-stone-600" for="password">Old Password : </label>
                            <input type="password" id="old_password" name="old_password" class="border border-gray-300 rounded px-4 py-2">
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="text-stone-600" for="password">New Password : </label>
                            <input type="password" id="password" name="password" class="border border-gray-300 rounded px-4 py-2">
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="text-stone-600" for="confirm_password">Confirm New Password : </label>
                            <input type="password" id="confirm_password" name="confirm_password" class="border border-gray-300 rounded px-4 py-2">
                        </div>

                        <button type="submit" class="bg-black text-white py-2 px-6 rounded-md mt-8" role="button">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </main>
</body>

</html>