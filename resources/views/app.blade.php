<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{ $page['props']['meta']['keywords'] ?? '' }}">
    {!! $page['props']['meta']['head'] ?? '' !!}

    <link rel="icon" type="image/png" href="{!! $page['props']['meta']['favicon'] ?? '' !!}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @routes
    @viteReactRefresh
    @vite(['resources/js/app.tsx', 'resources/css/app.css'])
</head>

<body class="font-sans dark antialiased">
    @inertia
    {!! $page['props']['meta']['scripts'] ?? '' !!}
</body>

</html>
