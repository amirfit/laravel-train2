<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Document</title>
</head>
<body>
    <header class="bg-dark text-light p-3">
        <div class="container">
            Header
        </div>
    </header>
    @yield('content')
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>