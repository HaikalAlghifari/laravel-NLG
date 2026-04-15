<!DOCTYPE html>
<html>

<head>
    <title>Product App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        @if (session('success'))
            <div class="bg-green-200 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </div>
</body>

</html>
