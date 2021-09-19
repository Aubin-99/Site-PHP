<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Coding City">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        section{
            max-width: 800px;
            width: 100%;
            font-size: 10px;
            font-family: sans-serif;
            text-align: center;
        }
        h1{
            font-size: 1.6rem;
            font-weight: 400;
            text-align: center;
            margin-bottom: 2rem;
            font-family: serif;
            color: #88dafd;
            line-height: 2;
        }

        p span{
            font-size: 1.1rem;
            font-weight: 400;
            color: #88dafd;
        }

        strong, .copyright{
            font-size: 1rem;
            color: #88dafd;
        }
    </style>
</head>
<body>
     <h1 style="--bs-green: ">Administration de <?= WEBSITE_NAME ?></h1>
      <p>Cher <span style="--bs-blue: "><?= $name ?> <?= $firstname ?></span>  <br>
          Nous souhaiterons vous compter parmi notre équipe. <br>
          Nous serons ravis que vous nous suivez grace à ce <a href="<?= WEBSITE_URL.'/activation.php?n='.$name
          .'&e='.$email.'&t='.$token?>">Lien</a>. <br>
          Votre mot de passe par défaut est <strong><em>1234456</em></strong> que vous pourriez modifier
          dans vos paramètres.<br>
          Nous accrdons l'importance à votre oeuvre. <br>
          Cordialement,
      </p>

     <div class="copyright" style="--bs-yellow: ">&copy;  <?= WEBSITE_NAME ?> <?= date('Y') ?>Tous droits reservés</div>
</body>

