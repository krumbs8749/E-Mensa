<?php
function check_ersteller($email, $link){
    $ersteller_id = '';
    /* Prepared statement, stage 1: prepare */
    $stmt = $link->prepare("SELECT id FROM ersteller WHERE email = ?");

    /* Prepared statement, stage 2: bind and execute */
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $post = $stmt->get_result();
    $stmt->close();

    if (!$post) {
        echo "Fehler während der Abfrage:  ", mysqli_error($link);
        exit();
    };
    foreach($post as $d){
        $ersteller_id =  $d['id'];
    }
    return $ersteller_id;
}

function insert_into_wuenschgericht($rd) {
    if(!isset($rd['name_wg']) || $_SERVER["REQUEST_METHOD"] !== 'POST') return;
    $link = connectdb();

    $arr = [
        'name_gericht' => mysqli_real_escape_string($link, $rd['name_wg']),
        'beschreibung' => mysqli_real_escape_string($link, $rd['beschreibung_wg']),
        'ersteller' => mysqli_real_escape_string($link, $rd['ersteller_wg']) ?? 'anonym',
        'email' => mysqli_real_escape_string($link, $rd['email_wg'])
    ];
    $ersteller_id = check_ersteller($arr['email'], $link);
    if(empty($ersteller_id)){
        /* Prepared statement, stage 1: prepare */
        $stmt = $link->prepare("INSERT INTO ersteller (name, email) VALUES (?, ?)");

        /* Prepared statement, stage 2: bind and execute */
        $stmt->bind_param("ss", $arr['ersteller'], $arr['email']);
        $stmt->execute();

        $ersteller_id = check_ersteller($arr['email'], $link);
    }


    $date = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
    /* Prepared statement, stage 1: prepare */
    $stmt = $link->prepare("INSERT INTO wunschgericht (name, beschreibung, erstell_am, ersteller_id) VALUES (?, ?, ?, ?)");

    /* Prepared statement, stage 2: bind and execute */
    $stmt->bind_param("sssi", $arr['name_gericht'], $arr['beschreibung'], $date, $ersteller_id);
    $stmt->execute();

    $stmt->close();
}
