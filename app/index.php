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


<body>


</body>


</html>