<?php /** @var controllers\controlador_dp_colonia $controlador  controlador en ejecucion */ ?>
<?php use config\views; ?>
<?php echo $controlador->forms_inputs_modifica; ?>
<?php echo $controlador->inputs->georeferencia; ?>
<?php include (new views())->ruta_templates.'botons/submit/modifica_bd.php';?>
