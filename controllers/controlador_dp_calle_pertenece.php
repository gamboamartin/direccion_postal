<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace controllers;

use gamboamartin\errores\errores;
use gamboamartin\system\links_menu;
use gamboamartin\system\system;
use gamboamartin\template_1\html;
use html\dp_calle_html;
use html\dp_calle_pertenece_html;
use html\dp_colonia_postal_html;
use models\dp_calle_pertenece;
use PDO;
use stdClass;

class controlador_dp_calle_pertenece extends system {

    public function __construct(PDO $link, stdClass $paths_conf = new stdClass()){
        $modelo = new dp_calle_pertenece(link: $link);
        $html_base = new html();
        $html = new dp_calle_pertenece_html(html: $html_base);
        $obj_link = new links_menu($this->registro_id);
        parent::__construct(html:$html, link: $link,modelo:  $modelo, obj_link: $obj_link, paths_conf: $paths_conf);

        $this->titulo_lista = 'Calles';

    }

    public function alta(bool $header, bool $ws = false): array|string
    {
        $r_alta =  parent::alta(header: false); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar template', data: $r_alta,header: false,ws: false);
        }

        $this->inputs->select = new stdClass();

        $select = (new dp_calle_html(html: $this->html_base))->select_dp_calle_id(cols:12,con_registros: true, id_selected:-1,link: $this->link);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar select', data: $select,header: false,ws: false);
        }

        $this->inputs->select->dp_calle_id = $select;

        $select = (new dp_colonia_postal_html(html: $this->html_base))->select_dp_colonia_postal_id(cols:12,con_registros: true, id_selected:-1,link: $this->link);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar select', data: $select,header: false,ws: false);
        }

        $in_georeferencia = (new dp_calle_pertenece_html(html: $this->html_base))->input(cols: 12,row_upd:  new stdClass(),value_vacio:  true, campo: "Georeferencia");

        if(errores::$error){
            $error = $this->errores->error(mensaje: 'Error al generar el input',data:  $in_georeferencia);
            print_r($error);
            die('Error');
        }

        $this->inputs->georeferencia = $in_georeferencia;
        $this->inputs->select->dp_colonia_postal_id = $select;

        return $r_alta;
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

    public function modifica(bool $header, bool $ws = false, string $breadcrumbs = '', bool $aplica_form = true,
                             bool $muestra_btn = true): array|string
    {
        $r_modifica = parent::modifica(header: false,breadcrumbs:  $breadcrumbs,aplica_form:  $aplica_form,
            muestra_btn: $muestra_btn); // TODO: Change the autogenerated stub

        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar template', data: $r_modifica,header: false,ws: false);
        }

        $this->inputs->select = new stdClass();

        $select = (new dp_calle_html(html: $this->html_base))->select_dp_calle_id(cols:12,con_registros: true, id_selected:$this->row_upd->dp_calle_id,
            link: $this->link);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar select', data: $select,header: false,ws: false);
        }
        $this->inputs->select->dp_calle_id = $select;

        $select = (new dp_colonia_postal_html(html: $this->html_base))->select_dp_colonia_postal_id(cols:12,con_registros: true,
            id_selected:$this->row_upd->dp_colonia_postal_id,
            link: $this->link);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar select', data: $select,header: false,ws: false);
        }
        $this->inputs->select->dp_colonia_postal_id = $select;

        return $r_modifica;

    }


}
