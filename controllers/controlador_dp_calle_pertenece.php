<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace controllers;

use gamboamartin\direccion_postal\models\dp_calle;
use gamboamartin\direccion_postal\models\dp_calle_pertenece;
use gamboamartin\direccion_postal\models\dp_colonia_postal;
use gamboamartin\errores\errores;
use gamboamartin\system\links_menu;
use gamboamartin\template_1\html;
use html\dp_calle_pertenece_html;
use PDO;
use stdClass;

class controlador_dp_calle_pertenece extends _ctl_calles {


    public function __construct(PDO $link, stdClass $paths_conf = new stdClass()){
        $modelo = new dp_calle_pertenece(link: $link);
        $html_base = new html();
        $html = new dp_calle_pertenece_html(html: $html_base);
        $obj_link = new links_menu(link: $link, registro_id: $this->registro_id);

        $columns["dp_calle_pertenece_id"]["titulo"] = "Id";
        $columns["dp_calle_pertenece_codigo"]["titulo"] = "Código";
        $columns["dp_pais_descripcion"]["titulo"] = "País";
        $columns["dp_estado_descripcion"]["titulo"] = "Estado";
        $columns["dp_municipio_descripcion"]["titulo"] = "Municipio";
        $columns["dp_colonia_postal_descripcion"]["titulo"] = "Colonia Postal";
        $columns["dp_calle_pertenece_descripcion"]["titulo"] = "Calle";

        $filtro = array("dp_calle_pertenece.id","dp_calle_pertenece.codigo","dp_calle_pertenece.descripcion",
            "dp_pais.descripcion", "dp_estado.descripcion","dp_municipio.descripcion",
            "dp_colonia_postal.descripcion");

        parent::__construct(html: $html, link: $link, modelo: $modelo, obj_link: $obj_link, columns: $columns,
            filtro: $filtro, paths_conf: $paths_conf);

        $this->parents_verifica[] = (new dp_colonia_postal(link: $this->link));
        $this->parents_verifica[] = (new dp_calle(link: $this->link));

        $this->verifica_parents_alta = true;
    }


    /**
     * @param string $identificador
     * @param mixed $propiedades
     * @return void
     */
    public function asignar_propiedad(string $identificador, mixed $propiedades)
    {
        if (!array_key_exists($identificador,$this->keys_selects)){
            $this->keys_selects[$identificador] = new stdClass();
        }

        foreach ($propiedades as $key => $value){
            $this->keys_selects[$identificador]->$key = $value;
        }
    }

    public function get_calle_pertenece(bool $header, bool $ws = true): array|stdClass
    {

        $keys['dp_calle'] = array('id','descripcion','codigo','codigo_bis');
        $keys['dp_colonia'] = array('id','descripcion','codigo','codigo_bis');
        $keys['dp_cp'] = array('id','descripcion','codigo','codigo_bis');
        $keys['dp_municipio'] = array('id','descripcion','codigo','codigo_bis');
        $keys['dp_estado'] = array('id','descripcion','codigo','codigo_bis');
        $keys['dp_pais'] = array('id','descripcion','codigo','codigo_bis');
        $keys['dp_colonia_postal'] = array('id','descripcion','codigo','codigo_bis');

        $salida = $this->get_out(header: $header,keys: $keys, ws: $ws);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar salida',data:  $salida,header: $header,ws: $ws);

        }
        return $salida;
    }

    public function inicializa_priedades(): array
    {


        $propiedades_base = (new _init_dps())->asigna_propiedades_base(controlador: $this);
        if(errores::$error){
            return $this->errores->error('Error al asignar propiedades',data: $propiedades_base);
        }

        $identificador = "dp_colonia_postal_id";
        $propiedades = array("label" => "Colonia Postal", "con_registros" => false);
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "dp_calle_id";
        $propiedades = array("label" => "Calle");
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "codigo";
        $propiedades = array("place_holder" => "Código");
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "georeferencia";
        $propiedades = array("place_holder" => "Georeferencia", "cols" => 12);
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        return $this->keys_selects;
    }


    public function modifica(bool $header, bool $ws = false): array|stdClass
    {
        $r_modifica =  parent::modifica(header: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar template',data:  $r_modifica, header: $header,ws:$ws);
        }

        $colonia_postal = (new dp_colonia_postal($this->link))->get_colonia_postal($this->row_upd->dp_colonia_postal_id);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al obtener colonia_postal',data:  $colonia_postal);
        }

        $identificador = "dp_pais_id";
        $propiedades = array("id_selected" => $colonia_postal['dp_pais_id']);
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "dp_estado_id";
        $propiedades = array("id_selected" => $colonia_postal['dp_estado_id'], "con_registros" => true,
            "filtro" => array('dp_pais.id' => $colonia_postal['dp_pais_id']));
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "dp_municipio_id";
        $propiedades = array("id_selected" => $colonia_postal['dp_municipio_id'], "con_registros" => true,
            "filtro" => array('dp_estado.id' => $colonia_postal['dp_estado_id']));
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "dp_cp_id";
        $propiedades = array("id_selected" => $colonia_postal['dp_cp_id'], "con_registros" => true,
            "filtro" => array('dp_estado.id' => $colonia_postal['dp_estado_id']));
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "dp_colonia_postal_id";
        $propiedades = array("id_selected" => $colonia_postal['dp_colonia_postal_id'], "con_registros" => true,
            "filtro" => array('dp_cp.id' => $colonia_postal['dp_cp_id']));
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "dp_calle_id";
        $propiedades = array("id_selected" => $this->row_upd->dp_calle_id);
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $inputs = $this->genera_inputs(keys_selects:  $this->keys_selects);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al inicializar inputs',data:  $inputs);
        }

        return $r_modifica;
    }
}
