<?php require_once 'views/display_header.php';?>

<?php echo display_header('Mettre à jour une catégorie', 'fas fa-edit'); ?>

<section>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-10 col-sm mx-auto">
                <?= display_session_alert()?>
                <?= display_session_alert('warning')?>
                <div class="card bg-dark text-light">
                    <div class="card-header">
                        <h1 class="text-center text-warning fs-3">Ajouter une catégorie</h1>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="category" class="form-label">Nom de la catégorie</label>
                                <input type="text" id="category" class="form-control rounded-0" name="category"
                                       value="<?= isset($_POST['category']) ? get_data($_POST,'category'):
                                       $currentCategory->title ?>">
                                <?php echo display_errors($errors,'category') ?><br>
                                <input type="submit" name="edit_category" class="btn btn-warning mt-3 rounded-0" value="Modifier">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
