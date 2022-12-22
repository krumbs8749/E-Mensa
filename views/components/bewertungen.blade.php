<!DOCTYPE html>
<html>
<head lang="de">
    <meta charset="UTF-8">
    <title>bewertung</title>
    <style>

        .welcome_container{
            color: #008888;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            margin: 5% 0 5% 0;
        }

        .bewertung {
            border: 1px solid #008888;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-direction: column;
            padding: 10px;
            width: auto;
            margin-bottom: 10px;
        }
        .benutzer_info {
            font-size: .9rem;
            font-weight: 700;
        }
        .gericht_info{
            font-size: 18px;
            font-weight: 700;
            margin: 10px 0;
        }
        .go_back_container, .bewertung > a {
            width: 15%;
            text-decoration: none;
            text-align: center;
            background: #008888;
            border: 1px black solid;
            border-radius: 10px;
            color: white;
            padding: 5px;
            margin-bottom: 0.5rem;

            font-size: .9rem;
            font-family: sans-serif;

        }
    </style>
</head>
<body>
<div class="welcome_container">
    <h1>Bewertungen von unseren Besuchern</h1>
</div>
<div class="bewertungen_container">

    @foreach($bewertungen as $bewertung)
        <div class="bewertung">
            <span class="gericht_info">{{ $bewertung['gericht'] }}</span>
            <div class="benutzer_info">
                {{$bewertung['name']}} :
                {{$bewertung['sterne']}}
            </div>
            <div class="benutzer_bemerkung">
                {{$bewertung['bemerkung']}}
            </div>
            <a href="/delete_bewertung?bewertung_id={{$bewertung['bewertung_id']}}">löschen</a>
        </div>
    @endforeach

</div>
<a href="/werbeseite" class="go_back_container">Go back to main menu</a>



</body>
</html>
