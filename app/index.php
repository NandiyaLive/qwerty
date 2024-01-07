<?php
require("../lib/auth.php");

$username= $_SESSION['username'];
$user_id= $_SESSION['user_id'];


require("../lib/config.php");

$notes = array();

$sql = "SELECT * FROM notes WHERE user_id = $user_id ORDER BY created_at DESC";
$result = $conn->query($sql);

//fetch Notes from DB
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $note = array(
            "id" => $row["id"],
            "title" => $row["title"],
            "content" => $row["content"],
            "created_at" => $row["created_at"]
        );

        array_push($notes, $note);
    }
} else {
    $error = "Create a note to get started!";
}

//Shorten the input string if necessary
function truncate($string, $length)
    {
        return (strlen($string) > $length) ? substr($string, 0, $length) . "..." : $string;
    }


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
    </main>


</body>


</html>