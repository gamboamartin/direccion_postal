<?php
namespace html;

use gamboamartin\errores\errores;
use gamboamartin\system\html_controler;
use models\dp_calle;
use PDO;


class dp_calle_html extends html_controler {
    public function select_dp_calle_id(int $cols, bool $con_registros, int $id_selected, PDO $link): array|string
    {
        $modelo = new dp_calle($link);

        $select = $this->select_catalogo(cols:$cols, con_registros: $con_registros,id_selected:$id_selected,
            modelo: $modelo, label: 'Calle');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select', data: $select);
        }
        return $select;
    }

}
