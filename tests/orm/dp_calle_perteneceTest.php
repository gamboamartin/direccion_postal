<?php
namespace tests\orm;

use gamboamartin\errores\errores;
use gamboamartin\test\test;
use JsonException;


use models\dp_calle_pertenece;
use models\dp_colonia;
use models\dp_colonia_postal;
use models\dp_cp;
use models\dp_estado;
use models\dp_municipio;
use models\dp_pais;
use stdClass;


class dp_calle_perteneceTest extends test {
    public errores $errores;
    private stdClass $paths_conf;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->errores = new errores();
        $this->paths_conf = new stdClass();
        $this->paths_conf->generales = '/var/www/html/cat_sat/config/generales.php';
        $this->paths_conf->database = '/var/www/html/cat_sat/config/database.php';
        $this->paths_conf->views = '/var/www/html/cat_sat/config/views.php';
    }

    /**
     * @throws JsonException
     */
    public function test_objs_direcciones(): void
    {
        errores::$error = false;
        $_GET['session_id'] = 1;
        $_GET['seccion'] = 'dp_estado';
        $_SESSION['usuario_id'] = 1;
        $modelo = new dp_calle_pertenece($this->link);


        $del_calle_pertenece = (new dp_calle_pertenece($this->link))->elimina_todo();
        if(errores::$error){
            $error = (new errores())->error('Error al eliminar calle_pertenece', $del_calle_pertenece);
            print_r($error);exit;
        }

        $del_colonia_postal = (new dp_colonia_postal($this->link))->elimina_todo();
        if(errores::$error){
            $error = (new errores())->error('Error al eliminar colonia_postal', $del_colonia_postal);
            print_r($error);exit;
        }

        $del_cp = (new dp_cp($this->link))->elimina_todo();
        if(errores::$error){
            $error = (new errores())->error('Error al eliminar cp', $del_cp);
            print_r($error);exit;
        }

        $del_municipio = (new dp_municipio($this->link))->elimina_todo();
        if(errores::$error){
            $error = (new errores())->error('Error al eliminar municipio', $del_municipio);
            print_r($error);exit;
        }

        $del_estado = (new dp_estado($this->link))->elimina_todo();
        if(errores::$error){
            $error = (new errores())->error('Error al eliminar estado', $del_estado);
            print_r($error);exit;
        }

        $del_pais = (new dp_pais($this->link))->elimina_todo();
        if(errores::$error){
            $error = (new errores())->error('Error al eliminar pais', $del_pais);
            print_r($error);exit;
        }

        $del_colonia = (new dp_colonia($this->link))->elimina_todo();
        if(errores::$error){
            $error = (new errores())->error('Error al eliminar colonia', $del_colonia);
            print_r($error);exit;
        }


        $dp_calle_pertenece_id = 1;
        $resultado = $modelo->objs_direcciones($dp_calle_pertenece_id);
        $this->assertIsArray($resultado);
        $this->assertTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase("Error al obtener calle pertenece",$resultado['mensaje']);

        errores::$error = false;

        $pais['id'] = 1;
        $pais['codigo'] = 1;
        $pais['descripcion'] = 1;
        $pais['descripcion_select'] = 1;
        $inserta_pais = (new dp_pais($this->link))->alta_registro($pais);
        if(errores::$error){
            $error = (new errores())->error('Error al $inserta_pais', $inserta_pais);
            print_r($error);exit;
        }

        $estado['id'] = 1;
        $estado['codigo'] = 1;
        $estado['descripcion'] = 1;
        $estado['descripcion_select'] = 1;
        $estado['dp_pais_id'] = 1;
        $inserta_estado = (new dp_estado($this->link))->alta_registro($estado);
        if(errores::$error){
            $error = (new errores())->error('Error al $inserta_estado', $inserta_estado);
            print_r($error);exit;
        }

        $municipio['id'] = 1;
        $municipio['codigo'] = 1;
        $municipio['descripcion'] = 1;
        $municipio['descripcion_select'] = 1;
        $municipio['dp_estado_id'] = 1;
        $inserta_municipio = (new dp_municipio($this->link))->alta_registro($municipio);
        if(errores::$error){
            $error = (new errores())->error('Error al $inserta_municipio', $inserta_municipio);
            print_r($error);exit;
        }

        $cp['id'] = 1;
        $cp['codigo'] = 1;
        $cp['descripcion'] = 1;
        $cp['dp_municipio_id'] = 1;
        $cp['descripcion_select'] = 1;
        $inserta_cp = (new dp_cp($this->link))->alta_registro($cp);
        if(errores::$error){
            $error = (new errores())->error('Error al $inserta_cp', $inserta_cp);
            print_r($error);exit;
        }


        $colonia['id'] = 1;
        $colonia['codigo'] = 1;
        $colonia['descripcion'] = 1;
        $inserta_colonia = (new dp_colonia($this->link))->alta_registro($colonia);
        if(errores::$error){
            $error = (new errores())->error('Error al $inserta_colonia', $inserta_colonia);
            print_r($error);exit;
        }

        $colonia_postal['id'] = 1;
        $colonia_postal['codigo'] = 1;
        $colonia_postal['descripcion'] = 1;
        $colonia_postal['dp_cp_id'] = 1;
        $colonia_postal['dp_colonia_id'] = 1;
        $inserta_colonia_postal = (new dp_colonia_postal($this->link))->alta_registro($colonia_postal);
        if(errores::$error){
            $error = (new errores())->error('Error al $inserta_colonia_postal', $inserta_colonia_postal);
            print_r($error);exit;
        }

        $calle_pertenece['id'] = 1;
        $calle_pertenece['codigo'] = 1;
        $calle_pertenece['descripcion'] = 1;
        $calle_pertenece['dp_calle_id'] = 1;
        $calle_pertenece['dp_colonia_postal_id'] = 1;
        $calle_pertenece['descripcion_select'] = 1;

        $inserta_calle_pertenece = (new dp_calle_pertenece($this->link))->alta_registro($calle_pertenece);
        if(errores::$error){
            $error = (new errores())->error('Error al $inserta_calle_pertenece', $inserta_calle_pertenece);
            print_r($error);exit;
        }


        $dp_calle_pertenece_id = 1;
        $resultado = $modelo->objs_direcciones($dp_calle_pertenece_id);


        $this->assertIsObject($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertObjectHasAttribute('pais',$resultado);

        errores::$error = false;
    }







}

