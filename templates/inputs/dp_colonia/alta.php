<?php /** @var controllers\controlador_dp_colonia $controlador  controlador en ejecucion */ ?>
<?php use config\views; ?>
<?php echo $controlador->forms_inputs_alta; ?>
<?php echo $controlador->inputs->georeferencia; ?>
<?php include (new views())->ruta_templates.'botons/submit/alta_bd_otro.php';?>