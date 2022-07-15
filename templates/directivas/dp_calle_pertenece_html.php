<?php
namespace html;

use gamboamartin\errores\errores;
use gamboamartin\system\html_controler;
use models\dp_calle_pertenece;
use PDO;


class dp_calle_pertenece_html extends html_controler {

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
