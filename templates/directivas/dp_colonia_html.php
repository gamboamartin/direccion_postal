<?php
namespace html;

use gamboamartin\errores\errores;
use gamboamartin\system\html_controler;
use models\dp_colonia;
use PDO;


class dp_colonia_html extends html_controler {
    public function select_dp_colonia_id(int $cols, bool $con_registros, int|null $id_selected, PDO $link,
                                         bool $disabled = false, array $filtro = array()): array|string
    {
        $modelo = new dp_colonia($link);

        if(is_null($id_selected)){
            $id_selected = -1;
        }
        $select = $this->select_catalogo(cols: $cols, con_registros: $con_registros, id_selected: $id_selected,
            modelo: $modelo, disabled: $disabled, filtro: $filtro, label: 'Colonia');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select', data: $select);
        }
        return $select;
    }

}
