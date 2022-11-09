<?php
    require_once "./parts/parts.php";
    require_once "./agenda/general_functions.php";
    require_once "./agenda/add_contact.php";
    require_once "./agenda/edit_contact.php";
    require_once "./agenda/block_contact.php";
    require_once "./agenda/show_contacts.php";
    require_once "./agenda/files_contact.php";

    $contacts = isset($_POST["contacts"]) ? json_decode($_POST["contacts"], true) : [];
    $action = $_SERVER["PHP_SELF"];
    date_default_timezone_set("Atlantic/Canary");
?>
<?= createHeader($contacts) ?>
<div class="w-100">

    <?php if(showTable()): ?>
        <?= createContactsTable($contacts, $action) ?>
    <?php endif; ?>

    <?php if (isset($_POST["action"])) :?>
            <?php if (isset($_POST["action"]["add"])): ?>
                <?= contactForm("Añadir Contacto","add_form",$action, $contacts) ?>
            <?php endif; ?>   
            <?php if (isset($_POST["action"]["update"])): ?>
                <?= editContactForm($action, $contacts) ?>
            <?php endif; ?>

            <?php if (isset($_POST["action"]["block"])): ?>
                <?= blockContactForm($action, $contacts) ?>
            <?php endif; ?>

            <?php if (isset($_POST["action"]["upload"])): ?>
                <?= uploadForm($action ,$contacts) ?>
            <?php endif; ?>    
    <?php endif; ?>

    <?php if(isModify()): ?> 

        <?php $is_ok = comprobeFields()?>
        <?php if($is_ok) : ?>
            <?= createErrors("Existen campos vacíos o campos de más", true) ?>
        <?php else : ?>
            <?php $message = validateAddUserForm() ?>
        <?php endif; ?>

        <?php if(empty($message) && !$is_ok ): ?>
            <?php
                $time_stamp = $_POST["timestamp_insert"] ?? 0;
                [ $dni, $contact ] = modifyAction(!isset($_POST["action"]["edit"]), $time_stamp, $contacts);
            ?>
            <?= sendContactDataForm("Datos enviados", $contacts, [$dni => $contact], $action) ?>
        <?php endif; ?>
        <?php if(!empty($message)): ?>
            <?= createErrors($message) ?>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(isset($_POST["block_action"])): ?>
        <?= sendblockContact($action, $contacts) ?>
    <?php endif; ?>

    <?php if(isset($_POST["order_action"])): ?>
        <?php
            $order = $_POST["order"];
            orderContacts($contacts, $order === "dni", $order);
        ?>
        
        <?= createContactsTable($contacts, $action) ?>
    <?php endif; ?>

    <?php if(isset($_POST["upload_action"])): ?>
        <?php 
            $message = uploadFile($contacts);
        ?>
        
        <?php if (!empty($message)) : ?>
            <?= $message ?>
        <?php else: ?>
            <?= createContactsTable($contacts, $action) ?>
        <?php endif; ?>

    <?php endif; ?>
</div>

<?= createFooter() ?>