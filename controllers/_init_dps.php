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

        $urls['calle'] = array();

        $urls['estado']['seccion_param'] = 'dp_pais';
        $urls['estado']['key_option'] = 'descripcion';

        $urls['municipio']['seccion_param'] = 'dp_estado';
        $urls['municipio']['key_option'] = 'descripcion';

        $urls['cp']['seccion_param'] = 'dp_municipio';
        $urls['cp']['key_option'] = 'descripcion';

        $urls['colonia_postal']['seccion_param'] = 'dp_cp';
        $urls['colonia_postal']['key_option'] = 'descripcion';
        $urls['colonia_postal']['entidad_key'] = 'dp_colonia';


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

    private function limpia_selector(string $entidad): string
    {
        return 'sl_'.$entidad.'.empty();';
    }

    private function new_option(string $entidad_key, string $key_option, string $seccion): string
    {
        return 'integra_new_option(sl_'.$seccion.','.$seccion.'.'.$entidad_key.'_'.$key_option.','.$seccion.'.'.$seccion.'_id);';
    }

    public function selector(string $entidad): string
    {
        return '$("#'.$entidad.'_id");';
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

            $url = $this->url_servicio_get(seccion_limpia: $seccion_limpia, seccion_param: $seccion_param);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al generar url js',data:  $url);
            }


            $new_option = $this->new_option(entidad_key: $entidad_key, key_option: $key_option,seccion:  $key);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al generar new_option',data:  $new_option);
            }

            $css_id = $this->selector(entidad: $key);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al generar css',data:  $css_id);
            }

            $limpia = $this->limpia_selector(entidad: $key);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al generar limpia',data:  $limpia);
            }


            $urls_js[$key]['url'] = $url;
            $urls_js[$key]['new_option'] = $new_option;
            $urls_js[$key]['css_id'] = $css_id;
            $urls_js[$key]['limpia'] = $limpia;
        }
        return $urls_js;
    }
}
