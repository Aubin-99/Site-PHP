<?php require_once 'partials/_header.php'; ?>

<?php $title = "Ajouter une categorie";?>

<?php

if(!logged_in()) redirect_to('login.php');

$q = $db->prepare("SELECT * FROM category ORDER BY id DESC LIMIT 30");
$q->execute();

$categories = $q->fetchAll(PDO::FETCH_OBJ);
$cats = [];
foreach ($categories as $k => $category){
    $cats[$category->id] = trim($category->title);
}


if(isset($_POST['post'])){
    $subitbutton = array_pop($_POST);
    $_POST = sanitize($_POST);
    $_FILES = sanitize($_FILES);
    $title = $_POST['title'];
    $content = $_POST['content'] ?? null;
    $category = $_POST['category'];

    if(!not_empty($title)){
        $errors['title'] = "Champ obligatoire.";
    }elseif (!length_validation($title,3,255)){
        $errors['title'] = "Doit etre compris entre 3 et 250.";
    }

    if(!not_empty($category)){
        $errors['category'] = "Champ obligatoire.";
    }
    foreach ($category as $uniqueCategory){
        if(!in_array($uniqueCategory,$cats)){
            $errors['category'] = "Au moins l'une des catégories est eronnée.";
        }
    }

    if(!not_empty($content)){
        $errors['content'] = "Champ obligatoire.";
    }

    if(!empty($_FILES['image']['name'])){
        if($_FILES['image']['error']==0){
            extract($_FILES);
            $tmpImg = $image['tmp_name'] ?? null;
            $nameImg = $image['name'] ?? null;
            $typeImg = $image['type'] ?? null;

            if(!in_array($typeImg, ['image/jpeg','image.jpg','image/png'])){
                $errors['image'] = 'Image invalide';
            }
        }
    } else{
        $errors['image'] = "L'image est obligatoire.";
    }

    if(!file_exists('/post')){
        mkdir(BASE_FILE_ROOT.'/post', 0777, true);
    }

    $postImageFolder = BASE_FILE_ROOT. '/post';
    $pathImg = $postImageFolder .'/'. ($nameImg ?? null);

    if(empty($errors)){
        $db->beginTransaction();
        $q = $db->prepare("INSERT INTO post (title,content,image,user_id) VALUES(:title,:content,:image,:user_id)");
        $q->execute([
            'title'  => $title,
            'content' => $content,
            'image'   => $pathImg,
            'user_id' => $_SESSION['id']
        ]);
        $post_id = $db->lastInsertId();
        foreach ($category as $k => $item){
            if(in_array($item,$cats)){
                $key = array_search($item,$cats);
            }

            $q = $db->prepare("INSERT INTO post_category(post_id,category_id) VALUES(:post_id,:category_id)");
            $q->execute([
                'post_id'  => $post_id,
                'category_id' => $key

            ]);
        }
        $success = $db->commit();

        if($success){
            if(!move_uploaded_file($tmpImg,$pathImg)) $_SESSION['warning'] = "Echec lors du téléchargement de l'image";
            $_SESSION['info'] = "Ajout de l'image avec success";
            redirect_to('post.list.php');
        }else{
            $_SESSION['warning'] = "Echec lors de la mise à jour";
        }
    }


}
?>

<?php $errors = []; ?>

<?php require_once 'views/_post.php'; ?>

<?php require_once 'partials/_footer.php'; ?>