<?php /** @var controllers\controlador_dp_colonia_postal $controlador  controlador en ejecucion */ ?>
<?php use config\views; ?>
<?php echo $controlador->inputs->dp_pais_id; ?>
<?php echo $controlador->inputs->dp_estado_id; ?>
<?php echo $controlador->inputs->dp_municipio_id; ?>
<?php echo $controlador->inputs->dp_cp_id; ?>
<?php echo $controlador->inputs->dp_colonia_id; ?>
<?php include (new views())->ruta_templates.'botons/submit/alta_bd.php';?>

