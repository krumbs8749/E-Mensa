<!doctype html>
<html class="no-js" lang="DE">
<head>
    <meta charset="utf-8">
    <title>E-Mensa Routing Script</title>
    <meta name="description" content="unused">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/css/bootstrap.min.css" integrity="sha512-CpIKUSyh9QX2+zSdfGP+eWLx23C8Dj9/XmHjZY2uDtfkdLGo0uY12jgcnkX9vXOgYajEKb/jiw67EYm+kBf+6g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .main > table,
        .main > table > thead > tr > th,
        .main > table > tbody > tr > td{
            border: 2px solid black;
        }
    </style>
    <meta name="theme-color" content="#dadada">
</head>
<body>
<div class="container">
    <div class="row">
        <header class="mt-5">
            <h1>{{$titel}}</h1>
        </header>
        <nav class="mt-5">
            <strong>Navigation</strong>
            <form class="page-selector" method="get">
                <button name="no" value="1">Gericht</button>
                <button name="no" value="2">Kategorie</button>

            </form>
        </nav>
        <main class="main">
            <strong>{{$request['no'] === '1'? "Gericht" : 'Kategorie'}}</strong>
            @yield("main")
        </main>
        <footer>
            <strong>Footer</strong>
            <ul>
                <li>(c)E-Mensa GmBh</li>
                <li>Ikram Ahmad & Christian Küpper</li>
                <li><a href="">Impressum</a></li>
            </ul>
        </footer>
    </div>
</div>

</body>

</html>
n
