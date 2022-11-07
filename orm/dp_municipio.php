<?php
namespace gamboamartin\direccion_postal\models;
use base\orm\modelo;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class dp_municipio extends modelo{
    public function __construct(PDO $link){
        $tabla = 'dp_municipio';
        $columnas = array($tabla=>false,'dp_estado'=>$tabla,'dp_pais'=>'dp_estado');
        $campos_obligatorios[] = 'descripcion';
        $campos_obligatorios[] = 'descripcion_select';
        $campos_obligatorios[] = 'dp_estado_id';

        $campos_view['dp_pais_id'] = array('type' => 'selects', 'model' => new dp_pais($link));
        $campos_view['dp_estado_id'] = array('type' => 'selects', 'model' => new dp_estado($link));

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas,campos_view: $campos_view);

        $this->NAMESPACE = __NAMESPACE__;
    }

    public function alta_bd(): array|stdClass
    {
        if(!isset($this->registro['dp_estado_id'])){
            $dp_estado_id = (new dp_estado($this->link))->id_predeterminado();
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al obtener estado predeterminado',data:  $dp_estado_id);

            }
            $this->registro['dp_estado_id'] = $dp_estado_id;

        }

        if(!isset($this->registro['descripcion_select'])){
            $descripcion_select = $this->registro['codigo'].' '.$this->registro['descripcion'];

            $this->registro['descripcion_select'] = $descripcion_select;

        }

        $r_alta_bd = parent::alta_bd(); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al  insertar municipio',data:  $r_alta_bd);

        }

        return $r_alta_bd;

    }
}