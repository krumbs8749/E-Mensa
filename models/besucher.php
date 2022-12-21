<?php
function db_anzahl_besucher() {
    $link = connectdb();

    $sql = "SELECT DISTINCT COUNT(*) as anzahl FROM besucher";

    $res_anzahl_besucher = mysqli_query($link, $sql);

    if (!$res_anzahl_besucher) {
        echo "Fehler während der Abfrage:  ", mysqli_error($link);
        exit();
    }

    mysqli_close($link);
    return $res_anzahl_besucher ;
}

function update_besucher(){
    $link = connectdb();
    if(!isset($_SESSION['besucher'])){
        $time = mysqli_real_escape_string($link,  $_SERVER['REQUEST_TIME_FLOAT']);
        $ip = mysqli_real_escape_string($link,$_SERVER['REMOTE_ADDR']);
        $_SESSION['besucher'] = true;
    }

    /* Prepared statement, stage 1: prepare */
    $stmt = $link->prepare("INSERT INTO besucher (ip_address, timestamp) VALUES (?, ?)");

    /* Prepared statement, stage 2: bind and execute */
    $stmt->bind_param("ss", $ip, $time);
    $stmt->execute();

    $stmt->close();
}
