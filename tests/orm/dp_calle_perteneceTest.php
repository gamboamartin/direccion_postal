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
use tests\base_test;


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
     */
    public function test_objs_direcciones(): void
    {
        errores::$error = false;
        $_GET['session_id'] = 1;
        $_GET['seccion'] = 'dp_estado';
        $_SESSION['usuario_id'] = 1;
        $modelo = new dp_calle_pertenece($this->link);


        $del = (new base_test())->del_dp_calle($this->link);
        if(errores::$error){
            $error = (new errores())->error('Error al eliminar', $del);
            print_r($error);
            exit;
        }



        $dp_calle_pertenece_id = 1;
        $resultado = $modelo->objs_direcciones($dp_calle_pertenece_id);
        $this->assertIsArray($resultado);
        $this->assertTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase("Error al obtener calle pertenece",$resultado['mensaje']);

        errores::$error = false;

        $alta = (new base_test())->alta_dp_calle_pertenece($this->link);
        if(errores::$error){
            $error = (new errores())->error('Error al insertar', $alta);
            print_r($error);
            exit;
        }


        $dp_calle_pertenece_id = 1;
        $resultado = $modelo->objs_direcciones($dp_calle_pertenece_id);


        $this->assertIsObject($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertObjectHasAttribute('pais',$resultado);

        errores::$error = false;
    }







}

