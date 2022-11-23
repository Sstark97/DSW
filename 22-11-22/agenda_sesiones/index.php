<?php
    require_once "./parts/parts.php";
    require_once "./agenda/general_functions.php";
    require_once "./agenda/add_contact.php";
    require_once "./agenda/edit_contact.php";
    require_once "./agenda/block_contact.php";
    require_once "./agenda/show_contacts.php";
    require_once "./agenda/files_contact.php";

    session_name("diary");
    session_start();

    $contacts = isset($_SESSION["contacts"]) ? $_SESSION["contacts"] : [];
    $action = $_SERVER["PHP_SELF"];
    date_default_timezone_set("Atlantic/Canary");
?>
<?= createHeader($contacts) ?>
    <!- Función para enseñar la Tabla y donde se recibe la accion de ordenar ->
    <?php if(showTable() || isset($_POST["order_action"])): ?>
        <?= createContactsTable($contacts, $action) ?>
    <?php endif; ?>

    <!- Función que controla que mostrar según la acción ->
    <?php if (isset($_POST["action"])) :?>
        <?= actions($action, $contacts) ?>
    <?php endif; ?>
    
    <!- En está parte se controlan los efectos de añadir/actualizar contactos ->
    <?php if(isModify()): ?> 
        <?= returnModifyResult($action, $contacts) ?>
    <?php endif; ?>

    <!- En está parte se realiza la acción de bloquear ->
    <?php if(isset($_POST["block_action"])): ?>
        <?= sendblockContact($action, $contacts) ?>
    <?php endif; ?>

    <!- En esta sección controlamos la subida de ficheros ->
    <?php if(isset($_POST["upload_action"])): ?>
        <?= uploadResult($contacts, $action) ?>
    <?php endif; ?>
<?= createFooter() ?>