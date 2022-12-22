<?php
function bewertung_controller(){
    $link = connectdb();

    $sterne = $_POST['sterne_bewertung'];
    $email = $_SESSION['email']; // erstellt von
    $bemerkung = $_POST['bemerkung_bewertung'];
    $gerichtId = $_SESSION['gerichtId'];
    $datetime = new DateTime();
    $datetime = $datetime->format('Y-m-d H-i-s');

    $sterne_options = ['sehr gut', 'gut', 'schlecht', 'sehr schlecht'];
    // Fehler
    if(!in_array($sterne, $sterne_options)){
        return false;
    }
    if(strlen($bemerkung) < 5){
        return false;
    }

    $stmt = $link->prepare("CALL bewertung_controller( ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $email, $bemerkung, $datetime, $sterne, $gerichtId);
    $stmt->execute();
    $stmt->close();

    return true;
}

function db_get_bewertung(){
    $link = connectdb();

    $sql = "SELECT b.id as bewertung_id,  g.name as gericht, bn.name as name, bemerkung, sterne FROM gericht_hat_bewertung
            JOIN bewertungen b on gericht_hat_bewertung.bewertung_id = b.id
            JOIN benutzer bn on bn.id = b.erstellt_von
            JOIN gericht as g on g.id = gericht_hat_bewertung.gericht_id
            ORDER BY b.zeitpunkt DESC 
            LIMIT 30";

    $res = $link->query($sql);
    return $res;
}
function db_get_benutzer_bewertung(){
    $link = connectdb();
    $userId = $_SESSION['userId'];

    $sql = "SELECT b.id as bewertung_id, g.name as gericht, bemerkung, sterne FROM gericht_hat_bewertung
            JOIN bewertungen b on gericht_hat_bewertung.bewertung_id = b.id AND b.erstellt_von = $userId
            JOIN gericht as g on g.id = gericht_hat_bewertung.gericht_id
            ORDER BY b.zeitpunkt DESC 
            LIMIT 30";

    $res = $link->query($sql);
    return $res;
}
function db_delete_bewertung($bewertung_id){
    $link = connectdb();
    $userId = $_SESSION['userId'];

    $sql = "DELETE FROM bewertungen 
            WHERE bewertungen.id = $bewertung_id AND bewertungen.erstellt_von = $userId";

    $link->query($sql);

    header('Location: /bewertungen');
    exit();
}