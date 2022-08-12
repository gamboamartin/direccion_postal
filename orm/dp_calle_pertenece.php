<?php
namespace models;
use base\orm\modelo;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class dp_calle_pertenece extends modelo{
    public function __construct(PDO $link){
        $tabla = __CLASS__;
        $columnas = array($tabla=>false,'dp_colonia_postal'=>$tabla,'dp_calle'=>$tabla,'dp_cp'=>'dp_colonia_postal',
            'dp_colonia'=>'dp_colonia_postal','dp_municipio'=>'dp_cp','dp_estado'=>'dp_municipio','dp_pais'=>'dp_estado');
        $campos_obligatorios[] = 'descripcion';

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas);
    }

    public function objs_direcciones(int $dp_calle_pertenece_id): stdClass
    {
        $dp_calle_pertenece = $this->registro(
            registro_id: $dp_calle_pertenece_id, columnas_en_bruto: true,retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener calle pertenece',data:  $dp_calle_pertenece);
        }

        $dp_calle = (new dp_calle($this->link))->registro(
            registro_id: $dp_calle_pertenece->dp_calle_id, columnas_en_bruto: true,retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener $dp_calle',data:  $dp_calle);
        }

        $dp_colonia_postal = (new dp_colonia_postal($this->link))->registro(
            registro_id: $dp_calle_pertenece->dp_colonia_postal_id, columnas_en_bruto: true,retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener $dp_colonia_postal',data:  $dp_colonia_postal);
        }

        $dp_colonia = (new dp_colonia($this->link))->registro(
            registro_id: $dp_colonia_postal->dp_colonia_id, columnas_en_bruto: true,retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener $dp_colonia',data:  $dp_colonia);
        }

        $dp_cp = (new dp_cp($this->link))->registro(
            registro_id: $dp_colonia_postal->dp_cp_id, columnas_en_bruto: true,retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener $dp_cp',data:  $dp_cp);
        }

        $dp_municipio = (new dp_municipio($this->link))->registro(
            registro_id: $dp_cp->dp_municipio_id, columnas_en_bruto: true,retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener $dp_municipio',data:  $dp_municipio);
        }

        $dp_estado = (new dp_estado($this->link))->registro(registro_id: $dp_municipio->dp_estado_id,
            columnas_en_bruto: true,retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener estado',data:  $dp_estado);
        }
        $dp_pais = (new dp_pais($this->link))->registro(registro_id: $dp_estado->dp_pais_id,
            columnas_en_bruto: true,retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener estado',data:  $dp_pais);
        }

        $data = new stdClass();

        $data->pais = $dp_pais;
        $data->estado = $dp_estado;
        $data->municipio = $dp_municipio;
        $data->cp = $dp_cp;
        $data->colonia = $dp_colonia;
        $data->colonia_postal = $dp_colonia_postal;
        $data->calle = $dp_calle;
        $data->calle_pertenece = $dp_calle_pertenece;

        return $data;


    }
}