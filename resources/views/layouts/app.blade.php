<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        // Función para manejar el sessionStorage
        function saveToSession(key, data) {
            sessionStorage.setItem(key, JSON.stringify(data));
        }

        function getFromSession(key) {
            const data = sessionStorage.getItem(key);
            return data ? JSON.parse(data) : null;
        }
    </script>
</body>
</html>
