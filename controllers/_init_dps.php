<?php

namespace controllers;

use gamboamartin\errores\errores;
use stdClass;

class _init_dps{

    private errores $error;

    public function __construct(){
        $this->error = new errores();
    }

    public function asigna_propiedades_base(controlador_dp_calle_pertenece|controlador_dp_colonia_postal $controlador): controlador_dp_calle_pertenece|controlador_dp_colonia_postal
    {
        $identificador = "dp_pais_id";
        $propiedades = array("label" => "Pais");
        $controlador->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "dp_estado_id";
        $propiedades = array("label" => "Estado", "con_registros" => false);
        $controlador->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "dp_municipio_id";
        $propiedades = array("label" => "Municipio", "con_registros" => false);
        $controlador->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "dp_cp_id";
        $propiedades = array("label" => "Código Postal", "con_registros" => false);
        $controlador->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        return $controlador;
    }
    public function init_datatables(array $columns, array $filtro): stdClass
    {
        $datatables = new stdClass();
        $datatables->columns = $columns;
        $datatables->filtro = $filtro;

        return $datatables;
    }

    public function init_propiedades_ctl(controlador_dp_calle|controlador_dp_calle_pertenece|_ctl_calles $controler){
        $controler->titulo_lista = 'Calles';

        $propiedades = $controler->inicializa_priedades();
        if(errores::$error){
           return $this->error->error(mensaje: 'Error al inicializar propiedades',data:  $propiedades);
        }
        $controler->lista_get_data = true;

        return $controler;
    }
}
