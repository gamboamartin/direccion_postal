<?php /** @var controllers\controlador_dp_calle_pertenece $controlador  controlador en ejecucion */ ?>
<script>
    let sl_dp_pais = <?php echo $controlador->url_servicios['dp_pais']['css_id']; ?>;
    let sl_dp_estado = <?php echo $controlador->url_servicios['dp_estado']['css_id']; ?>;
    let sl_dp_municipio = <?php echo $controlador->url_servicios['dp_municipio']['css_id']; ?>;
    let sl_dp_cp = <?php echo $controlador->url_servicios['dp_cp']['css_id']; ?>;
    let sl_dp_colonia_postal = <?php echo $controlador->url_servicios['dp_colonia_postal']['css_id']; ?>;
    let sl_dp_calle = <?php echo $controlador->url_servicios['dp_calle']['css_id']; ?>;

let asigna_estados = (dp_pais_id = '') => {
    let url = <?php echo $controlador->url_servicios['dp_estado']['url']; ?>

    get_data(url, function (data) {

    <?php echo $controlador->url_servicios['dp_estado']['limpia']; ?>
    <?php echo $controlador->url_servicios['dp_municipio']['limpia']; ?>
    <?php echo $controlador->url_servicios['dp_cp']['limpia']; ?>
    <?php echo $controlador->url_servicios['dp_colonia_postal']['limpia']; ?>

        <?php echo $controlador->url_servicios['dp_estado']['options']; ?>

    <?php echo $controlador->url_servicios['dp_estado']['refresh']; ?>
    <?php echo $controlador->url_servicios['dp_municipio']['refresh']; ?>
    <?php echo $controlador->url_servicios['dp_cp']['refresh']; ?>
    <?php echo $controlador->url_servicios['dp_colonia_postal']['refresh']; ?>
    });
}

let asigna_municipios = (dp_estado_id = '') => {
    let url = <?php echo $controlador->url_servicios['dp_municipio']['url']; ?>

    get_data(url, function (data) {
    <?php echo $controlador->url_servicios['dp_municipio']['limpia']; ?>
    <?php echo $controlador->url_servicios['dp_cp']['limpia']; ?>
    <?php echo $controlador->url_servicios['dp_colonia_postal']['limpia']; ?>



    <?php echo $controlador->url_servicios['dp_municipio']['options']; ?>

    <?php echo $controlador->url_servicios['dp_municipio']['refresh']; ?>
    <?php echo $controlador->url_servicios['dp_cp']['refresh']; ?>
    <?php echo $controlador->url_servicios['dp_colonia_postal']['refresh']; ?>
    });
}

let asigna_codigos_postales = (dp_municipio_id = '') => {
    let url = <?php echo $controlador->url_servicios['dp_cp']['url']; ?>

    get_data(url, function (data) {
    <?php echo $controlador->url_servicios['dp_cp']['limpia']; ?>
    <?php echo $controlador->url_servicios['dp_colonia_postal']['limpia']; ?>



    <?php echo $controlador->url_servicios['dp_cp']['options']; ?>

    <?php echo $controlador->url_servicios['dp_cp']['refresh']; ?>
    <?php echo $controlador->url_servicios['dp_colonia_postal']['refresh']; ?>
    });
}

let asigna_colonias_postales = (dp_cp_id = '') => {
    let url = <?php echo $controlador->url_servicios['dp_colonia_postal']['url']; ?>

    get_data(url, function (data) {
    <?php echo $controlador->url_servicios['dp_colonia_postal']['limpia']; ?>


    <?php echo $controlador->url_servicios['dp_colonia_postal']['options']; ?>

    <?php echo $controlador->url_servicios['dp_colonia_postal']['refresh']; ?>
    });
}

sl_dp_pais.change(function () {
    let selected = $(this).find('option:selected');
    asigna_estados(selected.val());
});

sl_dp_estado.change(function () {
    let selected = $(this).find('option:selected');
    asigna_municipios(selected.val());
});

sl_dp_municipio.change(function () {
    let selected = $(this).find('option:selected');
    asigna_codigos_postales(selected.val());
});

sl_dp_cp.change(function () {
    let selected = $(this).find('option:selected');
    asigna_colonias_postales(selected.val());
});
</script>