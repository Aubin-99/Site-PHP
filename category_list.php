<?php

$title = "Liste des categories";



require_once 'partials/_header.php';

if(!logged_in()) redirect_to('login.php');

// recherche d'un élément et pagination

//$perPage = 2;
$query = "SELECT * FROM category";
//$queryCount = "SELECT COUNT(id) AS count FROM category";
$params = [];



if(!empty($_GET['q']) ){
    $query .= " WHERE title LIKE :q";
//    $queryCount .= " WHERE title LIKE :q";
    $params['q'] = "%{$_GET['q']}%";

}
// Connaitre le nombre d'éléments par page
//Connaitre le nombre d'éléments dans la base de données
// Connaitre le nombre total de pages
//Calculer le décalage
//Construire notre requete
//Recuperer les éléments
// Implémenter la pagination

/*
$page = (int)($_GET['p'] ?? 1);
$offset = ($page - 1) * $perPage;

$query .= "LIMIT $perPage OFFSET $offset";*/


$q = $db->prepare($query);
$q->execute($params);
$categories = $q->fetchAll(PDO::FETCH_OBJ);

/*
$q = $db->prepare($queryCount);
$q->execute($params);
$totalElements = $q->fetch()['count'];
$totalPages = ceil($totalElements / $perPage);
*/








require_once 'views/_category_list.php';



require_once 'partials/_footer.php';