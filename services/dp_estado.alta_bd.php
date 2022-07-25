<?php

include "../init.php";
require '../vendor/autoload.php';

$_SESSION['usuario_id'] = 2;

use config\database;
use gamboamartin\errores\errores;
use gamboamartin\services\error_write\error_write;
use gamboamartin\services\services;


$services = new services(path: __FILE__);

$info = '';
$tabla = 'dp_estado';

$db = new database();


$data_local = $services->data_conexion_local(name_model: $tabla);
if(errores::$error){
    $error = (new errores())->error('Error al obtener datos de conexion local', $data_local);
    (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
}

if(!isset($db->servers_in_data)){
    $error = (new errores())->error('Error no existe database->servers_in_data', $db);
    (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
}

foreach ($db->servers_in_data as $database){


    $valida = $services->valida_estructura(data_local: $data_local, database: $database, tabla: $tabla);
    if(errores::$error){
        $error = (new errores())->error('Error comparar datos ', $valida);
        (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
    }

}

/**
 * @var base\orm\modelo $modelo_local
 */
$modelo_local = new $tabla(link: $data_local->link);


$offset = 0;
$order[$tabla.'.id'] = 'DESC';

$r_modelo_local = $modelo_local->filtro_and(columnas_en_bruto: true, limit: 0,offset: $offset, order: $order);
if(errores::$error){
    $error = (new errores())->error('Error al obtener datos locales', $r_modelo_local);
    (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
}

$registros = $r_modelo_local->registros;

foreach ($db->servers_in_data as $database){
    $data_remoto = $services->data_conexion_remota(conf_database: $database, name_model: $tabla);
    if(errores::$error){
        $error = (new errores())->error('Error al obtener datos remotos', $data_remoto);
        (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
    }

    /**
     * @var base\orm\modelo $modelo_remoto
     */
    $modelo_remoto = new $tabla(link: $data_local->link);


    $insersiones = 0;

    foreach ($registros as $registro){

        $insertado = $services->alta_row(modelo: $modelo_remoto, registro: $registro);
        if(errores::$error){
            $error = (new errores())->error(mensaje: 'Error al insertar registro', data: $insertado);
            (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
        }
        if($insertado){
            $insersiones++;
        }
        if($insersiones>=10){
            break;
        }
    }

}

$services->finaliza_servicio();