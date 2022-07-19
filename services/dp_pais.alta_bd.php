<?php

include "../init.php";
require '../vendor/autoload.php';

$_SESSION['usuario_id'] = 2;

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

    $valida = $services->verifica_tabla_synk(data_local: $data_local,data_remoto:  $data_remoto, database: $database,
        tabla:  $tabla);
    if(errores::$error){
        $error = (new errores())->error('Error comparar datos ', $valida);
        (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
    }

}

$dp_pais_modelo_local = new dp_pais(link: $data_local->link);


$offset = 0;
$order['dp_pais.id'] = 'DESC';

$r_dp_pais_modelo_local = $dp_pais_modelo_local->filtro_and(columnas_en_bruto: true, limit: 0,offset: $offset, order: $order);
if(errores::$error){
    $error = (new errores())->error('Error al obtener datos locales', $r_dp_pais_modelo_local);
    (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
}

$registros = $r_dp_pais_modelo_local->registros;

foreach ($db->servers_in_data as $database){
    $data_remoto = $services->data_conexion_remota(conf_database: $database, name_model: $tabla);
    if(errores::$error){
        $error = (new errores())->error('Error al obtener datos remotos', $data_remoto);
        (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
    }
    $r_dp_pais_modelo_remoto = new dp_pais(link: $data_remoto->link);

    $insersiones = 0;

    foreach ($registros as $registro){

        $filtro['dp_pais.id'] = $registro['id'];
        $existe_remoto = $r_dp_pais_modelo_remoto->existe(filtro: $filtro);
        if(errores::$error){
            $error = (new errores())->error('Error al obtener pais remoto', $existe_remoto);
            (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
        }
        if(!$existe_remoto){
            $registro = $services->limpia_row_alta(registro: $registro);
            if(errores::$error){
                $error = (new errores())->error('Error al limpiar registro', $registro);
                (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
            }
            unset($registro['usuario_alta_id'],$registro['usuario_update_id']);
            $r_alta_dp_pais = $r_dp_pais_modelo_remoto->alta_registro(registro: $registro);
            if(errores::$error){
                $error = (new errores())->error('Error al insertar pais', $r_alta_dp_pais);
                (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
            }

            $insersiones++;
        }
        if($insersiones>=10){
            break;
        }
    }

}






$services->finaliza_servicio();