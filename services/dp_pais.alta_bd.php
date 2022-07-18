<?php

include "../init.php";
require '../vendor/autoload.php';

use base\conexion;
use config\database;
use gamboamartin\errores\errores;
use gamboamartin\services\error_write\error_write;
use gamboamartin\services\services;
use models\dp_pais;


$services = new services(path: __FILE__);

$info = '';
$tabla = 'dp_pais';

$databases = (new database())->servers_in_data;
$paths_conf = new stdClass();
$paths_conf->generales = '/var/www/html/administrador/config/generales.php';
$paths_conf->database = '/var/www/html/administrador/config/database.php';
$paths_conf->views = '/var/www/html/administrador/config/views.php';

$cnx = new conexion(paths_conf: $paths_conf);
$link_local = conexion::$link;

foreach ($databases as $database){

    $link_remoto = $cnx->genera_link_custom(conf_database: $database, motor: 'MYSQL');
    if(errores::$error){
        $error = (new errores())->error('Error al conectar con remoto', $link_remoto);
        (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
    }

    var_dump($link_remoto);

    $existe_tabla = (new \base\orm\validaciones())->existe_tabla(link:  $link_remoto,tabla: $tabla);
    if(!$existe_tabla){
        $error = (new errores())->error('Error no existe la tabla', $tabla);
        (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
    }


    $modelo = new dp_pais(link: $link_remoto);






}
$services->finaliza_servicio();