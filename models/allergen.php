<?php
function db_allergen() {
    $link = connectdb();


    $sql = "SELECT DISTINCT code, name FROM allergen";

    $res_allergen = mysqli_query($link, $sql);

    if (!$res_allergen) {
        echo "Fehler während der Abfrage:  ", mysqli_error($link);
        exit();
    };

    mysqli_close($link);
    return $res_allergen;
}