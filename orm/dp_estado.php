<?php
namespace gamboamartin\direccion_postal\models;
use base\orm\modelo;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class dp_estado extends modelo{
    public function __construct(PDO $link){
        $tabla = 'dp_estado';
        $columnas = array($tabla=>false,'dp_pais'=>$tabla);
        $campos_obligatorios[] = 'descripcion';
        $campos_obligatorios[] = 'descripcion_select';
        $campos_obligatorios[] = 'dp_pais_id';

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas);
    }

    public function alta_bd(): array|stdClass
    {
        if(!isset($this->registro['dp_pais_id'])){
            $dp_pais_id = (new dp_pais($this->link))->id_predeterminado();
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al obtener pais predeterminado',data:  $dp_pais_id);

            }
            $this->registro['dp_pais_id'] = $dp_pais_id;

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

    public function get_estado_default(): array|stdClass|int
    {
        $filtro["dp_estado.predeterminado"] = 'activo';
        $registro = $this->filtro_and(filtro: $filtro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener el estado predeterminado',data:  $registro);
        }

        return $registro;
    }

    public function get_estado_default_id(): array|stdClass|int
    {
        $id_predeterminado = $this->id_predeterminado();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener el estado predeterminado',data:  $id_predeterminado);
        }

        return (int)$id_predeterminado;
    }




}