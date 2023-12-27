<?php
    include("../components/head.php");

    $notes = array(
        array("id" => "1", "title" => "Note 1", "content" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Culpa rem necessitatibus distinctio dicta vitae fuga explicabo saepe fugiat voluptates. Tempore mollitia officiis nesciunt iure, delectus, beatae nihil excepturi harum reprehenderit quibusdam magnam! Earum minus sed rem! Dignissimos illo labore iste!"),
        array("id" => "2", "title" => "Note 2", "content" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Culpa rem necessitatibus distinctio dicta vitae fuga explicabo saepe fugiat voluptates. Tempore mollitia officiis nesciunt iure, delectus, beatae nihil excepturi harum reprehenderit quibusdam magnam! Earum minus sed rem! Dignissimos illo labore iste!"),
        array("id" => "3", "title" => "Note 3", "content" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Culpa rem necessitatibus distinctio dicta vitae fuga explicabo saepe fugiat voluptates. Tempore mollitia officiis nesciunt iure, delectus, beatae nihil excepturi harum reprehenderit quibusdam magnam! Earum minus sed rem! Dignissimos illo labore iste!"),
        array("id" => "4", "title" => "Note 4", "content" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Culpa rem necessitatibus distinctio dicta vitae fuga explicabo saepe fugiat voluptates. Tempore mollitia officiis nesciunt iure, delectus, beatae nihil excepturi harum reprehenderit quibusdam magnam! Earum minus sed rem! Dignissimos illo labore iste!"),
        array("id" => "5", "title" => "Note 5", "content" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Culpa rem necessitatibus distinctio dicta vitae fuga explicabo saepe fugiat voluptates. Tempore mollitia officiis nesciunt iure, delectus, beatae nihil excepturi harum reprehenderit quibusdam magnam! Earum minus sed rem! Dignissimos illo labore iste!"),
        array("id" => "6", "title" => "Note 6", "content" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Culpa rem necessitatibus distinctio dicta vitae fuga explicabo saepe fugiat voluptates. Tempore mollitia officiis nesciunt iure, delectus, beatae nihil excepturi harum reprehenderit quibusdam magnam! Earum minus sed rem! Dignissimos illo labore iste!"),
        array("id" => "7", "title" => "Note 7", "content" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Culpa rem necessitatibus distinctio dicta vitae fuga explicabo saepe fugiat voluptates. Tempore mollitia officiis nesciunt iure, delectus, beatae nihil excepturi harum reprehenderit quibusdam magnam! Earum minus sed rem! Dignissimos illo labore iste!"),
        array("id" => "8", "title" => "Note 8", "content" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Culpa rem necessitatibus distinctio dicta vitae fuga explicabo saepe fugiat voluptates. Tempore mollitia officiis nesciunt iure, delectus, beatae nihil excepturi harum reprehenderit quibusdam magnam! Earum minus sed rem! Dignissimos illo labore iste!"),
        array("id" => "9", "title" => "Note 9", "content" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Culpa rem necessitatibus distinctio dicta vitae fuga explicabo saepe fugiat voluptates. Tempore mollitia officiis nesciunt iure, delectus, beatae nihil excepturi harum reprehenderit quibusdam magnam! Earum minus sed rem! Dignissimos illo labore iste!"),
        array("id" => "10", "title" => "Note 10", "content" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Culpa rem necessitatibus distinctio dicta vitae fuga explicabo saepe fugiat voluptates. Tempore mollitia officiis nesciunt iure, delectus, beatae nihil excepturi harum reprehenderit quibusdam magnam! Earum minus sed rem! Dignissimos illo labore iste!")
    );
?>

<body class="h-screen">
    <?php include("../components/navbar.php"); ?>

    <section class="mx-auto w-full max-w-7xl py-8 px-4">
        <h1 class="text-5xl font-bold">Notes.</h1>

        <div class="grid grid-cols-3 gap-4 mt-8">
            <?php
            foreach ($notes as $note) {
                echo "<a href='note.php?id=" . $note["id"] . "'>";
                echo "<div class='bg-white rounded-md border p-4'>";
                echo "<h2 class='text-2xl font-bold mb-4'>" . $note["title"] . "</h2>";
                echo "<p>" . $note["content"] . "</p>";
                echo "</div>";
                echo "</a>";
            }
            ?>
        </div>
    </section>
</body>

</html>