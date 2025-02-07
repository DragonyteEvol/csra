
** Tabla de contenidos**

[TOCM]

[TOC]

### DESCRIPCION

Aplicacion web encargada de analizar logs en busca de eventos y asignarle un puntaje segun su criticidad.

### DEPENDENCIAS
- Mysql 5.7
- PHP 7.0
- Apache 2.4
- Bootstrap 5.3.3
- Axios 1.1.2
#### INSTALACION DOCKER
Si usa docker puede ejecutar en la raiz del proyecto
    `docker build .`
#### INSTALACION MANUAL
##### MYSQL
    - Version 5.7
    La version de mysql recomendada es la 5.7 sin embargo debe realizar la configuracion de agrupacion multiple para que las operaciones realizadas en base de datos se ejecuten correctamente, Si su version de mysql o mariadb es inferior o igual a 5.7 debe realizar la siguiente configuracion

    1. crear archivo mysql.conf en la instalacion de mysql si usa docker debe acceder a la imagen.
    2. dentro del archivo mysql.conf debe alojar el siguiente codigo mas las configuraciones adicionales que considere pertinentes
    `[mysqld]`
    `sql_mode=STRICT_TRANS_TABLA,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION`
##### PHP
    - Version 7.0
    Para la version de php debe instalar los plugins de conexion a base de datos pdo.

###### INSTALACION PLUGINS
    - Si usa docker puede usar el siguiente comando dentro de la imagen
    `docker-php-ext-install pdo_mysql`
    - Si por el contrario prefiere, puede habilitar el plugin el el archivo de configuracion de php
    - Tambien puede instalarlo con algun gestor de paquetes para deribados de debian:
    `sudo apt install pdo-mysql php-mysql php5-mysql`

#### APACHE (SERVIDOR)
    - Version 2.4
##### HABILITAR SOBREESCRITURA
    Para cualquier vesion de apache debe activar la sobrescritura para modificacion de uri en tiempo real con el siguiente comando
    `a2enmod rewrite`
    y posteriormente reiniciar el contenedor o el servicio, para sistemas basados en debian
    `sudo /etc/init.d/apache2 restart`
    `systemctl restart apache2`
### CONFIGURACION BASE DE DATOS
    El proyecto en la raiz contiene un archivo llamado "config.php" este documento debe ser modificado y debe agregar las credenciales que corresponden a cada una de las bases de datos que usa el aplicativo

    El proyecto se conecta a 2 bases de datos una base de datos anfitrion que es la que contiene la informacion generada por el aplicativo y una base de datos remota que corresponde a los datos de (osiem) eventos, logs, etc.

### ESTRUCTURA
    El proyecto esta desarrollado bajo una estructura modelo, plantilla, controlador.
#### MODELOS
    Los modelos contienen el codigo necesario para los calculos y extraccion de informacion todos los modelos del proyecto heredan de la clase Model que tiene todos las funciones, clases, variables y constantes necesarias para la extraccion de informacion de cualquier tabla de base de datos.
##### VARIABLES DE CAMPO
    - $table[string]: tabla sobre la que actua el modelo
    - $columns[list]: lista de columnas que el modelo puede modificar
    - $args[list]: lista de columnas con prefijo ":" para consultas protegidas de inyeccion sql (opcional)
    - $one_to_one[dictionary]: diccionario con clave valor de modelos con los que quiere que se relacione el modelo actual en una relacion de 1 a 1 (opcional).
    - $one_to_much[dictionary]: diccionario con clave valor de modelos con los que quiere que se relacione el modelo actual en una relacion de 1 a muchos (opcional).
    - $much_to_much[dictionary]: diccionario con clave valor de modelos con los que quiere que se relacione el modelo actual en una relacion de muchos a muchos (opcional).

    Esta estructura permite que el proyecto sea escalable puesto que la creacion de un nuevo modelo solo implica heredar de la clase Model y configurar las variables de campo necesarias para su funcionamiento

#### CONTROLADORES
    Los controladores estan encargados de instanciar los modelos y enviar la informacion arrojada por el modelo a las vistas. El proyecto usa una variable general llamada "$data" es un diccionario que contiene la informacion de cualquier modelo por ejemplo con "$data["kris"]" puedo acceder a todos los kris arrojados por el modelo, 
##### TRUCO DEL ALMENDRUCO
    El proyecto puede funcionar como un API codificando la variable "$data" a un json.

#### PLANTILLAS
    Las vistas del proyecto usan bootstrap a travez de un CDN por lo cual siempre estara disponible la ultima version sin embargo se recomienda descargar una version estable y relacionarla al proyecto.
    Las vistas tambien hacen uso de axios 1.1.2 para conexion asincrona en esta los modelos anteriores funcionan como apis para enviar la informacion de forma asincrona a la vista.

