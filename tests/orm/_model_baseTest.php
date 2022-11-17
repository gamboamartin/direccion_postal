<?php
namespace gamboamartin\direccion_postal\tests\orm;

use gamboamartin\direccion_postal\models\_model_base;
use gamboamartin\direccion_postal\models\dp_calle_pertenece;
use gamboamartin\direccion_postal\models\dp_cp;
use gamboamartin\direccion_postal\models\dp_pais;
use gamboamartin\direccion_postal\tests\base_test;
use gamboamartin\errores\errores;
use gamboamartin\test\liberator;
use gamboamartin\test\test;
use stdClass;



class _model_baseTest extends test {
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

    public function test_asigna_data_no_existe(): void
    {
        errores::$error = false;
        $_GET['session_id'] = 1;
        $_GET['seccion'] = 'dp_estado';
        $_SESSION['usuario_id'] = 1;
        $modelo = new dp_pais($this->link);
        $modelo = new liberator($modelo);

        $data = array();
        $key = 'a';
        $registro_previo = array();
        $registro_previo['a'] = 'z';
        $resultado = $modelo->asigna_data_no_existe($data, $key, $registro_previo);

        $this->assertIsArray($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals('z',$resultado['a']);

        errores::$error = false;


    }

}

