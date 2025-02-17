<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
</head>
<body>
<nav>
        <x-nav-link href="/">home</x-nav-link>
        <x-nav-link href="/contact">contact</x-nav-link>
        <x-nav-link href="/about">about</x-nav-link>

    </nav>
    {{ $slot }}
</body>
</html>
