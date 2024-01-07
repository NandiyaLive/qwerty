<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    function render_head($title = "")
    {
        if (!empty($title)) {
            echo "<title>" . $title . " - QWERTY</title>";
        } else {
            echo "<title>QWERTY — Quick and effortless note-taking</title>";
        }
    }

    ?>
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODY0IiBoZWlnaHQ9Ijg2NCIgdmlld0JveD0iMCAwIDg2NCA4NjQiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSI4NjQiIGhlaWdodD0iODY0IiByeD0iMTIwIiBmaWxsPSIjRjdERjFFIi8+CjxwYXRoIGQ9Ik03MDEuMiA4MDQuNEw1NzkuNiA2OTguOEM1NTcuMiA3MDIuNTMzIDUzNi4xMzMgNzA0LjQgNTE2LjQgNzA0LjRDNDM2LjkzMyA3MDQuNCAzNzcuMiA2ODUuNzMzIDMzNy4yIDY0OC40QzI5Ny43MzMgNjEwLjUzMyAyNzggNTUwIDI3OCA0NjYuOEMyNzggMzg1LjIgMjk5Ljg2NyAzMjUuNzMzIDM0My42IDI4OC40QzM4Ny4zMzMgMjUxLjA2NyA0NDUuMiAyMzIuNCA1MTcuMiAyMzIuNEM2NjguNjY3IDIzMi40IDc0NC40IDMwNy44NjcgNzQ0LjQgNDU4LjhDNzQ0LjQgNTQxLjQ2NyA3MjMuNiA2MDMuODY3IDY4MiA2NDZMNzcwLjggNzA3LjZMNzAxLjIgODA0LjRaTTUxMy4yIDYxMEM1MjguMTMzIDYxMCA1NDAuNjY3IDYwNy42IDU1MC44IDYwMi44QzU2MC45MzMgNTk3LjQ2NyA1NjguOTMzIDU4OC40IDU3NC44IDU3NS42QzU4NiA1NTMuNzMzIDU5MS42IDUxOCA1OTEuNiA0NjguNEM1OTEuNiA0MTkuODY3IDU4NiAzODQuNjY3IDU3NC44IDM2Mi44QzU2My42IDM0MC40IDU0My4wNjcgMzI4LjY2NyA1MTMuMiAzMjcuNkM1MDIgMzI3LjYgNDkwLjI2NyAzMjguOTMzIDQ3OCAzMzEuNkM0NjYuMjY3IDMzMy43MzMgNDU4LjggMzM2LjkzMyA0NTUuNiAzNDEuMkM0NDkuMiAzNDguNjY3IDQ0NC4xMzMgMzY0LjY2NyA0NDAuNCAzODkuMkM0MzcuMiA0MTMuMiA0MzUuNiA0MzkuNiA0MzUuNiA0NjguNEM0MzUuNiA1MTMuMiA0MzkuODY3IDU0NiA0NDguNCA1NjYuOEM0NTQuMjY3IDU4Mi4yNjcgNDYyLjUzMyA1OTMuNDY3IDQ3My4yIDYwMC40QzQ4My44NjcgNjA2LjggNDk3LjIgNjEwIDUxMy4yIDYxMFoiIGZpbGw9ImJsYWNrIi8+Cjwvc3ZnPgo=" />

    <script src="https://cdn.tailwindcss.com"></script>
    <!-- tailwind.config.js -->
    <script>
        tailwind.config = {
            theme: {
                container: {
                    center: true,
                    padding: "1rem",
                },
                screens: {
                    "2xl": {
                        max: "1535px"
                    },
                    xl: {
                        max: "1279px"
                    },
                    lg: {
                        max: "1023px"
                    },
                    md: {
                        max: "767px"
                    },
                    xmd: {
                        max: "830px"
                    },
                    sm: {
                        max: "639px"
                    },
                    mobile: "640px",
                },
                extend: {}
            }
        }
    </script>

    <style>
        body {
            font-family: 'Rubik', sans-serif;
        }
    </style>
</head>