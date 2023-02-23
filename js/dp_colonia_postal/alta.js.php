<?php /** @var controllers\controlador_dp_calle_pertenece $controlador  controlador en ejecucion */ ?>
<script>
let sl_dp_pais = $("#dp_pais_id");
let sl_dp_estado = $("#dp_estado_id");
let sl_dp_municipio = $("#dp_municipio_id");
let sl_dp_cp = $("#dp_cp_id");

let asigna_estados = (dp_pais_id = '') => {
    let url = <?php echo $controlador->url_servicios['dp_estado']['url']; ?>

    get_data(url, function (data) {
        sl_dp_estado.empty();
        sl_dp_municipio.empty();
        sl_dp_cp.empty();

        integra_new_option(sl_dp_estado,'Seleccione un estado','-1');
        integra_new_option(sl_dp_municipio,'Seleccione un municipio','-1');
        integra_new_option(sl_dp_cp,'Seleccione un codigo postal','-1');

        $.each(data.registros, function( index, dp_estado ) {
    <?php echo $controlador->url_servicios['dp_estado']['new_option']; ?>
        });
        sl_dp_estado.selectpicker('refresh');
        sl_dp_municipio.selectpicker('refresh');
        sl_dp_cp.selectpicker('refresh');
    });
}

let asigna_municipios = (dp_estado_id = '') => {
    let url = <?php echo $controlador->url_servicios['dp_municipio']['url']; ?>

    get_data(url, function (data) {
        sl_dp_municipio.empty();
        sl_dp_cp.empty();

        integra_new_option(sl_dp_municipio,'Seleccione un municipio','-1');
        integra_new_option(sl_dp_cp,'Seleccione un codigo postal','-1');

        $.each(data.registros, function( index, dp_municipio ) {
    <?php echo $controlador->url_servicios['dp_municipio']['new_option']; ?>
        });
        sl_dp_municipio.selectpicker('refresh');
        sl_dp_cp.selectpicker('refresh');
    });
}

let asigna_codigos_postales = (dp_municipio_id = '') => {
    let url = <?php echo $controlador->url_servicios['dp_cp']['url']; ?>

    get_data(url, function (data) {
        sl_dp_cp.empty();
        integra_new_option(sl_dp_cp,'Seleccione un codigo postal','-1');

        $.each(data.registros, function( index, dp_cp ) {
    <?php echo $controlador->url_servicios['dp_cp']['new_option']; ?>
        });
        sl_dp_cp.selectpicker('refresh');
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
</script>