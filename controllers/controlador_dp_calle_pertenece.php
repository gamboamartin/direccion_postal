<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace controllers;

use gamboamartin\direccion_postal\models\dp_calle_pertenece;
use gamboamartin\errores\errores;
use gamboamartin\system\links_menu;
use gamboamartin\system\system;
use gamboamartin\template_1\html;
use html\dp_calle_html;
use html\dp_calle_pertenece_html;
use html\dp_colonia_postal_html;
use PDO;
use stdClass;

class controlador_dp_calle_pertenece extends system {

    public array $keys_selects = array();

    public function __construct(PDO $link, stdClass $paths_conf = new stdClass()){
        $modelo = new dp_calle_pertenece(link: $link);
        $html_base = new html();
        $html = new dp_calle_pertenece_html(html: $html_base);
        $obj_link = new links_menu(link: $link, registro_id: $this->registro_id);

        $columns["dp_calle_pertenece_id"]["titulo"] = "Id";
        $columns["dp_calle_pertenece_codigo"]["titulo"] = "Codigo";
        $columns["dp_pais_descripcion"]["titulo"] = "Pais";
        $columns["dp_estado_descripcion"]["titulo"] = "Estado";
        $columns["dp_municipio_descripcion"]["titulo"] = "Municipio";
        $columns["dp_cp_descripcion"]["titulo"] = "CP";
        $columns["dp_colonia_postal_descripcion"]["titulo"] = "Colonia Postal";
        $columns["dp_calle_descripcion"]["titulo"] = "Calle";
        $columns["dp_calle_pertenece_descripcion"]["titulo"] = "Calle Pertenece";

        $filtro = array("dp_calle_pertenece.id","dp_calle_pertenece.codigo","dp_calle_pertenece.descripcion",
            "dp_pais.descripcion", "dp_estado.descripcion","dp_municipio.descripcion","dp_cp.descripcion",
            "dp_dp_colonia_postal.descripcion","dp_calle.descripcion");

        $datatables = new stdClass();
        $datatables->columns = $columns;
        $datatables->filtro = $filtro;

        parent::__construct(html:$html, link: $link,modelo:  $modelo, obj_link: $obj_link, datatables: $datatables,
            paths_conf: $paths_conf);

        $this->titulo_lista = 'Calles';

        $propiedades = $this->inicializa_priedades();
        if(errores::$error){
            $error = $this->errores->error(mensaje: 'Error al inicializar propiedades',data:  $propiedades);
            print_r($error);
            die('Error');
        }
    }

    public function alta(bool $header, bool $ws = false): array|string
    {
        $r_alta =  parent::alta(header: false, ws: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar template',data:  $r_alta, header: $header,ws:$ws);
        }

        $inputs = $this->genera_inputs(keys_selects:  $this->keys_selects);
        if(errores::$error){
            $error = $this->errores->error(mensaje: 'Error al generar inputs',data:  $inputs);
            print_r($error);
            die('Error');
        }

        return $r_alta;
    }

    public function asignar_propiedad(string $identificador, mixed $propiedades)
    {
        if (!array_key_exists($identificador,$this->keys_selects)){
            $this->keys_selects[$identificador] = new stdClass();
        }

        foreach ($propiedades as $key => $value){
            $this->keys_selects[$identificador]->$key = $value;
        }
    }

    private function base(): array|stdClass
    {
        $r_modifica =  parent::modifica(header: false,aplica_form:  false);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al generar template',data:  $r_modifica);
        }

        $this->asignar_propiedad(identificador:'dp_calle_id', propiedades:
            ["id_selected" => $this->row_upd->dp_calle_id]);
        $this->asignar_propiedad(identificador:'dp_colonia_postal_id', propiedades:
            ["id_selected" => $this->row_upd->dp_colonia_postal_id]);

        $inputs = $this->genera_inputs(keys_selects:  $this->keys_selects);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al inicializar inputs',data:  $inputs);
        }

        $data = new stdClass();
        $data->template = $r_modifica;
        $data->inputs = $inputs;

        return $data;
    }

    public function get_calle_pertenece(bool $header, bool $ws = true): array|stdClass
    {

        $keys['dp_calle'] = array('id','descripcion','codigo','codigo_bis');
        $keys['dp_colonia'] = array('id','descripcion','codigo','codigo_bis');
        $keys['dp_cp'] = array('id','descripcion','codigo','codigo_bis');
        $keys['dp_municipio'] = array('id','descripcion','codigo','codigo_bis');
        $keys['dp_estado'] = array('id','descripcion','codigo','codigo_bis');
        $keys['dp_pais'] = array('id','descripcion','codigo','codigo_bis');
        $keys['dp_colonia_postal'] = array('id','descripcion','codigo','codigo_bis');

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
        $propiedades = array("label" => "Estado");
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "dp_municipio_id";
        $propiedades = array("label" => "Municipio");
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "dp_cp_id";
        $propiedades = array("label" => "CP");
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "dp_colonia_postal_id";
        $propiedades = array("label" => "Colonia Postal");
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "dp_calle_id";
        $propiedades = array("label" => "Calle");
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "georeferencia";
        $propiedades = array("place_holder" => "Georeferencia", "cols" => 12);
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        return $this->keys_selects;
    }

    public function modifica(bool $header, bool $ws = false, string $breadcrumbs = '', bool $aplica_form = true,
                             bool $muestra_btn = true): array|string
    {
        $base = $this->base();
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al maquetar datos',data:  $base,
                header: $header,ws:$ws);
        }

        return $base->template;
    }
}
