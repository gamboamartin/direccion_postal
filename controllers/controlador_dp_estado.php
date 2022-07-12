<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace controllers;

use base\controller\salida_data;
use gamboamartin\errores\errores;
use gamboamartin\system\links_menu;
use gamboamartin\system\system;
use html\dp_estado_html;
use html\dp_pais_html;
use models\dp_estado;
use PDO;
use stdClass;
use Throwable;

class controlador_dp_estado extends system {

    public function __construct(PDO $link, stdClass $paths_conf = new stdClass()){
        $modelo = new dp_estado(link: $link);
        $html = new dp_estado_html();
        $obj_link = new links_menu($this->registro_id);
        parent::__construct(html:$html, link: $link,modelo:  $modelo, obj_link: $obj_link, paths_conf: $paths_conf);

        $this->titulo_lista = 'Estados';

    }

    public function alta(bool $header, bool $ws = false): array|string
    {
        $r_alta =  parent::alta(header: false, ws: false); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar template',data:  $r_alta, header: $header,ws:$ws);
        }


        $select = (new dp_pais_html())->select_dp_pais_id(id_selected:-1,link: $this->link);
        if(errores::$error){
            $error = $this->errores->error(mensaje: 'Error al generar select',data:  $select);
            print_r($error);
            die('Error');
        }

        $this->inputs->select = new stdClass();
        $this->inputs->select->dp_pais_id = $select;

        return $r_alta;

    }

    /**
     * @param bool $header If header muestra directo en aplicacion
     * @param bool $ws If ws retorna un obj en forma JSON
     * @return array|stdClass
     *@example
     * $_GET[pais_id] = 1;
     * retorna un JSON con la forma base de r_resultado_modelo
          */
    public function get_estado(bool $header, bool $ws = true): array|stdClass
    {

        $keys['dp_pais'] = array('id','descripcion','codigo','codigo_bis');
        $keys['dp_estado'] = array('id','descripcion','codigo','codigo_bis');


        $salida = $this->get_out(header: $header,keys: $keys, ws: $ws);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar salida',data:  $salida,header: $header,ws: $ws);

        }


        return $salida;


    }

    public function modifica(bool $header, bool $ws = false, string $breadcrumbs = '', bool $aplica_form = true, bool $muestra_btn = true): array|string
    {
        $r_modifica =  parent::modifica($header, $ws, $breadcrumbs, $aplica_form, $muestra_btn); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar template',data:  $r_modifica, header: $header,ws:$ws);
        }

        $select = (new dp_pais_html())->select_dp_pais_id(id_selected:$this->row_upd->dp_pais_id,
            link: $this->link);
        if(errores::$error){
            $error = $this->errores->error(mensaje: 'Error al generar select',data:  $select);
            print_r($error);
            die('Error');
        }

        $this->inputs->select = new stdClass();
        $this->inputs->select->dp_pais_id = $select;

        return $r_modifica;
    }


}
