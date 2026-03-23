<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vibora UK')</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}?v=8">
    <link rel="stylesheet" href="{{ asset('css/styling.css') }}?v=8">
    @yield('head')
</head>
<body>
    <button id="darkModeToggle" class="dark-mode-toggle" type="button">
        Toggle Dark Mode
    </button>

    @yield('content')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('darkModeToggle');

            if (localStorage.getItem('theme') === 'dark') {
                document.body.classList.add('dark-mode');
            }

            toggleBtn.addEventListener('click', function () {
                document.body.classList.toggle('dark-mode');

                if (document.body.classList.contains('dark-mode')) {
                    localStorage.setItem('theme', 'dark');
                } else {
                    localStorage.setItem('theme', 'light');
                }
            });
        });
    </script>

    @yield('scripts')
</body>
</html>