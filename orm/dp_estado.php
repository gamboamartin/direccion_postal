<?php
namespace gamboamartin\direccion_postal\models;
use base\orm\_defaults;
use base\orm\modelo;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class dp_estado extends modelo {
    public function __construct(PDO $link){
        $tabla = 'dp_estado';
        $columnas = array($tabla=>false,'dp_pais'=>$tabla);
        $campos_obligatorios[] = 'descripcion';
        $campos_obligatorios[] = 'descripcion_select';
        $campos_obligatorios[] = 'dp_pais_id';

        $campos_view['dp_pais_id'] = array('type' => 'selects', 'model' => new dp_pais($link));
        $campos_view['codigo'] = array('type' => 'inputs');
        $campos_view['descripcion'] = array('type' => 'inputs');

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas,campos_view: $campos_view);

        $this->NAMESPACE = __NAMESPACE__;
        $this->etiqueta = 'Estado';


        if(!isset($_SESSION['init'][$tabla])) {
            $catalogo[] = array('id'=>'1','codigo'=>'AGU','descripcion'=>'Aguascalientes','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'2','codigo'=>'BCN','descripcion'=>'Baja California','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'3','codigo'=>'BCS','descripcion'=>'Baja California Sur','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'4','codigo'=>'CAM','descripcion'=>'Campeche','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'5','codigo'=>'CHP','descripcion'=>'Chiapas','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'6','codigo'=>'CHH','descripcion'=>'Chihuahua','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'7','codigo'=>'COA','descripcion'=>'Coahuila','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'8','codigo'=>'COL','descripcion'=>'Colima','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'9','codigo'=>'CMX','descripcion'=>'Ciudad de México','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'10','codigo'=>'DUR','descripcion'=>'Durango','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'11','codigo'=>'GUA','descripcion'=>'Guanajuato','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'12','codigo'=>'GRO','descripcion'=>'Guerrero','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'13','codigo'=>'HID','descripcion'=>'Hidalgo','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'14','codigo'=>'JAL','descripcion'=>'Jalisco','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'15','codigo'=>'MEX','descripcion'=>'Estado de México','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'16','codigo'=>'MIC','descripcion'=>'Michoacán','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'17','codigo'=>'MOR','descripcion'=>'Morelos','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'18','codigo'=>'NAY','descripcion'=>'Nayarit','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'19','codigo'=>'NLE','descripcion'=>'Nuevo León','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'20','codigo'=>'OAX','descripcion'=>'Oaxaca','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'21','codigo'=>'PUE','descripcion'=>'Puebla','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'22','codigo'=>'QUE','descripcion'=>'Querétaro','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'23','codigo'=>'ROO','descripcion'=>'Quintana Roo','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'24','codigo'=>'SLP','descripcion'=>'San Luis Potosí','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'25','codigo'=>'SIN','descripcion'=>'Sinaloa','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'26','codigo'=>'SON','descripcion'=>'Sonora','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'27','codigo'=>'TAB','descripcion'=>'Tabasco','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'28','codigo'=>'TAM','descripcion'=>'Tamaulipas','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'29','codigo'=>'TLA','descripcion'=>'Tlaxcala','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'30','codigo'=>'VER','descripcion'=>'Veracruz','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'31','codigo'=>'YUC','descripcion'=>'Yucatán','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'32','codigo'=>'ZAC','descripcion'=>'Zacatecas','dp_pais_id'=>'151');
            $catalogo[] = array('id'=>'33','codigo'=>'AL','descripcion'=>'Alabama','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'34','codigo'=>'AK','descripcion'=>'Alaska','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'35','codigo'=>'AZ','descripcion'=>'Arizona','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'36','codigo'=>'AR','descripcion'=>'Arkansas','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'37','codigo'=>'CA','descripcion'=>'California','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'38','codigo'=>'NC','descripcion'=>'Carolina del Norte','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'39','codigo'=>'SC','descripcion'=>'Carolina del Sur','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'40','codigo'=>'CO','descripcion'=>'Colorado','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'41','codigo'=>'CT','descripcion'=>'Connecticut','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'42','codigo'=>'ND','descripcion'=>'Dakota del Norte','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'43','codigo'=>'SD','descripcion'=>'Dakota del Sur','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'44','codigo'=>'DE','descripcion'=>'Delaware','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'45','codigo'=>'FL','descripcion'=>'Florida','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'46','codigo'=>'GA','descripcion'=>'Georgia','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'47','codigo'=>'HI','descripcion'=>'Hawái','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'48','codigo'=>'ID','descripcion'=>'Idaho','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'49','codigo'=>'IL','descripcion'=>'Illinois','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'50','codigo'=>'IN','descripcion'=>'Indiana','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'51','codigo'=>'IA','descripcion'=>'Iowa','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'52','codigo'=>'KS','descripcion'=>'Kansas','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'53','codigo'=>'KY','descripcion'=>'Kentucky','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'54','codigo'=>'LA','descripcion'=>'Luisiana','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'55','codigo'=>'ME','descripcion'=>'Maine','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'56','codigo'=>'MD','descripcion'=>'Maryland','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'57','codigo'=>'MA','descripcion'=>'Massachusetts','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'58','codigo'=>'MI','descripcion'=>'Míchigan','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'59','codigo'=>'MN','descripcion'=>'Minnesota','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'60','codigo'=>'MS','descripcion'=>'Misisipi','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'61','codigo'=>'MO','descripcion'=>'Misuri','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'62','codigo'=>'MT','descripcion'=>'Montana','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'63','codigo'=>'NE','descripcion'=>'Nebraska','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'64','codigo'=>'NV','descripcion'=>'Nevada','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'65','codigo'=>'NJ','descripcion'=>'Nueva Jersey','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'66','codigo'=>'NY','descripcion'=>'Nueva York','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'67','codigo'=>'NH','descripcion'=>'Nuevo Hampshire','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'68','codigo'=>'NM','descripcion'=>'Nuevo México','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'69','codigo'=>'OH','descripcion'=>'Ohio','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'70','codigo'=>'OK','descripcion'=>'Oklahoma','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'71','codigo'=>'OR','descripcion'=>'Oregón','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'72','codigo'=>'PA','descripcion'=>'Pensilvania','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'73','codigo'=>'RI','descripcion'=>'Rhode Island','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'74','codigo'=>'TN','descripcion'=>'Tennessee','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'75','codigo'=>'TX','descripcion'=>'Texas','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'76','codigo'=>'UT','descripcion'=>'Utah','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'77','codigo'=>'VT','descripcion'=>'Vermont','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'78','codigo'=>'VA','descripcion'=>'Virginia','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'79','codigo'=>'WV','descripcion'=>'Virginia Occidental','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'80','codigo'=>'WA','descripcion'=>'Washington','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'81','codigo'=>'WI','descripcion'=>'Wisconsin','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'82','codigo'=>'WY','descripcion'=>'Wyoming','dp_pais_id'=>'66');
            $catalogo[] = array('id'=>'83','codigo'=>'ON','descripcion'=>'Ontario','dp_pais_id'=>'40');
            $catalogo[] = array('id'=>'84','codigo'=>'QC','descripcion'=>'Quebec','dp_pais_id'=>'40');
            $catalogo[] = array('id'=>'85','codigo'=>'NS','descripcion'=>'Nueva Escocia','dp_pais_id'=>'40');
            $catalogo[] = array('id'=>'86','codigo'=>'NB','descripcion'=>'Nuevo Brunswick','dp_pais_id'=>'40');
            $catalogo[] = array('id'=>'87','codigo'=>'MB','descripcion'=>'Manitoba','dp_pais_id'=>'40');
            $catalogo[] = array('id'=>'88','codigo'=>'BC','descripcion'=>'Columbia Británica','dp_pais_id'=>'40');
            $catalogo[] = array('id'=>'89','codigo'=>'PE','descripcion'=>'Isla del Príncipe Eduardo','dp_pais_id'=>'40');
            $catalogo[] = array('id'=>'90','codigo'=>'SK','descripcion'=>'Saskatchewan','dp_pais_id'=>'40');
            $catalogo[] = array('id'=>'91','codigo'=>'AB','descripcion'=>'Alberta','dp_pais_id'=>'40');
            $catalogo[] = array('id'=>'92','codigo'=>'NL','descripcion'=>'Terranova y Labrador','dp_pais_id'=>'40');
            $catalogo[] = array('id'=>'93','codigo'=>'NT','descripcion'=>'Territorios del Noroeste','dp_pais_id'=>'40');
            $catalogo[] = array('id'=>'94','codigo'=>'YT','descripcion'=>'Yukón','dp_pais_id'=>'40');
            $catalogo[] = array('id'=>'95','codigo'=>'UN','descripcion'=>'Nunavut','dp_pais_id'=>'40');



            $r_alta_bd = (new _defaults())->alta_defaults(catalogo: $catalogo, entidad: $this);
            if (errores::$error) {
                $error = $this->error->error(mensaje: 'Error al insertar', data: $r_alta_bd);
                print_r($error);
                exit;
            }
            $_SESSION['init'][$tabla] = true;
        }


    }

    public function alta_bd(): array|stdClass
    {
        $this->registro = $this->campos_base(data:$this->registro, modelo: $this);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar campo base',data: $this->registro);
        }

        if(!isset($this->registro['dp_pais_id'])){

            $r_pred = (new dp_pais(link: $this->link))->inserta_predeterminado();
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al insertar prederminado',data:  $r_pred);
            }

            $dp_pais_id = (new dp_pais($this->link))->id_predeterminado();
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al obtener pais predeterminado',data:  $dp_pais_id);
            }
            $this->registro['dp_pais_id'] = $dp_pais_id;
        }

        $r_alta_bd = parent::alta_bd();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al insertar estado',data:  $r_alta_bd);
        }
        return $r_alta_bd;
    }


    public function modifica_bd(array $registro, int $id, bool $reactiva = false): array|stdClass
    {
        $registro = $this->campos_base(data: $registro, modelo: $this, id: $id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar campo base',data: $registro);
        }

        $r_modifica_bd = parent::modifica_bd(registro: $registro,id: $id,reactiva:  $reactiva);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al modificar estado',data:  $r_modifica_bd);
        }
        return $r_modifica_bd;
    }

    public function get_estado(int $dp_estado_id): array|stdClass|int
    {
        $registro = $this->registro(registro_id: $dp_estado_id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener estado',data:  $registro);
        }

        return $registro;
    }

    public function get_estado_default(): array|stdClass|int
    {
        $filtro["dp_estado.predeterminado"] = 'activo';
        $registro = $this->filtro_and(filtro: $filtro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener el estado predeterminado',data:  $registro);
        }

        return $registro;
    }

    public function get_estado_default_id(): array|stdClass|int
    {
        $id_predeterminado = $this->id_predeterminado();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener el estado predeterminado',data:  $id_predeterminado);
        }

        return (int)$id_predeterminado;
    }

}