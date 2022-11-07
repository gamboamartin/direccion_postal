<?php
namespace gamboamartin\direccion_postal\models;
use base\orm\modelo;
use PDO;

class dp_calle extends modelo{
    public function __construct(PDO $link){
        $tabla = 'dp_calle';
        $columnas = array($tabla=>false);
        $campos_obligatorios[] = 'descripcion';

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas);

        $this->NAMESPACE = __NAMESPACE__;
    }
}