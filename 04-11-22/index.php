<?php
    require_once "./parts/parts.php";
    require_once "./agenda/general_functions.php";
    require_once "./agenda/add_contact.php";
    require_once "./agenda/edit_contact.php";
    require_once "./agenda/block_contact.php";
    require_once "./agenda/show_contacts.php";
    require_once "./agenda/files_contact.php";

    $contacts = isset($_POST["contacts"]) ? json_decode($_POST["contacts"], true) : [];
    date_default_timezone_set("Atlantic/Canary");
?>
<?= createHeader($contacts) ?>
<div class="w-100">

    <?php if(!isset($_POST["not_show"]) && !isset($_POST["order_action"]) && !isset($_POST["action"]) && !isset($_POST["block_action"]) && !isset($_POST["upload_action"])): ?>
        <?= createContactsTable($contacts, $_SERVER["PHP_SELF"]) ?>
    <?php endif; ?>

    <?php if (isset($_POST["action"])) :?>
            <?php if (isset($_POST["action"]["add"])): ?>
                <?= contactForm("Añadir Contacto","add_form",$_SERVER["PHP_SELF"], $contacts) ?>
            <?php endif; ?>   
            <?php if (isset($_POST["action"]["update"])): ?>
                <?= editContactForm($_SERVER["PHP_SELF"], $_POST["contact_dni"], $contacts) ?>
            <?php endif; ?>    

            <?php if (isset($_POST["action"]["block"])): ?>
                <?= blockContactForm($_SERVER["PHP_SELF"], $contacts) ?>
            <?php endif; ?>

            <?php if (isset($_POST["action"]["upload"])): ?>
                <?= uploadForm($_SERVER["PHP_SELF"],$_POST["contact_dni"] ,$contacts) ?>
            <?php endif; ?>    
    <?php endif; ?>

    <?php if(isset($_POST["add_form"]) || isset($_POST["action"]["edit"])): ?> 

        <?php $is_ok = comprobeFields($_POST["contact"])?>
        <?php if($is_ok ) : ?>
            <p>Hay campos de más o hay campos vacíos</p>
        <?php else : ?>
            <?php $message = validateAddUserForm(...array_values($_POST["contact"])) ?>
        <?php endif; ?>

        <?php if(empty($message) && !$is_ok ): ?>
            <?php
                $post_values = array_values($_POST["contact"]);
                $time_stamp = $_POST["timestamp_insert"] ?? 0;
                [ $dni, $contact ] = modifyAction(!isset($_POST["action"]["edit"]), $time_stamp, $contacts, $post_values);
            ?>
            <?= sendContactDataForm("Datos enviados", $contacts, [$dni => $contact], $_SERVER["PHP_SELF"]) ?>
        <?php endif; ?>
        <?php if(!empty($message)): ?>
            <?= $message ?>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(isset($_POST["block_action"])): ?>
        <?= sendblockContact($_SERVER["PHP_SELF"], $_POST["block_dni"], $contacts) ?>
    <?php endif; ?>

    <?php if(isset($_POST["order_action"])): ?>
        <?php
            $order = $_POST["order"];
            orderContacts($contacts, $order === "dni", $order);
        ?>
        
        <?= createContactsTable($contacts, $_SERVER["PHP_SELF"]) ?>
    <?php endif; ?>

    <?php if(isset($_POST["upload_action"])): ?>
        <?php 
            $message = uploadFile($_POST["contact_dni"], $_FILES["file_dni"]);
        ?>

        <?php if (!empty($message)) : ?>
            <?= $message ?>
        <?php else: ?>
            <?= createContactsTable($contacts, $_SERVER["PHP_SELF"]) ?>
        <?php endif; ?>

    <?php endif; ?>
</div>

<?= createFooter() ?>