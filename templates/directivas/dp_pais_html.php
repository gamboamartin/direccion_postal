<?php
namespace html;

use gamboamartin\errores\errores;
use gamboamartin\system\html_controler;
use gamboamartin\template\directivas;
use models\dp_pais;
use PDO;


class dp_pais_html extends html_controler {

    /**
     * @param int $cols Numero de columnas css
     * @param bool $con_registros si no con registros deja el select vacio
     * @param int $id_selected id para selected
     * @param PDO $link conexion a la base de datos
     * @param array $filtro
     * @return array|string
     * @version 0.120.26
     * @verfuncion 0.1.0
     * @fecha 2022-08-04
     * @author mgamboa
     */
    public function select_dp_pais_id(int $cols, bool $con_registros, int $id_selected, PDO $link,
                                      array $filtro = array()): array|string
    {
        $valida = (new directivas(html:$this->html_base))->valida_cols(cols:$cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar cols', data: $valida);
        }
        $modelo = new dp_pais($link);

        $select = $this->select_catalogo(cols: $cols, con_registros: $con_registros, id_selected: $id_selected,
            modelo: $modelo, filtro: $filtro, label: 'Pais');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select', data: $select);
        }
        return $select;
    }

}
