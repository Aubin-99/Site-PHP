<?php require_once 'partials/_header.php';


$q = $db->prepare("SELECT p.id,title,content,image,p.created_at,name,firstname FROM post p LEFT JOIN user u ON p.user_id = u.id 
  ORDER BY created_at DESC LIMIT 10");
$q->execute();

$posts = $q->fetchAll(PDO::FETCH_OBJ);



require_once 'views/_blog.php';


require_once 'partials/_footer.php';