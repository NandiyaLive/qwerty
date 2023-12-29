<!DOCTYPE html>
<html lang="en">

<?php
    require_once("../lib/config.php");
    require("../lib/auth.php");
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