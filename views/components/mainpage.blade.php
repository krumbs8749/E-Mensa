
@extends('werbeseite')

@section('header')
    <div class="logo">
        <span>E-Mensa Logo</span>
    </div>
    <div class="nav">
        <ul>
            <li><a href="../projekt">Ankündigung</a></li>
            <li><a href="../projekt">Speisen</a></li>
            <li><a href="../projekt">Zahlen</a></li>
            <li><a href="../projekt">Kontakt</a></li>
            <li><a href="../projekt">Wichtig für uns</a></li>
        </ul>
    </div>
    <div class="username">
        @if($username !== '')
            <span>Angemeldet als {{ $username }}</span>
            <a class="melden" href="/abmeldung">Abmelden</a>
        @else
            <a class="melden" href="/anmeldung">Jetzt anmelden</a>
        @endif
    </div>


@endsection

@section('img')
    <div class="img-container">
        <img class="img-nudel" alt="nudel image" src="img/spaghetti.jpg">
    </div>
@endsection

@section('info')
    <div class="info-container">
        <h3>Neues Essen kommt noch!</h3>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
    </div>
@endsection

@section('cost')
    <div class="cost-container">

        <h3>Koestlichkeiten, die Sie erwarten</h3>
        <a  class="wunschgericht" href="/wunschgericht">Was ist Ihres gewüncshten Gericht?</a>
        <table>
            <thead>
            <tr>
                <th></th>
                <th>Preis intern</th>
                <th>Preis extern</th>
                <th>Allergen</th>
            </tr>
            </thead>
            <tbody>
            <?php
//            foreach ($dishes as $key =>$dish){
//                echo
//                "<tr>
//                    <td><img alt={$dish['name']} class='img-dishes' src={$dish['img']}>{$dish['name']}</td>
//                    <td>{$dish['preis_intern']}</td>
//                    <td>{$dish['preis_extern']}</td>
//                </tr>";
//            }
            foreach ($res_gericht_allergen_pair as $key =>$dish){
                $pI = number_format($dish['preis_intern'], 2,',');
                $pE = number_format($dish['preis_extern'], 2,',');
                $filename = $dish['bildname']?? '00_image_missing.jpg';
                $img = "img/gerichte/$filename";
                echo
                "<tr>
                        <td><img alt='' class='img-dishes' src={$img}>{$dish['name']}</td>
                        <td>{$pI}&euro;</td>
                        <td>{$pE}&euro;</td>
                        <td>{$dish['allergen_codes']}</td>
                    </tr>";
            }
            ?>

            </tbody>
        </table>
    </div>
@endsection

@section('allerge')
    <div class="allerge-container">

        <h3>Die Allergen, die Sie berucksichtegen sollen</h3>
        <ul>
            <?php
            foreach($res_allergen as $allerge){
                echo "<li>{$allerge['code']}: {$allerge['name']}</li>";
            }
            ?>
        </ul>
    </div>
@endsection

@section('zahl')
    <div class="zahl-container">
        <h3>E-Mensa in Zahlen</h3>
        <ul>
            <li><?php
                foreach($res_anzahl_besucher as $anzahl){
                    echo "{$anzahl['anzahl']}";
                }
                ?> Besuche</li>
            <li><?php
                foreach($res_anzahl_newsletter as $anzahl){
                    echo "{$anzahl['anzahl']}";
                }
                ?> Anmeldungen zum Newsletter</li>
            <li><?php
                foreach($res_anzahl_gerichte as $anzahl){
                    echo "{$anzahl['anzahl']}";
                }
//                ?> Speisen</li>
        </ul>
    </div>
@endsection

@section('noti')
    <div class="noti-container">
        <h3>Interesse geweckt? Wir informieren Sie!</h3>
        <form method="post">
            <div class="input-container">
                <label for="vorname">Ihr Name</label>
                <input required type="text" id="vorname" name="vorname" placeholder="Vorname">
            </div>
            <div class="input-container">
                <label for="email">Ihr E-Mail</label>
                <input required type="email" id="email" name="email">
            </div>
            <div class="input-container">
                <label for="sprache">Newsletter bitte in</label>
                <select name="sprache" id="sprache">
                    <option class="options" selected value="de">Deustch</option>
                    <option class="options" value="en">English</option>
                </select>
            </div>
            <div class="input-container">
                <input required type="checkbox" id="datenschutz" name="datenschutz">
                <label for="datenschutz">Den Datenschutzbestimmungen stimme ich zu</label>
            </div>
            <button type="submit" class="newsletter-button">Zum newsletter anmelden</button>
        </form>
        <!----><?php
//        if(!empty($fehler)){
//            echo "<ul class='fehler-list'>";
//            foreach ($fehler as $f){
//                echo "<li>- {$f}</li>";
//            }
//            echo "</ul>";
//        }else if($check === true){
//            echo "<p class='erfolgreich-eingabe'>Ihre Eingaben werden erfolgreich eingerichtet</p>";
//            $fehler = false;
//        }
//
//        ?>
    </div>
@endsection
@section('werbung')
    <div class="werbung-container">
        <h3>Das ist uns wichtig!</h3>
        <ul>
            <li>Beste frische saisoonale Zutaten</li>
            <li>Ausgewagene abwechslungsreiche Gerichte</li>
            <li>Sauberkeit</li>
        </ul>
    </div>
@endsection
@section('farewell')
    <div class="farewell-container">
        <h2>Wir freuen uns auf Ihren Besuch!</h2>
    </div>
@endsection

@section('footer')
    <ul>
        <li>(c)E-Mensa GmBh</li>
        <li>Ikram Ahmad & Christian Küpper</li>
        <li><a href="">Impressum</a></li>
    </ul>
@endsection
