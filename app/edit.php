<!DOCTYPE html>
<html lang="en">

<?php
    require_once("../lib/config.php");
    require("../lib/auth.php");

    $note_id = $_GET["id"];
    $user_id = $_SESSION["user_id"];

    $sql = "SELECT * FROM notes WHERE id = '$note_id' AND user_id = '$user_id'";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($result->num_rows === 0) {
        $error = "Note not found";
    } else {
        $title = $row["title"];
        $content = $row["content"];
        $banner_path = $row["banner_path"];
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


    <main class="container max-w-7xl">
        <h1 class="text-2xl font-bold mb-4">Edit Note</h1>
        <!-- Show Banner image and a button to delete image -->
        <img src="<?php echo $banner_path ?>" alt="Banner Image" class="w-full h-96 object-cover object-center">

        <div class="flex items-center justify-end gap-2 mt-4">
            <a href="./edit.php?id=<?php echo $note_id ?>">
                <div class="bg-black text-white py-2 px-8 rounded" role="button">
                    Edit
                </div>
            </a>

            <a href="./delete.php?id=<?php echo $note_id ?>">
                <div class="bg-red-500 text-white py-2 px-8 rounded" role="button">
                    Delete
                </div>
            </a>
        </div>

        <form action="save_note.php" method="POST">
            <!-- If banner image is null show a input field to upload image -->
            
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