<!DOCTYPE html>
<html lang="en">

<?php
    require("../lib/config.php");
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
        require("../lib/config.php");  
        if(preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
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
        if(isset($_POST["savechanges"])) {
            $new_name = $_POST["name"];
            $new_email = $_POST["email"];
            $run_sql = true;

            if(!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION["error"] = "Invalid email address.";
                $run_sql = false;
            }

            if ($run_sql) {
                $sql = "UPDATE users SET name = '$new_name', email = '$new_email' WHERE id = '$user_id'";
                $result = $conn->query($sql);

                if($result) {
                    header("Location: index.php");
                } else {
                    $_SESSION["error"] = "Something went wrong.";
                }
            }
        }


        if(isset($_POST["changepassword"])) {
            $old_password = $_POST["old_password"];
            $password = $_POST["new_password"];
            $confirm_password = $_POST["confirm_new_password"];
            $run_sql = true;

            if($password !== $confirm_password) {
                $_SESSION["error"] = "Passwords do not match.";
                $run_sql = false;
            } 

            if(!isValidPassword($password)) {
                $_SESSION["error"] = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
                $run_sql = false;
            }

            if ($run_sql) {
                if(password_verify($old_password, $user['password'])) {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "UPDATE users SET password = '$password' WHERE id = '$user_id'";
                    $result = $conn->query($sql);

                    if($result) {
                        $_SESSION["success"] = "Password changed successfully.";
                    } else {
                        $_SESSION["error"] = "Something went wrong.";
                    }
                } else {
                    $_SESSION["error"] = "Old password is incorrect.";
                }
            }
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
        <div class="flex gap-16">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" autocomplete="off" class="flex flex-col gap-4 w-fit min-w-64">
                <?php if($user["dp_path"] === null) { ?>
                    <div class="bg-[radial-gradient(ellipse_at_bottom_right,_var(--tw-gradient-stops))] from-red-200 via-red-300 to-yellow-200 rounded-full w-64 h-64"></div>
                <?php } else { ?>
                    <img src="../<?php echo $dp_path; ?>" alt="Profile Picture" class="rounded-full w-64 h-64">
                <?php } ?>
            </form>

            <div class="grid grid-cols-2 gap-8 w-full">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                    <h3 class="text-2xl font-medium">Edit Account</h3>

                    <div class="flex flex-col gap-1">
                        <label class="text-stone-600" for="name">Name : </label>
                        <input type="text" id="name" name="name" required class="border border-gray-300 rounded px-4 py-2" value="<?php echo $name; ?>">
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-stone-600" for="email">Email : </label>
                        <input type="email" id="email" name="email" required class="border border-gray-300 rounded px-4 py-2" value="<?php echo $email; ?>">
                    </div>

                    <div class="flex justify-end mt-4">
                        <input type="submit" value="Save Change" name="savechanges" class="bg-black text-white py-2 px-6 rounded-md" role="button">
                    </div>
                </form>
            
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="flex flex-col gap-4">
                    <h3 class="text-2xl font-medium">Change Password</h3>

                    <div class="flex flex-col gap-1">
                        <label class="text-stone-600" for="old_password">Old Password : </label>
                        <input type="password" id="old_password" name="old_password" required class="border border-gray-300 rounded px-4 py-2">
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-stone-600" for="password">New Password : </label>
                        <input type="password" id="new_password" name="new_password" required class="border border-gray-300 rounded px-4 py-2">
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-stone-600" for="confirm_password">Confirm New Password : </label>
                        <input type="password" id="confirm_new_password" name="confirm_new_password" required class="border border-gray-300 rounded px-4 py-2">
                    </div>

                    <div class="flex justify-end mt-4">
                        <input type="submit" value="Change Password" name="changepassword" class="bg-black text-white py-2 px-6 rounded-md" role="button">
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>