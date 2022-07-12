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
use html\dp_colonia_html;
use html\dp_colonia_postal_html;
use html\dp_cp_html;
use models\dp_colonia_postal;
use PDO;
use stdClass;

class controlador_dp_colonia_postal extends system {

    public function __construct(PDO $link, stdClass $paths_conf = new stdClass()){
        $modelo = new dp_colonia_postal(link: $link);
        $html = new dp_colonia_postal_html();
        $obj_link = new links_menu($this->registro_id);
        parent::__construct(html:$html, link: $link,modelo:  $modelo, obj_link: $obj_link, paths_conf: $paths_conf);

        $this->titulo_lista = 'Colonias Postales';

    }

    public function alta(bool $header, bool $ws = false): array|string
    {
        $r_alta =  parent::alta(header: false); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar template', data: $r_alta,header: false,ws: false);
        }

        $this->inputs->select = new stdClass();

        $select = (new dp_cp_html())->select_dp_cp_id(cols:12,con_registros: true, id_selected:-1,link: $this->link);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar select', data: $select,header: false,ws: false);
        }

        $this->inputs->select->dp_cp_id = $select;

        $select = (new dp_colonia_html())->select_dp_colonia_id(cols:12,con_registros: true, id_selected:-1,link: $this->link);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar select', data: $select,header: false,ws: false);
        }

        $this->inputs->select->dp_colonia_id = $select;

        return $r_alta;
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

        $select = (new dp_cp_html())->select_dp_cp_id(cols:12,con_registros: true, id_selected:$this->row_upd->dp_cp_id,
            link: $this->link);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar select', data: $select,header: false,ws: false);
        }
        $this->inputs->select->dp_cp_id = $select;

        $select = (new dp_colonia_html())->select_dp_colonia_id(cols:12,con_registros: true, id_selected:$this->row_upd->dp_colonia_id,
            link: $this->link);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar select', data: $select,header: false,ws: false);
        }
        $this->inputs->select->dp_colonia_id = $select;

        return $r_modifica;

    }


}
