<!DOCTYPE html>
<html lang="en">

<?php
    require("../lib/auth.php");
    require_once("../lib/config.php");
    
    if(isset($_GET["id"])) {
        $_SESSION["note_id"] = $_GET["id"];    
    } else {
        $_SESSION["error"] = "Note not found";
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
        $content = addslashes($row["content"]);
        $banner_path = $row["banner_path"];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["updatenote"])) {
            $new_title = $_POST["title"];
            $new_content = addslashes(str_replace("\\", "", $_POST["content"]));

            $sql = "UPDATE notes SET title = '$new_title', content = '$new_content' WHERE id = '$note_id' AND user_id = '$user_id'";

            $result = $conn->query($sql);
            if($result) {
                header("Location: .");
            } else {
                $_SESSION["error"] = "Error updating note";
            }
        }
    }

?>


<?php
    include("../components/head.php");
    render_head("Edit Note");
?>

<body>
    <header>
        <?php
        include("../components/navbar.php")
        ?>
    </header>


    <main class="container max-w-7xl mb-16">
        <h1 class="text-2xl font-bold mb-4">Edit Note</h1>
        <?php if (isset($_SESSION["error"])) { ?>
            <div class="bg-red-500 text-white p-4 rounded">
                <?php
                    echo $_SESSION["error"];
                    unset($_SESSION["error"]);
                ?>
            </div>
        <?php } else { ?>
            <?php if($banner_path != NULL || $banner_path != "") { ?>
                <img src="<?php echo $banner_path ?>" alt="Banner Image" class="w-full h-96 object-cover object-center">
            <?php } ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" class="mt-4">
                <label for="title" class="block">Title</label>
                <input type="text" name="title" id="title" class="border border-gray-300 rounded w-full p-2 mb-4" value="<?php echo $title ?>">

                <label for="content" class="block">Content</label>
                <textarea name="content" id="content" cols="30" rows="10" class="border border-gray-300 rounded w-full p-2 mb-4"><?php echo $content ?></textarea>

                <input type="submit" value="Update Note" name="updatenote" class="bg-black text-white py-2 px-8 rounded mt-4 mr-0 ml-auto block cursor-pointer">
            </form>
        <?php } ?>
    </main>
</body>

</html>