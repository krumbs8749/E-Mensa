<?php
function login_controller($rd){
    if($_SERVER['REQUEST_METHOD'] !== 'POST') return;

    $link = connectdb();
    $userLogger = FrontController::logger();

    $email = mysqli_real_escape_string($link, htmlspecialchars($_POST['email_anmeldung']));
    $password = sha1(saltFront . $_POST['passwort_anmeldung'] . saltBack);
    $date = new DateTime();
    $dateTime = $date->format('Y-m-d H-i-s');


    // Start Transaction
    $link->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

    // Check if user exists
    $sql = "SELECT DISTINCT id FROM benutzer WHERE benutzer.email = '$email' ";
    $userID = $link->query($sql)->fetch_assoc()['id'];
    $link -> commit();

    if(isset($userID)){
        $_SESSION['userId'] = $userID;
        // login user
        $userLoginDataCheck = $link->query("SELECT COUNT(1) as res FROM benutzer WHERE passwort = '$password' AND email = '$email'")->fetch_assoc()['res'];
        $link -> commit();

        if($userLoginDataCheck === '1'){
            // update user
            $stmt = $link->prepare("CALL  update_anmeldung(?, ?)");
            $stmt->bind_param("ss", $userID, $dateTime);
            $stmt->execute();
            $link -> commit();
            $stmt->close();

            $userLogger->info('Loggin in a registered user', ['username' => $_POST['name_anmeldung'], 'email' => $_POST['email_anmeldung']]);
        }else{

            $stmt = $link->prepare("UPDATE benutzer SET anzahlfehler = benutzer.anzahlfehler + 1, letzterfehler = ? WHERE email = ?");
            $stmt->bind_param("ss", $dateTime, $_POST['email_anmeldung']);
            $stmt->execute();
            $link -> commit();
            $stmt->close();
            $_SESSION['check_passwort'] = false;
            $userLogger->warning('User gave the wrong password', ['username' => $_POST['name_anmeldung'], 'email' => $_POST['email_anmeldung']]);
            return false;
        }

    }else{
        // register user

        /* Prepared statement, stage 1: prepare */
        $stmt = $link->prepare("INSERT INTO benutzer (name, email, passwort, admin, anzahlfehler, anzahlanmeldungen, letzteanmeldung, letzterfehler)
        VALUES (?, ?, ?, 0, 0, 1, ?, NULL)");

        /* Prepared statement, stage 2: bind and execute */
        $stmt->bind_param("ssss", $_POST['name_anmeldung'], $_POST['email_anmeldung'], $password, $dateTime);
        $stmt->execute();
        $link -> commit();
        $stmt->close();

        $userLogger->info('Registering a new user', ['username' => $_POST['name_anmeldung'], 'email' => $_POST['email_anmeldung']]);

    }
    return true;
}
function login_controller_stored_procedures($rd){
    if($_SERVER['REQUEST_METHOD'] !== 'POST') return;

    $link = connectdb();


    $password = sha1(saltFront . $_POST['passwort_anmeldung'] . saltBack);
    $timestamp = $_SERVER['REQUEST_TIME'];
    $date = new DateTime();
    $date->setTimestamp($timestamp);
    $dateTime = $date->format('Y-m-d H-i-s');

    /* Prepared statement, stage 1: prepare */
    $stmt = $link->prepare("CALL loginController( ?, ?, ?, ?, @checkIfExist, @checkEmail, @checkPasswort)");

    /* Prepared statement, stage 2: bind and execute */
    $stmt->bind_param("ssss", $_POST['name_anmeldung'], $_POST['email_anmeldung'], $password, $dateTime);
    $stmt->execute();
    $stmt->close();
//    $userID = $link->query("SELECT @checkIfExist as checkIfExist")->fetch_assoc()['checkIfExist'];
    $checkEmail = $link->query("SELECT @checkEmail as checkEmail")->fetch_assoc()['checkEmail'];
    $checkPasswort = $link->query("SELECT @checkPasswort as checkPasswort")->fetch_assoc()['checkPasswort'];

    if(!$checkPasswort) $_SESSION['check_passwort'] = false;
    if(!$checkEmail) $_SESSION['check_email'] = false;


    return $checkEmail && $checkPasswort;
}