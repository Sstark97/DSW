<?php
    require_once "./parts/parts.php";
    require_once "./agenda/add_contact.php";
    $contacts = []
    // dni, nombre, apellidos, teléfono, fecha de nacimiento, correo electrónico.
?>
<?= createHeader() ?>
<div class="w-100">
    <?php if (isset($_POST["action"])) :?>
            <?php if (strcmp($_POST["action"][0],"Añadir contacto") === 0): ?>
                <?= createAddUserForm($_SERVER["PHP_SELF"]) ?>
            <?php endif; ?>   

            <?php if (strcmp($_POST["action"][0],"Actualizar datos") === 0): ?>
                <div class="w-100">Actualizar Datos</div>
            <?php endif; ?>   

            <?php if (strcmp($_POST["action"][0],"Bloquear un Contacto") === 0): ?>
                <div class="w-100">Bloquear un Contacto</div>
            <?php endif; ?>   

            <?php if (strcmp($_POST["action"][0],"Mostrar todos los contactos") === 0): ?>
                <div class="w-100">Mostrar todos los contactos</div>
            <?php endif; ?>   

            <?php if (strcmp($_POST["action"][0],"Subir datos Extra") === 0): ?>
                <div class="w-100">Subir datos Extra</div>
            <?php endif; ?>   
    <?php endif; ?>

    <?php if(isset($_POST["add_form"])): ?>
        <pre>
            <?= print_r($_POST["contact"]) ?>
        </pre>
    <?php endif; ?>
</div>

<?= createFooter() ?>