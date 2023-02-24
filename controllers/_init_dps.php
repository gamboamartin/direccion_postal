<?php

namespace controllers;

use base\controller\controler;
use gamboamartin\errores\errores;
use stdClass;

class _init_dps{

    private errores $error;

    public function __construct(){
        $this->error = new errores();
    }

    private function asigna_data(array $childrens, string $entidad_key, string $key_option, string $seccion_limpia, string $seccion_param){
        $update = $this->update_ejecuta(childrens: $childrens,entidad_key:  $entidad_key,
            key_option:  $key_option,seccion_limpia:  $seccion_limpia,seccion_param:  $seccion_param);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al asignar update', data: $update);
        }

        return 'let asigna_'.$entidad_key.' = ('.$seccion_param.'_id = "") => {
            '.$update.'
        }
        ';

    }

    public function asigna_propiedades_base(
        controlador_dp_calle_pertenece|controlador_dp_colonia_postal $controlador): controlador_dp_calle_pertenece|controlador_dp_colonia_postal
    {
        $identificador = "dp_pais_id";
        $propiedades = array("label" => "Pais",'key_descripcion_select' => 'dp_pais_descripcion');
        $prop = $controlador->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al asignar propiedad', data: $prop);
        }


        $identificador = "dp_estado_id";
        $propiedades = array("label" => "Estado", "con_registros" => false);
        $prop = $controlador->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al asignar propiedad', data: $prop);
        }

        $identificador = "dp_municipio_id";
        $propiedades = array("label" => "Municipio", "con_registros" => false);
        $prop = $controlador->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al asignar propiedad', data: $prop);
        }

        $identificador = "dp_cp_id";
        $propiedades = array("label" => "Código Postal", "con_registros" => false);
        $prop = $controlador->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al asignar propiedad', data: $prop);
        }

        return $controlador;
    }

    private function change(string $entidad, string $exe){

        $selected = $this->selected(entidad: $entidad);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar selected',data:  $selected);
        }

        $exe_fn = '';
        if($exe !== '') {

            $exe_fn = $this->ejecuta_funcion($exe);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al generar exe',data:  $exe_fn);
            }
        }

        return $selected.$exe_fn;
    }

    private function ejecuta_funcion(string $entidad): string
    {
        return 'asigna_'.$entidad.'(selected.val());';
    }

    private function event_change(string $entidad, string $exe){
        $change = $this->change(entidad: $entidad, exe: $exe);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar change',data:  $change);
        }

        return 'sl_'.$entidad.'.change(function () {
        '.$change.'
        });';
    }


    /**
     * Inicializa datatables
     * @param array $columns Columnas para front
     * @param array $filtro Filtros aplicables datatables
     * @return stdClass
     */
    final public function init_datatables(array $columns, array $filtro): stdClass
    {
        $datatables = new stdClass();
        $datatables->columns = $columns;
        $datatables->filtro = $filtro;

        return $datatables;
    }

    final public function init_js(controler $controler): array
    {
        $urls = array();

        $urls['pais'] = array();
        $urls['pais']['exe'] = 'dp_estado';

        $urls['calle'] = array();

        $urls['estado']['seccion_param'] = 'dp_pais';
        $urls['estado']['key_option'] = 'descripcion';
        $urls['estado']['childrens'] = array('estado','municipio','cp','colonia_postal');
        $urls['estado']['exe'] = 'dp_municipio';

        $urls['municipio']['seccion_param'] = 'dp_estado';
        $urls['municipio']['key_option'] = 'descripcion';
        $urls['municipio']['childrens'] = array('municipio','cp','colonia_postal');
        $urls['municipio']['exe'] = 'dp_cp';

        $urls['cp']['seccion_param'] = 'dp_municipio';
        $urls['cp']['key_option'] = 'descripcion';
        $urls['cp']['childrens'] = array('cp','colonia_postal');
        $urls['cp']['exe'] = 'dp_colonia_postal';

        $urls['colonia_postal']['seccion_param'] = 'dp_cp';
        $urls['colonia_postal']['key_option'] = 'descripcion';
        $urls['colonia_postal']['entidad_key'] = 'dp_colonia_postal';
        $urls['colonia_postal']['childrens'] = array('colonia_postal');


        $urls_js = $this->urls(urls:$urls);

        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar url js',data:  $urls_js);
        }
        $controler->url_servicios = $urls_js;
        return $urls_js;
    }

    final public function init_propiedades_ctl(controlador_dp_calle|controlador_dp_calle_pertenece|_ctl_calles $controler){
        $controler->titulo_lista = 'Calles';

        $propiedades = $controler->inicializa_priedades();
        if(errores::$error){
           return $this->error->error(mensaje: 'Error al inicializar propiedades',data:  $propiedades);
        }
        $controler->lista_get_data = true;

        return $controler;
    }

    private function limpia_selector(string $css_id, string $entidad_limpia): string
    {

        $empty = $css_id.'.empty();';
        $init = 'integra_new_option('.$css_id.',"Seleccione '.$entidad_limpia.'","-1");';

        return $empty.$init;

    }

    private function limpia_selectores(array $selectores){
        $limpia_selectores = '';
        foreach ($selectores as $selector) {

            $entidad = "dp_$selector";

            $css_id = $this->selector(entidad:$entidad);
            if (errores::$error) {
                return $this->error->error(mensaje: 'Error al generar css_id', data: $css_id);
            }

            $limpia = $this->limpia_selector(css_id: $css_id, entidad_limpia: $selector);
            if (errores::$error) {
                return $this->error->error(mensaje: 'Error al generar limpia', data: $limpia);
            }
            $limpia_selectores.=$limpia;
        }
        return $limpia_selectores;
    }

    private function new_option(string $entidad_key, string $key_option, string $seccion): string
    {
        return 'integra_new_option(sl_'.$seccion.','.$seccion.'.'.$entidad_key.'_'.$key_option.','.$seccion.'.'.$seccion.'_id);';
    }

    private function options(string $entidad_key, string $key_option, string $seccion){
        $new_option = $this->new_option(entidad_key: $entidad_key,key_option:  $key_option,seccion:  $seccion);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar new option', data: $new_option);
        }
        return '$.each(data.registros, function( index, '.$seccion.' ) {
            '.$new_option.'
        });';
    }

    private function refresh_selectores(array $selectores){

        $refreshs = '';
        foreach ($selectores as $selector) {

            $entidad = "dp_$selector";

            $css_id = $this->selector(entidad:$entidad);
            if (errores::$error) {
                return $this->error->error(mensaje: 'Error al generar css_id', data: $css_id);
            }

            $refresh = $this->refresh_selectpicker(css_id: $css_id);
            if (errores::$error) {
                return $this->error->error(mensaje: 'Error al generar refresh', data: $refresh);
            }
            $refreshs.=$refresh;
        }
        return $refreshs;

    }

    private function refresh_selectpicker(string $css_id): string
    {
        return $css_id.'.selectpicker("refresh");';
    }

    private function select(string $entidad){
        $css_id = $this->selector($entidad);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar css',data:  $css_id);
        }
        return 'let sl_'.$entidad.' = '.$css_id.';';
    }

    private function selected(string $entidad): string
    {
        return 'let selected = sl_'.$entidad.'.find("option:selected");';
    }


    private function selector(string $entidad): string
    {
        return '$("#'.$entidad.'_id")';
    }

    private function update(array $childrens, string $entidad_key, string $key, string $key_option){


        $limpia = $this->limpia_selectores(selectores: $childrens);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar limpia',data:  $limpia);
        }

        $options = $this->options(entidad_key: $entidad_key,key_option:  $key_option,seccion:  $key);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar options',data:  $options);
        }

        $refresh = $this->refresh_selectores(selectores: $childrens);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar refresh',data:  $refresh);
        }

        return $limpia.$options.$refresh;

    }

    private function update_data(array $childrens, string $entidad_key, string $key, string $key_option){

        $update = $this->update(childrens: $childrens,entidad_key: $entidad_key,key: $key,key_option: $key_option);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar update',data:  $update);
        }

        return 'get_data(url, function (data) {
        '.$update.'
        });';
    }

    private function update_ejecuta(array $childrens, string $entidad_key, string $key_option,
                                    string $seccion_limpia, string $seccion_param){

        $key = "dp_$seccion_limpia";

        $url = $this->url_servicio_get(seccion_limpia: $seccion_limpia, seccion_param: $seccion_param);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar url',data:  $url);
        }

        $url_val = 'let url = '.$url.';';


        $update = $this->update_data(childrens: $childrens, entidad_key: $entidad_key,key:  $key,key_option:  $key_option);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar update',data:  $update);
        }

        $ej_update = $url_val.$update;
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar update',data:  $update);
        }

        return $ej_update;
    }



    /**
     * Genera el elemento necesario para integrar en java la obtencion de una url
     * @param string $accion Accion a ejecutar
     * @param string $seccion Seccion a ejecutar
     * @param string $extra_params Params GET
     * @return string
     */
    private function url_servicio(string $accion, string $seccion, string $extra_params = ''): string
    {


        return "get_url('$seccion','$accion', $extra_params);";
    }

    private function url_servicio_extra_param(string $accion, string $seccion, string $seccion_param): array|string
    {
        $extra_param_js = '{'.$seccion_param.'_id: '.$seccion_param.'_id}';
        $url = $this->url_servicio(accion: $accion,seccion:  $seccion,extra_params:  $extra_param_js);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar url',data: $url);
        }
        return $url;
    }

    private function url_servicio_get(string $seccion_limpia, string $seccion_param): array|string
    {
        $accion = "get_$seccion_limpia";
        $seccion = "dp_$seccion_limpia";

        $url = $this->url_servicio_extra_param(accion: $accion,seccion:  $seccion, seccion_param: $seccion_param);

        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar url js',data:  $url);

        }
        return $url;
    }

    final public function urls(array $urls): array
    {
        $urls_js = array();
        foreach ($urls as $seccion_limpia=>$data){
            $key = "dp_$seccion_limpia";

            $seccion_param = '';
            if(isset($data['seccion_param'])){
                $seccion_param = $data['seccion_param'];
            }

            $key_option = '';
            if(isset($data['key_option'])){
                $key_option = $data['key_option'];
            }

            $entidad_key = $key;
            if(isset($data['entidad_key'])){
                $entidad_key = $data['entidad_key'];
            }

            $childrens = array();
            if(isset($data['childrens'])){
                $childrens = $data['childrens'];
            }

            $exe = '';
            if(isset($data['exe'])){
                $exe = $data['exe'];
            }

            $css_id = $this->select(entidad: $key);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al generar css',data:  $css_id);
            }

            $update = $this->asigna_data(childrens: $childrens,entidad_key:  $entidad_key,key_option:  $key_option,
                seccion_limpia: $seccion_limpia,seccion_param:  $seccion_param);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al generar update',data:  $update);
            }


            $change = $this->event_change(entidad: $key,exe:  $exe);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al generar change',data:  $change);
            }

            $even_full = $css_id.$update.$change;
            $event_change = $css_id.$change;
            $event_update = $css_id.$update;

            $urls_js[$key]['update'] = $update;
            $urls_js[$key]['css_id'] = $css_id;
            $urls_js[$key]['change'] = $change;
            $urls_js[$key]['event_full'] = $even_full;
            $urls_js[$key]['event_change'] = $event_change;
            $urls_js[$key]['event_update'] = $event_update;

        }
        return $urls_js;
    }
}
