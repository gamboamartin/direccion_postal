<?php
namespace gamboamartin\direccion_postal\models;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class dp_pais extends _model_base {
    public function __construct(PDO $link){
        $tabla = 'dp_pais';
        $columnas = array($tabla=>false);
        $campos_obligatorios[] = 'descripcion';
        $campos_obligatorios[] = 'descripcion_select';

        $campos_view['codigo'] = array('type' => 'inputs');
        $campos_view['descripcion'] = array('type' => 'inputs');

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas, campos_view: $campos_view);
        $this->NAMESPACE = __NAMESPACE__;
    }

    public function alta_bd(): array|stdClass
    {
        $this->registro = $this->campos_base(data:$this->registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar campo base',data: $this->registro);
        }

        $r_alta_bd =  parent::alta_bd();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al insertar pais', data: $r_alta_bd);
        }
        return $r_alta_bd;
    }



    public function modifica_bd(array $registro, int $id, bool $reactiva = false): array|stdClass
    {


        $registro = $this->campos_base(data:$registro, id: $id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar campo base',data: $registro);
        }

        $r_modifica_bd = parent::modifica_bd($registro, $id, $reactiva); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al modificar cp',data:  $r_modifica_bd);
        }

        return $r_modifica_bd;
    }

}