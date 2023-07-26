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
    public function test_childrens(): void
    {
        errores::$error = false;
        $_GET['session_id'] = 1;
        $_GET['seccion'] = 'dp_calle';
        $_SESSION['grupo_id'] = '1';
        $init = new _init_dps();
        $init = new liberator($init);

        $data = array();
        $data['childrens'] = array();

        $resultado = $init->childrens($data);
        $this->assertIsArray($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEmpty($resultado);
        errores::$error = false;
    }


    public function test_entidad_key(): void
    {
        errores::$error = false;
        $_GET['session_id'] = 1;
        $_GET['seccion'] = 'dp_calle';
        $_SESSION['grupo_id'] = '1';
        $init = new _init_dps();
        $init = new liberator($init);

        $data = array();
        $key = 'a';
        $resultado = $init->entidad_key($data, $key);
        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals("a", $resultado);
        errores::$error = false;
    }

    public function test_exe(): void
    {
        errores::$error = false;
        $_GET['session_id'] = 1;
        $_GET['seccion'] = 'dp_calle';
        $_SESSION['grupo_id'] = '1';
        $init = new _init_dps();
        $init = new liberator($init);

        $data = array();
        $data['childrens'] = array();
        $data['exe'] = '  aaa';

        $resultado = $init->exe($data);
        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals("aaa", $resultado);
        errores::$error = false;
    }

    public function test_key(): void
    {
        errores::$error = false;
        $_GET['session_id'] = 1;
        $_GET['seccion'] = 'dp_calle';
        $_SESSION['grupo_id'] = '1';
        $init = new _init_dps();
        $init = new liberator($init);

        $seccion_limpia = 'a';
        $resultado = $init->key($seccion_limpia);
        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals("dp_a", $resultado);
        errores::$error = false;
    }

    public function test_key_option(): void
    {
        errores::$error = false;
        $_GET['session_id'] = 1;
        $_GET['seccion'] = 'dp_calle';
        $_SESSION['grupo_id'] = '1';
        $init = new _init_dps();
        $init = new liberator($init);

        $data = array();
        $resultado = $init->key_option($data);
        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals("", $resultado);
        errores::$error = false;
    }

    public function test_params(): void
    {
        errores::$error = false;
        $_GET['session_id'] = 1;
        $_GET['seccion'] = 'dp_calle';
        $_SESSION['grupo_id'] = '1';
        $init = new _init_dps();
        $init = new liberator($init);

        $data = array();
        $seccion_limpia = 'a';
        $resultado = $init->params($data, $seccion_limpia);
        $this->assertIsObject($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals('let sl_dp_a = $("#dp_a_id");', $resultado->css_id);

        errores::$error = false;

    }

    public function test_seccion_param(): void
    {
        errores::$error = false;
        $_GET['session_id'] = 1;
        $_GET['seccion'] = 'dp_calle';
        $_SESSION['grupo_id'] = '1';
        $init = new _init_dps();
        $init = new liberator($init);

        $data = array();
        $data['seccion_param'] = 'a';
        $resultado = $init->seccion_param($data);
        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals("a", $resultado);

        errores::$error = false;

        $data = array();
        $data['seccion_param'] = '';
        $resultado = $init->seccion_param($data);
        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals("", $resultado);

        errores::$error = false;
    }

    public function test_select(): void
    {
        errores::$error = false;
        $_GET['session_id'] = 1;
        $_GET['seccion'] = 'dp_calle';
        $_SESSION['grupo_id'] = '1';
        $init = new _init_dps();
        $init = new liberator($init);

        $entidad = 'z';
        $resultado = $init->select($entidad);
        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals('let sl_z = $("#z_id");', $resultado);

        errores::$error = false;
    }

    public function test_selector(): void
    {
        errores::$error = false;
        $_GET['session_id'] = 1;
        $_GET['seccion'] = 'dp_calle';
        $_SESSION['grupo_id'] = '1';
        $init = new _init_dps();
        $init = new liberator($init);

        $entidad = 'a';
        $resultado = $init->selector($entidad);
        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals('$("#a_id")', $resultado);

        errores::$error = false;
    }

    public function test_url_servicio(): void
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

    public function test_url_servicio_extra_param(): void
    {
        errores::$error = false;
        $_GET['session_id'] = 1;
        $_GET['seccion'] = 'dp_calle';
        $_SESSION['grupo_id'] = '1';
        $init = new _init_dps();
        $init = new liberator($init);

        $accion = 'a';
        $seccion = 'v';
        $seccion_param = '';
        $resultado = $init->url_servicio_extra_param($accion, $seccion, $seccion_param);

        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals("get_url('v','a', {});", $resultado);
    }







}

