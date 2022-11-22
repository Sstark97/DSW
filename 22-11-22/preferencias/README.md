# Grabado de preferencias de usuario con cookies

Vas a desarrollar una página web (index.php) en la que se pregunten datos del usuario, concretamente:
- Nombre y apellidos
- Color deseado para el fondo
- Color deseado para la letra (darle a elegir una entre tres tipos de letras: Times new Romans, Arial, Calibri)
- Idioma (darle a elegir entre español o inglés)

Tras aceptar los datos, se deberá abrir una segunda página (bienvenida.php) que dará el saludo al usuario, por ejemplo: Bienvenido/a  Juan Sánchez, o Welcome Juan Sánchez, utilizando el tipo de letra, los colores elegidos y el saludo en el idioma seleccionado.

- La siguiente vez que se acceda a la página inicial (index.php) ya no nos preguntará las preferencias porque se dará cuenta que tiene los datos en cookies y nos llevará a la segunda página.

- Si intentamos acceder directamente a la página del saludo y no hemos grabado las preferencias esta página nos llevará a la página con el formulario (index.php).

- En la página del saludo, un enlace nos permitirá borrar las preferencias.