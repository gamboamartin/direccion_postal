<?php
namespace gamboamartin\direccion_postal\tests\controllers;

use controllers\_init_dps;
use controllers\controlador_dp_calle;
use gamboamartin\errores\errores;
use gamboamartin\test\liberator;
use gamboamartin\test\test;
use stdClass;


class _init_dpsTest extends test {
    public errores $errores;
    private stdClass $paths_conf;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->errores = new errores();
        $this->paths_conf = new stdClass();
        $this->paths_conf->generales = '/var/www/html/direccion_postal/config/generales.php';
        $this->paths_conf->database = '/var/www/html/direccion_postal/config/database.php';
        $this->paths_conf->views = '/var/www/html/direccion_postal/config/views.php';
    }

    /**
     */
    public function test_get_calle(): void
    {
        errores::$error = false;
        $_GET['session_id'] = 1;
        $_GET['seccion'] = 'dp_calle';
        $_SESSION['grupo_id'] = '1';
        $init = new _init_dps();
        $init = new liberator($init);

        $accion = 'a';
        $seccion = 'c';
        $resultado = $init->url_servicio($accion, $seccion);

        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals("get_url('c','a', {});", $resultado);

        errores::$error = false;
    }







}

