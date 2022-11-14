<?php
namespace gamboamartin\direccion_postal\models;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class dp_colonia_postal extends _model_base {
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

        $registro = $this->init_alta_bd(registro: $this->registro);
        if(errores::$error) {
            return $this->error->error(
                mensaje: 'Error al integrar predeterminados', data: $registro);
        }
        $this->registro = $registro;

        $r_alta_bd = parent::alta_bd();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al  insertar municipio',data:  $r_alta_bd);
        }
        return $r_alta_bd;
    }

    protected function campos_base(array $data): array
    {

        $keys = array('dp_cp_id','dp_colonia_id');
        $valida = $this->validacion->valida_ids(keys:$keys,registro:  $data);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar data',data:  $valida);
        }

        $cp = (new dp_cp($this->link))->get_cp(dp_cp_id: $data['dp_cp_id']);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener CP',data:  $cp);
        }

        $colonia = (new dp_colonia($this->link))->get_colonia(dp_colonia_id: $data['dp_colonia_id']);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener colonia',data:  $cp);
        }

        if(!isset($data['codigo_bis'])){
            $data['codigo_bis'] =  $data['codigo'];
        }

        if(!isset($data['descripcion'])){
            $data['descripcion'] =  "{$colonia['dp_colonia_descripcion']} - {$cp['dp_cp_descripcion']}";
        }

        $data = $this->data_base(data: $data);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al integrar data base', data: $data);
        }
        return $data;
    }

    private function dp_colonia_id_predeterminado(array $registro): array
    {

        if(!isset($registro['dp_colonia_id']) || (int)$registro['dp_colonia_id'] === -1){
            $registro = $this->integra_dp_colonia_id_predeterminado(registro: $registro);
            if(errores::$error){
                return $this->error->error(
                    mensaje: 'Error al integrar dp_colonia_id predeterminado',data:  $registro);
            }
        }
        return $registro;
    }

    private function dp_cp_id_predeterminado(array $registro): array
    {

        if(!isset($registro['dp_cp_id']) || (int)$registro['dp_cp_id'] === -1){
            $registro = $this->integra_dp_cp_id_predeterminado(registro: $registro);
            if(errores::$error){
                return $this->error->error(
                    mensaje: 'Error al integrar dp_calle_id predeterminado',data:  $registro);
            }
        }
        return $registro;
    }

    public function get_colonia_postal(int $dp_colonia_postal_id): array|stdClass
    {
        $registro = $this->registro(registro_id: $dp_colonia_postal_id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener colonia',data:  $registro);
        }

        return $registro;
    }

    private function init_alta_bd(array $registro): array
    {
        $registro = $this->predeterminados(registro: $registro);
        if(errores::$error) {
            return $this->error->error(
                mensaje: 'Error al integrar predeterminados', data: $registro);
        }

        $keys = array('dp_cp_id','dp_colonia_id');
        $valida = $this->validacion->valida_ids(keys: $keys, registro: $registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar modelo->registro',data:  $valida);
        }

        $registro = $this->campos_base(data:$registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar campo base',data: $registro);
        }

        $registro = $this->limpia_campos(registro: $registro, campos_limpiar: array('dp_pais_id',
            'dp_estado_id', 'dp_municipio_id'));
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al limpiar campos', data: $registro);
        }
        return $registro;
    }

    private function integra_dp_colonia_id_predeterminado(array $registro): array
    {
        $dp_colonia_id = (new dp_colonia($this->link))->id_predeterminado();
        if(errores::$error){
            return $this->error->error(
                mensaje: 'Error al obtener dp_colonia_id predeterminado',data:  $dp_colonia_id);
        }
        $registro['dp_colonia_id'] = $dp_colonia_id;
        return $registro;
    }

    private function integra_dp_cp_id_predeterminado(array $registro): array
    {
        $dp_cp_id = (new dp_cp($this->link))->id_predeterminado();
        if(errores::$error){
            return $this->error->error(
                mensaje: 'Error al obtener dp_cp_id predeterminado',data:  $dp_cp_id);
        }
        $registro['dp_cp_id'] = $dp_cp_id;
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

        $keys = array('dp_cp_id','dp_colonia_id');
        $valida = $this->validacion->valida_ids(keys:$keys,registro:  $registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar registro',data:  $valida);
        }

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

    private function predeterminados(array $registro): array
    {
        $registro = $this->dp_cp_id_predeterminado(registro: $registro);
        if(errores::$error) {
            return $this->error->error(
                mensaje: 'Error al integrar dp_calle_id predeterminado', data: $registro);
        }

        $registro = $this->dp_colonia_id_predeterminado(registro: $registro);
        if(errores::$error) {
            return $this->error->error(
                mensaje: 'Error al integrar dp_colonia_postal_id predeterminado', data: $registro);
        }
        return $registro;
    }
}