<?php
namespace html;

use gamboamartin\errores\errores;
use gamboamartin\system\html_controler;
use models\dp_calle;
use PDO;


class dp_calle_html extends html_controler {
    /**
     * @param int $cols
     * @param bool $con_registros
     * @param int|null $id_selected
     * @param PDO $link
     * @param array $filtro
     * @return array|string
     */
    public function select_dp_calle_id(int $cols, bool $con_registros, int|null $id_selected, PDO $link,
                                       array $filtro = array()): array|string{

        if(is_null($id_selected)){
            $id_selected = -1;
        }

        $modelo = new dp_calle($link);

        $select = $this->select_catalogo(cols:$cols, con_registros: $con_registros,id_selected:$id_selected,
            modelo: $modelo, label: 'Calle');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select', data: $select);
        }
        return $select;
    }

}
