<?php
namespace html;

use gamboamartin\errores\errores;

use gamboamartin\system\init;
use gamboamartin\template\html;
use models\dp_calle;
use PDO;
use stdClass;


class selects {
    private errores  $error;
    public function __construct(){
        $this->error = new errores();
    }

    /**
     * Genera un select de tipo estado inicializado
     * @param html $html Clade de template
     * @param PDO $link conexion a bd
     * @param stdClass $row Registro en operacion
     * @return array|stdClass
     */
    public function dp_estado_id(html $html, PDO $link, stdClass $row): array|stdClass
    {
        $row_ = $row;

        $row_ = (new init())->row_value_id($row_, tabla: 'dp_estado');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener id',data:  $row_);
        }

        $select = (new dp_estado_html(html: $html))->select_dp_estado_id(cols: 6, con_registros:true,
            id_selected:$row_->dp_estado_id,link: $link);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select',data:  $select);

        }

        $data = new stdClass();
        $data->row = $row_;
        $data->select = $select;
        return $data;
    }

    /**
     * Genera un select de tipo estado inicializado
     * @param html $html Clade de template
     * @param PDO $link conexion a bd
     * @param stdClass $row Registro en operacion
     * @return array|stdClass
     */
    public function dp_municipio_id(html $html, PDO $link, stdClass $row): array|stdClass
    {
        $row_ = $row;

        $row_ = (new init())->row_value_id($row_, tabla: 'dp_municipio');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener id',data:  $row_);
        }

        $select = (new dp_municipio_html(html: $html))->select_dp_municipio_id(cols: 6, con_registros:true,
            id_selected:$row_->dp_estado_id,link: $link);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select',data:  $select);

        }

        $data = new stdClass();
        $data->row = $row_;
        $data->select = $select;
        return $data;
    }

    /**
     * Genera un select de tipo pais inicializado
     * @param html $html Clade de template
     * @param PDO $link conexion a bd
     * @param stdClass $row Registro en operacion
     * @return array|stdClass
     * @version 0.83.8
     * @verfuncion 0.1.0
     * @fecha 2022-08-05 10:01
     * @author mgamboa
     *
     */
    public function dp_pais_id(html $html, PDO $link, stdClass $row): array|stdClass
    {

        $row_ = $row;
        $row_ = (new init())->row_value_id($row_, tabla: 'dp_pais');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener id',data:  $row_);
        }

        $select = (new dp_pais_html(html: $html))->select_dp_pais_id(cols: 6, con_registros:true,
            id_selected:$row_->dp_pais_id,link: $link);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select',data:  $select);

        }

        $data = new stdClass();
        $data->row = $row_;
        $data->select = $select;
        return $data;
    }

}
