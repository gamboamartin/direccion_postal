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

$link_local = $services->conecta_pdo(conf_database: $db);


$modelo_local = new dp_pais(link: $link_local);

$columnas_local = (new columnas())->columnas_bd_native(modelo:$modelo_local, tabla_bd: 'dp_pais');
if(errores::$error){
    $error = (new errores())->error('Error al obtener columnas local', $columnas_local);
    (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
}
var_dump($columnas_local);

$n_columnas_local = count($columnas_local);


foreach ($db->servers_in_data as $database){

    $link_remoto = $services->conecta_pdo(conf_database: $database);
    if(errores::$error){
        $error = (new errores())->error('Error al conectar con remoto', $link_remoto);
        (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
    }

    var_dump($link_remoto);


    $existe_tabla = (new validaciones())->existe_tabla(link:  $link_remoto, name_bd: $database->db_name,tabla: $tabla);
    if(!$existe_tabla){
        $error = (new errores())->error('Error no existe la tabla', $tabla);
        (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
    }
    var_dump($existe_tabla);
    $modelo_remoto = new dp_pais(link: $link_remoto);

    $columnas_remoto = (new columnas())->columnas_bd_native(modelo:$modelo_remoto, tabla_bd: 'dp_pais');
    if(errores::$error){
        $error = (new errores())->error('Error al obtener columnas remotas', $columnas_remoto);
        (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);
    }
    var_dump($columnas_remoto);
    $n_columnas_remoto = count($columnas_remoto);

    if($n_columnas_remoto > $n_columnas_local){
        $error = (new errores())->error('Error las columnas remotas son mayores a las columnas locales',
            array('remoto'=>$columnas_remoto,'local'=>$columnas_local));
        (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);

    }
    if($n_columnas_remoto < $n_columnas_local){
        $error = (new errores())->error('Error las columnas remotas son menores a las columnas locales',
            array('remoto'=>$columnas_remoto,'local'=>$columnas_local));
        (new error_write())->out(error: $error,info:  $info,path_info:  $services->name_files->path_info);

    }


}
$services->finaliza_servicio();