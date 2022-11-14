<?php
namespace gamboamartin\direccion_postal\models;
use base\orm\modelo;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class dp_calle_pertenece extends modelo{
    public function __construct(PDO $link){
        $tabla = 'dp_calle_pertenece';
        $columnas = array($tabla=>false,'dp_colonia_postal'=>$tabla,'dp_calle'=>$tabla,'dp_cp'=>'dp_colonia_postal',
            'dp_colonia'=>'dp_colonia_postal','dp_municipio'=>'dp_cp','dp_estado'=>'dp_municipio','dp_pais'=>'dp_estado');
        $campos_obligatorios[] = 'descripcion';

        $campos_view['dp_pais_id'] = array('type' => 'selects', 'model' => new dp_pais($link));
        $campos_view['dp_estado_id'] = array('type' => 'selects', 'model' => new dp_estado($link));
        $campos_view['dp_municipio_id'] = array('type' => 'selects', 'model' => new dp_municipio($link));
        $campos_view['dp_cp_id'] = array('type' => 'selects', 'model' => new dp_cp($link));
        $campos_view['dp_colonia_postal_id'] = array('type' => 'selects', 'model' => new dp_colonia_postal($link));
        $campos_view['dp_calle_id'] = array('type' => 'selects', 'model' => new dp_calle($link));
        $campos_view['codigo'] = array('type' => 'inputs');
        $campos_view['georeferencia'] = array('type' => 'inputs');

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

        if(!isset($this->registro['dp_calle_id']) || (int)$this->registro['dp_calle_id'] === -1){
            $dp_calle_id = (new dp_calle($this->link))->id_predeterminado();
            if(errores::$error){
                return $this->error->error(
                    mensaje: 'Error al obtener dp_calle_id predeterminado',data:  $dp_calle_id);
            }
            $this->registro['dp_calle_id'] = $dp_calle_id;
        }

        if(!isset($this->registro['dp_colonia_postal_id']) || (int)$this->registro['dp_colonia_postal_id'] === -1){
            $dp_colonia_postal_id = (new dp_colonia_postal($this->link))->id_predeterminado();
            if(errores::$error){
                return $this->error->error(
                    mensaje: 'Error al obtener dp_colonia_postal_id predeterminado',data:  $dp_colonia_postal_id);
            }
            $this->registro['dp_colonia_postal_id'] = $dp_colonia_postal_id;
        }

        $this->registro = $this->limpia_campos(registro: $this->registro, campos_limpiar: array('dp_pais_id',
            'dp_estado_id', 'dp_municipio_id','dp_cp_id'));
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al limpiar campos', data: $this->registro);
        }

        $r_alta_bd = parent::alta_bd();
        if(errores::$error){
            return $this->error->error(mensaje:  'Error al dar de alta registro', data: $r_alta_bd);
        }
        return $r_alta_bd;
    }

    private function campos_base(array $data): array
    {
        $colonia_postal = (new dp_colonia_postal($this->link))->get_colonia_postal($data['dp_colonia_postal_id']);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al obtener colonia postal',data:  $colonia_postal);
        }

        $calle = (new dp_calle($this->link))->get_calle($data['dp_calle_id']);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al obtener calle',data:  $calle);
        }

        if(!isset($data['codigo_bis'])){
            $data['codigo_bis'] =  $data['codigo'];
        }

        if(!isset($data['descripcion'])){
            $data['descripcion'] =  "{$calle['dp_calle_descripcion']} - {$colonia_postal['dp_colonia_postal_descripcion']}";
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

    public function get_calle_pertenece_default_id(): array|stdClass|int
    {
        $id_predeterminado = $this->id_predeterminado();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener el puesto predeterminado',data:  $id_predeterminado);
        }

        return (int)$id_predeterminado;
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
            'dp_municipio_id','dp_cp_id'));
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al limpiar campos', data: $registro);
        }

        $r_modifica_bd = parent::modifica_bd($registro, $id, $reactiva); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al modificar calle pertenece',data:  $r_modifica_bd);
        }

        return $r_modifica_bd;
    }


    /**
     * Genera un objeto con todos los elementos de una calle como elemento atomico de domicilios a nivel datos
     * @param int $dp_calle_pertenece_id Identificador de calle_pertenece
     * @return stdClass|array $data->pais, $data->estado, $data->municipio, $data->cp, $data->colonia, $data->colonia_postal
     * $data->calle, $data->calle_pertenece
     * @version 0.115.8
     */
    public function objs_direcciones(int $dp_calle_pertenece_id): stdClass|array
    {
        if($dp_calle_pertenece_id <=0){
            return $this->error->error(mensaje: 'Error $dp_calle_pertenece_id debe ser mayor a 0',
                data:  $dp_calle_pertenece_id);
        }
        $dp_calle_pertenece = $this->registro(
            registro_id: $dp_calle_pertenece_id, columnas_en_bruto: true,retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener calle pertenece',data:  $dp_calle_pertenece);
        }

        $dp_calle = (new dp_calle($this->link))->registro(
            registro_id: $dp_calle_pertenece->dp_calle_id, columnas_en_bruto: true,retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener $dp_calle',data:  $dp_calle);
        }

        $dp_colonia_postal = (new dp_colonia_postal($this->link))->registro(
            registro_id: $dp_calle_pertenece->dp_colonia_postal_id, columnas_en_bruto: true,retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener $dp_colonia_postal',data:  $dp_colonia_postal);
        }

        $dp_colonia = (new dp_colonia($this->link))->registro(
            registro_id: $dp_colonia_postal->dp_colonia_id, columnas_en_bruto: true,retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener $dp_colonia',data:  $dp_colonia);
        }

        $dp_cp = (new dp_cp($this->link))->registro(
            registro_id: $dp_colonia_postal->dp_cp_id, columnas_en_bruto: true,retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener $dp_cp',data:  $dp_cp);
        }

        $dp_municipio = (new dp_municipio($this->link))->registro(
            registro_id: $dp_cp->dp_municipio_id, columnas_en_bruto: true,retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener $dp_municipio',data:  $dp_municipio);
        }

        $dp_estado = (new dp_estado($this->link))->registro(registro_id: $dp_municipio->dp_estado_id,
            columnas_en_bruto: true,retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener estado',data:  $dp_estado);
        }
        $dp_pais = (new dp_pais($this->link))->registro(registro_id: $dp_estado->dp_pais_id,
            columnas_en_bruto: true,retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener pais',data:  $dp_pais);
        }

        $data = new stdClass();

        $data->pais = $dp_pais;
        $data->estado = $dp_estado;
        $data->municipio = $dp_municipio;
        $data->cp = $dp_cp;
        $data->colonia = $dp_colonia;
        $data->colonia_postal = $dp_colonia_postal;
        $data->calle = $dp_calle;
        $data->calle_pertenece = $dp_calle_pertenece;

        return $data;

    }


}