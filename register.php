<?php

$title = "Ajouter un administrateur";

require_once 'partials/_header.php';

if(!super() && !admin()) redirect_to('login.php');

$errors = [];
$roles = ['admin','super','modo'];

if(isset($_POST['add_user'])){
    $submit = array_pop($_POST);

    if(!not_empty($_POST)){
        $errors['gobal'] = "Tous les champs sont obligatoires";
        $_SESSION['warning'] = $errors['gobal'];
    }

    $name = sanitize($_POST['name']);
    $firstname = sanitize($_POST['firstname']);
    $email = sanitize($_POST['email']);
    $role = sanitize($_POST['role']);

    if(!length_validation($name,3,60)){
        $errors['name'] = 'Doit etre compris entre 3 et 60';
    }
    if(!length_validation($firstname,3,60)){
        $errors['firstname'] = 'Doit etre compris entre 3 et 60';
    }

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors['email'] = 'Email non valide.';
    }

    if(!in_array($role,$roles)){
        $errors['role'] = 'Role invalide.';
    }
    $usedEmail = [];
    $dbEmails = $db->query("SELECT email FROM user ")->fetchAll(PDO::FETCH_OBJ);
    foreach ($dbEmails as $dbEmail){
        $usedEmail[] = $dbEmail->email;
    }
    if(in_array($email,$usedEmail)){
        $errors['email'] = 'Cet email existe déja';
    }



    if(empty($errors)){
        $password = password_hash('1234456', PASSWORD_ARGON2I);

        //Enregistrement de l'utilisateur
        $db->beginTransaction();
        $q = $db->prepare("INSERT INTO user(name,firstname,email,password,role)
 VALUES (:name ,:firstname,:email,:password,:role)");
         $q->execute([
            'name'=> $name,
            'firstname'=> $firstname,
            'email'=> $email,
            'password'=> $password,
            'role'=> $role
        ]);
        $user_id = $db->lastInsertId();
        $q = $db->query("INSERT INTO user_add(user_id) VALUES($user_id) ");
        $state = $db->commit();

        if($state){
            // Envoi d'un mail à l'utilisateur
        /*    $token = sha1($name.$email.'1234456');
            ob_start();
            require 'templates/activation.tmpl.php';
            $content = ob_get_clean();
            $subject = WEBSITE_NAME . '- Activation de votre compte';
            $headers = 'MIME-Version: 1.0'. "\r\n";
            $headers .= 'Content-type : text/html; charset=UTF-8'. "\r\n";
            $successMail = mail($email,$subject,$content,$headers);

            if(!$successMail){
                $_SESSION['warning'] = "Echec le mail a été rejété lors de la livraison";
            }*/
                $_SESSION['success'] = "Utilisateur ajouté avec succès";
                redirect_to('user_list.php');

        }else{
            $_SESSION['warning'] = "Echec lors de l'inscription";
        }
    }
}
require_once 'views/_register.php';


require_once 'partials/_footer.php';
