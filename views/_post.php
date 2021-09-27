<?php require_once 'views/display_header.php';?>


<?php echo display_header('Ajouter un article', 'fas fa-file-alt'); ?>


<section>
    <div class="container py-5">
     <div class="row">
        <div class="col-md-8 col-sm mx-auto">
            <?= display_session_alert()?>
            <?= display_session_alert('warning')?>
            <?= display_session_alert('info')?>
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center"> Ajouter un article</h2>
                </div>
                <div class="card-body border-top border-warning">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="field">
                            <label for="title" class="form-label"> Titre:</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="title"><i class="fas fa-heading"></i></span>
                                <input type="text" class="form-control" placeholder="Titre de l'article" aria-label="name"
                                 value="<?= get_data($_POST,'title')?>"  name="title" id="title"   aria-describedby="basic-name">
                            </div>
                            <?= display_errors($errors,'title');?>
                        </div>

                        <div class="field">
                            <label for="role"> Categorie:</label>
                            <div class="input-group mb-3">
                                <label for="role" class="input-group-text"> <i class="fas fa-user-folder"></i> </label>
                                <select name="category[]" class="form-select" id="category" multiple>
                                    <?php foreach ($cats as $category): ?>
                                       <option value="<?= $category ?>" <?= get_selected_value('category', $category) ?> ><?=$category?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <?= display_errors($errors,'category');?>
                        </div>

                        <div class="field">
                            <label for="firstname" class="form-label"> Image:</label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" 
                                        name="image"  id="profile-image" >
                                <label for="profile-image" class="input-group-text"><i class="fas fa-image">
                                </i></label>       
                            </div>
                            <?= display_errors($errors,'image');?>
                        </div>
                        <div class="field">
                            <label for="content" class="form-label"> Article:</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="content"><i class="fas fa-intro-circle"></i></span>
                                <textarea class="form-control" id="content" value="<?= get_data($_POST,'content')?>" name="content" ></textarea>
                            </div>
                            <?= display_errors($errors,'content');?>
                        </div>
                
                        <input type="submit" value="Ajouter" class="btn btn-warning rounded-0" name="post">
                    </form>
                </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>
