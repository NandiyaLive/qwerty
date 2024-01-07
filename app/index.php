<?php
require("../lib/auth.php");

$username= $_SESSION['username'];
$user_id= $_SESSION['user_id'];


require("../lib/config.php");

$notes = array();

$sql = "SELECT * FROM notes WHERE user_id = $user_id ORDER BY created_at DESC";
$result = $conn->query($sql);



?>

<!DOCTYPE html>
<html lang="en">

<?php
    include("../components/head.php");
    render_head("Notes");
?>

<body class="h-screen">
    <header>
        <?php
            include("../components/navbar.php")
        ?>
    </header>


    <main class="container max-w-7xl mb-16">
        <div class="flex justify-between">
            <h1 class="text-5xl font-bold">Notes.</h1>
            <a href='new.php'>
                <div class='bg-black text-white py-2 px-6 rounded-md' role='button'>
                    Create Note
                </div>
            </a>
        </div>


        <div class="grid grid-cols-3 gap-4 mt-8 lg:grid-cols-2 sm:grid-cols-1">
            <?php
            if (isset($error)) {
                echo "<p>" . $error . "</p>";
            } else {
                foreach ($notes as $note) {
                    echo "<a href='note.php?id=" . $note["id"] . "'>";
                    echo "<div class='bg-white rounded-md border p-4 h-full flex flex-col justify-between'>";
                    echo "<div>";
                    echo "<h2 class='text-2xl font-bold mb-4'>" . $note["title"] . "</h2>";
                    echo "<p>" . truncate($note["content"], 100) . "</p>";
                    echo "</div>";
                    echo "<p class='text-gray-500 text-sm mt-4'>" . $note["created_at"] . "</p>";
                    echo "</div>";
                    echo "</a>";
                }
            }
            ?>
        </div>
    </main>
</body>

</html>