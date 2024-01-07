<!DOCTYPE html>
<html lang="en">

<?php
    require_once("../lib/config.php");
    require("../lib/auth.php");
    
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
        $content = $row["content"];
        $banner_path = $row["banner_path"];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["deleteimage"])) {
            $sql = "UPDATE notes SET banner_path = NULL WHERE id = '$note_id' AND user_id = '$user_id'";
            $result = $conn->query($sql);

            if($result) {
                require("../lib/deleteImage.php");
                deleteImage($banner_path);
                header("Location: ./edit.php?id=$note_id");
            } else {
                $_SESSION["error"] = "Error deleting image";
            }
        }

        if(isset($_POST["updatenote"])) {
            $new_title = $_POST["title"];
            $new_content = $_POST["content"];
            $banner_path = null;

            if(isset($_FILES["banner_image"])){
                require("../lib/uploadImage.php");
                $banner_image = $_FILES["banner_image"];
    
                $filename = pathinfo($banner_image["name"], PATHINFO_FILENAME);
    
                $target_file_name = $filename . "_" . time() . "." . pathinfo($banner_image["name"], PATHINFO_EXTENSION);
    
                $upload_status = uploadImage($banner_image, "../uploads/banner_images/", $target_file_name);
    
                if($upload_status["status"] === "success") {
                    $banner_path = $upload_status["file_path"];
                } else {
                    $_SESSION["error"] = $upload_status["error"];
                }
            } else {
                $banner_path = null;
            }

            $sql = "UPDATE notes SET title = '$new_title', content = '$new_content', banner_path = '$banner_path' WHERE id = '$note_id' AND user_id = '$user_id'";

            if(mysqli_query($conn, $sql)) {
                header("Location: .");
            } else {
                $_SESSION["error"] = "Error updating note" . mysqli_error($conn);
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

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                    <input type="submit" value="Delete Image" name="deleteimage" class="bg-red-500 hover:bg-red-600 text-white py-2 px-8 rounded mt-4 mr-0 ml-auto block cursor-pointer">
                </form>
            <?php } ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <?php if($banner_path == NULL) { ?>
                    <label for="banner" class="block">Banner Image</label>
                    <input type="file" name="banner" id="banner" class="border border-gray-300 rounded w-full p-2 mb-4">
                <?php } ?>

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