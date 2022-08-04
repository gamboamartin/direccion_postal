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

    public function dp_estado_id(html $html, PDO $link, stdClass $row): array|stdClass
    {


        $row = (new init())->row_value_id($row, tabla: 'dp_estado');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener id',data:  $row);
        }

        $select = (new dp_estado_html(html: $html))->select_dp_estado_id(cols: 6, con_registros:true,
            id_selected:$row->dp_estado_id,link: $link);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select',data:  $select);

        }

        $data = new stdClass();
        $data->row = $row;
        $data->select = $select;
        return $data;
    }

    public function dp_pais_id(html $html, PDO $link, stdClass $row): array|stdClass
    {


        $row = (new init())->row_value_id($row, tabla: 'dp_pais');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener id',data:  $row);
        }

        $select = (new dp_pais_html(html: $html))->select_dp_pais_id(cols: 6, con_registros:true,
            id_selected:$row->dp_pais_id,link: $link);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select',data:  $select);

        }

        $data = new stdClass();
        $data->row = $row;
        $data->select = $select;
        return $data;
    }

}
