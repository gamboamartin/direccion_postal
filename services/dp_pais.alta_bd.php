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


        $val =$services->init_val_tabla();
        if(errores::$error){
            $error = (new errores())->error('Error inicializar datos', $val);
            (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
        }


        foreach ($data_remoto->columnas as $column_remoto){
            if($column_remoto['Field'] === $column_local['Field']){
                $val->existe = true;
                if($column_remoto['Type'] === $column_local['Type']){
                    $val->tipo_dato = true;
                }
                if($column_remoto['Null'] === $column_local['Null']){
                    $val->null = true;
                }
                if($column_remoto['Key'] === $column_local['Key']){
                    $val->key = true;
                }
                if($column_remoto['Default'] === $column_local['Default']){
                    $val->default = true;
                }
                if($column_remoto['Extra'] === $column_local['Extra']){
                    $val->extra = true;
                }
                break;
            }

        }
        if(!$val->existe){
            $error = (new errores())->error('Error no existe columna en remoto', $column_local['Field']);
            (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
        }
        if(!$val->tipo_dato){
            $error = (new errores())->error('Error no coincide tipo de dato columna en remoto', $column_local['Field']);
            (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
        }
        if(!$val->null){
            $error = (new errores())->error('Error no coincide null columna en remoto', $column_local['Field']);
            (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
        }
        if(!$val->key){
            $error = (new errores())->error('Error no coincide key columna en remoto', $column_local['Field']);
            (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
        }
        if(!$val->default){
            $error = (new errores())->error('Error no coincide default columna en remoto', $column_local['Field']);
            (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
        }
        if(!$val->extra){
            $error = (new errores())->error('Error no coincide extra columna en remoto', $column_local['Field']);
            (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
        }

    }


}
$services->finaliza_servicio();