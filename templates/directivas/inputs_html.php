<?php
namespace html;

use gamboamartin\errores\errores;
use gamboamartin\system\html_controler;
use gamboamartin\system\system;
use gamboamartin\template\directivas;
use models\dp_calle;
use PDO;
use stdClass;


class inputs_html {
    private errores $error;
    public function __construct(){
        $this->error = new errores();
    }

    /**
     * Asigna los elementos de un direcciones basicas
     * @param system $controler Controlador en ejecucion
     * @param stdClass $inputs Inputs con datos asignados en forma de html
     * @return stdClass
     */
    public function base_direcciones_asignacion(system $controler, stdClass $inputs): stdClass
    {
        $controler->inputs->select->dp_pais_id = $inputs->selects->dp_pais_id;
        $controler->inputs->select->dp_estado_id = $inputs->selects->dp_estado_id;
        $controler->inputs->select->dp_municipio_id = $inputs->selects->dp_municipio_id;
        $controler->inputs->select->dp_cp_id = $inputs->selects->dp_cp_id;
        $controler->inputs->select->dp_colonia_postal_id = $inputs->selects->dp_colonia_postal_id;
        $controler->inputs->select->dp_calle_pertenece_id = $inputs->selects->dp_calle_pertenece_id;
        return $controler->inputs->select;
    }

    /**
     * @param int $cols Numero de columnas css
     * @param directivas $directivas Directivas de template html
     * @param stdClass $row_upd registro en proceso
     * @param bool $value_vacio si vacio limpiar valores
     * @param string $campo Nombre del campo para name
     * @return array|string
     */
    public function input(int $cols, directivas $directivas, stdClass $row_upd, bool $value_vacio,
                          string $campo): array|string
    {

        if($cols<=0){
            return $this->error->error(mensaje: 'Error cold debe ser mayor a 0', data: $cols);
        }
        if($cols>=13){
            return $this->error->error(mensaje: 'Error cold debe ser menor o igual a  12', data: $cols);
        }

        $html =$directivas->input_text_required(disable: false,name: $campo,place_holder: $campo,
            row_upd: $row_upd, value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html);
        }

        $div = $directivas->html->div_group(cols: $cols,html:  $html);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al integrar div', data: $div);
        }

        return $div;
    }


}
