<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ihre E-Mensa</title>
    <link rel="stylesheet" type="text/css" href="css/werbeseite.css">
</head>
<body>
<header class="e-mensa header">
    @yield('header')
</header>
<main class="e-mensa main-container">
{{--    @yield('main')--}}
    @yield('img')
    @yield('info')
    @yield('cost')
    @yield('allerge')
    @yield('zahl')
    @yield('noti')
    @yield('werbung')
    @yield('farewell')
</main>
<footer>
    @yield('footer')
</footer>

</body>
</html>
