<?php
    require_once "../parts/parts.php";
    include "../db_functions.php";

    $error = deleteStudent();
?>

<?= createHeader() ?>
    <?php if($error): ?>
            <div class="container mt-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger" role="alert">
                            <?= $error ?>
                        </div>
                    </div>
                </div>
            </div>
    <?php endif; ?>
<?= createFooter() ?>
