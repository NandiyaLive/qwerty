<?php
    require("../lib/auth.php");

    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];

    $notes = array();

    for ($i = 1; $i <= 10; $i++) {
        $note = array(
            "id" => $i,
            "title" => "Note " . $i,
            "content" => generateRandomText(),
            "created_at" => generateRandomTime()
        );

        $notes[] = $note;
    }

    function generateRandomText() {
        $texts = array(
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            "Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.",
            "Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
        );

        return $texts[array_rand($texts)];
    }

    function generateRandomTime() {
        $start = strtotime("2022-01-01");
        $end = strtotime("2022-12-31");
        $randomTimestamp = mt_rand($start, $end);

        return date("Y-m-d — H:i:s", $randomTimestamp);
    }

    usort($notes, function ($a, $b) {
        return strtotime($b["created_at"]) - strtotime($a["created_at"]);
    });
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
    

    <main class="container max-w-7xl">
        <div class="flex justify-between">
            <h1 class="text-5xl font-bold">Notes.</h1>
            <a href='new.php'>
                <div class='bg-black text-white py-2 px-6 rounded-md' role='button'>
                    <span class='text-lg font-bold'>+</span> Create Note
                </div>
            </a>
        </div>
        

        <div class="grid grid-cols-3 gap-4 mt-8">
            <?php
            foreach ($notes as $note) {
                echo "<a href='note.php?id=" . $note["id"] . "'>";
                echo "<div class='bg-white rounded-md border p-4 h-full flex flex-col justify-between'>";
                echo "<div>";
                echo "<h2 class='text-2xl font-bold mb-4'>" . $note["title"] . "</h2>";
                echo "<p>" . $note["content"] . "</p>";
                echo "</div>";
                echo "<p class='text-gray-500 text-sm mt-4'>" . $note["created_at"] . "</p>";
                echo "</div>";
                echo "</a>";
            }
            ?>
        </div>
    </main>
</body>

</html>