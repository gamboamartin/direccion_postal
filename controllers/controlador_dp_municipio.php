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
use html\dp_estado_html;
use html\dp_municipio_html;
use html\dp_pais_html;

use models\dp_municipio;
use PDO;
use stdClass;

class controlador_dp_municipio extends system {

    public function __construct(PDO $link, stdClass $paths_conf = new stdClass()){
        $modelo = new dp_municipio(link: $link);
        $html = new dp_municipio_html();
        $obj_link = new links_menu($this->registro_id);
        parent::__construct(html:$html, link: $link,modelo:  $modelo, obj_link: $obj_link, paths_conf: $paths_conf);
        
        $this->titulo_lista = 'Municipio';

    }
    public function alta(bool $header, bool $ws = false): array|string
    {
        $r_alta =  parent::alta(header: false, ws: false); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar template',data:  $r_alta, header: $header,ws:$ws);
        }


        $select = (new dp_estado_html())->select_dp_estado_id(id_selected:-1,link: $this->link);
        if(errores::$error){
            $error = $this->errores->error(mensaje: 'Error al generar select',data:  $select);
            print_r($error);
            die('Error');
        }

        $this->inputs->select = new stdClass();
        $this->inputs->select->dp_estado_id = $select;

        return $r_alta;

    }


}
