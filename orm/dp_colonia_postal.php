<?php
namespace gamboamartin\direccion_postal\models;
use base\orm\_defaults;
use base\orm\modelo;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class dp_colonia_postal extends _base {
    public function __construct(PDO $link){
        $tabla = 'dp_colonia_postal';
        $columnas = array($tabla=>false,'dp_cp'=>$tabla,'dp_colonia'=>$tabla,'dp_municipio'=>'dp_cp',
            'dp_estado'=>'dp_municipio','dp_pais'=>'dp_estado');
        $campos_obligatorios[] = 'descripcion';

        $campos_view['dp_colonia_id'] = array('type' => 'selects', 'model' => new dp_colonia($link));
        $campos_view['codigo'] = array('type' => 'inputs');
        $campos_view['descripcion'] = array('type' => 'inputs');

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas,campos_view: $campos_view);

        $this->NAMESPACE = __NAMESPACE__;

        $this->etiqueta = 'Colonia Postal';

        if(!isset($_SESSION['init'][$tabla])) {

            if(isset($_SESSION['init']['dp_colonia'])){
                unset($_SESSION['init']['dp_colonia']);
            }
            if(isset($_SESSION['init']['dp_cp'])){
                unset($_SESSION['init']['dp_cp']);
            }
            new dp_colonia(link: $this->link);
            new dp_cp(link: $this->link);

            $catalogo = array();
            $catalogo[] = array('id'=>'28733','codigo' => '45010-28733', 'descripcion' => '45010-28733','dp_cp_id'=>'45010','dp_colonia_id'=>'28733');
            $catalogo[] = array('id'=>'45812','codigo' => '45580-45812', 'descripcion' => '45580-45812','dp_cp_id'=>'45580','dp_colonia_id'=>'45812');
            $catalogo[] = array('id'=>'110706','codigo' => '45580-110706', 'descripcion' => '45580-110706','dp_cp_id'=>'45580','dp_colonia_id'=>'110706');


            $r_alta_bd = (new _defaults())->alta_defaults(catalogo: $catalogo, entidad: $this);
            if (errores::$error) {
                $error = $this->error->error(mensaje: 'Error al insertar', data: $r_alta_bd);
                print_r($error);
                exit;
            }
            $_SESSION['init'][$tabla] = true;
        }

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
            return $this->error->error(mensaje: 'Error al  insertar colonia postal',data:  $r_alta_bd);
        }
        return $r_alta_bd;
    }

    protected function campos_base_temp(array $data, modelo $modelo, int $id = -1,
                                   array  $keys_integra_ds = array('codigo','descripcion')): array
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

        if(!isset($data['codigo'])){
            $data['codigo'] =  $cp['dp_cp_descripcion'].' '.$colonia['dp_colonia_descripcion'];
        }

        if(!isset($data['codigo_bis'])){
            $keys = array('codigo');
            $valida = $this->validacion->valida_existencia_keys(keys:$keys,registro:  $data);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al validar data',data:  $valida);
            }

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

    /**
     * Obtiene los datos de colonia postal
     * @param int $dp_colonia_postal_id Identificar
     * @return array|stdClass
     * @version 1.10.7
     */
    public function get_colonia_postal(int $dp_colonia_postal_id): array|stdClass
    {
        if($dp_colonia_postal_id <= 0){
            return $this->error->error(
                mensaje: 'Error al dp_colonia_postal_id debe ser mayor a 0',data:  $dp_colonia_postal_id);
        }
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

        $registro = $this->campos_base_temp(data:$registro, modelo: $this);
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

    private function init_upd(int $id, array $registro): array
    {
        $registro = $this->modifica_bd_init_data(id: $id, registro: $registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al incializar registro',data:  $registro);
        }

        $keys = array('dp_cp_id','dp_colonia_id');
        $valida = $this->validacion->valida_ids(keys:$keys,registro:  $registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar registro',data:  $valida);
        }

        $registro = $this->campos_base_temp(data:$registro, modelo: $this, id: $id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar campo base',data: $registro);
        }

        $registro = $this->limpia_campos(registro: $registro, campos_limpiar: array('dp_pais_id','dp_estado_id',
            'dp_municipio_id'));
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al limpiar campos', data: $registro);
        }
        return $registro;
    }

    private function integra_dp_colonia_id_predeterminado(array $registro): array
    {
        $r_pred = (new dp_colonia(link: $this->link))->inserta_predeterminado();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al insertar prederminado',data:  $r_pred);
        }

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

        $r_pred = (new dp_cp(link: $this->link))->inserta_predeterminado();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al insertar prederminado',data:  $r_pred);
        }

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
        $registro = $this->init_upd(id: $id,registro:  $registro);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al inicializar campos', data: $registro);
        }

        $r_modifica_bd = parent::modifica_bd($registro, $id, $reactiva);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al modificar cp',data:  $r_modifica_bd);
        }

        return $r_modifica_bd;
    }

    private function modifica_bd_init(array $registro, stdClass $registro_previo): array
    {
        if(!isset($registro['dp_cp_id'])){
            $registro['dp_cp_id'] = $registro_previo->dp_cp_id;
        }
        if(!isset($registro['dp_colonia_id'])){
            $registro['dp_colonia_id'] = $registro_previo->dp_colonia_id;
        }
        if(!isset($registro['codigo'])){
            $registro['codigo'] = $registro_previo->dp_colonia_postal_codigo;
        }
        if(!isset($registro['descripcion'])){
            $registro['descripcion'] = $registro_previo->dp_colonia_postal_descripcion;
        }
        return  $registro;
    }

    private function modifica_bd_init_data(int $id, array $registro): array
    {
        $registro_previo = $this->registro(registro_id: $id, retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener registro',data:  $registro_previo);
        }

        $registro = $this->modifica_bd_init(registro: $registro,registro_previo:  $registro_previo);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al incializar registro',data:  $registro);
        }
        return $registro;
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