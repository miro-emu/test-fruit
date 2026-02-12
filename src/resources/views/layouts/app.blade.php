<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mogitate</title>
    <title>Contact Form</title>
        <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" >
        <link rel="stylesheet" href="{{ asset('css/common.css') }}" >
        @yield('css')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Charm:wght@400;700&display=swap" rel="stylesheet">
</head>

<body class="background">
    <header class="header">
        <a class="header-logo" href="/products">mogitate</a>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>