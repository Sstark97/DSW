<?php
namespace Controller;

class GeneralController {
    /**
     * Fragmento HTML con los posibles errores
     * 
     * Función que genera un fragmento de código HTML
     * que muestro los errores que le pasemops como 
     * parámetro
     * 
     * @param string $message mensaje de error que queremos mostrar
     * @param bool $empty controla si debebemos envolver el mensaje en un <span></span>
     * @return string fragmento HTML con los errores
     */
    public static function createErrors(string $message, bool $empty = false)
    {
        $message = $empty ? "<span>$message</span>" : $message;

        return <<< END
            <div id="errors" class="d-flex flex-column align-items-center w-50 mx-auto fw-3 pt-3 text-white">
                <p class='m-0 mb-2'>Hay Errores 🐛</p>
                $message
            </div>
        END;
    }

    /**
     * Comprueba los campos de un formulario
     * 
     * Función que comprueba si los elementos pasados
     * tienen las mismas claves y si existen elementos vacíos
     * en el array a comprobar
     * 
     * @param array $to_comprobe campos a comprobar
     * @param array $keys claves que queremos analizar
     * @return bool true si hay diferencias y false en caso contrario
     */
    public static function comprobeFields(array $to_comprobe, array $keys)
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

    /**
     * Sanitizado de los datos
     * 
     * Función que sanitiza los datos que le pasemos,
     * evitando espacios y código HTML insertado
     * 
     * @param array $fields campos a sanitizar
     * @return array campos sanitizados
     */
    public static function sanitizeFields(array $fields) {
        $sanitize_fields = [];

        foreach ($fields as $key => $field) {
            $sanitize_field = $key !== "email" 
                ? trim(strip_tags($field)) 
                : trim(strip_tags(filter_var($field, FILTER_SANITIZE_EMAIL)));

            array_push($sanitize_fields, $sanitize_field);
        }

        return $sanitize_fields;
    }
}