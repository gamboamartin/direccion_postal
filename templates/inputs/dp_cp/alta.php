<?php /** @var controllers\controlador_dp_cp $controlador  controlador en ejecucion */ ?>
<?php use config\views; ?>
<?php echo $controlador->inputs->codigo; ?>
<?php echo $controlador->inputs->descripcion; ?>
<?php echo $controlador->inputs->georeferencia; ?>
<?php echo $controlador->inputs->dp_municipio_id; ?>
<?php include (new views())->ruta_templates.'botons/submit/alta_bd.php';?>