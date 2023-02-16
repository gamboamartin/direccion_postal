<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace controllers;

use gamboamartin\direccion_postal\models\dp_cp;
use gamboamartin\direccion_postal\models\dp_municipio;
use gamboamartin\errores\errores;
use gamboamartin\system\links_menu;
use gamboamartin\template_1\html;
use html\dp_cp_html;
use PDO;
use stdClass;


class controlador_dp_cp extends _ctl_dps {

    public array|stdClass $keys_selects = array();

    public function __construct(PDO $link, stdClass $paths_conf = new stdClass()){
        $modelo = new dp_cp(link: $link);
        $html_base = new html();
        $html = new dp_cp_html(html: $html_base);
        $obj_link = new links_menu(link: $link,registro_id:  $this->registro_id);

        $columns["dp_cp_id"]["titulo"] = "Id";
        $columns["dp_cp_codigo"]["titulo"] = "Código";
        $columns["dp_pais_descripcion"]["titulo"] = "País";
        $columns["dp_estado_descripcion"]["titulo"] = "Estado";
        $columns["dp_municipio_descripcion"]["titulo"] = "Municipio";
        $columns["dp_cp_descripcion"]["titulo"] = "Código Postal";
        $columns["dp_cp_georeferencia"]["titulo"] = "Georeferencia";

        $filtro = array("dp_cp.id","dp_cp.codigo","dp_cp.descripcion","dp_pais.descripcion",
            "dp_estado.descripcion","dp_municipio.descripcion","dp_cp.georeferencia");

        $datatables = new stdClass();
        $datatables->columns = $columns;
        $datatables->filtro = $filtro;

        parent::__construct(html:$html, link: $link,modelo:  $modelo, obj_link: $obj_link, datatables: $datatables,
            paths_conf: $paths_conf);

        $this->titulo_lista = 'Códigos Postales';

        $propiedades = $this->inicializa_priedades();
        if(errores::$error){
            $error = $this->errores->error(mensaje: 'Error al inicializar propiedades',data:  $propiedades);
            print_r($error);
            die('Error');
        }

        $this->parents_verifica[] = (new dp_municipio(link: $this->link));
        $this->verifica_parents_alta = true;
    }


    /**
     * Función que obtiene los campos de dp_pais, dp_estado, dp_municipio y dp_cp por medio de
     * un arreglo $keys con los nombres de sus respectivos campos.
     * La variable $salida llama a la función get_out con los parámetros $header, $keys y $ws.
     * En caso de presentarse un error, un if se encarga de capturarlo y mostrar la información correspondiente.
     * Finalmente se retorna la variable $salida.
     * @param bool $header
     * @param bool $ws
     * @return array|stdClass
     */
    public function get_cp(bool $header, bool $ws = true): array|stdClass
    {

        $keys['dp_pais'] = array('id','descripcion','codigo','codigo_bis');
        $keys['dp_estado'] = array('id','descripcion','codigo','codigo_bis');
        $keys['dp_municipio'] = array('id','descripcion','codigo','codigo_bis');
        $keys['dp_cp'] = array('id','descripcion','codigo','codigo_bis');

        $salida = $this->get_out(header: $header,keys: $keys, ws: $ws);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar salida',data:  $salida,header: $header,ws: $ws);

        }
        return $salida;
    }

    private function inicializa_priedades(): array
    {
        $identificador = "dp_pais_id";
        $propiedades = array("label" => "Pais");
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "dp_estado_id";
        $propiedades = array("label" => "Estado", "con_registros" => false);
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "dp_municipio_id";
        $propiedades = array("label" => "Municipio", "con_registros" => false);
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "codigo";
        $propiedades = array("place_holder" => "Código");
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "descripcion";
        $propiedades = array("place_holder" => "Código Postal", "cols" => 12);
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "georeferencia";
        $propiedades = array("place_holder" => "Georeferencia", "cols" => 12);
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        return $this->keys_selects;
    }

    public function modifica(bool $header, bool $ws = false): array|stdClass
    {
        $r_modifica =  parent::modifica(header: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar template',data:  $r_modifica, header: $header,ws:$ws);
        }

        $municipio = (new dp_municipio($this->link))->get_municipio($this->row_upd->dp_municipio_id);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al obtener municipio',data:  $municipio);
        }

        $identificador = "dp_pais_id";
        $propiedades = array("id_selected" => $municipio['dp_pais_id']);
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "dp_estado_id";
        $propiedades = array("id_selected" => $municipio['dp_estado_id'], "con_registros" => true,
            "filtro" => array('dp_pais.id' => $municipio['dp_pais_id']));
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "dp_municipio_id";
        $propiedades = array("id_selected" => $this->row_upd->dp_municipio_id, "con_registros" => true,
            "filtro" => array('dp_estado.id' => $municipio['dp_estado_id']));
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $inputs = $this->genera_inputs(keys_selects:  $this->keys_selects);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al inicializar inputs',data:  $inputs);
        }

        return $r_modifica;
    }
}
