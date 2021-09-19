<?php

require_once 'partials/_header.php';

$title = "Modifier une categorie";

if(!super()) redirect_to('category_list.php');

$errors = [];

if(!isset($_GET['id']) || $_GET['id']<0){
    redirect_to('category_list.php');
}

$id = (int)($_GET['id']);

$q = $db -> prepare("SELECT * FROM category WHERE id = :id");
$q ->execute(['id' => $id]);

$currentCategory = $q->fetch(PDO::FETCH_OBJ);

if(!$currentCategory){
    redirect_to('category_list.php');
}

//Mettre à jour acceptation de modification

if(isset($_POST['edit_category'])){
    $submit = array_pop($_POST);
    $category = sanitize($_POST['category']);

    if(!not_empty($category)){
        $errors['category'] = "Champ obligatoire";
    }elseif (!length_validation($category, 3, 200)){
        $errors['category'] = "Champ trop court";
    }
    if(empty($errors)){
        $q = $db ->prepare("UPDATE category SET title = :title WHERE id = :id");
        $state = $q ->execute([
            'title' => $category,
            'id' => $id
        ]);

        if($state){
            $_SESSION['success'] = "Categorie mise à jour avec succès";
            redirect_to('category_list.php');
        }else{
            $_SESSION['warning'] = "Echec lors de la mise à jour de la categorie";
        }
    }else{
        $_SESSION['warning'] = "Remplissez convenablement le formulaire";
    }



}


require_once 'views/_category_edit.php';


require_once 'partials/_footer.php';
