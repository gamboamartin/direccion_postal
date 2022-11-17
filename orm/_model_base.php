<?php
namespace gamboamartin\direccion_postal\models;

use base\orm\modelo;
use gamboamartin\errores\errores;

class _model_base extends modelo {

    private function asigna_data_no_existe(array $data, string $key, array $registro_previo): array
    {
        if(!isset($data[$key])){
            $data[$key] = $registro_previo[$key];
        }
        return $data;
    }

    private function asigna_data_row_previo(array $data, int $id): array
    {
        $registro_previo = $this->registro(registro_id: $id, columnas_en_bruto: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener registro previo',data: $registro_previo);
        }
        $data = $this->asigna_datas_base(data: $data,registro_previo:  $registro_previo);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al asigna data',data: $data);
        }

        return $data;
    }

    private function asigna_datas_base(array $data, array $registro_previo): array
    {
        $keys = array('descripcion','codigo');

        $data = $this->asigna_datas_no_existe(data: $data,keys:  $keys,registro_previo:  $registro_previo);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al asigna data',data: $data);
        }
        return $data;
    }

    private function asigna_datas_no_existe(array $data, array $keys, array $registro_previo): array
    {
        foreach ($keys as $key){
            $data = $this->asigna_data_no_existe(data: $data,key:  $key,registro_previo:  $registro_previo);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al asigna data',data: $data);
            }
        }
        return $data;
    }

    protected function campos_base(array $data, int $id = -1): array
    {

        $data = $this->init_data_base(data: $data,id: $id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener registro previo',data: $data);
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

    private function init_data_base(array $data, int $id): array
    {
        if((!isset($data['descripcion']) || !isset($data['codigo'])) && $id > 0){
            $data = $this->asigna_data_row_previo(data:$data,id :$id);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al obtener registro previo',data: $data);
            }
        }
        return $data;
    }

}