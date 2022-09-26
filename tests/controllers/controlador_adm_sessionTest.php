<?php
namespace gamboamartin\direccion_postal\tests\controllers;

use controllers\controlador_adm_session;
use controllers\controlador_dp_calle;
use gamboamartin\errores\errores;
use gamboamartin\test\test;
use stdClass;


class controlador_adm_sessionTest extends test {
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
    public function test_denegado(): void
    {
        errores::$error = false;
        $_GET['session_id'] = 1;
        $_GET['seccion'] = 'dp_estado';
        $ctl = new controlador_adm_session(link: $this->link,paths_conf: $this->paths_conf);

        $_GET['dp_calle_id'] = 1;
        $resultado = $ctl->denegado(header: false,ws: false);

        $this->assertIsArray($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
    }







}

