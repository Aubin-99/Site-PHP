<?php

require_once 'partials/_header.php';

$title = " Supprimer une categorie";

if(!super()) redirect_to('category_list.php');

if(!isset($_GET['id']) || $_GET['id']<0){
    redirect_to('category_list.php');
}

$id = (int)($_GET['id']);

$q = $db ->prepare("DELETE FROM category WHERE id = :id");
$state = $q ->execute(['id'=>$id]);

 if($state){
     $_SESSION['success'] = "Categorie #$id supprimée avec succès";
     redirect_to('category_list.php');
 }else{
     $_SESSION['warning'] = "Echec lors de la suppression de la categorie";
     redirect_to('category_list.php');
 }
