<!DOCTYPE html>
<html lang="en">

<?php
    require_once("../lib/config.php");
    require("../lib/auth.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $title = $_POST["title"];
        $content = $_POST["content"];
        $user_id = $_SESSION["user_id"];

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

        if(!isset($_SESSION["error"])) {
            $sql = "INSERT INTO notes (title, content, banner_path, user_id) VALUES ('$title', '$content', '$banner_path', '$user_id')";

            if($conn->query($sql) === TRUE) {
                header("Location: .");
            } else {
                $_SESSION["error"] = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
?>

<?php
    include("../components/head.php");
    render_head("New Note");
?>

<body>
    <header>
        <?php
        include("../components/navbar.php")
        ?>
    </header>


    <main class="container max-w-7xl">
        <h1 class="text-2xl font-bold mb-4">Add New Note</h1>
        <?php if(isset($_SESSION["error"])) { ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">
                    <?php
                        echo $_SESSION["error"];
                        unset($_SESSION["error"]);
                    ?>
                </span>
            </div>
        <?php } ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="category" class="block text-gray-700 font-bold mb-2">Banner Image</label>
                <input type="file" name="banner_image" id="banner_image" class="w-full px-3 py-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
                <input type="text" name="title" id="title" class="w-full px-3 py-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label for="content" class="block text-gray-700 font-bold mb-2">Content</label>
                <textarea name="content" id="content" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded" required></textarea>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Note</button>
        </form>
    </main>
</body>

</html>