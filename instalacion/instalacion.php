<?php
namespace gamboamartin\direccion_postal\instalacion;

use gamboamartin\administrador\models\_instalacion;
use gamboamartin\errores\errores;
use gamboamartin\facturacion\models\_etapa;
use gamboamartin\facturacion\models\_transacciones_fc;
use gamboamartin\facturacion\models\fc_complemento_pago;
use gamboamartin\facturacion\models\fc_complemento_pago_etapa;
use gamboamartin\facturacion\models\fc_factura;
use gamboamartin\facturacion\models\fc_factura_etapa;
use gamboamartin\facturacion\models\fc_nota_credito;
use gamboamartin\facturacion\models\fc_nota_credito_etapa;
use PDO;
use stdClass;

class instalacion
{

    private function _add_fc_cancelacion(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_cancelacion');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['cat_sat_motivo_cancelacion_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_cancelacion');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;


        return $out;

    }

    private function _add_fc_cancelacion_nc(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_cancelacion_nc');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['cat_sat_motivo_cancelacion_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_cancelacion_nc');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;


        return $out;

    }
    private function _add_fc_cfdi_sellado(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_cfdi_sellado');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_factura_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_cfdi_sellado');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        $campos = new stdClass();
        $campos->fecha_pago = new stdClass();
        $campos->fecha_pago->tipo_dato = 'DATETIME';
        $campos->fecha_pago->default = '1900-01-01';

        $campos->comprobante_sello = new stdClass();
        $campos->comprobante_sello->tipo_dato = 'longblob';

        $campos->comprobante_certificado = new stdClass();
        $campos->comprobante_certificado->tipo_dato = 'longblob';

        $campos->comprobante_no_certificado = new stdClass();

        $campos->complemento_tfd_sl = new stdClass();
        $campos->complemento_tfd_sl->tipo_dato = 'longblob';

        $campos->complemento_tfd_fecha_timbrado = new stdClass();
        $campos->complemento_tfd_no_certificado_sat = new stdClass();
        $campos->complemento_tfd_rfc_prov_certif = new stdClass();

        $campos->complemento_tfd_sello_cfd = new stdClass();
        $campos->complemento_tfd_sello_cfd->tipo_dato = 'longblob';

        $campos->complemento_tfd_sello_sat = new stdClass();
        $campos->complemento_tfd_sello_sat->tipo_dato = 'longblob';

        $campos->uuid = new stdClass();
        $campos->complemento_tfd_tfd = new stdClass();

        $campos->cadena_complemento_sat = new stdClass();
        $campos->cadena_complemento_sat->tipo_dato = 'longblob';

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_cfdi_sellado');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;



        return $out;

    }

    private function _add_fc_cfdi_sellado_cp(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_cfdi_sellado_cp');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_complemento_pago_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_cfdi_sellado_cp');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        $campos = new stdClass();
        $campos->fecha_pago = new stdClass();
        $campos->fecha_pago->tipo_dato = 'DATETIME';
        $campos->fecha_pago->default = '1900-01-01';

        $campos->comprobante_sello = new stdClass();
        $campos->comprobante_sello->tipo_dato = 'longblob';

        $campos->comprobante_certificado = new stdClass();
        $campos->comprobante_certificado->tipo_dato = 'longblob';

        $campos->comprobante_no_certificado = new stdClass();

        $campos->complemento_tfd_sl = new stdClass();
        $campos->complemento_tfd_sl->tipo_dato = 'longblob';

        $campos->complemento_tfd_fecha_timbrado = new stdClass();
        $campos->complemento_tfd_no_certificado_sat = new stdClass();
        $campos->complemento_tfd_rfc_prov_certif = new stdClass();

        $campos->complemento_tfd_sello_cfd = new stdClass();
        $campos->complemento_tfd_sello_cfd->tipo_dato = 'longblob';

        $campos->complemento_tfd_sello_sat = new stdClass();
        $campos->complemento_tfd_sello_sat->tipo_dato = 'longblob';

        $campos->uuid = new stdClass();
        $campos->complemento_tfd_tfd = new stdClass();

        $campos->cadena_complemento_sat = new stdClass();
        $campos->cadena_complemento_sat->tipo_dato = 'longblob';

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_cfdi_sellado_cp');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;



        return $out;

    }

    private function _add_fc_cfdi_sellado_nc(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_cfdi_sellado_nc');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_nota_credito_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_cfdi_sellado_nc');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        $campos = new stdClass();
        $campos->fecha_pago = new stdClass();
        $campos->fecha_pago->tipo_dato = 'DATETIME';
        $campos->fecha_pago->default = '1900-01-01';

        $campos->comprobante_sello = new stdClass();
        $campos->comprobante_sello->tipo_dato = 'longblob';

        $campos->comprobante_certificado = new stdClass();
        $campos->comprobante_certificado->tipo_dato = 'longblob';

        $campos->comprobante_no_certificado = new stdClass();

        $campos->complemento_tfd_sl = new stdClass();
        $campos->complemento_tfd_sl->tipo_dato = 'longblob';

        $campos->complemento_tfd_fecha_timbrado = new stdClass();
        $campos->complemento_tfd_no_certificado_sat = new stdClass();
        $campos->complemento_tfd_rfc_prov_certif = new stdClass();

        $campos->complemento_tfd_sello_cfd = new stdClass();
        $campos->complemento_tfd_sello_cfd->tipo_dato = 'longblob';

        $campos->complemento_tfd_sello_sat = new stdClass();
        $campos->complemento_tfd_sello_sat->tipo_dato = 'longblob';

        $campos->uuid = new stdClass();
        $campos->complemento_tfd_tfd = new stdClass();

        $campos->cadena_complemento_sat = new stdClass();
        $campos->cadena_complemento_sat->tipo_dato = 'longblob';

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_cfdi_sellado_nc');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;



        return $out;

    }

    private function _add_fc_uuid_cancela(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_uuid_cancela');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_uuid_id'] = new stdClass();
        $foraneas['cat_sat_motivo_cancelacion_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_uuid_cancela');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        /*$campos = new stdClass();
        $campos->fecha_pago = new stdClass();
        $campos->fecha_pago->tipo_dato = 'DATETIME';
        $campos->fecha_pago->default = '1900-01-01';

        $campos->comprobante_sello = new stdClass();
        $campos->comprobante_sello->tipo_dato = 'longblob';

        $campos->comprobante_certificado = new stdClass();
        $campos->comprobante_certificado->tipo_dato = 'longblob';

        $campos->comprobante_no_certificado = new stdClass();

        $campos->complemento_tfd_sl = new stdClass();
        $campos->complemento_tfd_sl->tipo_dato = 'longblob';

        $campos->complemento_tfd_fecha_timbrado = new stdClass();
        $campos->complemento_tfd_no_certificado_sat = new stdClass();
        $campos->complemento_tfd_rfc_prov_certif = new stdClass();

        $campos->complemento_tfd_sello_cfd = new stdClass();
        $campos->complemento_tfd_sello_cfd->tipo_dato = 'longblob';

        $campos->complemento_tfd_sello_sat = new stdClass();
        $campos->complemento_tfd_sello_sat->tipo_dato = 'longblob';

        $campos->uuid = new stdClass();
        $campos->complemento_tfd_tfd = new stdClass();

        $campos->cadena_complemento_sat = new stdClass();
        $campos->cadena_complemento_sat->tipo_dato = 'longblob';

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_uuid_cancela');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;*/



        return $out;

    }

    private function _add_fc_receptor_email(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_receptor_email');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['not_receptor_id'] = new stdClass();
        $foraneas['com_email_cte_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_receptor_email');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        /*$campos = new stdClass();
        $campos->fecha_pago = new stdClass();
        $campos->fecha_pago->tipo_dato = 'DATETIME';
        $campos->fecha_pago->default = '1900-01-01';

        $campos->comprobante_sello = new stdClass();
        $campos->comprobante_sello->tipo_dato = 'longblob';

        $campos->comprobante_certificado = new stdClass();
        $campos->comprobante_certificado->tipo_dato = 'longblob';

        $campos->comprobante_no_certificado = new stdClass();

        $campos->complemento_tfd_sl = new stdClass();
        $campos->complemento_tfd_sl->tipo_dato = 'longblob';

        $campos->complemento_tfd_fecha_timbrado = new stdClass();
        $campos->complemento_tfd_no_certificado_sat = new stdClass();
        $campos->complemento_tfd_rfc_prov_certif = new stdClass();

        $campos->complemento_tfd_sello_cfd = new stdClass();
        $campos->complemento_tfd_sello_cfd->tipo_dato = 'longblob';

        $campos->complemento_tfd_sello_sat = new stdClass();
        $campos->complemento_tfd_sello_sat->tipo_dato = 'longblob';

        $campos->uuid = new stdClass();
        $campos->complemento_tfd_tfd = new stdClass();

        $campos->cadena_complemento_sat = new stdClass();
        $campos->cadena_complemento_sat->tipo_dato = 'longblob';

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_receptor_email');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;*/



        return $out;

    }

    private function _add_fc_conf_aut_producto(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_conf_aut_producto');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['com_tipo_cliente_id'] = new stdClass();
        $foraneas['fc_csd_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_conf_aut_producto');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        /*$campos = new stdClass();
        $campos->fecha_pago = new stdClass();
        $campos->fecha_pago->tipo_dato = 'DATETIME';
        $campos->fecha_pago->default = '1900-01-01';

        $campos->comprobante_sello = new stdClass();
        $campos->comprobante_sello->tipo_dato = 'longblob';

        $campos->comprobante_certificado = new stdClass();
        $campos->comprobante_certificado->tipo_dato = 'longblob';

        $campos->comprobante_no_certificado = new stdClass();

        $campos->complemento_tfd_sl = new stdClass();
        $campos->complemento_tfd_sl->tipo_dato = 'longblob';

        $campos->complemento_tfd_fecha_timbrado = new stdClass();
        $campos->complemento_tfd_no_certificado_sat = new stdClass();
        $campos->complemento_tfd_rfc_prov_certif = new stdClass();

        $campos->complemento_tfd_sello_cfd = new stdClass();
        $campos->complemento_tfd_sello_cfd->tipo_dato = 'longblob';

        $campos->complemento_tfd_sello_sat = new stdClass();
        $campos->complemento_tfd_sello_sat->tipo_dato = 'longblob';

        $campos->uuid = new stdClass();
        $campos->complemento_tfd_tfd = new stdClass();

        $campos->cadena_complemento_sat = new stdClass();
        $campos->cadena_complemento_sat->tipo_dato = 'longblob';

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_receptor_email');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;*/



        return $out;

    }
    private function _add_fc_complemento_pago_etapa(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_complemento_pago_etapa');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['pr_etapa_proceso_id'] = new stdClass();
        $foraneas['fc_complemento_pago_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_complemento_pago_etapa');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;
        $campos = new stdClass();
        $campos->fecha = new stdClass();
        $campos->fecha->tipo_dato = 'DATE';
        $campos->fecha->default = '1900-01-01';

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_complemento_pago_etapa');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;
        return $out;

    }
    private function _add_fc_conf_etapa_rel(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_conf_etapa_rel');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['pr_etapa_proceso_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_conf_etapa_rel');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;
        $campos = new stdClass();
        $campos->fecha_pago = new stdClass();
        $campos->fecha_pago->tipo_dato = 'DATETIME';
        $campos->fecha_pago->default = '1900-01-01';

        $campos->monto = new stdClass();
        $campos->monto->tipo_dato = 'double';
        $campos->monto->default = '0';
        $campos->monto->longitud = '100,2';

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_conf_etapa_rel');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;
        return $out;

    }
    private function _add_fc_cuenta_predial(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_cuenta_predial');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_partida_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_cuenta_predial');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        return $out;

    }

    private function _add_fc_cuenta_predial_nc(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_cuenta_predial_nc');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_partida_nc_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_cuenta_predial_nc');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        return $out;

    }

    private function _add_fc_email(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_email');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_factura_id'] = new stdClass();
        $foraneas['com_email_cte_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_email');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;


        return $out;

    }

    private function _add_fc_email_cp(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_email_cp');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_complemento_pago_id'] = new stdClass();
        $foraneas['com_email_cte_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_email_cp');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;


        return $out;

    }

    private function _add_fc_email_nc(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_email_nc');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_nota_credito_id'] = new stdClass();
        $foraneas['com_email_cte_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_email_nc');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;


        return $out;

    }
    private function _add_fc_factura_documento(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_factura_documento');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_factura_id'] = new stdClass();
        $foraneas['doc_documento_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_factura_documento');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;


        return $out;

    }

    private function _add_fc_complemento_pago_documento(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_complemento_pago_documento');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_complemento_pago_id'] = new stdClass();
        $foraneas['doc_documento_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_complemento_pago_documento');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;


        return $out;

    }

    private function _add_fc_nota_credito_documento(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_nota_credito_documento');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_nota_credito_id'] = new stdClass();
        $foraneas['doc_documento_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_nota_credito_documento');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;


        return $out;

    }
    private function _add_fc_factura_etapa(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_factura_etapa');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['pr_etapa_proceso_id'] = new stdClass();
        $foraneas['fc_factura_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_factura_etapa');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;
        $campos = new stdClass();
        $campos->fecha = new stdClass();
        $campos->fecha->tipo_dato = 'DATE';
        $campos->fecha->default = '1900-01-01';

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_factura_etapa');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;
        return $out;

    }

    private function _add_fc_cer_csd(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_cer_csd');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['doc_documento_id'] = new stdClass();
        $foraneas['fc_csd_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_cer_csd');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        /*$campos = new stdClass();
        $campos->fecha = new stdClass();
        $campos->fecha->tipo_dato = 'DATE';
        $campos->fecha->default = '1900-01-01';

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_cer_csd');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;*/
        return $out;

    }

    private function _add_fc_key_csd(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_key_csd');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['doc_documento_id'] = new stdClass();
        $foraneas['fc_csd_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_key_csd');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        /*$campos = new stdClass();
        $campos->fecha = new stdClass();
        $campos->fecha->tipo_dato = 'DATE';
        $campos->fecha->default = '1900-01-01';

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_cer_csd');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;*/
        return $out;

    }

    private function _add_fc_cer_pem(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_cer_pem');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['doc_documento_id'] = new stdClass();
        $foraneas['fc_cer_csd_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_cer_pem');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        /*$campos = new stdClass();
        $campos->fecha = new stdClass();
        $campos->fecha->tipo_dato = 'DATE';
        $campos->fecha->default = '1900-01-01';

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_cer_csd');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;*/
        return $out;

    }

    private function _add_fc_key_pem(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_key_pem');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['doc_documento_id'] = new stdClass();
        $foraneas['fc_key_csd_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_key_pem');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        /*$campos = new stdClass();
        $campos->fecha = new stdClass();
        $campos->fecha->tipo_dato = 'DATE';
        $campos->fecha->default = '1900-01-01';

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_cer_csd');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;*/
        return $out;

    }
    private function _add_fc_factura_relacionada(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_factura_relacionada');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_relacion_id'] = new stdClass();
        $foraneas['fc_factura_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_factura_relacionada');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        return $out;

    }

    private function _add_fc_nota_credito_relacionada(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_nota_credito_relacionada');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_relacion_nc_id'] = new stdClass();
        $foraneas['fc_nota_credito_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_nota_credito_relacionada');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        return $out;

    }

    private function _add_fc_notificacion(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_notificacion');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_factura_id'] = new stdClass();
        $foraneas['not_mensaje_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_notificacion');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;


        return $out;

    }

    private function _add_fc_notificacion_nc(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_notificacion_nc');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_nota_credito_id'] = new stdClass();
        $foraneas['not_mensaje_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_notificacion_nc');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;


        return $out;

    }
    private function _add_fc_pago_pago(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_pago_pago');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_pago_id'] = new stdClass();
        $foraneas['cat_sat_forma_pago_id'] = new stdClass();
        $foraneas['cat_sat_moneda_id'] = new stdClass();
        $foraneas['com_tipo_cambio_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_pago_pago');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;
        $campos = new stdClass();
        $campos->fecha_pago = new stdClass();
        $campos->fecha_pago->tipo_dato = 'DATETIME';
        $campos->fecha_pago->default = '1900-01-01';

        $campos->monto = new stdClass();
        $campos->monto->tipo_dato = 'double';
        $campos->monto->default = '0';
        $campos->monto->longitud = '100,2';

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_pago_pago');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;
        return $out;

    }
    private function _add_fc_pago(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_pago');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_complemento_pago_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_pago');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;
        $campos = new stdClass();
        $campos->version = new stdClass();
        $campos->version->tipo_dato = 'VARCHAR';
        $campos->version->default = 'SV';


        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_pago');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;
        return $out;

    }

    private function _add_fc_relacion(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_relacion');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_factura_id'] = new stdClass();
        $foraneas['cat_sat_tipo_relacion_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_relacion');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;


        return $out;

    }

    private function _add_fc_relacion_nc(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_relacion_nc');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_nota_credito_id'] = new stdClass();
        $foraneas['cat_sat_tipo_relacion_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_relacion_nc');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;


        return $out;

    }

    private function _add_fc_uuid_fc(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_uuid_fc');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_uuid_id'] = new stdClass();
        $foraneas['fc_relacion_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_uuid_fc');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;


        return $out;

    }

    private function _add_fc_uuid_nc(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_uuid_nc');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_uuid_id'] = new stdClass();
        $foraneas['fc_relacion_nc_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_uuid_nc');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;


        return $out;

    }
    private function _add_fc_uuid(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_uuid');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_csd_id'] = new stdClass();
        $foraneas['com_sucursal_id'] = new stdClass();
        $foraneas['cat_sat_tipo_de_comprobante_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_uuid');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;
        $campos = new stdClass();
        $campos->uuid = new stdClass();



        $campos->fecha = new stdClass();
        $campos->fecha->tipo_dato = 'DATE';
        $campos->fecha->default = '1900-01-01';

        $campos->total = new stdClass();
        $campos->total->tipo_dato = 'DOUBLE';
        $campos->total->longitud = '100,4';
        $campos->total->default = '0';

        $campos->folio = new stdClass();


        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_uuid');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;
        return $out;

    }
    private function _add_fc_uuid_etapa(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_uuid_etapa');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_uuid_id'] = new stdClass();
        $foraneas['pr_etapa_proceso_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_uuid_etapa');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;
        $campos = new stdClass();
        $campos->fecha = new stdClass();
        $campos->fecha->tipo_dato = 'DATE';
        $campos->fecha->default = '1900-01-01';


        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_uuid_etapa');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;
        return $out;

    }

    private function _add_fc_traslado_dr(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_traslado_dr');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_impuesto_dr_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_traslado_dr');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;



        return $out;

    }

    private function _add_fc_retencion_dr(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_retencion_dr');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_impuesto_dr_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_retencion_dr');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;



        return $out;

    }

    private function _add_fc_impuesto_dr(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_impuesto_dr');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_docto_relacionado_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_impuesto_dr');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;



        return $out;

    }

    private function _add_fc_docto_relacionado(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_docto_relacionado');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_factura_id'] = new stdClass();
        $foraneas['cat_sat_obj_imp_id'] = new stdClass();
        $foraneas['fc_pago_pago_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_docto_relacionado');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        $campos = new stdClass();
        $campos->equivalencia_dr = new stdClass();
        $campos->equivalencia_dr->tipo_dato = 'DOUBLE';
        $campos->equivalencia_dr->default = '0';
        $campos->equivalencia_dr->longitud = '100,4';

        $campos->num_parcialidad = new stdClass();
        $campos->num_parcialidad->tipo_dato = 'BIGINT';

        $campos->imp_saldo_ant = new stdClass();
        $campos->imp_saldo_ant->tipo_dato = 'DOUBLE';
        $campos->imp_saldo_ant->default = '0';
        $campos->imp_saldo_ant->longitud = '100,4';

        $campos->imp_pagado = new stdClass();
        $campos->imp_pagado->tipo_dato = 'DOUBLE';
        $campos->imp_pagado->default = '0';
        $campos->imp_pagado->longitud = '100,4';

        $campos->imp_saldo_insoluto = new stdClass();
        $campos->imp_saldo_insoluto->tipo_dato = 'DOUBLE';
        $campos->imp_saldo_insoluto->default = '0';
        $campos->imp_saldo_insoluto->longitud = '100,4';

        $campos->total_factura = new stdClass();
        $campos->total_factura->tipo_dato = 'DOUBLE';
        $campos->total_factura->default = '0';
        $campos->total_factura->longitud = '100,4';

        $campos->total_factura_tc = new stdClass();
        $campos->total_factura_tc->tipo_dato = 'DOUBLE';
        $campos->total_factura_tc->default = '0';
        $campos->total_factura_tc->longitud = '100,4';

        $campos->imp_pagado_tc = new stdClass();
        $campos->imp_pagado_tc->tipo_dato = 'DOUBLE';
        $campos->imp_pagado_tc->default = '0';
        $campos->imp_pagado_tc->longitud = '100,4';

        $campos->saldo_factura_tc = new stdClass();
        $campos->saldo_factura_tc->tipo_dato = 'DOUBLE';
        $campos->saldo_factura_tc->default = '0';
        $campos->saldo_factura_tc->longitud = '100,4';


        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_docto_relacionado');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;



        return $out;

    }

    private function _add_fc_traslado_dr_part(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_traslado_dr_part');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['cat_sat_tipo_impuesto_id'] = new stdClass();
        $foraneas['cat_sat_tipo_factor_id'] = new stdClass();
        $foraneas['cat_sat_factor_id'] = new stdClass();
        $foraneas['fc_traslado_dr_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_traslado_dr_part');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        $campos = new stdClass();
        $campos->base_dr = new stdClass();
        $campos->base_dr->tipo_dato = 'DOUBLE';
        $campos->base_dr->default = '0';
        $campos->base_dr->longitud = '100,4';

        $campos->importe_dr = new stdClass();
        $campos->importe_dr->tipo_dato = 'DOUBLE';
        $campos->importe_dr->default = '0';
        $campos->importe_dr->longitud = '100,4';

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_traslado_dr_part');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;


        return $out;

    }

    private function _add_fc_retencion_dr_part(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_retencion_dr_part');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['cat_sat_tipo_impuesto_id'] = new stdClass();
        $foraneas['cat_sat_tipo_factor_id'] = new stdClass();
        $foraneas['cat_sat_factor_id'] = new stdClass();
        $foraneas['fc_retencion_dr_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_retencion_dr_part');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        $campos = new stdClass();
        $campos->base_dr = new stdClass();
        $campos->base_dr->tipo_dato = 'DOUBLE';
        $campos->base_dr->default = '0';
        $campos->base_dr->longitud = '100,4';

        $campos->importe_dr = new stdClass();
        $campos->importe_dr->tipo_dato = 'DOUBLE';
        $campos->importe_dr->default = '0';
        $campos->importe_dr->longitud = '100,4';

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_retencion_dr_part');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;


        return $out;

    }

    private function _add_fc_factura_automatica(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_factura_automatica');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_ejecucion_automatica_id'] = new stdClass();
        $foraneas['fc_factura_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_factura_automatica');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;




        return $out;

    }

    private function _add_fc_conf_traslado(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_conf_traslado');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['com_producto_id'] = new stdClass();
        $foraneas['cat_sat_tipo_factor_id'] = new stdClass();
        $foraneas['cat_sat_factor_id'] = new stdClass();
        $foraneas['cat_sat_tipo_impuesto_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_conf_traslado');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;




        return $out;

    }
    private function _add_fc_conf_retenido(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_conf_retenido');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['com_producto_id'] = new stdClass();
        $foraneas['cat_sat_tipo_factor_id'] = new stdClass();
        $foraneas['cat_sat_factor_id'] = new stdClass();
        $foraneas['cat_sat_tipo_impuesto_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_conf_retenido');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;




        return $out;

    }

    private function _add_fc_traslado_p_part(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_traslado_p_part');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_traslado_p_id'] = new stdClass();
        $foraneas['cat_sat_tipo_impuesto_id'] = new stdClass();
        $foraneas['cat_sat_tipo_factor_id'] = new stdClass();
        $foraneas['cat_sat_factor_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_traslado_p_part');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        $campos = new stdClass();
        $campos->base_p = new stdClass();
        $campos->base_p->tipo_dato = 'DOUBLE';
        $campos->base_p->default = '0';
        $campos->base_p->longitud = '100,4';

        $campos->importe_p = new stdClass();
        $campos->importe_p->tipo_dato = 'DOUBLE';
        $campos->importe_p->default = '0';
        $campos->importe_p->longitud = '100,4';

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_traslado_p_part');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;



        return $out;

    }

    private function _add_fc_retencion_p_part(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_retencion_p_part');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['cat_sat_tipo_impuesto_id'] = new stdClass();
        $foraneas['cat_sat_tipo_factor_id'] = new stdClass();
        $foraneas['cat_sat_factor_id'] = new stdClass();
        $foraneas['fc_retencion_p_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_retencion_p_part');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        $campos = new stdClass();
        $campos->base_p = new stdClass();
        $campos->base_p->tipo_dato = 'DOUBLE';
        $campos->base_p->default = '0';
        $campos->base_p->longitud = '100,4';

        $campos->importe_p = new stdClass();
        $campos->importe_p->tipo_dato = 'DOUBLE';
        $campos->importe_p->default = '0';
        $campos->importe_p->longitud = '100,4';

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_retencion_p_part');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;



        return $out;

    }

    private function _add_fc_traslado_nc(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_traslado_nc');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['cat_sat_tipo_factor_id'] = new stdClass();
        $foraneas['cat_sat_factor_id'] = new stdClass();
        $foraneas['cat_sat_tipo_impuesto_id'] = new stdClass();
        $foraneas['fc_partida_nc_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_traslado_nc');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        $campos = new stdClass();
        $campos->total = new stdClass();
        $campos->total->tipo_dato = 'DOUBLE';
        $campos->total->default = '0';
        $campos->total->longitud = '100,4';


        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_traslado_nc');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;



        return $out;

    }

    private function _add_fc_pago_total(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_pago_total');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_pago_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_pago_total');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        $campos = new stdClass();
        $campos->total_traslados_base_iva_16 = new stdClass();
        $campos->total_traslados_base_iva_16->tipo_dato = 'DOUBLE';
        $campos->total_traslados_base_iva_16->default = '0';
        $campos->total_traslados_base_iva_16->longitud = '100,4';

        $campos->total_traslados_base_iva_08 = new stdClass();
        $campos->total_traslados_base_iva_08->tipo_dato = 'DOUBLE';
        $campos->total_traslados_base_iva_08->default = '0';
        $campos->total_traslados_base_iva_08->longitud = '100,4';

        $campos->total_traslados_base_iva_00 = new stdClass();
        $campos->total_traslados_base_iva_00->tipo_dato = 'DOUBLE';
        $campos->total_traslados_base_iva_00->default = '0';
        $campos->total_traslados_base_iva_00->longitud = '100,4';

        $campos->total_traslados_impuesto_iva_16 = new stdClass();
        $campos->total_traslados_impuesto_iva_16->tipo_dato = 'DOUBLE';
        $campos->total_traslados_impuesto_iva_16->default = '0';
        $campos->total_traslados_impuesto_iva_16->longitud = '100,4';

        $campos->total_traslados_impuesto_iva_08 = new stdClass();
        $campos->total_traslados_impuesto_iva_08->tipo_dato = 'DOUBLE';
        $campos->total_traslados_impuesto_iva_08->default = '0';
        $campos->total_traslados_impuesto_iva_08->longitud = '100,4';

        $campos->total_traslados_impuesto_iva_00 = new stdClass();
        $campos->total_traslados_impuesto_iva_00->tipo_dato = 'DOUBLE';
        $campos->total_traslados_impuesto_iva_00->default = '0';
        $campos->total_traslados_impuesto_iva_00->longitud = '100,4';

        $campos->monto_total_pagos = new stdClass();
        $campos->monto_total_pagos->tipo_dato = 'DOUBLE';
        $campos->monto_total_pagos->default = '0';
        $campos->monto_total_pagos->longitud = '100,4';

        $campos->total_retenciones_iva = new stdClass();
        $campos->total_retenciones_iva->tipo_dato = 'DOUBLE';
        $campos->total_retenciones_iva->default = '0';
        $campos->total_retenciones_iva->longitud = '100,4';

        $campos->total_retenciones_ieps = new stdClass();
        $campos->total_retenciones_ieps->tipo_dato = 'DOUBLE';
        $campos->total_retenciones_ieps->default = '0';
        $campos->total_retenciones_ieps->longitud = '100,4';

        $campos->total_retenciones_isr = new stdClass();
        $campos->total_retenciones_isr->tipo_dato = 'DOUBLE';
        $campos->total_retenciones_isr->default = '0';
        $campos->total_retenciones_isr->longitud = '100,4';


        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_pago_total');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;



        return $out;

    }

    private function _add_fc_traslado_cp(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_traslado_cp');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['cat_sat_tipo_factor_id'] = new stdClass();
        $foraneas['cat_sat_factor_id'] = new stdClass();
        $foraneas['cat_sat_tipo_impuesto_id'] = new stdClass();
        $foraneas['fc_partida_cp_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_traslado_cp');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        $campos = new stdClass();
        $campos->total = new stdClass();
        $campos->total->tipo_dato = 'DOUBLE';
        $campos->total->default = '0';
        $campos->total->longitud = '100,4';


        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_traslado_cp');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;



        return $out;

    }

    private function _add_fc_traslado_p(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_traslado_p');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_impuesto_p_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_traslado_p');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        /*$campos = new stdClass();

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_traslado_p');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;*/



        return $out;

    }

    private function _add_fc_retencion_p(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_retencion_p');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_impuesto_p_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_retencion_p');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        /*$campos = new stdClass();

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_traslado_p');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;*/



        return $out;

    }

    private function _add_fc_impuesto_p(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_impuesto_p');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_pago_pago_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_impuesto_p');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        /*$campos = new stdClass();

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_impuesto_p');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;*/



        return $out;

    }

    private function _add_fc_ejecucion_automatica(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_ejecucion_automatica');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_conf_automatico_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_ejecucion_automatica');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;




        return $out;

    }

    private function _add_fc_conf_automatico(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_conf_automatico');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['com_tipo_cliente_id'] = new stdClass();
        $foraneas['fc_csd_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_conf_automatico');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;


        return $out;

    }



    /**
     * @param PDO $link
     * @param string $table
     * @return array
     */
    private function _add_foraneas_facturacion(PDO $link,string $table): array
    {
        $init = (new _instalacion(link: $link));
        $foraneas = $this->foraneas_factura();
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al obtener foraneas', data:  $foraneas);
        }


        $foraneas_r = $init->foraneas(foraneas: $foraneas,table:  $table);

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }

        return $foraneas_r;

    }

    private function _add_fc_nota_credito_etapa(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_nota_credito_etapa');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['pr_etapa_proceso_id'] = new stdClass();
        $foraneas['fc_nota_credito_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_nota_credito_etapa');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;
        $campos = new stdClass();
        $campos->fecha = new stdClass();
        $campos->fecha->tipo_dato = 'DATE';
        $campos->fecha->default = '1900-01-01';

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_nota_credito_etapa');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;
        return $out;

    }

    private function _add_fc_nc_rel(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'fc_nc_rel');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;
        $foraneas = array();
        $foraneas['fc_relacion_nc_id'] = new stdClass();
        $foraneas['fc_factura_id'] = new stdClass();

        $foraneas_r = (new _instalacion(link:$link))->foraneas(foraneas: $foraneas,table:  'fc_nc_rel');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;
        $campos = new stdClass();
        $campos->monto_aplicado_factura = new stdClass();
        $campos->monto_aplicado_factura->tipo_dato = 'DOUBLE';
        $campos->monto_aplicado_factura->default = '0';
        $campos->monto_aplicado_factura->longitud = '100,4';

        $result = (new _instalacion(link: $link))->add_columns(campos: $campos,table:  'fc_nc_rel');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos', data:  $result);
        }
        $out->columnas = $result;
        return $out;

    }

    /**
     * POR DOCUMENTAR EN WIKI
     * Esta función devuelve un array de campos que son tratados como doubles en la facturación.
     *
     * @return array Retorna un array que consiste en nombres de campos que son tratados como doubles. Los campos incluidos son:
     *               'cantidad',
     *               'valor_unitario',
     *               'descuento',
     *               'total_traslados',
     *               'total_retenciones',
     *               'total',
     *               'monto_pago_nc',
     *               'monto_pago_cp',
     *               'saldo',
     *               'monto_saldo_aplicado',
     *               'total_descuento',
     *               'sub_total_base',
     *               'sub_total'
     * @version 22.2.0
     */
    private function campos_doubles_facturacion(): array
    {
        $campos_double = array();
        $campos_double[] = 'cantidad';
        $campos_double[] = 'valor_unitario';
        $campos_double[] = 'descuento';
        $campos_double[] = 'total_traslados';
        $campos_double[] = 'total_retenciones';
        $campos_double[] = 'total';
        $campos_double[] = 'monto_pago_nc';
        $campos_double[] = 'monto_pago_cp';
        $campos_double[] = 'saldo';
        $campos_double[] = 'monto_saldo_aplicado';
        $campos_double[] = 'total_descuento';
        $campos_double[] = 'sub_total_base';
        $campos_double[] = 'sub_total';
        return $campos_double;

    }

    /**
     * POR DOCUMENTAR EN WIKI
     * Esta es la función `campos_double_facturacion_integra` de la clase `Instalacion`.
     *
     * Esta función realiza la integración de los campos que son tratados como números de doble precisión (double) en
     * el contexto de la facturación.
     *
     * @param stdClass $campos Objeto que contiene los metadatos de los campos
     * @param PDO $link Representa una conexión a una base de datos.
     * @return array|stdClass Retorna un arreglo de campos dobles configurados correctamente, o en caso de error,
     * un objeto de la clase `errores`.
     *
     * @throws errores En caso de que ocurra algún error durante el proceso, se lanza una excepción de la clase errores.
     *
     * Primero, se crea una nueva instancia de `_instalacion` con el enlace PDO proporcionado.
     * Se obtiene la lista de campos double llamando a la función `campos_doubles_facturacion()`, y en caso de error,
     * se retorna un nuevo objeto de la clase `errores`.
     * A continuación, en la instancia `_instalacion` creada se realiza la adecuación predeterminada de los campos
     * double utilizando el método `campos_double_default()`,
     * pasando como parámetros el objeto $campos y los campos dobles obtenidos en el paso anterior.
     * Si ocurre algún error en este punto, se retorna un nuevo objeto de la clase `errores`.
     * Si todo el proceso se realiza sin errores, se retornan los campos ajustados.
     * @version 24.0.0
     */
    private function campos_double_facturacion_integra(stdClass $campos, PDO $link): array|stdClass
    {
        $init = (new _instalacion(link: $link));

        $campos_double = $this->campos_doubles_facturacion();
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al obtener campos_double', data:  $campos_double);
        }

        $campos = $init->campos_double_default(campos: $campos,name_campos:  $campos_double);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos double', data:  $campos);
        }
        return $campos;

    }

    private function campos_status_factura(stdClass $campos, PDO $link)
    {
        $init = (new _instalacion(link: $link));
        $name_campos = array();
        $name_campos[] = 'aplica_saldo';
        $name_campos[] = 'es_plantilla';

        $campos = $init->campos_status_inactivo(campos: $campos,name_campos:  $name_campos);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos status', data:  $campos);
        }

        return $campos;

    }

    private function exe_campos_factura(PDO $link, _transacciones_fc $modelo, _etapa $modelo_etapa)
    {
        $init = (new _instalacion(link: $link));

        $campos = $this->init_campos_factura(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos status', data:  $campos);
        }


        $campos_r = $init->add_columns(campos: $campos,table:  $modelo->tabla);

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $campos_r);
        }

        print_r($_SESSION['entidades_bd']);
        print_r($_SESSION['campos_tabla']);
        print_r($_SESSION['columnas_completas']);

        $registros = $modelo->registros(columnas_en_bruto: true);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al obtener registros', data:  $registros);
        }

        foreach ($registros as $registro){

            $ultima_etapa = $modelo->ultima_etapa(modelo_etapa: $modelo_etapa, registro_id: $registro['id']);
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al obtener ultima_etapa', data:  $ultima_etapa);
            }
            $etapa_descripcion = 'ALTA';
            if(!isset($ultima_etapa->pr_etapa_descripcion)){
                $etapa_descripcion = $ultima_etapa->pr_etapa_descripcion;
            }


            if(!isset($registro['etapa'])){
                return (new errores())->error(mensaje: 'Error no se asigno el campo etapa', data:  $registro);
            }

            if($etapa_descripcion !== $registro['etapa']){
                if(is_null($etapa_descripcion)){
                    $etapa_descripcion = 'ALTA';
                }
                $upd = $modelo->modifica_etapa(etapa_descripcion: $etapa_descripcion, registro_id: $registro['id']);
                if(errores::$error){
                    return (new errores())->error(mensaje: 'Error al actualizar etapa', data:  $upd);
                }
            }
        }


        return $campos_r;

    }

    private function fc_cancelacion(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_cancelacion(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_cancelacion_nc(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_cancelacion_nc(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }
    private function fc_cfdi_sellado(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_cfdi_sellado(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_cfdi_sellado_cp(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_cfdi_sellado_cp(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_cfdi_sellado_nc(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_cfdi_sellado_nc(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_uuid_cancela(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_uuid_cancela(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_receptor_email(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_receptor_email(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_conf_aut_producto(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_conf_aut_producto(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }
    private function fc_complemento_pago(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_complemento_pago_etapa(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        $foraneas_r = $this->_add_foraneas_facturacion(link: $link,table: __FUNCTION__);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }

        $create = $this->_add_fc_pago(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        $create = $this->_add_fc_pago_pago(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }


        $modelo = new fc_complemento_pago(link: $link, valida_atributos_criticos: false);
        $modelo_etapa = new fc_complemento_pago_etapa(link: $link);
        $campos_r = $this->exe_campos_factura(link: $link, modelo: $modelo,modelo_etapa: $modelo_etapa);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $campos_r);
        }

        $result = new stdClass();
        $result->foranenas = $foraneas_r;
        $result->campos = $campos_r;

        return $result;

    }

    private function fc_complemento_pago_etapa(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_complemento_pago_etapa(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }


        return $create;

    }

    private function fc_conf_etapa_rel(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_conf_etapa_rel(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_cuenta_predial(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_cuenta_predial(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_cuenta_predial_nc(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_cuenta_predial_nc(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_ejecucion_aut_plantilla(PDO $link): array|stdClass
    {
        $init = (new _instalacion(link: $link));

        $existe_entidad = $init->existe_entidad(table: __FUNCTION__);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al verificar table', data:  $existe_entidad);
        }

        if(!$existe_entidad) {

            $campos = new stdClass();
            $create_table = $init->create_table(campos: $campos, table: __FUNCTION__);
            if (errores::$error) {
                return (new errores())->error(mensaje: 'Error al crear table', data: $create_table);
            }
        }


        $foraneas = array();
        $foraneas['com_tipo_cliente_id'] = new stdClass();

        $foraneas_r = $init->foraneas(foraneas: $foraneas,table:  __FUNCTION__);

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }



        return $foraneas_r;

    }

    private function fc_email(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_email(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_email_cp(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_email_cp(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_email_nc(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_email_nc(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_factura(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_factura_etapa(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        $foraneas_r = $this->_add_foraneas_facturacion(link: $link,table: __FUNCTION__);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }

        $modelo = new fc_factura(link: $link, valida_atributos_criticos: false);
        $modelo_etapa = new fc_factura_etapa(link: $link);


        $campos_r = $this->exe_campos_factura(link: $link, modelo: $modelo, modelo_etapa: $modelo_etapa);

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $campos_r);
        }

        $result = new stdClass();
        $result->foraneas = $foraneas_r;
        $result->campos_r = $campos_r;

        return $result;


    }

    private function fc_factura_aut_plantilla(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $init = (new _instalacion(link: $link));



        $create_table = $init->create_table_new( table: __FUNCTION__);
        if (errores::$error) {
            return (new errores())->error(mensaje: 'Error al crear table '.__FUNCTION__, data: $create_table);
        }
        $out->create_table = $create_table;



        $foraneas = array();
        $foraneas['fc_ejecucion_aut_plantilla_id'] = new stdClass();
        $foraneas['fc_factura_id'] = new stdClass();

        $foraneas_r = $init->foraneas(foraneas: $foraneas,table:  __FUNCTION__);

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }
        $out->foraneas_r = $foraneas_r;

        $name_index = 'unique_fc_factura_id_exe';
        $existe_indice = $init->existe_indice_by_name(name_index: $name_index, table: __FUNCTION__);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al VERIFICAR SI EXISTE INDICE', data:  $existe_indice);
        }
        if(!$existe_indice){
            $columnas = array();
            $columnas[] = 'fc_factura_id';
            $columnas[] = 'fc_ejecucion_aut_plantilla_id';
            $uniques = $init->index_unique(columnas: $columnas, table: __FUNCTION__,index_name: $name_index);
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al ajustar uniques', data:  $uniques);
            }
            $out->uniques = $uniques;
        }

        return $out;

    }

    private function fc_factura_documento(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_factura_documento(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_complemento_pago_documento(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_complemento_pago_documento(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_nota_credito_documento(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_nota_credito_documento(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }
    private function fc_factura_etapa(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_factura_etapa(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }
    private function fc_cer_csd(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_cer_csd(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_key_csd(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_key_csd(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }
    private function fc_cer_pem(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_cer_pem(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_key_pem(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_key_pem(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }


    private function fc_factura_relacionada(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_factura_relacionada(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_nota_credito_relacionada(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_nota_credito_relacionada(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_nc_rel(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_nc_rel(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_nota_credito(PDO $link): array|stdClass
    {

        $create = (new _instalacion(link: $link))->create_table_new(table: __FUNCTION__);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        $create = $this->_add_fc_nota_credito_etapa(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }


        $foraneas_r = $this->_add_foraneas_facturacion(link: $link,table: __FUNCTION__);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }

        $modelo = new fc_nota_credito(link: $link, valida_atributos_criticos: false);
        $modelo_etapa = new fc_nota_credito_etapa(link: $link);


        $campos_r = $this->exe_campos_factura(link: $link, modelo: $modelo, modelo_etapa: $modelo_etapa);

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $campos_r);
        }

        $result = new stdClass();
        $result->foraneas = $foraneas_r;
        $result->campos_r = $campos_r;

        return $result;


    }

    private function fc_nota_credito_etapa(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_nota_credito_etapa(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_notificacion(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_notificacion(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_notificacion_nc(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_notificacion_nc(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_pago(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_pago(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_pago_pago(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_pago_pago(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_partida(PDO $link): array|stdClass
    {
        $init = (new _instalacion(link: $link));
        $foraneas = array();
        $foraneas['com_producto_id'] = new stdClass();
        $foraneas['fc_factura_id'] = new stdClass();


        $foraneas_r = $init->foraneas(foraneas: $foraneas,table:  'fc_partida');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }


        $campos = new stdClass();

        $campos->cantidad = new stdClass();
        $campos->cantidad->tipo_dato = 'double';
        $campos->cantidad->default = '0';
        $campos->cantidad->longitud = '100,2';

        $campos->valor_unitario = new stdClass();
        $campos->valor_unitario->tipo_dato = 'double';
        $campos->valor_unitario->default = '0';
        $campos->valor_unitario->longitud = '100,2';

        $campos->descuento = new stdClass();
        $campos->descuento->tipo_dato = 'double';
        $campos->descuento->default = '0';
        $campos->descuento->longitud = '100,2';

        $campos->sub_total = new stdClass();
        $campos->sub_total->tipo_dato = 'double';
        $campos->sub_total->default = '0';
        $campos->sub_total->longitud = '100,2';

        $campos->total_traslados = new stdClass();
        $campos->total_traslados->tipo_dato = 'double';
        $campos->total_traslados->default = '0';
        $campos->total_traslados->longitud = '100,2';

        $campos->total_retenciones = new stdClass();
        $campos->total_retenciones->tipo_dato = 'double';
        $campos->total_retenciones->default = '0';
        $campos->total_retenciones->longitud = '100,2';

        $campos->sub_total_base = new stdClass();
        $campos->sub_total_base->tipo_dato = 'double';
        $campos->sub_total_base->default = '0';
        $campos->sub_total_base->longitud = '100,2';

        $campos->total = new stdClass();
        $campos->total->tipo_dato = 'double';
        $campos->total->default = '0';
        $campos->total->longitud = '100,2';


        $campos_r = $init->add_columns(campos: $campos,table:  'fc_partida');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $campos_r);
        }


        $result = new stdClass();
        $result->foranenas = $foraneas_r;
        $result->campos = $campos_r;

        return $result;

    }

    private function fc_partida_cp(PDO $link): array|stdClass
    {

        $init = (new _instalacion(link: $link));

        $create = $init->create_table_new(table: __FUNCTION__);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create', data:  $create);
        }

        $foraneas = array();
        $foraneas['com_producto_id'] = new stdClass();
        $foraneas['fc_complemento_pago_id'] = new stdClass();


        $foraneas_r = $init->foraneas(foraneas: $foraneas,table:  'fc_partida_cp');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }


        $campos = new stdClass();

        $campos->sub_total = new stdClass();
        $campos->sub_total->tipo_dato = 'double';
        $campos->sub_total->default = '0';
        $campos->sub_total->longitud = '100,2';

        $campos->total_traslados = new stdClass();
        $campos->total_traslados->tipo_dato = 'double';
        $campos->total_traslados->default = '0';
        $campos->total_traslados->longitud = '100,2';

        $campos->total_retenciones = new stdClass();
        $campos->total_retenciones->tipo_dato = 'double';
        $campos->total_retenciones->default = '0';
        $campos->total_retenciones->longitud = '100,2';

        $campos->sub_total_base = new stdClass();
        $campos->sub_total_base->tipo_dato = 'double';
        $campos->sub_total_base->default = '0';
        $campos->sub_total_base->longitud = '100,2';

        $campos->total = new stdClass();
        $campos->total->tipo_dato = 'double';
        $campos->total->default = '0';
        $campos->total->longitud = '100,2';

        $campos_r = $init->add_columns(campos: $campos,table:  'fc_partida_cp');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $campos_r);
        }

        $result = new stdClass();
        $result->foranenas = $foraneas_r;
        $result->campos = $campos_r;

        return $result;

    }

    private function fc_partida_nc(PDO $link): array|stdClass
    {
        $init = (new _instalacion(link: $link));

        $create = $init->create_table_new(table: __FUNCTION__);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create', data:  $create);
        }

        $foraneas = array();
        $foraneas['com_producto_id'] = new stdClass();
        $foraneas['fc_nota_credito_id'] = new stdClass();

        $foraneas_r = $init->foraneas(foraneas: $foraneas,table:  'fc_partida_nc');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }


        $campos = new stdClass();

        $campos->cantidad = new stdClass();
        $campos->cantidad->tipo_dato = 'double';
        $campos->cantidad->default = '0';
        $campos->cantidad->longitud = '100,2';

        $campos->valor_unitario = new stdClass();
        $campos->valor_unitario->tipo_dato = 'double';
        $campos->valor_unitario->default = '0';
        $campos->valor_unitario->longitud = '100,2';

        $campos->descuento = new stdClass();
        $campos->descuento->tipo_dato = 'double';
        $campos->descuento->default = '0';
        $campos->descuento->longitud = '100,2';

        $campos->sub_total = new stdClass();
        $campos->sub_total->tipo_dato = 'double';
        $campos->sub_total->default = '0';
        $campos->sub_total->longitud = '100,2';

        $campos->total_traslados = new stdClass();
        $campos->total_traslados->tipo_dato = 'double';
        $campos->total_traslados->default = '0';
        $campos->total_traslados->longitud = '100,2';

        $campos->total_retenciones = new stdClass();
        $campos->total_retenciones->tipo_dato = 'double';
        $campos->total_retenciones->default = '0';
        $campos->total_retenciones->longitud = '100,2';

        $campos->sub_total_base = new stdClass();
        $campos->sub_total_base->tipo_dato = 'double';
        $campos->sub_total_base->default = '0';
        $campos->sub_total_base->longitud = '100,2';

        $campos->total = new stdClass();
        $campos->total->tipo_dato = 'double';
        $campos->total->default = '0';
        $campos->total->longitud = '100,2';


        $campos_r = $init->add_columns(campos: $campos,table:  'fc_partida_nc');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $campos_r);
        }

        $result = new stdClass();
        $result->foranenas = $foraneas_r;
        $result->campos = $campos_r;

        return $result;

    }

    private function fc_relacion(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_relacion(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_relacion_nc(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_relacion_nc(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }
    private function fc_retenido(PDO $link): array|stdClass
    {
        $init = (new _instalacion(link: $link));

        $create = $init->create_table_new(table: __FUNCTION__);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create', data:  $create);
        }

        $foraneas = array();
        $foraneas['fc_partida_id'] = new stdClass();
        $foraneas['cat_sat_tipo_factor_id'] = new stdClass();
        $foraneas['cat_sat_factor_id'] = new stdClass();
        $foraneas['cat_sat_tipo_impuesto_id'] = new stdClass();


        $foraneas_r = $init->foraneas(foraneas: $foraneas,table:  'fc_retenido');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }


        $campos = new stdClass();

        $campos->total = new stdClass();
        $campos->total->tipo_dato = 'double';
        $campos->total->default = '0';
        $campos->total->longitud = '100,2';

        $campos_r = $init->add_columns(campos: $campos,table:  'fc_retenido');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $campos_r);
        }

        $result = new stdClass();
        $result->foranenas = $foraneas_r;
        $result->campos = $campos_r;

        return $result;

    }

    private function fc_retenido_cp(PDO $link): array|stdClass
    {
        $init = (new _instalacion(link: $link));

        $create = $init->create_table_new(table: __FUNCTION__);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create', data:  $create);
        }

        $foraneas = array();
        $foraneas['fc_partida_cp_id'] = new stdClass();
        $foraneas['cat_sat_tipo_factor_id'] = new stdClass();
        $foraneas['cat_sat_factor_id'] = new stdClass();
        $foraneas['cat_sat_tipo_impuesto_id'] = new stdClass();


        $foraneas_r = $init->foraneas(foraneas: $foraneas,table:  'fc_retenido_cp');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }


        $campos = new stdClass();

        $campos->total = new stdClass();
        $campos->total->tipo_dato = 'double';
        $campos->total->default = '0';
        $campos->total->longitud = '100,2';

        $campos_r = $init->add_columns(campos: $campos,table:  'fc_retenido_cp');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $campos_r);
        }

        $result = new stdClass();
        $result->foranenas = $foraneas_r;
        $result->campos = $campos_r;

        return $result;

    }

    private function fc_retenido_nc(PDO $link): array|stdClass
    {
        $init = (new _instalacion(link: $link));

        $create = $init->create_table_new(table: __FUNCTION__);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create', data:  $create);
        }

        $foraneas = array();
        $foraneas['fc_partida_nc_id'] = new stdClass();
        $foraneas['cat_sat_tipo_factor_id'] = new stdClass();
        $foraneas['cat_sat_factor_id'] = new stdClass();
        $foraneas['cat_sat_tipo_impuesto_id'] = new stdClass();


        $foraneas_r = $init->foraneas(foraneas: $foraneas,table:  'fc_retenido_nc');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }


        $campos = new stdClass();

        $campos->total = new stdClass();
        $campos->total->tipo_dato = 'double';
        $campos->total->default = '0';
        $campos->total->longitud = '100,2';

        $campos_r = $init->add_columns(campos: $campos,table:  'fc_retenido_nc');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $campos_r);
        }

        $result = new stdClass();
        $result->foranenas = $foraneas_r;
        $result->campos = $campos_r;

        return $result;

    }

    private function fc_traslado(PDO $link): array|stdClass
    {
        $init = (new _instalacion(link: $link));

        $create = $init->create_table_new(table: __FUNCTION__);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create', data:  $create);
        }
        $foraneas = array();
        $foraneas['fc_partida_id'] = new stdClass();
        $foraneas['cat_sat_tipo_factor_id'] = new stdClass();
        $foraneas['cat_sat_factor_id'] = new stdClass();
        $foraneas['cat_sat_tipo_impuesto_id'] = new stdClass();


        $foraneas_r = $init->foraneas(foraneas: $foraneas,table:  'fc_traslado');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $foraneas_r);
        }


        $campos = new stdClass();

        $campos->total = new stdClass();
        $campos->total->tipo_dato = 'double';
        $campos->total->default = '0';
        $campos->total->longitud = '100,2';


        $campos_r = $init->add_columns(campos: $campos,table:  'fc_traslado');

        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $campos_r);
        }

        $result = new stdClass();
        $result->foranenas = $foraneas_r;
        $result->campos = $campos_r;

        return $result;

    }

    private function fc_traslado_dr(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_traslado_dr(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_retencion_dr(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_retencion_dr(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_impuesto_dr(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_impuesto_dr(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_docto_relacionado(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_docto_relacionado(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_traslado_dr_part(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_traslado_dr_part(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_retencion_dr_part(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_retencion_dr_part(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_factura_automatica(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_factura_automatica(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_conf_traslado(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_conf_traslado(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_conf_retenido(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_conf_retenido(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_traslado_p_part(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_traslado_p_part(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_retencion_p_part(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_retencion_p_part(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_traslado_nc(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_traslado_nc(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_pago_total(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_pago_total(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_traslado_cp(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_traslado_cp(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_traslado_p(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_traslado_p(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_retencion_p(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_retencion_p(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }
    private function fc_impuesto_p(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_impuesto_p(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_ejecucion_automatica(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_ejecucion_automatica(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_conf_automatico(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_conf_automatico(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }


    private function fc_uuid(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_uuid(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_uuid_etapa(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_uuid_etapa(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_uuid_fc(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_uuid_fc(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    private function fc_uuid_nc(PDO $link): array|stdClass
    {
        $create = $this->_add_fc_uuid_nc(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;

    }

    /**
     * POR DOCUMENTAR WIKI
     * Esta función devuelve un array con las claves foráneas utilizadas en la factura.
     *
     * @return array Las claves foráneas utilizadas en la factura.
     * @version 20.3.0
     */
    private function foraneas_factura(): array
    {
        $foraneas = array();
        $foraneas['fc_csd_id'] = new stdClass();
        $foraneas['cat_sat_forma_pago_id'] = new stdClass();
        $foraneas['cat_sat_metodo_pago_id'] = new stdClass();
        $foraneas['cat_sat_moneda_id'] = new stdClass();
        $foraneas['com_tipo_cambio_id'] = new stdClass();
        $foraneas['cat_sat_uso_cfdi_id'] = new stdClass();
        $foraneas['cat_sat_tipo_de_comprobante_id'] = new stdClass();
        $foraneas['dp_calle_pertenece_id'] = new stdClass();
        $foraneas['cat_sat_regimen_fiscal_id'] = new stdClass();
        $foraneas['com_sucursal_id'] = new stdClass();
        return $foraneas;

    }

    private function init_campos_factura(PDO $link)
    {
        $campos = new stdClass();
        $campos = $this->campos_double_facturacion_integra(campos: $campos,link:  $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos double', data:  $campos);
        }


        $campos = $this->campos_status_factura(campos: $campos,link:  $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar campos status', data:  $campos);
        }

        $campos->folio_fiscal = new stdClass();
        $campos->folio_fiscal->default = 'SIN ASIGNAR';

        $campos->etapa = new stdClass();
        $campos->etapa->default = 'ALTA';

        return $campos;

    }
    final public function instala(PDO $link): array|stdClass
    {

        $result = new stdClass();


        $fc_cer_csd = $this->fc_cer_csd(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_cer_csd', data:  $fc_cer_csd);
        }
        $result->fc_cer_csd = $fc_cer_csd;

        $fc_cer_csd = $this->fc_key_csd(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_cer_csd', data:  $fc_cer_csd);
        }
        $result->fc_cer_csd = $fc_cer_csd;

        $fc_cer_pem = $this->fc_cer_pem(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_cer_pem', data:  $fc_cer_pem);
        }
        $result->fc_cer_pem = $fc_cer_pem;

        $fc_key_pem = $this->fc_key_pem(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_key_pem', data:  $fc_key_pem);
        }
        $result->fc_key_pem = $fc_key_pem;

        $fc_factura = $this->fc_factura(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_factura', data:  $fc_factura);
        }

        $result->fc_factura = $fc_factura;

        $fc_factura_etapa = $this->fc_factura_etapa(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_factura_etapa', data:  $fc_factura_etapa);
        }


        $fc_complemento_pago = $this->fc_complemento_pago(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_complemento_pago', data:  $fc_complemento_pago);
        }
        $result->fc_complemento_pago = $fc_complemento_pago;

        $fc_complemento_pago_etapa = $this->fc_complemento_pago_etapa(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_complemento_pago_etapa', data:  $fc_complemento_pago_etapa);
        }

        $result->fc_complemento_pago_etapa = $fc_complemento_pago_etapa;

        $fc_pago = $this->fc_pago(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_pago', data:  $fc_pago);
        }
        $result->fc_pago = $fc_pago;

        $fc_pago_pago = $this->fc_pago_pago(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_pago_pago', data:  $fc_pago_pago);
        }
        $result->fc_pago_pago = $fc_pago_pago;

        $fc_partida = $this->fc_partida(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_partida', data:  $fc_partida);
        }
        $result->fc_partida = $fc_partida;

        $fc_traslado = $this->fc_traslado(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_traslado', data:  $fc_traslado);
        }
        $result->fc_traslado = $fc_traslado;



        $fc_partida_cp = $this->fc_partida_cp(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_partida_nc', data:  $fc_partida_cp);
        }
        $result->fc_partida_cp = $fc_partida_cp;

        $fc_retenido = $this->fc_retenido(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_retenido', data:  $fc_retenido);
        }
        $result->fc_retenido = $fc_retenido;

        $fc_nota_credito = $this->fc_nota_credito(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_retenido', data:  $fc_nota_credito);
        }
        $result->fc_nota_credito = $fc_nota_credito;

        $fc_nota_credito_etapa = $this->fc_nota_credito_etapa(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_nota_credito_etapa', data:  $fc_nota_credito_etapa);
        }
        $result->fc_nota_credito_etapa = $fc_nota_credito_etapa;

        $fc_partida_nc = $this->fc_partida_nc(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_partida_nc', data:  $fc_partida_nc);
        }
        $result->fc_partida_nc = $fc_partida_nc;

        $fc_retenido_nc = $this->fc_retenido_nc(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_retenido_nc', data:  $fc_retenido_nc);
        }
        $result->fc_retenido_nc = $fc_retenido_nc;

        $fc_ejecucion_aut_plantilla = $this->fc_ejecucion_aut_plantilla(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_ejecucion_aut_plantilla',
                data:  $fc_ejecucion_aut_plantilla);
        }
        $result->fc_ejecucion_aut_plantilla = $fc_ejecucion_aut_plantilla;

        $fc_factura_aut_plantilla = $this->fc_factura_aut_plantilla(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_ejecucion_aut_plantilla',
                data:  $fc_factura_aut_plantilla);
        }
        $result->fc_factura_aut_plantilla = $fc_factura_aut_plantilla;

        $fc_conf_etapa_rel = $this->fc_conf_etapa_rel(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_conf_etapa_rel', data:  $fc_conf_etapa_rel);
        }
        $result->fc_conf_etapa_rel = $fc_conf_etapa_rel;

        $fc_uuid = $this->fc_uuid(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_uuid', data:  $fc_uuid);
        }
        $result->fc_uuid = $fc_uuid;

        $fc_uuid_etapa = $this->fc_uuid_etapa(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_uuid_etapa', data:  $fc_uuid_etapa);
        }
        $result->fc_uuid_etapa = $fc_uuid_etapa;

        $fc_factura_documento = $this->fc_factura_documento(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_factura_documento', data:  $fc_factura_documento);
        }
        $result->fc_factura_documento = $fc_factura_documento;

        $fc_cuenta_predial = $this->fc_cuenta_predial(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_cuenta_predial', data:  $fc_cuenta_predial);
        }
        $result->fc_cuenta_predial = $fc_cuenta_predial;

        $fc_cuenta_predial_nc = $this->fc_cuenta_predial_nc(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_cuenta_predial_nc', data:  $fc_cuenta_predial_nc);
        }
        $result->fc_cuenta_predial_nc = $fc_cuenta_predial_nc;

        $fc_cfdi_sellado = $this->fc_cfdi_sellado(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_cfdi_sellado', data:  $fc_cfdi_sellado);
        }
        $result->fc_cfdi_sellado = $fc_cfdi_sellado;

        $fc_cancelacion = $this->fc_cancelacion(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_cancelacion', data:  $fc_cancelacion);
        }
        $result->fc_cancelacion = $fc_cancelacion;

        $fc_cancelacion_nc = $this->fc_cancelacion_nc(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_cancelacion_nc', data:  $fc_cancelacion_nc);
        }
        $result->fc_cancelacion_nc = $fc_cancelacion_nc;

        $fc_relacion = $this->fc_relacion(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_relacion', data:  $fc_relacion);
        }
        $result->fc_relacion = $fc_relacion;

        $fc_relacion_nc = $this->fc_relacion_nc(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_relacion_nc', data:  $fc_relacion_nc);
        }
        $result->fc_relacion_nc = $fc_relacion_nc;

        $fc_factura_relacionada = $this->fc_factura_relacionada(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_factura_relacionada', data:  $fc_factura_relacionada);
        }
        $result->fc_factura_relacionada = $fc_factura_relacionada;

        $fc_nota_credito_relacionada = $this->fc_nota_credito_relacionada(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_nota_credito_relacionada', data:  $fc_nota_credito_relacionada);
        }
        $result->fc_nota_credito_relacionada = $fc_nota_credito_relacionada;

        $fc_uuid_fc = $this->fc_uuid_fc(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_uuid_fc', data:  $fc_uuid_fc);
        }
        $result->fc_uuid_fc = $fc_uuid_fc;

        $fc_uuid_nc = $this->fc_uuid_nc(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_uuid_nc', data:  $fc_uuid_nc);
        }
        $result->fc_uuid_fc = $fc_uuid_fc;

        $fc_email = $this->fc_email(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_email', data:  $fc_email);
        }
        $result->fc_email = $fc_email;

        $fc_notificacion = $this->fc_notificacion(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_notificacion', data:  $fc_notificacion);
        }
        $result->fc_notificacion = $fc_notificacion;

        $fc_notificacion_nc = $this->fc_notificacion_nc(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_notificacion_nc', data:  $fc_notificacion_nc);
        }
        $result->fc_notificacion_nc = $fc_notificacion_nc;

        $fc_nc_rel = $this->fc_nc_rel(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_nc_rel', data:  $fc_nc_rel);
        }
        $result->fc_nc_rel = $fc_nc_rel;

        $fc_docto_relacionado = $this->fc_docto_relacionado(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_docto_relacionado', data:  $fc_docto_relacionado);
        }
        $result->fc_docto_relacionado = $fc_docto_relacionado;

        $fc_impuesto_dr = $this->fc_impuesto_dr(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_impuesto_dr', data:  $fc_impuesto_dr);
        }
        $result->fc_impuesto_dr = $fc_impuesto_dr;

        $fc_traslado_dr = $this->fc_traslado_dr(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_traslado_dr', data:  $fc_traslado_dr);
        }
        $result->fc_traslado_dr = $fc_traslado_dr;

        $fc_retencion_dr = $this->fc_retencion_dr(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_retencion_dr', data:  $fc_retencion_dr);
        }
        $result->fc_traslado_dr = $fc_traslado_dr;

        $fc_traslado_dr_part = $this->fc_traslado_dr_part(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_traslado_dr_part', data:  $fc_traslado_dr_part);
        }
        $result->fc_traslado_dr_part = $fc_traslado_dr_part;

        $fc_retencion_dr_part = $this->fc_retencion_dr_part(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_traslado_dr_part', data:  $fc_retencion_dr_part);
        }
        $result->fc_retencion_dr_part = $fc_retencion_dr_part;

        $fc_conf_automatico = $this->fc_conf_automatico(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_conf_automatico', data:  $fc_conf_automatico);
        }
        $result->fc_conf_automatico = $fc_conf_automatico;

        $fc_ejecucion_automatica = $this->fc_ejecucion_automatica(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_ejecucion_automatica', data:  $fc_ejecucion_automatica);
        }
        $result->fc_ejecucion_automatica = $fc_ejecucion_automatica;

        $fc_factura_automatica = $this->fc_factura_automatica(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_factura_automatica', data:  $fc_factura_automatica);
        }
        $result->fc_factura_automatica = $fc_factura_automatica;

        $fc_conf_traslado = $this->fc_conf_traslado(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_conf_traslado', data:  $fc_conf_traslado);
        }
        $result->fc_conf_traslado = $fc_conf_traslado;

        $fc_conf_retenido = $this->fc_conf_retenido(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_conf_retenido', data:  $fc_conf_retenido);
        }
        $result->fc_conf_retenido = $fc_conf_retenido;

        $fc_impuesto_p = $this->fc_impuesto_p(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_impuesto_p', data:  $fc_impuesto_p);
        }
        $result->fc_impuesto_p = $fc_impuesto_p;

        $fc_traslado_p = $this->fc_traslado_p(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_traslado_p', data:  $fc_traslado_p);
        }
        $result->fc_traslado_p = $fc_traslado_p;

        $fc_retencion_p = $this->fc_retencion_p(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_retencion_p', data:  $fc_retencion_p);
        }
        $result->fc_retencion_p = $fc_retencion_p;

        $fc_traslado_p_part = $this->fc_traslado_p_part(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_traslado_p_part', data:  $fc_traslado_p_part);
        }
        $result->fc_traslado_p_part = $fc_traslado_p_part;

        $fc_retencion_p_part = $this->fc_retencion_p_part(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_retencion_p_part', data:  $fc_retencion_p_part);
        }
        $result->fc_retencion_p_part = $fc_retencion_p_part;

        $fc_traslado_nc = $this->fc_traslado_nc(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_traslado_nc', data:  $fc_traslado_nc);
        }
        $result->fc_traslado_nc = $fc_traslado_nc;

        $fc_traslado_cp = $this->fc_traslado_cp(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_traslado_cp', data:  $fc_traslado_cp);
        }
        $result->fc_traslado_cp = $fc_traslado_cp;

        $fc_email_cp = $this->fc_email_cp(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_email_cp', data:  $fc_email_cp);
        }
        $result->fc_email_cp = $fc_email_cp;

        $fc_email_nc = $this->fc_email_nc(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_email_nc', data:  $fc_email_nc);
        }
        $result->fc_email_cp = $fc_email_cp;

        $fc_retenido_cp = $this->fc_retenido_cp(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_retenido_cp', data:  $fc_retenido_cp);
        }
        $result->fc_retenido_cp = $fc_retenido_cp;

        $fc_pago_total = $this->fc_pago_total(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_pago_total', data:  $fc_pago_total);
        }
        $result->fc_pago_total = $fc_pago_total;


        $fc_complemento_pago_documento = $this->fc_complemento_pago_documento(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_complemento_pago_documento', data:  $fc_complemento_pago_documento);
        }
        $result->fc_complemento_pago_documento = $fc_complemento_pago_documento;

        $fc_nota_credito_documento = $this->fc_nota_credito_documento(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_nota_credito_documento', data:  $fc_nota_credito_documento);
        }
        $result->fc_nota_credito_documento = $fc_nota_credito_documento;


        $fc_cfdi_sellado_cp = $this->fc_cfdi_sellado_cp(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_cfdi_sellado_cp', data:  $fc_cfdi_sellado_cp);
        }
        $result->fc_cfdi_sellado_cp = $fc_cfdi_sellado_cp;

        $fc_cfdi_sellado_nc = $this->fc_cfdi_sellado_nc(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_cfdi_sellado_nc', data:  $fc_cfdi_sellado_nc);
        }
        $result->fc_cfdi_sellado_nc = $fc_cfdi_sellado_nc;

        $fc_uuid_cancela = $this->fc_uuid_cancela(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_uuid_cancela', data:  $fc_uuid_cancela);
        }
        $result->fc_uuid_cancela = $fc_uuid_cancela;

        $fc_receptor_email = $this->fc_receptor_email(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_receptor_email', data:  $fc_receptor_email);
        }
        $result->fc_receptor_email = $fc_receptor_email;

        $fc_conf_aut_producto = $this->fc_conf_aut_producto(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar fc_conf_aut_producto', data:  $fc_conf_aut_producto);
        }
        $result->fc_receptor_email = $fc_receptor_email;

        return $result;

    }

}