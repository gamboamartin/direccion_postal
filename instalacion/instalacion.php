<?php
namespace gamboamartin\direccion_postal\instalacion;

use gamboamartin\administrador\models\_instalacion;
use gamboamartin\direccion_postal\models\dp_estado;
use gamboamartin\direccion_postal\models\dp_pais;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class instalacion
{


    private function _add_dp_estado(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'dp_estado');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['dp_pais_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'dp_pais');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        /*$campos = new stdClass();
        $campos->fecha = new stdClass();
        $campos->fecha->tipo_dato = 'DATE';
        $campos->fecha->default = '1900-01-01';

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_cer_csd');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;*/



        return $out;

    }

    private function _add_dp_municipio(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'dp_municipio');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['dp_estado_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'dp_municipio');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        /*$campos = new stdClass();
        $campos->fecha = new stdClass();
        $campos->fecha->tipo_dato = 'DATE';
        $campos->fecha->default = '1900-01-01';

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_cer_csd');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;*/



        return $out;

    }


    private function _add_dp_pais(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'dp_pais');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        
        return $out;

    }

    private function dp_estado(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = $this->_add_dp_estado(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        $dp_estados_ins = array();
        $dp_estado_ins['id'] = '14';
        $dp_estado_ins['codigo'] = 'JAL';
        $dp_estado_ins['descripcion_select'] = 'JAL Jalisco';
        $dp_estado_ins['descripcion'] = 'Jalisco';
        $dp_estado_ins['dp_pais_id'] = '151';

        $dp_estados_ins[0] = $dp_estado_ins;
        foreach ($dp_estados_ins as $dp_estado_ins){
            $alta = (new dp_estado(link: $link))->inserta_registro_si_no_existe(registro: $dp_estado_ins);
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al insertar',data:  $alta);
            }
            $out->altas[] = $alta;

        }

        return $out;

    }

    private function dp_municipio(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = $this->_add_dp_municipio(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        $dp_estados_ins = array();
        $dp_estado_ins['id'] = '230';
        $dp_estado_ins['codigo'] = 'JAL008';
        $dp_estado_ins['descripcion_select'] = 'JAL008 Arandas';
        $dp_estado_ins['descripcion'] = 'Arandas';
        $dp_estado_ins['dp_estado_id'] = '14';

        $dp_estados_ins[0] = $dp_estado_ins;
        foreach ($dp_estados_ins as $dp_estado_ins){
            $alta = (new dp_estado(link: $link))->inserta_registro_si_no_existe(registro: $dp_estado_ins);
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al insertar',data:  $alta);
            }
            $out->altas[] = $alta;

        }

        return $out;

    }



    private function dp_pais(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = $this->_add_dp_pais(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        $dp_paises_ins = array();
        $dp_pais_ins['id'] = '151';
        $dp_pais_ins['codigo'] = 'MEX';
        $dp_pais_ins['descripcion_select'] = 'MEX Mexico';
        $dp_pais_ins['descripcion'] = 'Mexico';

        $dp_paises_ins[0] = $dp_pais_ins;
        foreach ($dp_paises_ins as $dp_pais_ins){
            $alta = (new dp_pais(link: $link))->inserta_registro_si_no_existe(registro: $dp_pais_ins);
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al insertar',data:  $alta);
            }
            $out->altas[] = $alta;

        }

        return $out;

    }


    final public function instala(PDO $link): array|stdClass
    {

        $result = new stdClass();


        $dp_pais = $this->dp_pais(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar dp_pais', data:  $dp_pais);
        }
        $result->dp_pais = $dp_pais;

        $dp_estado = $this->dp_estado(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar dp_estado', data:  $dp_estado);
        }
        $result->dp_estado = $dp_estado;

        $dp_municipio = $this->dp_municipio(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar dp_municipio', data:  $dp_municipio);
        }
        $result->dp_municipio = $dp_municipio;


        return $result;

    }

}
