<?php

require_once 'views/display_header.php';

$param = "<span class='text-info'>". ds_info('name').' '.ds_info('firstname') . "</span>";


echo display_header('Bienvenue sur votre profil ' . $param, 'fas fa-user-cog');
?>

<section>
    <div class="row me-0">
        <div class="col-md-3 profile-left">
             <div class="d-flex flex-column p-3 bg-dark text-white h-100">
                 <div class="card bg-transparent rounded-0 border-0">
                     <img src="<?= ds_info('image')?>" class="card-img-top img-rounded mx-auto w-50">
                     <div class="card-body px-0 text-center">
                         <h5 class="card-title mb-0"><?= $param ?></h5>
                         <h6 class="text-info"><?= ds_info('role') == 'super' ? 'Super Admin': ds_info('role') ?></h6>
                         <p class="profile-button d-flex justify-content-center">
                             <a href="" class="btn btn-warning mx-1 btn-sm">S'abonner</a>
                             <a href="" class="btn btn-light mx-1 btn-sm">Message</a>
                         </p>
                     </div>
                      <div class="dropdown-divider border-warning"></div>
                     <nav class="flex-column">
                         <a href="#" class="nav-link text-white-50 active"><i class="fas fa-tachometer-alt"></i> Tableau de bord</a>
                         <a href="#" class="nav-link text-white-50 active"><i class="fas fa-heading"></i> Articles</a>
                         <a href="#" class="nav-link text-white-50 active"><i class="fas fa-users"></i> Utilisateurs</a>
                         <a href="#" class="nav-link text-white-50 active"><i class="fas fa-comments"></i> Commentaires</a>
                         <a href="#" class="nav-link text-white-50 active"><i class="fas fa-question"></i> Aide</a>
                     </nav>
                     <div class="dropdown-divider border-warning"></div>

                     <div class="card-body text-capitalize text-center row">
                         <div class="col-sm-4">
                             <div class="profile stat-value">19</div>
                             <div class="profile stat-title">Posts</div>
                         </div>
                         <div class="col-sm-4">
                             <div class="profile stat-value">156</div>
                             <div class="profile stat-title">Comm</div>
                         </div>
                         <div class="col-sm-4">
                             <div class="profile stat-value">89</div>
                             <div class="profile stat-title">Projets</div>
                         </div>
                     </div>
                     <div class="dropdown-divider border-warning"></div>
                     <div class="card-body">
                         <h6 class="text-center text-info">A propos de <?= $param ?></h6>
                         <p class="text-white-50">lorem ipsum dolor sit amet, consecteur</p>
                     </div>
                     <div class="dropdown-divider border-warning"></div>

                     <div class="card-header text-center text-uppercase">
                         <i class="fas fa-globe-africa"></i> Liens importants
                     </div>
                     <ul class="list-group list-group-flush">
                         <li class="list-group-item bg-transparent border-secondary border-bottom">
                             <a href="#" class="text-light"><i class="fab fa-facebook-square"></i> Facebook </a>
                         </li>
                         <li class="list-group-item bg-transparent border-secondary border-bottom">
                             <a href="#" class="text-light"><i class="fab fa-twitter"></i> Twitter </a>
                         </li>
                         <li class="list-group-item bg-transparent border-secondary border-bottom">
                             <a href="#" class="text-light"><i class="fab fa-youtube"></i> Youtube </a>
                         </li>
                     </ul>
                 </div>
             </div>
        </div>
        <div class="col-md-9 profile-right">
            <div class="container-fluid py-3">
                <?= display_session_alert()?>
                <?= display_session_alert('warning')?>
                <?= display_session_alert('info')?>

                <div class="row mx-0">
                    <div class="col-md-6">
                        <div class="col-md-12 border-bottom border-warning mb-3">
                            <h1 class="text-center"> Informations </h1>
                        </div>
                        <span class="fw-bold"> Nom : </span> <span class="fs-6"><?= ds_info('name') ?></span><br>
                        <span class="fw-bold"> Prénom : </span> <span class="fs-6"><?= ds_info('firstname') ?></span><br>
                        <span class="fw-bold"> Naissance : </span> <span class="fs-6"><?= ds_info('born_at') ?></span><br>
                        <span class="fw-bold"> Sexe : </span> <span class="fs-6"></span><br>
                        <span class="fw-bold"> Adresse : </span> <span class="fs-6"><?= ds_info('adress') ?></span><br>
                        <span class="fw-bold"> Telephone : </span> <span class="fs-6"><?= ds_info('phone') ?></span><br>
                        <span class="fw-bold"> Biographie : </span> <span class="fs-6"><?= ds_info('bio') ?></span><br>
                        <form action="" method="post" class="d-flex">
                            <button class="btn btn-link" name="update_profile">Mettre à jour le profil</button>
                            <button class="btn btn-link" name="update_password">Mettre à jour le mot de passe</button>
                        </form>
                    </div>

                    <div class="col-md-6">
                        <div class="row">

                            <?php if(isset($_POST['update_profile']) || $profileForm === true): ?>
                                <div class="col-md-12 border-bottom border-warning mb-3">
                                    <h1 class="text-center"> Modifier votre profil </h1>
                                </div>

                                <div class="card border-0">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="field">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-born_at"><i class="fas fa-calendar-alt"></i></span>
                                                <input type="text" class="form-control" placeholder="Ex:.1998-10-31 ou 1998/12/25" aria-label="born_at"
                                                       value="<?=  get_data($_POST,'born_at', $userInfo->born_at) ?>"  name="born_at" id="born_at"   aria-describedby="basic-born_at">
                                            </div>
                                            <?= display_errors($errors,'born_at');?>
                                        </div>

                                        <div class="field d-flex justify-content-evenly align-items-center mb-3 fs-6">
                                            <div class="form-check">
                                                <input type="radio" name="gender" id="male" value="male" class="form-check-input" checked>
                                                <label for="male" class="form-check-label">Homme</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" name="gender" id="female" value="female" class="form-check-input">
                                                <label for="female" class="form-check-label">Femme</label>
                                            </div>
                                            <?= display_errors($errors,'gender');?>
                                        </div>
                                        <div class="field">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-adress"><i class="fas fa-user"></i></span>
                                                <input type="text" class="form-control" placeholder="Ex:14 Avenue de la Pte des poissonniers" aria-label="adress"
                                                       value="<?=  get_data($_POST,'adress', $userInfo->adress) ?>"  name="adress" id="adress"   aria-describedby="basic-adress">
                                            </div>
                                            <?= display_errors($errors,'adress');?>
                                        </div>
                                        <div class="field">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-email"><i class="fas fa-at"></i></span>
                                                <input type="text" class="form-control" placeholder="Mettre à jour votre email" aria-label="email"
                                                       value="<?=   get_data($_POST,'email', $userInfo->email)?>"  name="email" id="email"   aria-describedby="basic-email">
                                            </div>
                                            <?= display_errors($errors,'email');?>
                                        </div>
                                        <div class="field">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-phone"><i class="fas fa-phone-alt"></i></span>
                                                <input type="text" class="form-control" placeholder="+33753804152" aria-label="phone"
                                                       value="<?=  get_data($_POST,'phone',$userInfo->phone)?>"  name="phone" id="phone"   aria-describedby="basic-phone">
                                            </div>
                                            <?= display_errors($errors,'phone');?>
                                        </div>

                                        <div class="field">
                                            <div class="input-group mb-3">
                                                <label for="profile-image" class="input-group-text"><i class="fas fa-image"></i></label>
                                                <input type="file" class="form-control" id="profile-image" name="image">
                                                <?= display_errors($errors,'image');?>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                                                <textarea name="bio" id="" cols="30" rows="5" placeholder="Parlez nous de vous"
                                                          class="form-control"><?=  get_data($_POST,'bio',$userInfo->bio) ?></textarea>
                                                <?= display_errors($errors,'bio');?>
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <input type="submit" class="btn btn-warning rounded-0" name="update_user" value="Mettre à jour">
                                            <a href="profile.php?id=<?= ds_info('id') ?>"  class="ms-5 btn btn-danger rounded-0">Annuler</a>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>


                            <?php if(isset($_POST['update_password']) || $passForm === true): ?>
                                <div class="col-md-12 border-bottom border-warning mb-3">
                                    <h1 class="text-center"> Modifier votre mot de passe </h1>
                                </div>

                                <div class="card border-0">
                                    <form action="" method="post">
                                        <div class="field">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-born_at"><i class="fas fa-lock"></i></span>
                                                <input type="password" class="form-control" placeholder="Mot de passe actuel" aria-label="born_at"
                                                       value="<?= get_data($_POST,'old_password')?>"  name="old_password" id="old_password"   aria-describedby="basic-old_password">
                                            </div>
                                            <?= display_errors($errors,'old_password');?>
                                        </div>

                                        <div class="field">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-adress"><i class="fas fa-lock"></i></span>
                                                <input type="password" class="form-control" placeholder="Nouveau mot de passe" aria-label="adress"
                                                       value="<?= get_data($_POST,'new_password')?>"  name="new_password" id="new_password"   aria-describedby="basic-new_password">
                                            </div>
                                            <?= display_errors($errors,'new_password');?>
                                        </div>
                                        <div class="field">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-email"><i class="fas fa-lock"></i></span>
                                                <input type="password" class="form-control" placeholder="Confirmer nouveau mot de passe" aria-label="email"
                                                       value="<?= get_data($_POST,'confirm_password')?>"  name="confirm_password" id="confirm_password"   aria-describedby="basic-confirm_password">
                                            </div>
                                            <?= display_errors($errors,'confirm_password');?>
                                        </div>

                                        <div class="d-flex">
                                            <input type="submit" class="btn btn-warning rounded-0" name="change_password" value="Mettre à jour">
                                            <a href="profile.php?id=<?= ds_info('id') ?>" class="ms-5 btn btn-danger rounded-0">Annuler</a>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


