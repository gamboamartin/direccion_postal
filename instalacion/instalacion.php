<?php
namespace gamboamartin\direccion_postal\instalacion;

use gamboamartin\administrador\models\_instalacion;
use gamboamartin\direccion_postal\models\dp_colonia;
use gamboamartin\direccion_postal\models\dp_colonia_postal;
use gamboamartin\direccion_postal\models\dp_cp;
use gamboamartin\direccion_postal\models\dp_estado;
use gamboamartin\direccion_postal\models\dp_municipio;
use gamboamartin\direccion_postal\models\dp_pais;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class instalacion
{

    private function _add_dp_colonia(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'dp_colonia');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;

        $campos = new stdClass();
        $campos->georeferencia = new stdClass();

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'dp_colonia');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;


        return $out;

    }

    private function _add_dp_colonia_postal(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'dp_colonia_postal');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;

        $foraneas = array();
        $foraneas['dp_cp_id'] = new stdClass();
        $foraneas['dp_colonia_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'dp_colonia_postal');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;



        return $out;

    }

    private function _add_dp_cp(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'dp_cp');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['dp_municipio_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'dp_cp');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        $campos = new stdClass();
        $campos->georeferencia = new stdClass();

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'dp_cp');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;



        return $out;

    }

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

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'dp_estado');

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

    /**
     * POR DOCUMENTAR EN WIKI
     * Este método maneja la creación de la tabla 'dp_pais' en el proceso de instalación.
     *
     * @param PDO $link Conexión de base de datos mediante el objeto PDO.
     *
     * @return array|stdClass
     * Retorna un objeto con el resultado de la creación de la tabla. En caso de error, Retorna un objeto de error.
     *
     * @throws errores En el caso de que ocurran errores en el proceso de creación de la tabla, se lanza una excepción.
     * @version 20.3.0
     */

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

    private function dp_colonia(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = $this->_add_dp_colonia(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        $dp_colonias_ins = array();
        $dp_colonia_ins['id'] = '49728';
        $dp_colonia_ins['codigo'] = '49728';
        $dp_colonia_ins['descripcion_select'] = 'Residencial Revolución';
        $dp_colonia_ins['descripcion'] = 'Residencial Revolución';
        $dp_colonia_ins['georeferencia'] = 'SG';

        $dp_colonias_ins[0] = $dp_colonia_ins;
        foreach ($dp_colonias_ins as $dp_colonia_ins){
            $alta = (new dp_colonia(link: $link))->inserta_registro_si_no_existe(registro: $dp_colonia_ins);
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al insertar',data:  $alta);
            }
            $out->altas[] = $alta;

        }

        return $out;

    }

    private function dp_colonia_postal(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = $this->_add_dp_colonia_postal(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        $dp_colonias_postales_ins = array();
        $dp_colonia_postal_ins['id'] = '23';
        $dp_colonia_postal_ins['codigo'] = '45580 Residencial Revolución';
        $dp_colonia_postal_ins['descripcion_select'] = '45580 Residencial Revolución Residencial Revolución - 45580';
        $dp_colonia_postal_ins['descripcion'] = 'Residencial Revolución - 45580';
        $dp_colonia_postal_ins['dp_cp_id'] = '2';
        $dp_colonia_postal_ins['dp_colonia_id'] = '49728';

        $dp_colonias_postales_ins[0] = $dp_colonia_postal_ins;
        foreach ($dp_colonias_postales_ins as $dp_colonia_postal_ins){
            $alta = (new dp_colonia_postal(link: $link))->inserta_registro_si_no_existe(registro: $dp_colonia_postal_ins);
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al insertar',data:  $alta);
            }
            $out->altas[] = $alta;

        }

        return $out;

    }

    private function dp_cp(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = $this->_add_dp_cp(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        $dp_cps_ins = array();
        $dp_cp_ins['id'] = '1';
        $dp_cp_ins['codigo'] = '45010';
        $dp_cp_ins['descripcion_select'] = '45010 45010';
        $dp_cp_ins['descripcion'] = '45010';
        $dp_cp_ins['dp_municipio_id'] = '1805';
        $dp_cp_ins['georeferencia'] = 'SG';
        $dp_cps_ins[0] = $dp_cp_ins;


        $dp_cp_ins['id'] = '2';
        $dp_cp_ins['codigo'] = '45580';
        $dp_cp_ins['descripcion_select'] = '45580 45580';
        $dp_cp_ins['descripcion'] = '45580';
        $dp_cp_ins['dp_municipio_id'] = '1649';
        $dp_cp_ins['georeferencia'] = 'SG';

        $dp_cps_ins[1] = $dp_cp_ins;

        foreach ($dp_cps_ins as $dp_cp_ins){
            $alta = (new dp_cp(link: $link))->inserta_registro_si_no_existe(registro: $dp_cp_ins);
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al insertar',data:  $alta);
            }
            $out->altas[] = $alta;

        }

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

        $dp_municipios_ins = array();

        $dp_municipio_ins['id'] = '230';
        $dp_municipio_ins['codigo'] = 'JAL008';
        $dp_municipio_ins['descripcion_select'] = 'JAL008 Arandas';
        $dp_municipio_ins['descripcion'] = 'Arandas';
        $dp_municipio_ins['dp_estado_id'] = '14';
        $dp_municipios_ins[0] = $dp_municipio_ins;


        $dp_municipio_ins['id'] = '1805';
        $dp_municipio_ins['codigo'] = 'JAL120';
        $dp_municipio_ins['descripcion_select'] = 'JAL120 Zapopan';
        $dp_municipio_ins['descripcion'] = 'Zapopan';
        $dp_municipio_ins['dp_estado_id'] = '14';
        $dp_municipios_ins[1] = $dp_municipio_ins;

        $dp_municipio_ins['id'] = '1649';
        $dp_municipio_ins['codigo'] = 'JAL098';
        $dp_municipio_ins['descripcion_select'] = 'JAL098 San Pedro Tlaquepaque';
        $dp_municipio_ins['descripcion'] = 'San Pedro Tlaquepaque';
        $dp_municipio_ins['dp_estado_id'] = '14';
        $dp_municipios_ins[2] = $dp_municipio_ins;


        foreach ($dp_municipios_ins as $dp_municipio_ins){
            $alta = (new dp_municipio(link: $link))->inserta_registro_si_no_existe(registro: $dp_municipio_ins);
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

        $dp_colonia = $this->dp_colonia(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar dp_colonia', data:  $dp_colonia);
        }
        $result->dp_colonia = $dp_colonia;

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

        $dp_cp = $this->dp_cp(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar dp_cp', data:  $dp_cp);
        }
        $result->dp_cp = $dp_cp;

        $dp_colonia_postal = $this->dp_colonia_postal(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar dp_colonia_postal', data:  $dp_colonia_postal);
        }
        $result->dp_colonia_postal = $dp_colonia_postal;


        return $result;

    }

}
