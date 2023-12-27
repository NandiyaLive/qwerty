<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QWERTY - Note Taking App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <header class=" py-4">
        <nav class="container mx-auto px-4 flex items-center justify-between">
            <h1 class="text-3xl font-bold">QWERTY</h1>

            <a href="login.php">
                <div class="bg-black text-white mt-8 py-2 px-6 rounded-md" role="button">
                    Login
                </div>
            </a>

        </nav>
    </header>

    <div class="container mx-auto px-4 py-8">
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
    </div>
</body>

</html>