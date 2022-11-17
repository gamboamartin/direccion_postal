<?php
namespace gamboamartin\direccion_postal\models;

use base\orm\modelo;
use gamboamartin\errores\errores;

class _model_base extends modelo {
    protected function campos_base(array $data, int $id = -1): array
    {

        if((!isset($data['descripcion']) || !isset($data['codigo'])) && $id > 0){
            $registro_previo = $this->registro(registro_id: $id, columnas_en_bruto: true);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al obtener registro previo',data: $registro_previo);
            }
            if(!isset($data['descripcion'])){
                $data['descripcion'] = $registro_previo['descripcion'];
            }
            if(!isset($data['codigo'])){
                $data['codigo'] = $registro_previo['codigo'];
            }

        }

        $keys = array('descripcion','codigo');
        $valida = $this->validacion->valida_existencia_keys(keys:$keys,registro:  $data);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar data', data: $valida);
        }

        if(!isset($data['codigo_bis'])){
            $data['codigo_bis'] =  $data['codigo'];
        }

        $data = $this->data_base(data: $data);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al integrar data base', data: $data);
        }

        return $data;
    }

    protected function data_base(array $data): array
    {
        $keys = array('descripcion','codigo');
        $valida = $this->validacion->valida_existencia_keys(keys:$keys,registro:  $data);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar data', data: $valida);
        }

        if(!isset($data['descripcion_select'])){
            $ds = str_replace("_"," ",$data['descripcion']);
            $ds = ucwords($ds);
            $data['descripcion_select'] =  "{$data['codigo']} - {$ds}";
        }

        if(!isset($data['alias'])){
            $data['alias'] = $data['codigo'];
        }
        return $data;
    }

}