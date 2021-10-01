<?php
require_once 'partials/_header.php';

$errors = [];

if(logged_in()){
    redirect_to('profile.php?id='.$_SESSION['id']);
}

if(isset($_POST['login'])){
    $submit = array_pop($_POST);
    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);

    if(!not_empty($_POST)){
        $errors['global'] = "Remplissez convenablement le formulaire";
        $_SESSION['warning'] = $errors['global'];
    }

    if(!not_empty($username)){
        $_SESSION['username'] = "Champ obligatoire";
    }
    if(!not_empty($password)){
        $_SESSION['password'] = "Champ obligatoire";
    }

    if(empty($errors)){
        $q = $db->prepare("SELECT u.id,name,firstname,email,password,role,created_at,active,
       born_at,gender,adress,phone,image,bio FROM user u LEFT JOIN user_add ua ON u.id=ua.user_id WHERE email = :username AND active ='1'");
        $q->execute(['username'=>$username]);
        $user = $q->fetch(PDO::FETCH_OBJ);
        if(!$user || !password_verify($password,$user->password)) {
            $_SESSION['warning'] = "Identifiants ou mot de passe invalide";
        }else{
            foreach ($user as $index => $item){
                $_SESSION[$index] = $item;
                if($index ==='password') unset($_SESSION[$index]);
            }
            $_SESSION['success'] = " Bienvenue " . ds_info('name').' '.ds_info('firstname');
            redirect_to('profile.php?id='.$user->id);
        }
    }else{
        $_SESSION['warning'] = "Remplissez convenablement le formulaire";
    }
}



require_once 'views/_login.php';


require_once 'partials/_footer.php';