<?php
    require_once "./parts/parts.php";
    require_once "./agenda/general_functions.php";
    require_once "./agenda/add_contact.php";
    require_once "./agenda/show_contacts.php";

    $contacts = isset($_POST["contacts"]) ? (array) json_decode($_POST["contacts"], true) : [];
    date_default_timezone_set("Atlantic/Canary");
?>
<?= createHeader($contacts) ?>
<div class="w-100">
    <?php if (isset($_POST["action"])) :?>
            <?php if (strcmp($_POST["action"][0],"Añadir contacto") === 0): ?>
                <?= contactForm("Añadir Contacto","add_form",$_SERVER["PHP_SELF"], $contacts) ?>
            <?php endif; ?>   

            <?php if (strcmp($_POST["action"][0],"Actualizar datos") === 0): ?>
                <div class="w-100">Actualizar Datos</div>
            <?php endif; ?>   

            <?php if (strcmp($_POST["action"][0],"Bloquear un Contacto") === 0): ?>
                <div class="w-100">Bloquear un Contacto</div>
            <?php endif; ?>   

            <?php if (strcmp($_POST["action"][0],"Mostrar todos los contactos") === 0): ?>
                <?= createContactsTable($contacts) ?>
            <?php endif; ?>   

            <?php if (strcmp($_POST["action"][0],"Subir datos Extra") === 0): ?>
                <div class="w-100">Subir datos Extra</div>
            <?php endif; ?>
            
    <?php endif; ?>

    <?php if(isset($_POST["add_form"])): ?>

        <?php if(comprobeFields($_POST["contact"])) : ?>
            <p>Hay campos de más o hay campos vacíos</p>
        <?php else : ?>
            <?php $message = validateAddUserForm(...array_values($_POST["contact"])) ?>
        <?php endif; ?>

        <?php if(isset($message) && $message !== ""): ?>
            <?= $message ?>
        <?php else: ?>
            <?php
                $contact = createContact(...array_values($_POST["contact"]));
                $dni = array_keys($contact)[0];
                $contact_values = array_values($contact);
                $contacts[$dni] = json_encode(...$contact_values);
            ?>
            <?= sendContactDataForm("Datos enviados", $contacts, $contact, $_SERVER["PHP_SELF"]) ?>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?= createFooter() ?>