<?php
namespace tests\links\secciones;

use gamboamartin\errores\errores;
use gamboamartin\template_1\html;
use gamboamartin\test\liberator;
use gamboamartin\test\test;
use html\selects;
use stdClass;
use html\dp_cp_html;


class selectsTest extends test {
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
    public function test_dp_pais_id(): void
    {
        errores::$error = false;
        $_GET['session_id'] = 1;
        $_GET['seccion'] = 'dp_estado';
        $html = new html();
        $dir = new selects();

        $row = new stdClass();
        $resultado = $dir->dp_pais_id($html, $this->link, $row);
        $this->assertIsObject($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals(121,$resultado->row->dp_pais_id);
        $this->assertStringContainsStringIgnoringCase("<div class='control-group col-sm-6'><label class='control-label' for='dp_pais_id'>Pais",$resultado->select);

        errores::$error = false;
        $_GET['session_id'] = 1;
        $_GET['seccion'] = 'dp_estado';
        $html = new html();
        $dir = new selects();

        $row = new stdClass();
        $row->dp_pais_id = 999;
        $resultado = $dir->dp_pais_id($html, $this->link, $row);
        $this->assertIsObject($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals(999,$resultado->row->dp_pais_id);
        $this->assertStringContainsStringIgnoringCase("<div class='control-group col-sm-6'><label class='control-label' for='dp_pais_id'>Pais",$resultado->select);


        errores::$error = false;
    }

    /**
     */
    public function test_name_obk_html(): void
    {
        errores::$error = false;
        $_GET['session_id'] = 1;
        $_GET['seccion'] = 'dp_estado';

        $dir = new selects();
        $dir = new liberator($dir);

        $tabla =  'a';
        $resultado = $dir->name_obk_html($tabla);
        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals("html\a_html",$resultado);
        errores::$error = false;
    }

    /**
     */
    public function test_obj_html(): void
    {
        errores::$error = false;
        $_GET['session_id'] = 1;
        $_GET['seccion'] = 'dp_estado';
        $html = new html();
        $dir = new selects();
        $dir = new liberator($dir);

        $name_obj = dp_cp_html::class;
        $resultado = $dir->obj_html($name_obj, $html);
        $this->assertIsObject($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }







}

