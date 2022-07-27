<?php
namespace html;

use gamboamartin\errores\errores;
use gamboamartin\system\html_controler;
use models\dp_municipio;
use PDO;


class dp_municipio_html extends html_controler {
    public function select_dp_municipio_id(int $cols, bool $con_registros, int $id_selected, PDO $link): array|string
    {
        $modelo = new dp_municipio($link);

        $select = $this->select_catalogo(cols:$cols, con_registros: $con_registros,id_selected:$id_selected,
            modelo: $modelo, label: 'Municipio');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select', data: $select);
        }
        return $select;
    }

}
