<?php /** @var controllers\controlador_dp_colonia_postal $controlador  controlador en ejecucion */ ?>
<script>
let sl_dp_pais = <?php echo $controlador->url_servicios['dp_pais']['css_id']; ?>;
let sl_dp_estado = <?php echo $controlador->url_servicios['dp_estado']['css_id']; ?>;
let sl_dp_municipio = <?php echo $controlador->url_servicios['dp_municipio']['css_id']; ?>;

let asigna_dp_estado = (dp_pais_id = '') => {



    <?php echo $controlador->url_servicios['dp_estado']['update']; ?>


}

let asigna_dp_municipio = (dp_estado_id = '') => {



    <?php echo $controlador->url_servicios['dp_municipio']['update']; ?>

}

sl_dp_pais.change(function () {
    let selected = $(this).find('option:selected');
    asigna_dp_estado(selected.val());
});

sl_dp_estado.change(function () {
    let selected = $(this).find('option:selected');
    asigna_dp_municipio(selected.val());
});
</script>