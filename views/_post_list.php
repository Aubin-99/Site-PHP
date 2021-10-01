<?php require_once 'views/display_header.php';?>


<?php echo display_header('Liste des articles', 'fas fa-clipboard-list'); ?>

<section>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-10 col-sm mx-auto">
                <?= display_session_alert()?>
                <?= display_session_alert('warning')?>
                <?= display_session_alert('info')?>
            </div>
        </div>
    </div>
</section>
