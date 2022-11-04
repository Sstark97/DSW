<?php

function createAddUserForm(string $action) {
    return <<< END
        <h1 class="text-center mt-2">Añadir contacto</h1>
        <form class="w-50 container mx-auto" action="$action" method="post">
            <div class="row">
                <div class="col">
                    <label for="contact[dni]" class="form-label">DNI</label>
                    <input type="text" class="form-control" name="contact[dni]">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="contact[name]" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="contact[name]">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="contact[surname]" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="contact[surname]">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="contact[phone]" class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" name="contact[phone]">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="contact[email]" class="form-label">Email</label>
                    <input type="email" class="form-control" name="contact[email]">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button name="add_form" class="btn btn-primary" type="submit">Añadir</button>
                </div>
            </div>
        </form>
    END;
}

function validateAddUserForm (string $name) {

}