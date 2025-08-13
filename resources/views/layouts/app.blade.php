<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My App')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body">
    <div class="w-full max-w-md bg-white rounded p-6">
        @yield('content')
    </div>
</body>
</html>
