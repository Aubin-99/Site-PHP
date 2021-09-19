<?php
function display_header(string $title = 'Formation PHP', string $icon = 'at'){
    return <<<HTML
    <section class="admin-header pt-70">
            <div class="border-top border-warning border-5"></div>
            <div class="bg-dark text-light">
                <div class="container">
                    <div class="row">
                        <h1><i class="<?= $icon ?>"></i>$title</h1>
                    </div>
                </div>
            </div>
            <div class="border-bottom border-warning border-5"></div>
    </section>
HTML;

}