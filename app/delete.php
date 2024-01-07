<?php
    require_once("../lib/config.php");
    require("../lib/auth.php");

    if(isset($_GET["id"])) {
        $_SESSION["note_id"] = $_GET["id"];
    }

    $user_id = $_SESSION["user_id"];
    $note_id = $_SESSION["note_id"];

    $sql = "SELECT * FROM notes WHERE id = '$note_id' AND user_id = '$user_id'";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($result->num_rows === 0) {
        $_SESSION["error"] = "Note not found";
    } else {
        $title = $row["title"];
        $banner_path = $row["banner_path"];
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST["delete"])) {
            $sql = "DELETE FROM notes WHERE id = '$note_id' AND user_id = '$user_id'";

            if($conn->query($sql) === TRUE) {
                unset($_SESSION["note_id"]);
                require("../lib/deleteImage.php");
                deleteImage($banner_path);
                header("Location: .");
            } else {
                $_SESSION["error"] = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
?>

<!DOCTYPE html>
<html>

<?php
    include("../components/head.php");
    render_head("Note");
?>

<body>
    <header>
        <?php
            include("../components/navbar.php")
        ?>
    </header>


    <main class="container max-w-7xl">
        <?php if (isset($_SESSION["error"])) { ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">
                    <?php
                        echo $_SESSION["error"];
                        unset($_SESSION["error"]);
                    ?>
                </span>
            </div>
        <?php } else { ?>
        <div class="max-w-2xl mx-auto border p-4">
            <p class="text-lg">
                Do you want to delete this note "<?php echo $title ?>"?
            </p>

            <div class="flex items-center justify-end gap-2 mt-8">
                <a href="./">
                    <button class="bg-black text-white py-2 px-8 rounded">
                        Cancel
                    </button>
                </a>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <input type="hidden" name="note_id" value="<?php echo $note_id ?>">
                    <button type="submit" name="delete" class="bg-red-500 text-white py-2 px-8 rounded">
                        Delete
                    </button>
                </form>
            </div>
        </div>
        <?php } ?>
    </main>
</body>

</html>