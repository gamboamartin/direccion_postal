<?php

namespace controllers;

use base\controller\controler;
use base\orm\modelo;
use gamboamartin\errores\errores;
use gamboamartin\system\html_controler;
use gamboamartin\system\links_menu;
use PDO;
use stdClass;

class _ctl_calles extends _ctl_dps {

    public function __construct(html_controler $html, PDO $link, modelo $modelo, links_menu $obj_link,
                                array $columns = array(), array $datatables_custom_cols = array(),
                                array $datatables_custom_cols_omite = array(), stdClass $datatables = new stdClass(),
                                array $filtro_boton_lista = array(), string $campo_busca = 'registro_id',
                                array $filtro = array(), string $valor_busca_fault = '',
                                stdClass $paths_conf = new stdClass())
    {
        $datatables = (new _init_dps())->init_datatables(columns: $columns,filtro:  $filtro);
        if(errores::$error){
            $error = (new errores())->error(mensaje: 'Error al inicializar datatables',data:  $datatables);
            print_r($error);
            die('Error');
        }

        parent::__construct(html:$html, link: $link,modelo:  $modelo, obj_link: $obj_link, datatables: $datatables,
            paths_conf: $paths_conf);

        $init = (new _init_dps())->init_propiedades_ctl(controler: $this);
        if(errores::$error){
            $error = (new errores())->error(mensaje: 'Error al inicializar propiedades',data:  $init);
            print_r($error);
            die('Error');
        }
    }

    private function url_servicio(string $accion, string $seccion, string $extra_params = ''): string
    {


        return "get_url('$seccion','$accion', $extra_params);";
    }

    private function url_servicio_extra_param(string $accion, string $seccion, string $seccion_param): array|string
    {
        $extra_param_js = '{'.$seccion_param.'_id: '.$seccion_param.'_id}';
        $url = $this->url_servicio(accion: $accion,seccion:  $seccion,extra_params:  $extra_param_js);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al generar url',data: $url);
        }
        return $url;
    }

    private function url_servicio_get(string $seccion_limpia, string $seccion_param): array|string
    {
        $accion = "get_$seccion_limpia";
        $seccion = "dp_$seccion_limpia";

        $url = $this->url_servicio_extra_param(accion: $accion,seccion:  $seccion, seccion_param: $seccion_param);

        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar url js',data:  $url,header: $header,ws: $ws);

        }
        return $url;
    }

    protected function urls(array $urls): array
    {
        $urls_js = array();
        foreach ($urls as $seccion_limpia=>$seccion_param){
            $url = $this->url_servicio_get(seccion_limpia: $seccion_limpia, seccion_param: $seccion_param);
            if(errores::$error){
                return $this->errores->error(mensaje: 'Error al generar url js',data:  $url);
            }
            $key = "dp_$seccion_limpia";
            $urls_js[$key] = $url;
        }
        return $urls_js;
    }


}
