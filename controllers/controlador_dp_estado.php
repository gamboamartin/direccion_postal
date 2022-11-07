<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace controllers;

use config\generales;
use gamboamartin\direccion_postal\models\dp_estado;
use gamboamartin\errores\errores;
use gamboamartin\system\links_menu;
use gamboamartin\system\system;
use gamboamartin\template_1\html;
use html\dp_estado_html;
use html\dp_pais_html;

use PDO;
use stdClass;

class controlador_dp_estado extends system {

    public array $keys_selects = array();
    public string $link_dp_pais_alta = "";

    public function __construct(PDO $link, stdClass $paths_conf = new stdClass()){
        $modelo = new dp_estado(link: $link);
        $html_base = new html();
        $html = new dp_estado_html(html: $html_base);
        $obj_link = new links_menu(link: $link,registro_id:  $this->registro_id);

        $columns["dp_estado_id"]["titulo"] = "Id";
        $columns["dp_estado_codigo"]["titulo"] = "Codigo";
        $columns["dp_pais_descripcion"]["titulo"] = "Pais";
        $columns["dp_estado_descripcion"]["titulo"] = "Estado";

        $filtro = array("dp_estado.id","dp_estado.codigo","dp_estado.descripcion","dp_pais.descripcion");

        $datatables = new stdClass();
        $datatables->columns = $columns;
        $datatables->filtro = $filtro;

        parent::__construct(html:$html, link: $link,modelo:  $modelo, obj_link: $obj_link, datatables: $datatables,
            paths_conf: $paths_conf);

        $this->titulo_lista = 'Estados';

        $links = $this->inicializa_links();
        if(errores::$error){
            $error = $this->errores->error(mensaje: 'Error al inicializar links',data:  $links);
            print_r($error);
            die('Error');
        }

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

        $this->asignar_propiedad(identificador:'dp_pais_id', propiedades: ["id_selected"=>$this->row_upd->dp_pais_id,
            "cols" => 12]);

        $inputs = $this->genera_inputs(keys_selects:  $this->keys_selects);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al inicializar inputs',data:  $inputs);
        }

        $data = new stdClass();
        $data->template = $r_modifica;
        $data->inputs = $inputs;

        return $data;
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

    private function inicializa_links(): array|string
    {
        $this->obj_link->genera_links($this);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al generar links para factura',data:  $this->obj_link);
        }

        $link = $this->obj_link->get_link("dp_pais","alta");
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al obtener link partida alta',data:  $link);
        }
        $this->link_dp_pais_alta = $link;

        return $link;
    }

    private function inicializa_priedades(): array
    {
        $identificador = "dp_pais_id";
        $propiedades = array("label" => "Pais");
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
