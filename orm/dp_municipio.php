<?php
namespace gamboamartin\direccion_postal\models;
use base\orm\_defaults;
use base\orm\modelo;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class dp_municipio extends modelo {
    public function __construct(PDO $link){
        $tabla = 'dp_municipio';
        $columnas = array($tabla=>false,'dp_estado'=>$tabla,'dp_pais'=>'dp_estado');
        $campos_obligatorios[] = 'descripcion';
        $campos_obligatorios[] = 'descripcion_select';
        $campos_obligatorios[] = 'dp_estado_id';

        $campos_view['dp_pais_id'] = array('type' => 'selects', 'model' => new dp_pais($link));
        $campos_view['dp_estado_id'] = array('type' => 'selects', 'model' => new dp_estado($link));
        $campos_view['codigo'] = array('type' => 'inputs');
        $campos_view['descripcion'] = array('type' => 'inputs');

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas,campos_view: $campos_view);

        $this->NAMESPACE = __NAMESPACE__;
        $this->etiqueta = 'Municipio';

        /*
        if(!isset($_SESSION['init'][$tabla])) {
            $descripcion = 'JALISCO';
            if(isset($_SESSION['init']['dp_estado'])){
                unset($_SESSION['init']['dp_estado']);
            }

            $r_dp_estado = (new dp_estado(link: $this->link))->registro_by_descripcion(descripcion: $descripcion);
            if (errores::$error) {
                $error = $this->error->error(mensaje: 'Error al obtener estado', data: $r_dp_estado);
                print_r($error);
                exit;
            }
            $dp_estado = $r_dp_estado->registros[0];

            $catalago = array();
            $catalago[] = array('codigo' => 'ZAP', 'descripcion' => 'ZAPOPAN', 'dp_estado_id' => $dp_estado['dp_estado_id']);
            $catalago[] = array('codigo' => 'GDL', 'descripcion' => 'GUADALAJARA', 'dp_estado_id' => $dp_estado['dp_estado_id']);
            $catalago[] = array('codigo' => 'TLQ', 'descripcion' => 'TLAQUEPAQUE', 'dp_estado_id' => $dp_estado['dp_estado_id']);


            $r_alta_bd = (new _defaults())->alta_defaults(catalago: $catalago, entidad: $this);
            if (errores::$error) {
                $error = $this->error->error(mensaje: 'Error al insertar', data: $r_alta_bd);
                print_r($error);
                exit;
            }
            $_SESSION['init'][$tabla] = true;
        }
        */


    }

    public function alta_bd(): array|stdClass
    {
        $this->registro = $this->campos_base(data:$this->registro, modelo: $this);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar campo base',data: $this->registro);
        }

        $this->registro = $this->limpia_campos(registro: $this->registro, campos_limpiar: array('dp_pais_id'));
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al limpiar campos', data: $this->registro);
        }

        if(!isset($this->registro['dp_estado_id'])){

            $r_pred = (new dp_estado(link: $this->link))->inserta_predeterminado();
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al insertar prederminado',data:  $r_pred);
            }

            $dp_estado_id = (new dp_estado($this->link))->id_predeterminado();
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al obtener estado predeterminado',data:  $dp_estado_id);
            }
            $this->registro['dp_estado_id'] = $dp_estado_id;
        }

        $r_alta_bd = parent::alta_bd();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al  insertar municipio',data:  $r_alta_bd);
        }
        return $r_alta_bd;
    }


    public function get_municipio(int $dp_municipio_id): array|stdClass
    {
        $registro = $this->registro(registro_id: $dp_municipio_id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener estado',data:  $registro);
        }

        return $registro;
    }

    private function limpia_campos(array $registro, array $campos_limpiar): array
    {
        foreach ($campos_limpiar as $valor) {
            if (isset($registro[$valor])) {
                unset($registro[$valor]);
            }
        }
        return $registro;
    }

    public function modifica_bd(array $registro, int $id, bool $reactiva = false): array|stdClass
    {
        $registro = $this->campos_base(data: $registro, modelo: $this, id: $id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar campo base',data: $registro);
        }

        $registro = $this->limpia_campos(registro: $registro, campos_limpiar: array('dp_pais_id'));
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al limpiar campos', data: $registro);
        }

        $r_modifica_bd = parent::modifica_bd($registro, $id, $reactiva);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al modificar municipio',data:  $r_modifica_bd);
        }
        return $r_modifica_bd;
    }
}