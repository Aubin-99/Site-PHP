<?php
define('WEBSITE_NAME', 'Aubin city Lite');
define('WEBSITE_URL','http://localhost:8000');
define('BASE_FILE_ROOT', 'uploads');
define('DEFAULT_PROFILE_PIC', 'MCC.png');


try {
    $db = new PDO('mysql:host=localhost;dbname=php', 'root','root');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e){
    die('Erreur : '.$e->getMessage());
}
