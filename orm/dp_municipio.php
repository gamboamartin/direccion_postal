<?php
namespace models;
use base\orm\modelo;
use PDO;

class dp_municipio extends modelo{
    public function __construct(PDO $link){
        $tabla = __CLASS__;
        $columnas = array($tabla=>false,'dp_estado'=>$tabla,'dp_pais'=>'dp_estado');
        $campos_obligatorios[] = 'descripcion';
        $campos_obligatorios[] = 'dp_estado_id';

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas);
    }
}