<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "gerichte"
 */
function db_gericht_select_all() {
    try {
        $link = connectdb();

        $sql = 'SELECT * FROM gericht ORDER BY name';
        $result = mysqli_query($link, $sql);

        $data = mysqli_fetch_all($result, MYSQLI_BOTH);

        mysqli_close($link);
    }
    catch (Exception $ex) {
        $data = array(
            'id'=>'-1',
            'error'=>true,
            'name' => 'Datenbankfehler '.$ex->getCode(),
            'beschreibung' => $ex->getMessage());
    }
    finally {
        return $data;
    }

}

function db_anzahl_gerichte() {
    $link = connectdb();

    $sql = "SELECT DISTINCT COUNT(*) as anzahl FROM gericht";

    $res_anzahl_gerichte = mysqli_query($link, $sql);

    if (!$res_anzahl_gerichte) {
        echo "Fehler während der Abfrage:  ", mysqli_error($link);
        exit();
    };;

    mysqli_close($link);
    return $res_anzahl_gerichte;
}

function db_get_gericht_bildname_name($id){
    $link = connectdb();

    $gerichtId = $link->real_escape_string($id);

    $sql = "SELECT DISTINCT bildname, name FROM gericht WHERE id = $gerichtId";

    $res_bildname = mysqli_query($link, $sql)->fetch_assoc();

    if (!$res_bildname) {
        echo "Fehler während der Abfrage:  ", mysqli_error($link);
        exit();
    };

    mysqli_close($link);
    return $res_bildname;
}
