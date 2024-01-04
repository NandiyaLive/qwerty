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
        <?php if(isset($error)) { ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">
                    <?php
                        echo $error;
                    ?>
                </span>
            </div>
        <?php } else { ?>
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
            <h1 class="text-3xl font-bold mb-4 mt-8"><?php echo $title ?></h1>
            <p class="mb-4"><?php echo $content ?></p>
        <?php } ?>
    </main>
</body>

</html>