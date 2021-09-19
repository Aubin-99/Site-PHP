<?php require_once 'includes/db.php';?>
<?php require_once 'includes/function.php';?>
<?php require_once 'partials/_header.php'; ?>
<?php require_once 'includes/session_function.php';?>


<?php

$title = "Ajouter une catégorie";

if(!super()) redirect_to('category_list.php');

$errors = [];
if(isset($_POST['ajouter'])){
    //Vérifier les données saisies(non vides)
    //données texte
    //longueur categorie
    //purification
    $submit = array_pop($_POST);

    $category = ($_POST['category']);
    $categories = explode(',',$category);

    $categories = sanitize($categories);


    if(empty($category)){
        $errors['category'] = 'Champ obligatoire';
    }elseif (mb_strlen($category) < 3){
        $errors['category'] = 'Champ compris entre 3 et 200';
    }elseif (mb_strlen($category) > 200) {
        $errors['category'] = 'Champ compris entre 3 et 200';
    }

    if(!not_empty($categories)){
        $errors['category'] = "Au moins l'une des categories est vide";
    }


    if(empty($errors)){
        $db->beginTransaction();
        foreach($categories as $category) {
            $q = $db->prepare("INSERT INTO category(title) VALUES (:title)");
            $q->execute(['title' => $category]);
        }
        if($db->commit()){
            $_SESSION['success'] = count($categories)."".'Catégories insérée avec succès';
            header('Location:category_list.php');
            exit();
        }
    }else{
            $_SESSION['warning'] = 'Erreur d\'insertion de la catégorie';
    }








}


?>


<?php require_once 'views/_category.php'; ?>

<?php require_once 'partials/_footer.php'; ?>
