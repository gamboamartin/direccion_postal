<?php
namespace gamboamartin\direccion_postal\models;
use base\orm\_defaults;
use base\orm\modelo;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class dp_cp extends modelo {

    public function __construct(PDO $link){
        $tabla = 'dp_cp';
        $columnas = array($tabla=>false,'dp_municipio'=>$tabla,'dp_estado'=>'dp_municipio','dp_pais'=>'dp_estado');
        $campos_obligatorios[] = 'descripcion';
        $campos_obligatorios[] = 'descripcion_select';

        $tipo_campos['codigo'] = 'cod_int_0_5_numbers';
        $tipo_campos['descripcion'] = 'cod_int_0_5_numbers';

        $campos_view['dp_pais_id'] = array('type' => 'selects', 'model' => new dp_pais($link));
        $campos_view['dp_estado_id'] = array('type' => 'selects', 'model' => new dp_estado($link));
        $campos_view['dp_municipio_id'] = array('type' => 'selects', 'model' => new dp_municipio($link));
        $campos_view['codigo'] = array('type' => 'inputs');
        $campos_view['descripcion'] = array('type' => 'inputs');
        $campos_view['georeferencia'] = array('type' => 'inputs');

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas,campos_view: $campos_view);

        $this->NAMESPACE = __NAMESPACE__;

        $this->etiqueta = 'CP';


        if(!isset($_SESSION['init'][$tabla])) {


            if(isset($_SESSION['init']['dp_municipio'])){
                unset($_SESSION['init']['dp_municipio']);
            }
            new dp_municipio(link: $this->link);

            $catalago = array();


            $catalago[] = array('codigo' => '03000', 'descripcion' => '03000', 'dp_municipio_id' => '394');

            $catalago[] = array('codigo' => '21110', 'descripcion' => '21110', 'dp_municipio_id' => '33');
            $catalago[] = array('codigo' => '24080', 'descripcion' => '24080', 'dp_municipio_id' => '35');
            $catalago[] = array('codigo' => '28047', 'descripcion' => '28047', 'dp_municipio_id' => '37');

            $catalago[] = array('codigo' => '45010', 'descripcion' => '45010', 'dp_municipio_id' => '1805');
            $catalago[] = array('codigo' => '45580', 'descripcion' => '45580', 'dp_municipio_id' => '1649');


            $catalago[] = array('codigo' => '54893', 'descripcion' => '54893', 'dp_municipio_id' => '1178');
            $catalago[] = array('codigo' => '61700', 'descripcion' => '61700', 'dp_municipio_id' => '1751');
            $catalago[] = array('codigo' => '68010', 'descripcion' => '68010', 'dp_municipio_id' => '1368');
            $catalago[] = array('codigo' => '76840', 'descripcion' => '76840', 'dp_municipio_id' => '459');
            $catalago[] = array('codigo' => '78485', 'descripcion' => '78485', 'dp_municipio_id' => '577');
            $catalago[] = array('codigo' => '82532', 'descripcion' => '82532', 'dp_municipio_id' => '271');

            $catalago[] = array('codigo' => '91779', 'descripcion' => '91779', 'dp_municipio_id' => '2043');

            $catalago[] = array('codigo' => '95803', 'descripcion' => '95803', 'dp_municipio_id' => '1887');





            foreach ($catalago as $key=>$row){
                $catalago[$key]['id'] = (int)$row['codigo'];
            }

            $r_alta_bd = (new _defaults())->alta_defaults(catalogo: $catalago, entidad: $this);
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

        $keys = array('descripcion');
        $valida = $this->validacion->valida_existencia_keys(keys:$keys,registro:  $this->registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar registro', data: $valida);
        }

        if(!isset($this->registro['codigo'])){
            $this->registro['codigo'] = $this->registro['descripcion'];
        }

        $registro = $this->init_alta_bd(registro: $this->registro);
        if(errores::$error) {
            return $this->error->error(
                mensaje: 'Error al integrar predeterminados', data: $registro);
        }
        $this->registro = $registro;


        $r_alta_bd =  parent::alta_bd(); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al insertar cp', data: $r_alta_bd);
        }
        return $r_alta_bd;
    }



    private function dp_municipio_id_predeterminado(array $registro): array
    {

        if(!isset($registro['dp_municipio_id']) || (int)$registro['dp_municipio_id'] === -1){
            $registro = $this->integra_dp_municipio_id_predeterminado(registro: $registro);
            if(errores::$error){
                return $this->error->error(
                    mensaje: 'Error al integrar dp_municipio_id predeterminado',data:  $registro);
            }
        }
        return $registro;
    }

    /**
     * Obtiene el codigo postal desde un id
     * @param int $dp_cp_id Identificador cd cp
     * @return array|stdClass
     * @version 1.6.6
     */
    public function get_cp(int $dp_cp_id): array|stdClass
    {
        if($dp_cp_id <= 0){
            return $this->error->error(mensaje: 'Error dp_cp_id debe ser mayor a 0',data:  $dp_cp_id);
        }
        $registro = $this->registro(registro_id: $dp_cp_id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener CP',data:  $registro);
        }

        return $registro;
    }

    private function init_alta_bd(array $registro): array
    {
        $keys = array('descripcion','codigo');
        $valida = $this->validacion->valida_existencia_keys(keys:$keys,registro:  $registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar registro', data: $valida);
        }

        $registro = $this->predeterminados(registro: $registro);
        if(errores::$error) {
            return $this->error->error(
                mensaje: 'Error al integrar predeterminados', data: $registro);
        }

        $keys = array('dp_municipio_id');
        $valida = $this->validacion->valida_ids(keys: $keys, registro: $registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar modelo->registro',data:  $valida);
        }

        $registro = $this->campos_base(data:$registro, modelo: $this);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar campo base',data: $registro);
        }

        $registro = $this->limpia_campos(registro: $registro, campos_limpiar: array('dp_pais_id', 'dp_estado_id'));
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al limpiar campos', data: $registro);
        }


        return $registro;
    }

    private function integra_dp_municipio_id_predeterminado(array $registro): array
    {
        $r_pred = (new dp_municipio(link: $this->link))->inserta_predeterminado();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al insertar prederminado',data:  $r_pred);
        }

        $dp_municipio_id = (new dp_municipio($this->link))->id_predeterminado();
        if(errores::$error){
            return $this->error->error(
                mensaje: 'Error al obtener dp_municipio_id predeterminado',data:  $dp_municipio_id);
        }
        $registro['dp_municipio_id'] = $dp_municipio_id;
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

        $registro = $this->limpia_campos(registro: $registro, campos_limpiar: array('dp_pais_id','dp_estado_id'));
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
        $registro = $this->dp_municipio_id_predeterminado(registro: $registro);
        if(errores::$error) {
            return $this->error->error(
                mensaje: 'Error al integrar dp_municipio_id predeterminado', data: $registro);
        }

        return $registro;
    }
}