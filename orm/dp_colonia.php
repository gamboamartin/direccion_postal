<?php
namespace gamboamartin\direccion_postal\models;
use base\orm\_defaults;
use base\orm\_modelo_parent;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class dp_colonia extends _modelo_parent {
    public function __construct(PDO $link){
        $tabla = 'dp_colonia';
        $columnas = array($tabla=>false);
        $campos_obligatorios[] = 'descripcion';

        $campos_view['descripcion'] = array('type' => 'inputs');


        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas,campos_view: $campos_view);

        $this->NAMESPACE = __NAMESPACE__;

        $this->etiqueta = 'Colonia';


        if(!isset($_SESSION['init'][$tabla])) {
            $catalogo = array();

            $catalogo[] = array('codigo' => '8981', 'descripcion' => 'Eligio Esquivel');
            $catalogo[] = array('codigo' => '9107', 'descripcion' => 'Fronteriza');
            $catalogo[] = array('codigo' => '9355', 'descripcion' => 'Santa Clara');
            $catalogo[] = array('codigo' => '28733', 'descripcion' => 'Ciudad Granja');
            $catalogo[] = array('codigo' => '45812', 'descripcion' => 'Residencial Revolución');

            $catalogo[] = array('codigo' => '100108', 'descripcion' => 'Ficus');

            $catalogo[] = array('codigo' => '110706', 'descripcion' => 'Revolución');


            foreach ($catalogo as $key=>$row){
                $catalogo[$key]['id'] = (int)$row['codigo'];
            }

            $r_alta_bd = (new _defaults())->alta_defaults(catalogo: $catalogo, entidad: $this);
            if (errores::$error) {
                $error = $this->error->error(mensaje: 'Error al insertar', data: $r_alta_bd);
                print_r($error);
                exit;
            }
            $_SESSION['init'][$tabla] = true;
        }


    }


    /**
     * Obtiene una colonia en base a su id
     * @param int $dp_colonia_id Identificador de colonia
     * @return array|stdClass
     * @version 1.9.6
     */
    public function get_colonia(int $dp_colonia_id): array|stdClass
    {
        if($dp_colonia_id <=0 ){
            return $this->error->error(mensaje: 'Error dp_colonia_id debe ser mayor a 0',data:  $dp_colonia_id);
        }
        $registro = $this->registro(registro_id: $dp_colonia_id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener colonia',data:  $registro);
        }

        return $registro;
    }

}