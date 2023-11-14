<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Pokemon Network</title>
    @yield('head')
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray">
    @yield('content')
</body>
</html>
