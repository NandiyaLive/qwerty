<!DOCTYPE html>
<html lang="en">

<?php include("../components/head.php"); ?>

<body>
    <?php include("../components/navbar.php"); ?>

    <div class="container max-w-7xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Add New Note</h1>
        <form action="save_note.php" method="POST">
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
                <input type="text" name="title" id="title" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="content" class="block text-gray-700 font-bold mb-2">Content</label>
                <textarea name="content" id="content" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required></textarea>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Note</button>
        </form>
    </div>
</body>

</html>