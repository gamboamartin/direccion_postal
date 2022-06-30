<?php
namespace html;

use gamboamartin\errores\errores;
use gamboamartin\system\html_controler;
use models\dp_pais;
use PDO;


class dp_pais_html extends html_controler {
    public function select_dp_pais_id(int $id_selected, PDO $link): array|string
    {
        $modelo = new dp_pais($link);

        $select = $this->select_catalogo(id_selected:$id_selected, modelo: $modelo);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select', data: $select);
        }
        return $select;
    }

}
