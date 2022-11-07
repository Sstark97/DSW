<?php
    require_once "./parts/parts.php";
    require_once "./agenda/general_functions.php";
    require_once "./agenda/add_contact.php";
    require_once "./agenda/show_contacts.php";

    $contacts = isset($_POST["contacts"]) ? json_decode($_POST["contacts"], true) : [];
    date_default_timezone_set("Atlantic/Canary");
?>
<?= createHeader($contacts) ?>
<div class="w-100">

    <?php if(!isset($_POST["not_show"]) && !isset($_POST["order_action"])): ?>
        <?= createContactsTable($contacts, $_SERVER["PHP_SELF"]) ?>
    <?php endif; ?>

    <?php if (isset($_POST["action"])) :?>
            <?php if (isset($_POST["action"]["add"])): ?>
                <?= contactForm("Añadir Contacto","add_form",$_SERVER["PHP_SELF"], $contacts) ?>
            <?php endif; ?>   

            <?php if (isset($_POST["action"]["block"])): ?>
                <div class="w-100">Bloquear un Contacto</div>
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

    <?php if(isset($_POST["order_action"])): ?>
        <?php
            $order = $_POST["order"];
            orderContacts($contacts, $order === "dni", $order);
        ?>
        
        <?= createContactsTable($contacts, $_SERVER["PHP_SELF"]) ?>
    <?php endif; ?>
</div>

<?= createFooter() ?>