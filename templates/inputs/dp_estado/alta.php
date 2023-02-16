<?php /** @var controllers\controlador_dp_estado $controlador  controlador en ejecucion */ ?>
<?php use config\views; ?>
<?php echo $controlador->inputs->dp_pais_id; ?>
<?php echo $controlador->inputs->codigo; ?>
<?php echo $controlador->inputs->descripcion; ?>
<?php include (new views())->ruta_templates.'botons/submit/alta_bd.php';?>

<div class="col-md-12">
    <?php
    foreach ($controlador->buttons_parents_alta as $button){ ?>
        <div class="col-md-4">
            <?php echo $button; ?>
        </div>
    <?php } ?>
</div>
