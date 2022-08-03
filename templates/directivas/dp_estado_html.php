<?php
namespace html;

use gamboamartin\errores\errores;
use gamboamartin\system\html_controler;
use gamboamartin\template_1\directivas;
use models\dp_estado;
use PDO;


class dp_estado_html extends html_controler {
    /**
     * @param int $cols Columnas css
     * @param bool $con_registros si con registros asigna registros si no deja limpio el select
     * @param int $id_selected Id seleccionado
     * @param PDO $link Conexion a la bd
     * @param array $filtro Filtro para la obtencion de registros
     * @return array|string
     * @version 0.59.7
     * @verfuncion 0.1.0
     * @fecha 2022-08-03 16:58
     * @author mgamboa
     */
    public function select_dp_estado_id(int $cols, bool $con_registros,int $id_selected, PDO $link,
                                        array $filtro = array()): array|string
    {
        $valida = (new directivas(html:$this->html_base))->valida_cols(cols:$cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar cols', data: $valida);
        }

        $modelo = new dp_estado($link);

        $select = $this->select_catalogo(cols: $cols, con_registros: $con_registros, id_selected: $id_selected,
            modelo: $modelo, filtro: $filtro, label: 'Estado');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select', data: $select);
        }
        return $select;
    }

}
