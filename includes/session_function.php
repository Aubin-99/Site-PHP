<?php

date_default_timezone_set('Africa/Libreville');
setlocale(LC_ALL, 'fr_FR.utf8', 'fra');

if(session_status()==PHP_SESSION_NONE){
    session_start();
}
// Message de succès ou échec d'envoi
function display_session_alert($type = 'success'){
    if(isset($_SESSION[$type])){
        $alert = "<div class='alert alert-$type text-center col-md-10 mx-auto fs-5'>$_SESSION[$type]</div>";
        unset($_SESSION[$type]);
    }else{
        $alert = '';
    }

    return $alert;
}

function ds_info($param = null){
    return $_SESSION[$param] ?? null;
}

function logged_in(){
    return isset($_SESSION['id'],$_SESSION['email'],$_SESSION['role']) ? : false;
}

function modo(){
    return isset($_SESSION['role']) && $_SESSION['role'] === 'modo'? : false;
}
function admin(){
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin'? : false;
}
function super(){
    return isset($_SESSION['role']) && $_SESSION['role'] === 'super'? : false;
}
