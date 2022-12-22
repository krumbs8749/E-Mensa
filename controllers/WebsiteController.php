<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/../models/werbeseite_data.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/allergen.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/benutzer.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/besucher.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/bewertung.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/ersteller.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht_hat_allergen.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/newsletter.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/wunschgericht.php');


class WebsiteController
{
    public function werbeseite (RequestData $rd) {
        $userLogger = FrontController::logger();
        $userLogger->info('Mainpage is called', [
            'username' => $_SESSION['username'] ?? '',
            'email' => $_SESSION['email'] ?? ''
        ]);

        $res_gericht_allergen_pair = db_gericht_allergen_pair();
        $res_allergen = db_allergen();
        $res_anzahl_gerichte = db_anzahl_gerichte();
        $res_anzahl_newsletter = db_anzahl_newsletter();
        $res_anzahl_besucher = db_anzahl_besucher();
        $dishes = self_dishes_data();
        update_newsletter($rd->getData());
        update_besucher();

        // reset bewertung
        $_SESSION['gerichtId'] = -1;

        return view('components.mainpage', [
            'request'=>$rd,
            'res_gericht_allergen_pair' => $res_gericht_allergen_pair,
            'res_allergen' => $res_allergen,
            'res_anzahl_gerichte' => $res_anzahl_gerichte,
            'res_anzahl_newsletter' => $res_anzahl_newsletter,
            'res_anzahl_besucher' => $res_anzahl_besucher,
            'dishes' => $dishes,
            'username' => $_SESSION['username'] ?? '',
            'url' => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"
        ]);
    }

    public function wunschgericht(RequestData $rd){
        insert_into_wuenschgericht($rd->getData());

        return view('components.wunschgericht', [
            'request'=>$rd,
            'url' => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"
        ]);
    }

    public function anmeldung(RequestData $rd){
        return view('components.anmeldung', [
            'check_password' => $_SESSION['check_passwort'] ?? true
        ]);
    }
    public function anmeldung_verfizieren(RequestData $rd){
        $success = login_controller($rd);
        if($success){

            $_SESSION['username'] = $_POST['name_anmeldung'];
            $_SESSION['email'] = $_POST['email_anmeldung'];
            if(isset($_SESSION['gerichtId']) && $_SESSION['gerichtId'] >= 0 ){
                $gerichtId = $_SESSION['gerichtId'];
                header("Location: /bewertung?gerichtId=$gerichtId");
                exit();
            }
            header('Location: /werbeseite');
        }else{
            header('Location: /anmeldung');
        }
    }
    public function abmeldung(RequestData $rd){
        $userLogger = FrontController::logger();
        $userLogger->info('Logging out a registered user', [
            'username' => $_SESSION['username'],
            'email' => $_SESSION['email']
        ]);


        $_SESSION['username'] = '';
        $_SESSION['check_passwort'] = true;
        header('Location: /werbeseite');

    }

    public function benutzer_verifizieren(RequestData $rd){
        $_SESSION['gerichtId'] = $rd->query['gerichtId'];

        if(isset($_SESSION['username']) && $_SESSION['username'] !== ''){
            $gerichtId = $_SESSION['gerichtId'];
            header("Location: /bewertung?gerichtId=$gerichtId");
        }else{
            header('Location: /anmeldung');
        }
    }

    public function bewertung(RequestData $rd){
        $res = db_get_gericht_bildname_name($_SESSION['gerichtId']);
        $gericht_img = $res['bildname'] ?? '00_image_missing.jpg';
        $gericht_img = "img/gerichte/$gericht_img";
        $gericht_name = $res['name'];

        return view('components.bewertung', [
            'gericht_img' => $gericht_img,
            'gericht_name' => $gericht_name
        ]);
    }

    public function bewertung_verifizieren(RequestData $rd){
        $success = bewertung_controller();
        if($success){
            header("Location: /werbeseite");
        }else{
            $gerichtId = $_SESSION['gerichtId'];
            header("Location: /bewertung?gerichtId=$gerichtId");
        }

    }
    public function bewertungen(RequestData $rd){
        $bewertungen = db_get_bewertung();
        return view('components.bewertungen', [
            'bewertungen' => $bewertungen
        ]);
    }
    public function meinebewertungen(RequestData $rd){
        $bewertungen = db_get_benutzer_bewertung();
        return view('components.meinebewertungen', [
            'bewertungen' => $bewertungen
        ]);
    }
    public function deletebewertung(RequestData $rd){
        db_delete_bewertung($rd->query['bewertung_id']);
        header("Location: /bewertungen");
    }


}