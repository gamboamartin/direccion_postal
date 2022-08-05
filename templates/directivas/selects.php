<?php
namespace html;

use gamboamartin\errores\errores;

use gamboamartin\system\html_controler;
use gamboamartin\system\init;
use gamboamartin\template\html;
use PDO;
use stdClass;


class selects {
    private errores  $error;
    public function __construct(){
        $this->error = new errores();
    }

    private function genera_obj_html(html $html, string $tabla): html_controler|array
    {
        $name_obj = $this->name_obk_html(tabla: $tabla);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener nombre de obj',data:  $name_obj);
        }


        $obj_html = $this->obj_html(name_obj: $name_obj,html: $html);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar objeto html',data:  $obj_html);
        }
        return $obj_html;
    }

    private function genera_select(PDO $link, html_controler $obj_html, stdClass $row_, string $tabla): array|string
    {
        $key_id = $this->key_id(tabla: $tabla);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar key id',data:  $key_id);
        }

        $name_function = $this->name_function(key_id: $key_id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar name function',data:  $name_function);
        }

        $select = $obj_html->$name_function(cols: 6, con_registros:true, id_selected:$row_->$key_id,link: $link);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select',data:  $select);

        }
        return $select;
    }

    private function key_id(string $tabla): string
    {
        return $tabla.'_id';
    }

    private function name_function(string $key_id): string
    {
        return 'select_'.$key_id;
    }

    /**
     * Genera el name del obj html
     * @param string $tabla Tabla para generacion
     * @return string|array
     * @version 0.86.8
     * @verfuncion 0.1.0
     * @fecha 2022-08-05 10:36
     * @author mgamboa
     */
    private function name_obk_html(string $tabla): string|array
    {
        $tabla = trim($tabla);
        if($tabla === ''){
            return $this->error->error(mensaje: 'Error tabla esta vacia',data: $tabla);
        }
        return "html\\".$tabla.'_html';
    }

    private function obj_html(string $name_obj, html $html): html_controler
    {
        /**
         * @var $obj_html html_controler
         */
        $obj_html = new $name_obj(html: $html);
        return $obj_html;
    }

    private function select_base(html $html, PDO $link, stdClass $row, string $tabla): array|stdClass
    {
        $row_ = $row;

        $row_ = (new init())->row_value_id($row_, tabla: $tabla);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener id',data:  $row_);
        }


        $obj_html = $this->genera_obj_html(html: $html,tabla: $tabla);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar objeto html',data:  $obj_html);
        }

        $select = $this->genera_select(link: $link,obj_html: $obj_html,row_: $row_,tabla: $tabla);
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
    public function dp_cp_id(html $html, PDO $link, stdClass $row): array|stdClass
    {

        $data = $this->select_base(html: $html,link:  $link, row: $row,tabla:  'dp_cp');
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
