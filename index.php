<!DOCTYPE html>
<html lang="en">

<?php
    include("components/head.php");
    render_head("");
?>

<body class="bg-gray-100">
    <header class=" py-8">
        <nav class="container mx-auto max-w-7xl flex items-center justify-between">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 864 864" class="h-10">
                    <rect width="864" height="864" fill="#F7DF1E" rx="120" />
                    <path fill="#000" d="M701.2 804.4 579.6 698.8c-22.4 3.733-43.467 5.6-63.2 5.6-79.467 0-139.2-18.667-179.2-56C297.733 610.533 278 550 278 466.8c0-81.6 21.867-141.067 65.6-178.4 43.733-37.333 101.6-56 173.6-56 151.467 0 227.2 75.467 227.2 226.4 0 82.667-20.8 145.067-62.4 187.2l88.8 61.6-69.6 96.8ZM513.2 610c14.933 0 27.467-2.4 37.6-7.2 10.133-5.333 18.133-14.4 24-27.2 11.2-21.867 16.8-57.6 16.8-107.2 0-48.533-5.6-83.733-16.8-105.6-11.2-22.4-31.733-34.133-61.6-35.2-11.2 0-22.933 1.333-35.2 4-11.733 2.133-19.2 5.333-22.4 9.6-6.4 7.467-11.467 23.467-15.2 48-3.2 24-4.8 50.4-4.8 79.2 0 44.8 4.267 77.6 12.8 98.4 5.867 15.467 14.133 26.667 24.8 33.6 10.667 6.4 24 9.6 40 9.6Z" />
                </svg>

                <h1 class="text-3xl font-bold">QWERTY</h1>
            </div>

            <a href="app">
                <div class="bg-black text-white py-2 px-6 rounded-md" role="button">
                    Get Started
                </div>
            </a>
        </nav>
    </header>    

    <main class="container max-w-7xl">
        <section class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Features</h2>
            <ul class="list-disc list-inside">
                <li class="mb-2">Create and manage notes</li>
                <li class="mb-2">Organize notes with tags</li>
                <li class="mb-2">Search notes by title or content</li>
                <li class="mb-2">Edit and delete notes</li>
            </ul>
        </section>

        <footer class="bg-gray-200 py-4">
            <div class="container mx-auto px-4">
                <p class="text-center text-gray-600">© 2022 QWERTY. All Rights Reserved.</p>
            </div>
        </footer>
    </main>
</body>

</html>