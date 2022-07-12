<?php
namespace html;

use gamboamartin\errores\errores;
use gamboamartin\system\html_controler;
use models\dp_cp;
use PDO;


class dp_cp_html extends html_controler {

    public function select_dp_cp_id(int $cols, int $id_selected, PDO $link): array|string
    {
        $modelo = new dp_cp($link);

        $select = $this->select_catalogo(cols:$cols,id_selected:$id_selected, modelo: $modelo);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select', data: $select);
        }
        return $select;
    }
}
