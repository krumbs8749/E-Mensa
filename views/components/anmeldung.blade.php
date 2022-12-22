<!DOCTYPE html>
<html>
<head lang="de">
    <meta charset="UTF-8">
    <title>Anmeldung</title>
    <style>

        .welcome_container{
            color: #008888;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            margin: 10% 0 20% 0;
        }
        .form_container{
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form_anmeldung{
            display: flex;
            flex-direction: column;
            height: 50%;
            width: 50%;
        }
        .form_anmeldung > button {
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
            display: grid;
            grid-template-columns: 15% auto;
        }

        .input-container > input {
            width: 100%;
        }
        .fehler{
            color: red;
        }
    </style>
</head>
<body>
<div class="welcome_container">
    <h1>Willkommen zum E-Mensa (Jetzt auch Online!)</h1>
</div>
<div class="form_container">
    <form class="form_anmeldung" action="/anmeldung_verfizieren" method="post">
        <div class="input-container">
            <label for="name_anmeldung">Name</label>
            <input required type="text" id="name_anmeldung" name="name_anmeldung">
        </div>
        <div class="input-container">
            <label for="email_anmeldung">E-Mail</label>
            <input required type="email" id="email_anmeldung" name="email_anmeldung">

        </div>
        <div class="input-container">
            <label for="passwort_anmeldung">Passwort</label>
            <input required type="password" id="passwort_anmeldung" name="passwort_anmeldung">
            @if(!$check_password)
                <span class="fehler">Ihre Passwort war falsch</span>
            @endif
        </div>
        <button type="submit">Anmelden</button>
    </form>
</div>

</body>
</html>
