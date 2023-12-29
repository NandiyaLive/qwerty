<?php 
    require_once("../lib/config.php");
    require("../lib/auth.php");
?>

<!DOCTYPE html>
<html lang="en">
    
<?php
    include("../components/head.php");
    render_head("Account");
?>

<body>
    <header>
        <?php
            include("../components/navbar.php")
        ?>
    </header>
    

    <main class="container max-w-7xl">
        <h1 class="text-5xl font-bold">Account</h1>
    </main>
</body>
</html>