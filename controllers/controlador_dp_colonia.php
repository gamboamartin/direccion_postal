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
use html\dp_pais_html;
use models\dp_colonia;
use PDO;
use stdClass;

class controlador_dp_colonia extends system {

    public function __construct(PDO $link, stdClass $paths_conf = new stdClass()){
        $modelo = new dp_colonia(link: $link);
        $html = new dp_colonia_html();
        $obj_link = new links_menu($this->registro_id);
        parent::__construct(html:$html, link: $link,modelo:  $modelo, obj_link: $obj_link, paths_conf: $paths_conf);

        $this->titulo_lista = 'Colonias';

    }




}