<?php require_once 'views/display_header.php';?>


<?php echo display_header('Inscription', 'fas fa-users'); ?>


<section>
    <div class="container py-5">
        <div class="col-md-8 col-sm mx-auto">
            <?= display_session_alert()?>
            <?= display_session_alert('warning')?>
            <div class="card bg-dark text-light">
                <div class="card-header">
                    <h2 class="text-center"> Ajouter un administrateur</h2>
                </div>
                <div class="card-body border-top border-warning">
                    <form action="" method="post">
                        <div class="field">
                            <label for="name" class="form-label"> Nom:</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-name"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" placeholder="Votre nom..." aria-label="name"
                                 value="<?= get_data($_POST,'name')?>"  name="name" id="name"   aria-describedby="basic-name">
                            </div>
                            <?= display_errors($errors,'name');?>
                        </div>
                        <div class="field">
                            <label for="firstname" class="form-label"> Prénom:</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-firstname"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" placeholder="Votre prénom..."
                                       value="<?= get_data($_POST,'firstname')?>" name="firstname"  id="firstname"  aria-label="firstname" aria-describedby="basic-firstname">
                            </div>
                            <?= display_errors($errors,'firstname');?>
                        </div>
                        <div class="field">
                            <label for="email" class="form-label"> Email:</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-email"><i class="fas fa-at"></i></span>
                                <input type="text" class="form-control" placeholder="Votre email..."
                                       value="<?= get_data($_POST,'email')?>" name="email" id="email"  aria-label="email" aria-describedby="basic-email">
                            </div>
                            <?= display_errors($errors,'email');?>
                        </div>
                        <div class="field">
                            <label for="role"> Role:</label>
                            <div class="input-group mb-3">
                                <label for="role" class="input-group-text"> <i class="fas fa-user-cog"></i> </label>
                                <select name="role" class="form-select" id="role" >
                                    <option value="modo" <?= !isset($_POST['role']) ? 'selected': get_selected_value('role','modo') ?>>Modérateur</option>
                                    <option value="admin" <?= get_selected_value('role','admin') ?>>Administrteur</option>
                                    <option value="super" <?= get_selected_value('role','super') ?>>Super Admin</option>
                                </select>
                            </div>
                            <?= display_errors($errors,'name');?>
                        </div>

                        <input type="submit" value="Ajouter" class="btn btn-warning rounded-0" name="add_user">
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
