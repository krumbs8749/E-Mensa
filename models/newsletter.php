<?php
function db_anzahl_newsletter() {
    $link = connectdb();

    $sql = "SELECT DISTINCT COUNT(*) as anzahl FROM newsletter";

    $res_anzahl_newsletter = mysqli_query($link, $sql);

    if (!$res_anzahl_newsletter) {
        echo "Fehler während der Abfrage:  ", mysqli_error($link);
        exit();
    };

    mysqli_close($link);
    return $res_anzahl_newsletter ;
}

function update_newsletter($rd){
    $link = connectdb();
    $user = [
        "vorname" => "",
        "email" => "",
        "sprache" => "",
        "datenschutz" => ""
    ];
    $fehler = [];
    $file = fopen("./user_data.txt", 'a');
    if(!$file){
        die('Öffnen fehlgeschlagen');
    }

    if(!empty($rd['vorname'])){
        $nm = $rd['vorname'];
        if($nm == ' '){
            array_push($fehler,"Vorname kann nicht nur leerzeichen enthalten");
        }else{

            $user['vorname'] = $nm;
        }
    }
    if(!empty($rd['email'])){
        $em = $rd['email'];
        $ending = explode("@", $em)[1];
        $wD = explode(".", $ending)[0];
        if( !filter_var($em, FILTER_VALIDATE_EMAIL)
            || $ending === "rcpt.at" || $ending === "damnthespam.at" || $ending === "wegwerfmail.de"
            || $wD === "trashmail") {
            array_push($fehler, "Ihre Email entspricht nicht den Vorgaben");
        }else {
            $user['email'] = $em;
        }
    }
    if(!empty($rd['sprache'])){
        $user['sprache'] = $rd['sprache'];
    }
    if(!empty($rd['datenschutz'])){
        if($rd['datenschutz'] !== "on"){
            array_push($fehler, "der Datenschutzbestimmung wurde nicht zugestimmt ");
        }else {
            $user['datenschutz'] = $rd['datenschutz'];
        }
    }
    if($user['vorname'] !== "" && $user['email'] !== "" && $user['datenschutz'] !== "" && $user['sprache'] ){


        $dts = $user['datenschutz']  === 'on' ? 1 : 0;
        $moegliche_sprache = ['de', 'en'];
        $sprache = mysqli_real_escape_string($link, $user['sprache']);
        $sprache = in_array($sprache, $moegliche_sprache) ? $sprache : 'de';
        /* Prepared statement, stage 1: prepare */
        $stmt = $link->prepare("INSERT INTO newsletter(name, email, datenschutz, sprache) VALUES (?, ?, ?, ?)");
        $user['vorname'] = mysqli_real_escape_string($link, $user['vorname']);
        $user['email'] = mysqli_real_escape_string($link, $user['email']);
        /* Prepared statement, stage 2: bind and execute */
        $stmt->bind_param("ssis", $user['vorname'], $user['email'], $dts, $sprache);
        $stmt->execute();

        $stmt->close();
    }

}
