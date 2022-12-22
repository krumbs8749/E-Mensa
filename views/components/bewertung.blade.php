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
        .gericht_container{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .gericht_container > img {
            max-height: 30%;
            max-width: 30%;
        }
        .form_container{
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form_bewertung{
            display: flex;
            flex-direction: column;
            height: 50%;
            width: 50%;
        }
        .go_back_container , .form_bewertung > button {
            width: 20%;
            align-self: flex-end;
            background: #008888;
            border: 1px black solid;
            border-radius: 10px;
            color: white;
            padding: 5px;
            margin-bottom: 2rem;
        }
        .input-container {
            margin-bottom: 2rem;
            display: flex;
            flex-direction: column;
        }

        .input-container > input {
            width: 100%;
        }
    </style>
</head>
<body>
<div class="welcome_container">
    <h1>Haben unsere Gerichte Ihnen gefallen?</h1>
</div>
<div class="gericht_container">
    <img alt="gerichte" src="{{$gericht_img}}">
    <h3>{{$gericht_name}}</h3>
</div>
<div class="form_container">
    <form class="form_bewertung" action="/bewertung_verifizieren" method="post">
        <div class="stars-container">
            <label>Ihre Bewertung</label>
            <fieldset>
                <label for="sg_bewertung">Sehr gut</label>
                <input type="radio" id="sg_bewertung" name="sterne_bewertung" value="sehr gut" />
                <label for="g_bewertung">Gut</label>
                <input type="radio" id="g_bewertunung" name="sterne_bewertung" value="gut" />
                <label for="s_bewertung">Schlecht</label>
                <input type="radio" id="s_bewertung" name="sterne_bewertung" value="schlecht" />
                <label for="ss_bewertung">Sehr schlecht</label>
                <input type="radio" id="ss_bewertung" name="sterne_bewertung" value="sehr schlecht" />
            </fieldset>

        </div>
        <div class="input-container">
            <label for="bemerkung_bewertung">Ihre Bemerkung</label>
            <input required type="text" id="bemerkung_bewertung" name="bemerkung_bewertung">
        </div>
        <button type="submit">Bewerten</button>
        <a href="/werbeseite" class="go_back_container">Go back to main menu</a>
    </form>

</div>

</body>
</html>
