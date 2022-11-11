<?php
namespace gamboamartin\direccion_postal\models;
use base\orm\modelo;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class dp_colonia_postal extends modelo{
    public function __construct(PDO $link){
        $tabla = 'dp_colonia_postal';
        $columnas = array($tabla=>false,'dp_cp'=>$tabla,'dp_colonia'=>$tabla,'dp_municipio'=>'dp_cp',
            'dp_estado'=>'dp_municipio','dp_pais'=>'dp_estado');
        $campos_obligatorios[] = 'descripcion';

        $campos_view['dp_pais_id'] = array('type' => 'selects', 'model' => new dp_pais($link));
        $campos_view['dp_estado_id'] = array('type' => 'selects', 'model' => new dp_estado($link));
        $campos_view['dp_municipio_id'] = array('type' => 'selects', 'model' => new dp_municipio($link));
        $campos_view['dp_cp_id'] = array('type' => 'selects', 'model' => new dp_cp($link));
        $campos_view['dp_colonia_id'] = array('type' => 'selects', 'model' => new dp_colonia($link));
        $campos_view['codigo'] = array('type' => 'inputs');
        $campos_view['descripcion'] = array('type' => 'inputs');

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas,campos_view: $campos_view);

        $this->NAMESPACE = __NAMESPACE__;
    }

    public function alta_bd(): array|stdClass
    {
        $this->registro = $this->campos_base(data:$this->registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar campo base',data: $this->registro);
        }

        if(!isset($this->registro['dp_cp_id'])){
            $dp_cp_id = (new dp_cp($this->link))->id_predeterminado();
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al obtener cp predeterminado',data:  $dp_cp_id);
            }
            $this->registro['dp_cp_id'] = $dp_cp_id;
        }

        if(!isset($this->registro['dp_colonia_id'])){
            $dp_colonia_id = (new dp_colonia($this->link))->id_predeterminado();
            if(errores::$error){
                return $this->error->error(
                    mensaje: 'Error al obtener dp_colonia predeterminado',data:  $dp_colonia_id);
            }
            $this->registro['dp_colonia_id'] = $dp_colonia_id;
        }

        $this->registro = $this->limpia_campos(registro: $this->registro, campos_limpiar: array('dp_pais_id','dp_estado_id',
            'dp_municipio_id'));
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al limpiar campos', data: $this->registro);
        }

        $r_alta_bd = parent::alta_bd();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al  insertar municipio',data:  $r_alta_bd);
        }
        return $r_alta_bd;
    }

    private function campos_base(array $data): array
    {
        $cp = (new dp_cp($this->link))->get_cp($data['dp_cp_id']);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al obtener CP',data:  $cp);
        }

        $colonia = (new dp_colonia($this->link))->get_colonia($data['dp_colonia_id']);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al obtener colonia',data:  $cp);
        }

        if(!isset($data['codigo_bis'])){
            $data['codigo_bis'] =  $data['codigo'];
        }

        if(!isset($data['descripcion'])){
            $data['descripcion'] =  "{$colonia['dp_colonia_descripcion']} - {$cp['dp_cp_descripcion']}";
        }

        if(!isset($data['descripcion_select'])){
            $ds = str_replace("_"," ",$data['descripcion']);
            $ds = ucwords($ds);
            $data['descripcion_select'] =  "{$data['codigo']} - {$ds}";
        }

        if(!isset($data['alias'])){
            $data['alias'] = $data['codigo'];
        }
        return $data;
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
        $registro = $this->campos_base(data:$registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar campo base',data: $registro);
        }

        $registro = $this->limpia_campos(registro: $registro, campos_limpiar: array('dp_pais_id','dp_estado_id',
            'dp_municipio_id'));
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al limpiar campos', data: $registro);
        }

        $r_modifica_bd = parent::modifica_bd($registro, $id, $reactiva);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al modificar cp',data:  $r_modifica_bd);
        }

        return $r_modifica_bd;
    }
}