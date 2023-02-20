<?php /** @var controllers\controlador_dp_colonia $controlador  controlador en ejecucion */ ?>
<?php use config\views; ?>
<?php echo $controlador->inputs->codigo; ?>
<?php echo $controlador->inputs->descripcion; ?>
<?php echo $controlador->inputs->georeferencia; ?>
<?php include (new views())->ruta_templates.'botons/submit/modifica_bd.php';?>

<div class="col-md-12">
    <?php
    foreach ($controlador->buttons_childrens_alta as $button){ ?>
        <div class="col-md-4">
            <?php echo $button; ?>
        </div>
    <?php } ?>
</div>

