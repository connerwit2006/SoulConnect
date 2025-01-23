<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body>
<h1 class="text-3xl font-bold underline text-red-600">
    Hello world! Hello world!
</h1>

<a href="{{ route('register') }}">Registreer hier</a>
<a href="{{ route('login') }}">Log hier in</a>

</body>
</html>
