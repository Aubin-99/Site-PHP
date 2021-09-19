<?php

 require_once 'views/display_header.php';


 echo display_header('Connexion', 'fas fa-sign-in-alt');
 ?>
 <section>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-10 col-sm mx-auto">
                <?= display_session_alert()?>
                <?= display_session_alert('warning')?>
                <div class="card bg-dark text-light">
                    <div class="card-header">
                        <h2 class="text-center"> Se connecter </h2>
                    </div>
                    <div class="card-body border-top border-warning">
                        <form action="" method="post">
                            <div class="field">
                                <label for="username" class="form-label"> Nom d'utilisateur:</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-username"><i class="fas fa-at"></i></span>
                                    <input type="text" class="form-control" placeholder="Votre nom d'utilisateur..." aria-label="username"
                                           value="<?= get_data($_POST,'username')?>"  name="username" id="username"   aria-describedby="basic-username">
                                </div>
                                <?= display_errors($errors,'username');?>
                            </div>
                            <div class="field">
                                <label for="password" class="form-label"> Mot de passe:</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-password"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" placeholder="Votre mot de passe..."
                                           value="<?= get_data($_POST,'password')?>" name="password"  id="password"  aria-label="password" aria-describedby="basic-password">
                                </div>
                                <?= display_errors($errors,'password');?>
                            </div>
                            <input type="submit" value="Se connecter" class="btn btn-warning rounded-0" name="login">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
