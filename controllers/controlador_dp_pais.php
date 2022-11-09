<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace controllers;

use gamboamartin\direccion_postal\models\dp_pais;
use gamboamartin\system\links_menu;
use gamboamartin\system\system;
use gamboamartin\template_1\html;
use html\dp_pais_html;
use PDO;
use stdClass;

class controlador_dp_pais extends system {

    public function __construct(PDO $link, stdClass $paths_conf = new stdClass()){
        $modelo = new dp_pais(link: $link);
        $html_base = new html();
        $html = new dp_pais_html(html: $html_base);
        $obj_link = new links_menu(link: $link,registro_id:  $this->registro_id);

        $columns["dp_pais_id"]["titulo"] = "Id";
        $columns["dp_pais_codigo"]["titulo"] = "Código";
        $columns["dp_pais_descripcion"]["titulo"] = "Pais";

        $filtro = array("dp_pais.id","dp_pais.codigo","dp_pais.descripcion");

        $datatables = new stdClass();
        $datatables->columns = $columns;
        $datatables->filtro = $filtro;

        parent::__construct(html:$html, link: $link,modelo:  $modelo, obj_link: $obj_link, datatables: $datatables,
            paths_conf: $paths_conf);

        $this->titulo_lista = 'Paises';
    }

}
