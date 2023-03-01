<?php

namespace controllers;

use base\controller\controler;
use gamboamartin\errores\errores;
use gamboamartin\validacion\validacion;
use stdClass;

class _init_dps{

    private errores $error;
    private validacion $validacion;

    public function __construct(){
        $this->error = new errores();
        $this->validacion = new validacion();
    }

    private function asigna_data(array $childrens, string $entidad, string $entidad_key, string $key_option,
                                 string $seccion_limpia, string $seccion_param){

        $update = $this->update_ejecuta(childrens: $childrens,entidad_key:  $entidad_key,
            key_option:  $key_option,seccion_limpia:  $seccion_limpia,seccion_param:  $seccion_param);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al asignar update', data: $update);
        }

        return 'let asigna_'.$entidad.' = ('.$seccion_param.'_id = "", val_selected_id = "") => {
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
        $propiedades = array("label" => "Estado", "con_registros" => false, 'key_descripcion_select' => 'dp_estado_descripcion');
        $prop = $controlador->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al asignar propiedad', data: $prop);
        }

        $identificador = "dp_municipio_id";
        $propiedades = array("label" => "Municipio", "con_registros" => false, 'key_descripcion_select' => 'dp_municipio_descripcion');
        $prop = $controlador->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al asignar propiedad', data: $prop);
        }

        $identificador = "dp_cp_id";
        $propiedades = array("label" => "Código Postal", "con_registros" => false, 'key_descripcion_select' => 'dp_cp_descripcion');
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

    private function childrens(array $data){
        $childrens = array();
        if(isset($data['childrens'])){
            $childrens = $data['childrens'];
        }
        return $childrens;
    }

    private function ejecuta_funcion(string $entidad): string
    {
        return 'asigna_'.$entidad.'(selected.val());';
    }

    private function entidad_key(array $data, string $key){
        $entidad_key = $key;
        if(isset($data['entidad_key'])){
            $entidad_key = $data['entidad_key'];
        }
        return $entidad_key;
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

    private function exe(array $data){
        $exe = '';
        if(isset($data['exe'])){
            $exe = $data['exe'];
        }
        return $exe;
    }

    private function genera_data_java(array $data, string $seccion_limpia, array $urls_js){
        $params = $this->params(data: $data, seccion_limpia: $seccion_limpia);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar params',data:  $params);
        }

        $java = $this->genera_java(params: $params);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar java',data:  $java);
        }

        $urls_js = $this->integra_datas(java: $java,params:  $params,urls_js:  $urls_js);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al integrar java',data:  $java);
        }
        return $urls_js;
    }

    private function genera_java(stdClass $params){
        $java = $this->java(params: $params);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar java',data:  $java);
        }

        $java = $this->java_compuesto(java: $java);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar java',data:  $java);
        }
        return $java;
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
        $urls['estado']['childrens'] = array('estado', 'municipio','cp','colonia_postal','calle_pertenece');
        $urls['estado']['exe'] = 'dp_municipio';

        $urls['municipio']['seccion_param'] = 'dp_estado';
        $urls['municipio']['key_option'] = 'descripcion';
        $urls['municipio']['childrens'] = array('municipio','cp','colonia_postal','calle_pertenece');
        $urls['municipio']['exe'] = 'dp_cp';

        $urls['cp']['seccion_param'] = 'dp_municipio';
        $urls['cp']['key_option'] = 'descripcion';
        $urls['cp']['childrens'] = array('cp','colonia_postal','calle_pertenece');
        $urls['cp']['exe'] = 'dp_colonia_postal';

        $urls['colonia_postal']['seccion_param'] = 'dp_cp';
        $urls['colonia_postal']['key_option'] = 'descripcion';
        $urls['colonia_postal']['entidad_key'] = 'dp_colonia';
        $urls['colonia_postal']['childrens'] = array('colonia_postal','calle_pertenece');
        $urls['colonia_postal']['exe'] = 'dp_calle_pertenece';

        $urls['calle_pertenece']['seccion_param'] = 'dp_colonia_postal';
        $urls['calle_pertenece']['key_option'] = 'descripcion';
        $urls['calle_pertenece']['entidad_key'] = 'dp_calle';
        $urls['calle_pertenece']['childrens'] = array('calle_pertenece');


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

    private function integra_data(stdClass $java, string $key, stdClass $params, array $urls_js): array
    {
        $data = $java->$key;
        $urls_js[$params->key][$key] = "<script> $data </script>";
        return $urls_js;
    }

    private function integra_datas(stdClass $java, stdClass $params, array $urls_js){
        $keys = array('update','css_id','change','event_full','event_change','event_update');
        foreach ($keys as $key){
            $urls_js = $this->integra_data(java: $java,key:  $key,params:  $params,urls_js:  $urls_js);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al integrar java',data:  $java);
            }
        }
        return $urls_js;
    }


    private function java(stdClass $params){

        $css_id = $this->select(entidad: $params->key);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar css',data:  $css_id);
        }

        $update = $this->asigna_data(childrens: $params->childrens, entidad: $params->key, entidad_key: $params->entidad_key,
            key_option: $params->key_option, seccion_limpia: $params->seccion_limpia, seccion_param: $params->seccion_param);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar update',data:  $update);
        }

        $change = $this->event_change(entidad: $params->key,exe:  $params->exe);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar change',data:  $change);
        }

        $data = new stdClass();
        $data->css_id = $css_id;
        $data->update = $update;
        $data->change = $change;
        return $data;

    }

    private function java_compuesto(stdClass $java): stdClass
    {
        $event_full = $java->css_id.$java->update.$java->change;
        $event_change = $java->css_id.$java->change;
        $event_update = $java->css_id.$java->update;

        $java->event_full = $event_full;
        $java->event_change = $event_change;
        $java->event_update = $event_update;
        return $java;

    }

    /**
     * Genera el key del array haciendo referencia a dp
     * @param string $seccion_limpia Seccion sin prefijo
     * @return string|array
     * @version 9.88.1
     */
    private function key(string $seccion_limpia): string|array
    {
        $seccion_limpia = trim($seccion_limpia);
        if($seccion_limpia === ''){
            return $this->error->error(mensaje: 'Error seccion_limpia esta vacia', data: $seccion_limpia);
        }
        return "dp_$seccion_limpia";
    }

    /**
     *
     * Genera el key a utilizar en option
     * @param array $data Datos inicializados de url
     * @return string
     */
    private function key_option(array $data): string
    {
        $key_option = '';
        if(isset($data['key_option'])){
            $key_option = $data['key_option'];
        }
        return $key_option;
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

    private function params(array $data, string $seccion_limpia){
        $key = $this->key(seccion_limpia: $seccion_limpia);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar key',data:  $key);
        }

        $seccion_param = $this->seccion_param(data: $data);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar seccion_param',data:  $seccion_param);
        }

        $key_option = $this->key_option(data: $data);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar key_option',data:  $key_option);
        }

        $entidad_key = $this->entidad_key(data: $data, key: $key );
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar entidad_key',data:  $entidad_key);
        }

        $childrens = $this->childrens(data: $data);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar childrens',data:  $childrens);
        }

        $exe = $this->exe(data: $data);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar exe',data:  $exe);
        }


        $css_id = $this->select(entidad: $key);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar css',data:  $css_id);
        }




        $data = new stdClass();
        $data->key = $key;
        $data->seccion_param = $seccion_param;
        $data->key_option = $key_option;
        $data->entidad_key = $entidad_key;
        $data->childrens = $childrens;
        $data->exe = $exe;
        $data->css_id = $css_id;
        $data->seccion_limpia = $seccion_limpia;

        return $data;
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

    /**
     * Obtiene el params de data
     * @param array $data Datos de inicializacion de urls
     * @return string|array
     * @version 9.94.2
     */
    private function seccion_param(array $data): string|array
    {
        $seccion_param = '';
        if(isset($data['seccion_param'])){
            $seccion_param = $data['seccion_param'];
        }
        
        return $seccion_param;
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
        $val_selected = '$("#'.$key.'_id").val(val_selected_id);';

        $refresh = $this->refresh_selectores(selectores: $childrens);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar refresh',data:  $refresh);
        }

        return $limpia.$options.$val_selected.$refresh;

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
     * @return string|array
     */
    private function url_servicio(string $accion, string $seccion, string $extra_params = ''): string|array
    {
        $accion = trim($accion);
        $valida = $this->validacion->valida_texto_pep_8(txt: $accion);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar accion',data: $valida);
        }
        $seccion = trim($seccion);
        $valida = $this->validacion->valida_texto_pep_8(txt: $seccion);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar seccion',data: $valida);
        }

        $extra_params = trim($extra_params);
        if($extra_params !== '') {

            $valida = $this->validacion->valida_params_json_parentesis(txt: $extra_params);
            if (errores::$error) {
                return $this->error->error(mensaje: 'Error al validar seccion', data: $valida);
            }
        }
        else{
            $extra_params = '{}';
        }

        return "get_url('$seccion','$accion', $extra_params);";
    }

    private function url_servicio_extra_param(string $accion, string $seccion, string $seccion_param): array|string
    {
        $extra_param_js = '';
        $seccion_param = trim($seccion_param);
        if($seccion_param !== '') {
            $extra_param_js = '{' . $seccion_param . '_id: ' . $seccion_param . '_id}';
        }
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

            $urls_js = $this->genera_data_java(data: $data,seccion_limpia:  $seccion_limpia,urls_js:  $urls_js);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al integrar java',data:  $urls_js);
            }

        }
        return $urls_js;
    }
}
