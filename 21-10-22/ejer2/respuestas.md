- ¿Qué ocurre si no se selecciona nada en el “checkbox”? Haz la prueba.
    Si no lo seleccionas no aparece en la Tabla usando un foreach, con un for normal pasa

- ¿Qué ocurre si no se selecciona nada en los “radio button”? Haz la prueba.
    Si no lo seleccionas no aparece en la Tabla usando un foreach, con un for normal pasa

- ¿Qué ocurre si no se selecciona nada en el select? Haz la prueba.
    Si no lo seleccionas no aparece en la Tabla usando un foreach, con un for normal falla

- Ahora introduce lo siguiente en el formulario, en el control del nombre: <p>Hola, que tal</p>. ¿Qué es lo que ocurre? Intenta solucionarlo mediante el uso de la función strip_tags($cadena)

- Introduce en el formulario, en el control nombre, un conjunto de caracteres en blanco antes de tu nombre y después de tu nombre. ¿Cómo se recoge en el parámetro? Intenta modificar el valor para que se eliminen los mismos. Utiliza la función trim($cadena).

- Introduce en el formulario, en el control nombre, lo siguiente: Pepito & Company. Comprueba a ver qué ocurre en tu página. Valida la misma a ver si está correcta. Intenta modificar ese valor mediante la función str_replace().