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

    private function select_base(html $html, PDO $link, stdClass $row, string $tabla): array|stdClass
    {
        $row_ = $row;

        $row_ = (new init())->row_value_id($row_, tabla: $tabla);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener id',data:  $row_);
        }

        $name_obj = "html\\".$tabla.'_html';
        $obj_html = new $name_obj(html: $html);
        $key_id = $tabla.'_id';
        $name_function = 'select_'.$key_id;


        $select = $obj_html->$name_function(cols: 6, con_registros:true, id_selected:$row_->$key_id,link: $link);
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
    public function dp_estado_id(html $html, PDO $link, stdClass $row): array|stdClass
    {

        $data = $this->select_base(html: $html,link:  $link, row: $row,tabla:  'dp_estado');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select',data:  $data);

        }

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
        $data = $this->select_base(html: $html,link:  $link, row: $row,tabla:  'dp_municipio');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select',data:  $data);

        }

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

        $data = $this->select_base(html: $html,link:  $link, row: $row,tabla:  'dp_pais');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select',data:  $data);

        }

        return $data;
    }

}
