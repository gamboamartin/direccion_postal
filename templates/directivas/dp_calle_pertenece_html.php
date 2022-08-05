<?php
namespace html;

use gamboamartin\errores\errores;
use gamboamartin\system\html_controler;
use gamboamartin\template\directivas;
use models\dp_calle_pertenece;
use PDO;
use stdClass;


class dp_calle_pertenece_html extends html_controler {

    /**
     * Genera un input de tipo entre calles
     * @param int $cols Numero de columnas css
     * @param bool $con_registros Si no con registros deja el select vacio
     * @param array $filtro filtro de datos para options
     * @param int $id_selected id seleccionado
     * @param string $label Etiqueta a mostrar
     * @param PDO $link conexion a base de datos
     * @param string $name name del input
     * @return array|string
     * @version 0.72.8
     * @verfuncion 0.1.0
     * @fecha 2022-08-04 13:11
     * @author mgamboa
     */
    private function entre_calles(int $cols, bool $con_registros, array $filtro, int $id_selected, string $label,
                                  PDO $link, string $name): array|string
    {
        $valida = (new directivas(html:$this->html_base))->valida_cols(cols:$cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar cols', data: $valida);
        }
        $modelo = new dp_calle_pertenece($link);

        $select = $this->select_catalogo(cols: $cols, con_registros: $con_registros, id_selected: $id_selected,
            modelo: $modelo, filtro: $filtro, key_id: 'dp_calle_pertenece_id', label: $label,name: $name);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select', data: $select);
        }
        return $select;
    }

    public function input(int $cols, stdClass $row_upd, bool $value_vacio, string $campo): array|string
    {

        $div = (new inputs_html())->input(cols: $cols,directivas:  $this->directivas, row_upd: $row_upd,
            value_vacio:  $value_vacio,campo:  $campo);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $div);
        }

        return $div;
    }

    /**
     * @param int $cols Numero de columnas en css
     * @param bool $con_registros
     * @param int $id_selected
     * @param PDO $link
     * @param array $filtro
     * @return array|string
     */
    public function select_dp_calle_pertenece_id(int $cols, bool $con_registros, int $id_selected, PDO $link,
                                                 array $filtro = array()): array|string
    {

        $valida = (new directivas(html:$this->html_base))->valida_cols(cols:$cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar cols', data: $valida);
        }

        $select = $this->entre_calles(cols: $cols,con_registros:  $con_registros, filtro: $filtro,
            id_selected: $id_selected, label: 'Calle', link: $link, name: 'dp_calle_pertenece_id' );

        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select', data: $select);
        }
        return $select;
    }

    /**
     * @param int $cols Numero de columnas en css
     * @param bool $con_registros Si con registros asigna los registros como options
     * @param int $id_selected Identificador
     * @param PDO $link Conexion a la base de datos
     * @param array $filtro Filtro de registros
     * @return array|string
     */
    public function select_dp_calle_pertenece_entre1_id(int $cols, bool $con_registros, int $id_selected,
                                                        PDO $link, array $filtro = array()): array|string
    {
        $valida = (new directivas(html:$this->html_base))->valida_cols(cols:$cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar cols', data: $valida);
        }

        $select = $this->entre_calles(cols: $cols,con_registros:  $con_registros, filtro: $filtro,
            id_selected: $id_selected, label: 'Entre calle', link: $link, name: 'dp_calle_pertenece_entre1_id' );

        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select', data: $select);
        }
        return $select;
    }

    /**
     * @param int $cols Numero de columnas en css
     * @param bool $con_registros
     * @param int $id_selected
     * @param PDO $link
     * @param array $filtro
     * @return array|string
     */
    public function select_dp_calle_pertenece_entre2_id(int $cols, bool $con_registros, int $id_selected,
                                                        PDO $link, array $filtro = array()): array|string
    {
        $valida = (new directivas(html:$this->html_base))->valida_cols(cols:$cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar cols', data: $valida);
        }

        $select = $this->entre_calles(cols: $cols,con_registros:  $con_registros, filtro: $filtro,
            id_selected: $id_selected, label: 'Entre calle', link: $link, name: 'dp_calle_pertenece_entre2_id');

        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select', data: $select);
        }
        return $select;
    }
}
