# Vas a crear tu propia Agenda. 
## Deberás crear un proyecto web en PHP que contendrá:

- Una página principal que me permita indicar al programa que acción quiero realizar. Las acciones que se pueden realizar (cuando se pinche en cada uno se deberá abrir una página nueva) son:
  1. Insertar un contacto: formulario en PHP que contendrá los siguientes campos: dni, nombre, apellidos, teléfono, fecha de nacimiento, correo electrónico. Se deberá realizar validación en el servidor de todos los datos pasados. Además, se deberá insertar internamente en la misma estructura la fecha en la que se insertó en la agenda al usuario (timestamp). Recuerda que se debe configurar la hora local de canarias.
  2. Actualizar datos del usuario: se deberán actualizar todos los campos de la agenda de un usuario determinado, realizándose en el servidor la validación de los mismos.
  3. Bloquear un contacto: se deberá abrir una página web en la que nos solicite el dni del usuario a bloquear. Un usuario bloqueado no se mostrará en la opción de “Mostrar todos los contactos”.
  4. Mostrar todos los contactos: se le mostrará al usuario la opción de ordenación que desee (por la clave, por el nombre o por el apellido). Se deberá crear una tabla en la que la cabecera indicará el campo que se está mostrando y en cada fila se mostrará los datos de cada usuario. La fecha de inserción del contacto se mostrará con el siguiente formato: Lunes, 02 de noviembre de 2022, 11:10 am, en español, en formato de 12 horas.
  5. Subir datos extras: el programa deberá permitir la subida de ficheros e indicar qué fichero pertenece a qué usuario, almacenando la ruta del mismo en un array. Si el fichero ocupa más de 1MB el fichero no se podrá subir al servidor. Los tipos de ficheros permitidos son pdf y odt. Realizar control de errores.
- El pie de la página deberá tener licencia Creative Commons "Reconocimiento" con tu nombre y apellidos, curso, módulo y ciclo.

## Notas a tener en cuenta

- Crea una nueva carpeta dentro del servidor web denominada agenda que contendrá tu proyecto.
- La cabecera y el pie de todo el aplicativo deben ser las mismas y estarán ubicadas en el servidor en una carpeta denominada parts.
- Se deberá utilizar una matriz asociativa de dos dimensiones para almacenar los datos (dni como clave y a continuación otro array que tendrá como clave los campos nombre, apellidos, email, etc).
- Modularizar el código lo máximo posible (uso de funciones).
- Uso de funciones de arrays y cadenas.
- Uso de variables superglobales