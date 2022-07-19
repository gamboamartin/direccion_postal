<?php
namespace html;

use gamboamartin\errores\errores;
use gamboamartin\system\html_controler;
use models\dp_calle_pertenece;
use PDO;
use stdClass;


class dp_calle_pertenece_html extends html_controler {

    public function input(int $cols, stdClass $row_upd, bool $value_vacio, string $campo): array|string
    {

        if($cols<=0){
            return $this->error->error(mensaje: 'Error cold debe ser mayor a 0', data: $cols);
        }
        if($cols>=13){
            return $this->error->error(mensaje: 'Error cold debe ser menor o igual a  12', data: $cols);
        }

        $html =$this->directivas->input_text_required(disable: false,name: $campo,place_holder: $campo,
            row_upd: $row_upd, value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html);
        }

        $div = $this->directivas->html->div_group(cols: $cols,html:  $html);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al integrar div', data: $div);
        }

        return $div;
    }

    public function select_dp_calle_pertenece_id(int $cols, bool $con_registros, int $id_selected, PDO $link): array|string
    {
        $modelo = new dp_calle_pertenece($link);

        $select = $this->select_catalogo(cols:$cols, con_registros: $con_registros,id_selected:$id_selected, modelo: $modelo);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select', data: $select);
        }
        return $select;
    }

    public function select_dp_calle_pertenece_entre1_id(int $cols, bool $con_registros, int $id_selected,
                                                        PDO $link): array|string
    {
        $modelo = new dp_calle_pertenece($link);

        $select = $this->select_catalogo(cols:$cols, con_registros: $con_registros,id_selected:$id_selected,
            modelo: $modelo, key_id: 'dp_calle_pertenece_entre1_id', label: 'Entre Calle');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select', data: $select);
        }
        return $select;
    }

    public function select_dp_calle_pertenece_entre2_id(int $cols, bool $con_registros, int $id_selected,
                                                        PDO $link): array|string
    {
        $modelo = new dp_calle_pertenece($link);

        $select = $this->select_catalogo(cols:$cols, con_registros: $con_registros,id_selected:$id_selected,
            modelo: $modelo, key_id: 'dp_calle_pertenece_entre2_id', label: 'Entre Calle');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select', data: $select);
        }
        return $select;
    }
}
