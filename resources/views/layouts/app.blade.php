<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        @yield('content')  <!-- Aquí se inyectará el contenido de cada vista -->
    </div>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
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
