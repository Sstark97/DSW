<?php
// Función que crea los errores a mostrar
function createErrors(string $message, bool $empty = false)
{
    $message = $empty ? "<span>$message</span>" : $message;

    return <<< END
        <div id="errors" class="d-flex flex-column align-items-center w-50 mx-auto fw-3 pt-3 text-white">
            <p class='m-0 mb-2'>Hay Errores 🐛</p>
            $message
        </div>
    END;
}

// Función que valida si hay campos de más o de menos
function comprobeFields(array $to_comprobe, array $keys)
{
    /*
    Comprobamos si hay diferencias en lo que
    nos llega con lo que debería llegar
     */
    $diff = count(array_diff(array_keys($to_comprobe), $keys));
    if ($diff !== 0) {
        return true;
    }

    // Comprobamos si hay valores vacíos
    $size_keys = count($keys);
    $stop = false;

    for ($i = 0; $i < $size_keys; $i++) {
        $key = $keys[$i];

        if (empty($to_comprobe[$key])) {
            $stop = true;
            break;
        }
    }

    return $stop;
}

// Función que sanea los datos que nos llegan
function sanitizeFields(array $fields)
{
    $sanitize_fields = [];

    foreach ($fields as $key => $field) {
        $sanitize_field = $key !== "email" ? trim(strip_tags($field)) : trim(strip_tags(filter_var($field, FILTER_SANITIZE_EMAIL)));

        array_push($sanitize_fields, $sanitize_field);
    }

    return $sanitize_fields;
}
