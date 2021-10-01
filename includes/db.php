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

function get_categories_for_article(int $id){
    global $db;
    $q = $db->prepare("SELECT title FROM post_category pc JOIN category c ON pc.category_id=c.id
                     WHERE pc.post_id = :id");
    $q->execute(['id'=>$id]);

    return  $q->fetchAll(PDO::FETCH_OBJ);
}
