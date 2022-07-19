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

    if($data_remoto->n_columnas > $data_local->n_columnas){
        $error = (new errores())->error('Error las columnas remotas son mayores a las columnas locales',
            array('remoto'=>$data_remoto->columnas,'local'=>$data_local->columnas));
        (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);

    }
    if($data_remoto->n_columnas < $data_local->n_columnas){
        $error = (new errores())->error('Error las columnas remotas son menores a las columnas locales',
            array('remoto'=>$data_remoto->columnas,'local'=>$data_local->columnas));
        (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);

    }

    foreach ($data_local->columnas as $column_local){
        $existe_columna_en_remoto = false;
        $tipo_dato_en_remoto_valido = false;
        $null_en_remoto_valido = false;
        $key_en_remoto_valido = false;
        $default_en_remoto_valido = false;
        $extra_en_remoto_valido = false;


        foreach ($data_remoto->columnas as $column_remoto){
            if($column_remoto['Field'] === $column_local['Field']){
                $existe_columna_en_remoto = true;
                if($column_remoto['Type'] === $column_local['Type']){
                    $tipo_dato_en_remoto_valido = true;
                }
                if($column_remoto['Null'] === $column_local['Null']){
                    $null_en_remoto_valido = true;
                }
                if($column_remoto['Key'] === $column_local['Key']){
                    $key_en_remoto_valido = true;
                }
                if($column_remoto['Default'] === $column_local['Default']){
                    $default_en_remoto_valido = true;
                }
                if($column_remoto['Extra'] === $column_local['Extra']){
                    $extra_en_remoto_valido = true;
                }
                break;
            }

        }
        if(!$existe_columna_en_remoto){
            $error = (new errores())->error('Error no existe columna en remoto', $column_local['Field']);
            (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
        }
        if(!$tipo_dato_en_remoto_valido){
            $error = (new errores())->error('Error no coincide tipo de dato columna en remoto', $column_local['Field']);
            (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
        }
        if(!$null_en_remoto_valido){
            $error = (new errores())->error('Error no coincide null columna en remoto', $column_local['Field']);
            (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
        }
        if(!$key_en_remoto_valido){
            $error = (new errores())->error('Error no coincide key columna en remoto', $column_local['Field']);
            (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
        }
        if(!$default_en_remoto_valido){
            $error = (new errores())->error('Error no coincide default columna en remoto', $column_local['Field']);
            (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
        }
        if(!$extra_en_remoto_valido){
            $error = (new errores())->error('Error no coincide extra columna en remoto', $column_local['Field']);
            (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
        }
        
    }


}
$services->finaliza_servicio();