<?php
namespace models;
use base\orm\modelo;
use PDO;

class dp_calle_pertenece extends modelo{
    public function __construct(PDO $link){
        $tabla = __CLASS__;
        $columnas = array($tabla=>false,'dp_colonia_postal'=>$tabla,'dp_calle'=>$tabla,'dp_cp'=>'dp_colonia_postal',
            'dp_colonia'=>'dp_colonia_postal','dp_municipio'=>'dp_cp','dp_estado'=>'dp_municipio','dp_pais'=>'dp_estado');
        $campos_obligatorios[] = 'descripcion';

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas);
    }
}