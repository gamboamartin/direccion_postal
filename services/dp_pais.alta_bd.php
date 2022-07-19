<?php

include "../init.php";
require '../vendor/autoload.php';

use base\conexion;
use base\orm\columnas;
use base\orm\validaciones;
use config\database;
use gamboamartin\errores\errores;
use gamboamartin\services\error_write\error_write;
use gamboamartin\services\services;
use models\dp_pais;


$services = new services(path: __FILE__);

$info = '';
$tabla = 'dp_pais';

$db = new database();


$data_local = $services->data_conexion_local(name_model: $tabla);
if(errores::$error){
    $error = (new errores())->error('Error al obtener datos de conexion local', $data_local);
    (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
}



foreach ($db->servers_in_data as $database){

    $data_remoto = $services->data_conexion_remota(conf_database: $database, name_model: $tabla);
    if(errores::$error){
        $error = (new errores())->error('Error al obtener datos remotos', $data_remoto);
        (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
    }

    $existe_tabla = (new validaciones())->existe_tabla(link:  $data_remoto->link, name_bd: $database->db_name,tabla: $tabla);
    if(!$existe_tabla){
        $error = (new errores())->error('Error no existe la tabla', $tabla);
        (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
    }
    
    $valida = $services->verifica_numero_columnas(data_local: $data_local, data_remoto: $data_remoto);
    if(errores::$error){
        $error = (new errores())->error('Error comparar datos '.$valida, $valida);
        (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
    }

    $valida = $services->verifica_columnas(columnas_local: $data_local->columnas,columnas_remotas:  $data_remoto->columnas);
    if(errores::$error){
        $error = (new errores())->error('Error comparar datos '.$valida, $valida);
        (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
    }


}
$services->finaliza_servicio();