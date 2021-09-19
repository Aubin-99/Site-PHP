<?php

require_once 'includes/db.php';
require_once 'includes/session_function.php';
require_once 'includes/function.php';

if(!logged_in()){
    redirect_to('login.php');
}

unset($_SESSION);
session_unset();
session_destroy();

redirect_to('login.php');
