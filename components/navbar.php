<nav class="container mx-auto w-full max-w-7xl flex items-center justify-between my-8">
    <a href="../app">
        <h1 class='text-4xl font-bold'>QWERTY</h1>
    </a>

    <div class='flex items-center gap-4'>
        <?php
            $current_uri = $_SERVER['REQUEST_URI'];
            $url_parts = explode("/", $current_uri);

            if ($_SESSION["user_id"]) {
                echo "<p><a href='../account'>Account</a></p>
                    <a href='../account/logout.php'>
                        <div class='bg-black text-white py-2 px-6 rounded-md' role='button'>
                            Logout
                        </div>
                    </a>";
            }
        ?>
    </div>
</nav>