<?php

require_once 'includes/session_function.php';

$title = $_SESSION['name'].' '. $_SESSION['firstname'];
require_once 'partials/_header.php';


if(!isset($_GET['id']) || $_GET['id']<0 || $_GET['id'] != $_SESSION['id']) redirect_to('login.php');
if(!logged_in()) redirect_to('login.php');

$q = $db->prepare("SELECT u.id,name,firstname,email,password,role,created_at,active,
       born_at,gender,adress,phone,image,bio, user_id FROM user u LEFT JOIN user_add ua ON ua.user_id = u.id WHERE u.id=:id");
$q->execute(['id' => $_SESSION['id']]);

$userInfo = $q->fetch(PDO::FETCH_OBJ);



$errors = [];
$profileForm = false;
$passForm = false;

if(isset($_POST['update_user'])){
    $submitButton = array_pop($_POST);
    $_POST = sanitize($_POST);
    extract($_POST);

    $bornTimesTamp = strtotime($born_at);
    !$bornTimesTamp ? $errors['born_at'] = "Date invalide." : $formateDate = date('Y-m-d',$bornTimesTamp);

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
    }

    if(!file_exists('/profile')){
        mkdir(BASE_FILE_ROOT.'/profile', 0777, true);
    }

    $profileImageFolder = BASE_FILE_ROOT. '/profile';
    $pathImg = $profileImageFolder .'/'. (!isset($nameImg) ? DEFAULT_PROFILE_PIC: $nameImg);

    if(empty($errors)){
        $q = $db->prepare("UPDATE user u RIGHT JOIN user_add ua ON u.id = ua.user_id SET ua.born_at = :born_at,
        gender = :gender, adress = :adress, phone = :phone, image = :image, bio = :bio, u.email = :email WHERE u.id = :id");
        $success = $q->execute([
            'born_at'   => $formateDate,
            'gender'   => $gender,
            'adress'   => $adress,
            'phone'   => $phone,
            'image'   => $pathImg,
            'bio'   => $bio,
            'email'   => $email,
            'id' => $_SESSION['id']
       ]);

        if($success){
            if(move_uploaded_file($tmpImg, $pathImg)) $_SESSION['success'] = 'Image mise à jour';

            $q = $db->prepare("SELECT u.id,name,firstname,email,password,role,created_at,active,
       born_at,gender,adress,phone,image,bio, user_id FROM user u LEFT JOIN user_add ua ON ua.user_id = u.id WHERE u.id=:id");
            $q->execute(['id' => $_SESSION['id']]);
            $userInfo = $q->fetch(PDO::FETCH_OBJ);
            foreach ($userInfo as $index => $info){
                $_SESSION[$index] = '';
                $_SESSION[$index] = $info;
            }
        }

            $_SESSION['info'] = "Profil mis à jour avec succès";
            $profileForm = false;
            redirect_to('profile.php?id='. ds_info('id'));
    }

    $profileForm = true;
}

if(isset($_POST['change_password'])){
    $submitButton = array_pop($_POST);
    $_POST = sanitize($_POST);
    extract($_POST);

    if(empty($old_password)) {
        $errors['old_password'] = 'Champ obligatoire';
    }elseif (!password_verify($old_password,$userInfo->password)){
        $errors['old_password'] = "Mot de passe inconrect";
    }
    if(empty($new_password)){
        $errors['new_password'] = "Champ obligatoire";
    }elseif (!length_validation($new_password,8,20)){
        $errors['new_password'] = "Champ compris entre 8 et 20 caractères";
    }
    if(empty($confirm_password)){
        $errors['confirm_password'] = "Champ obligatoire";
    }elseif ($new_password !== $confirm_password){
        $errors['confirm_password'] = "Mots de passes différents";
    }

    if(empty($errors)){
        $password = password_hash($new_password, PASSWORD_ARGON2I);
        $q = $db->prepare("UPDATE user SET password = :password WHERE id = :id");
        $success = $q->execute([
            'password'  => $password,
            'id'        => $_SESSION['id']
        ]);

        if($success){
            $_SESSION['info'] = "Mot de passe mis à jour avec succès";
            $passForm = false;
            redirect_to('profile.php?id='.ds_info('id'));
        }else{
            $_SESSION['warning'] = "Echec lors de la mise à jour du mot de passe";
        }

    }



    $passForm = true;
}
require_once 'views/_profile.php';


require_once 'partials/_footer.php';