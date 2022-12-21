<?php
function db_gericht_allergen_pair() {
    $link = connectdb();


    $sql = "SELECT name, GROUP_CONCAT(code) as allergen_codes, preis_intern, preis_extern, bildname
        FROM gericht_hat_allergen
        RIGHT JOIN gericht as gericht
        ON gericht_hat_allergen.gericht_id = gericht.id
        GROUP BY id
        ORDER BY  RAND()
        LIMIT 5";

    $res_gericht_allergen_pair = mysqli_query($link, $sql);

    if (!$res_gericht_allergen_pair) {
        echo "Fehler während der Abfrage:  ", mysqli_error($link);
        exit();
    }

    mysqli_close($link);
    return $res_gericht_allergen_pair;
}