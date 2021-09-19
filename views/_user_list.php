<?php require_once 'views/display_header.php';?>


<?php echo display_header('Liste des utilisateurs', 'fas fa-users'); ?>

<section>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-10 col-sm mx-auto">
                <?= display_session_alert()?>
                <?= display_session_alert('warning')?>
            </div>
        </div>
    </div>
</section>
