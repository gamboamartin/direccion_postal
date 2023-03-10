<?php
namespace gamboamartin\direccion_postal\models;
use base\orm\_defaults;
use base\orm\_modelo_parent;
use gamboamartin\errores\errores;
use PDO;

class dp_pais extends _modelo_parent {
    public function __construct(PDO $link){
        $tabla = 'dp_pais';
        $columnas = array($tabla=>false);
        $campos_obligatorios[] = 'descripcion';
        $campos_obligatorios[] = 'descripcion_select';

        $campos_view['codigo'] = array('type' => 'inputs');
        $campos_view['descripcion'] = array('type' => 'inputs');

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas, campos_view: $campos_view);
        $this->NAMESPACE = __NAMESPACE__;
        $this->etiqueta = 'Pais';


        if(!isset($_SESSION['init'][$tabla])) {
            $catalogo = array();
            $catalogo[] = array('id'=>'1','codigo'=>'AFG','descripcion'=>'Afganistán');
            $catalogo[] = array('id'=>'2','codigo'=>'ALA','descripcion'=>'Islas Åland');
            $catalogo[] = array('id'=>'3','codigo'=>'ALB','descripcion'=>'Albania');
            $catalogo[] = array('id'=>'4','codigo'=>'DEU','descripcion'=>'Alemania');
            $catalogo[] = array('id'=>'5','codigo'=>'AND','descripcion'=>'Andorra');
            $catalogo[] = array('id'=>'6','codigo'=>'AGO','descripcion'=>'Angola');
            $catalogo[] = array('id'=>'7','codigo'=>'AIA','descripcion'=>'Anguila');
            $catalogo[] = array('id'=>'8','codigo'=>'ATA','descripcion'=>'Antártida');
            $catalogo[] = array('id'=>'9','codigo'=>'ATG','descripcion'=>'Antigua y Barbuda');
            $catalogo[] = array('id'=>'10','codigo'=>'SAU','descripcion'=>'Arabia Saudita');
            $catalogo[] = array('id'=>'11','codigo'=>'DZA','descripcion'=>'Argelia');
            $catalogo[] = array('id'=>'12','codigo'=>'ARG','descripcion'=>'Argentina');
            $catalogo[] = array('id'=>'13','codigo'=>'ARM','descripcion'=>'Armenia');
            $catalogo[] = array('id'=>'14','codigo'=>'ABW','descripcion'=>'Aruba');
            $catalogo[] = array('id'=>'15','codigo'=>'AUS','descripcion'=>'Australia');
            $catalogo[] = array('id'=>'16','codigo'=>'AUT','descripcion'=>'Austria');
            $catalogo[] = array('id'=>'17','codigo'=>'AZE','descripcion'=>'Azerbaiyán');
            $catalogo[] = array('id'=>'18','codigo'=>'BHS','descripcion'=>'Bahamas (las)');
            $catalogo[] = array('id'=>'19','codigo'=>'BGD','descripcion'=>'Bangladés');
            $catalogo[] = array('id'=>'20','codigo'=>'BRB','descripcion'=>'Barbados');
            $catalogo[] = array('id'=>'21','codigo'=>'BHR','descripcion'=>'Baréin');
            $catalogo[] = array('id'=>'22','codigo'=>'BEL','descripcion'=>'Bélgica');
            $catalogo[] = array('id'=>'23','codigo'=>'BLZ','descripcion'=>'Belice');
            $catalogo[] = array('id'=>'24','codigo'=>'BEN','descripcion'=>'Benín');
            $catalogo[] = array('id'=>'25','codigo'=>'BMU','descripcion'=>'Bermudas');
            $catalogo[] = array('id'=>'26','codigo'=>'BLR','descripcion'=>'Bielorrusia');
            $catalogo[] = array('id'=>'27','codigo'=>'MMR','descripcion'=>'Myanmar');
            $catalogo[] = array('id'=>'28','codigo'=>'BOL','descripcion'=>'Bolivia, Estado Plurinacional de');
            $catalogo[] = array('id'=>'29','codigo'=>'BIH','descripcion'=>'Bosnia y Herzegovina');
            $catalogo[] = array('id'=>'30','codigo'=>'BWA','descripcion'=>'Botsuana');
            $catalogo[] = array('id'=>'31','codigo'=>'BRA','descripcion'=>'Brasil');
            $catalogo[] = array('id'=>'32','codigo'=>'BRN','descripcion'=>'Brunéi Darussalam');
            $catalogo[] = array('id'=>'33','codigo'=>'BGR','descripcion'=>'Bulgaria');
            $catalogo[] = array('id'=>'34','codigo'=>'BFA','descripcion'=>'Burkina Faso');
            $catalogo[] = array('id'=>'35','codigo'=>'BDI','descripcion'=>'Burundi');
            $catalogo[] = array('id'=>'36','codigo'=>'BTN','descripcion'=>'Bután');
            $catalogo[] = array('id'=>'37','codigo'=>'CPV','descripcion'=>'Cabo Verde');
            $catalogo[] = array('id'=>'38','codigo'=>'KHM','descripcion'=>'Camboya');
            $catalogo[] = array('id'=>'39','codigo'=>'CMR','descripcion'=>'Camerún');
            $catalogo[] = array('id'=>'40','codigo'=>'CAN','descripcion'=>'Canadá');
            $catalogo[] = array('id'=>'41','codigo'=>'QAT','descripcion'=>'Catar');
            $catalogo[] = array('id'=>'42','codigo'=>'BES','descripcion'=>'Bonaire, San Eustaquio y Saba');
            $catalogo[] = array('id'=>'43','codigo'=>'TCD','descripcion'=>'Chad');
            $catalogo[] = array('id'=>'44','codigo'=>'CHL','descripcion'=>'Chile');
            $catalogo[] = array('id'=>'45','codigo'=>'CHN','descripcion'=>'China');
            $catalogo[] = array('id'=>'46','codigo'=>'CYP','descripcion'=>'Chipre');
            $catalogo[] = array('id'=>'47','codigo'=>'COL','descripcion'=>'Colombia');
            $catalogo[] = array('id'=>'48','codigo'=>'COM','descripcion'=>'Comoras');
            $catalogo[] = array('id'=>'49','codigo'=>'PRK','descripcion'=>'Corea (la República Democrática Popular de)');
            $catalogo[] = array('id'=>'50','codigo'=>'KOR','descripcion'=>'Corea (la República de)');
            $catalogo[] = array('id'=>'51','codigo'=>'CIV','descripcion'=>'Côte dIvoire');
            $catalogo[] = array('id'=>'52','codigo'=>'CRI','descripcion'=>'Costa Rica');
            $catalogo[] = array('id'=>'53','codigo'=>'HRV','descripcion'=>'Croacia');
            $catalogo[] = array('id'=>'54','codigo'=>'CUB','descripcion'=>'Cuba');
            $catalogo[] = array('id'=>'55','codigo'=>'CUW','descripcion'=>'Curaçao');
            $catalogo[] = array('id'=>'56','codigo'=>'DNK','descripcion'=>'Dinamarca');
            $catalogo[] = array('id'=>'57','codigo'=>'DMA','descripcion'=>'Dominica');
            $catalogo[] = array('id'=>'58','codigo'=>'ECU','descripcion'=>'Ecuador');
            $catalogo[] = array('id'=>'59','codigo'=>'EGY','descripcion'=>'Egipto');
            $catalogo[] = array('id'=>'60','codigo'=>'SLV','descripcion'=>'El Salvador');
            $catalogo[] = array('id'=>'61','codigo'=>'ARE','descripcion'=>'Emiratos Árabes Unidos (Los)');
            $catalogo[] = array('id'=>'62','codigo'=>'ERI','descripcion'=>'Eritrea');
            $catalogo[] = array('id'=>'63','codigo'=>'SVK','descripcion'=>'Eslovaquia');
            $catalogo[] = array('id'=>'64','codigo'=>'SVN','descripcion'=>'Eslovenia');
            $catalogo[] = array('id'=>'65','codigo'=>'ESP','descripcion'=>'España');
            $catalogo[] = array('id'=>'66','codigo'=>'USA','descripcion'=>'Estados Unidos (los)');
            $catalogo[] = array('id'=>'67','codigo'=>'EST','descripcion'=>'Estonia');
            $catalogo[] = array('id'=>'68','codigo'=>'ETH','descripcion'=>'Etiopía');
            $catalogo[] = array('id'=>'69','codigo'=>'PHL','descripcion'=>'Filipinas (las)');
            $catalogo[] = array('id'=>'70','codigo'=>'FIN','descripcion'=>'Finlandia');
            $catalogo[] = array('id'=>'71','codigo'=>'FJI','descripcion'=>'Fiyi');
            $catalogo[] = array('id'=>'72','codigo'=>'FRA','descripcion'=>'Francia');
            $catalogo[] = array('id'=>'73','codigo'=>'GAB','descripcion'=>'Gabón');
            $catalogo[] = array('id'=>'74','codigo'=>'GMB','descripcion'=>'Gambia (La)');
            $catalogo[] = array('id'=>'75','codigo'=>'GEO','descripcion'=>'Georgia');
            $catalogo[] = array('id'=>'76','codigo'=>'GHA','descripcion'=>'Ghana');
            $catalogo[] = array('id'=>'77','codigo'=>'GIB','descripcion'=>'Gibraltar');
            $catalogo[] = array('id'=>'78','codigo'=>'GRD','descripcion'=>'Granada');
            $catalogo[] = array('id'=>'79','codigo'=>'GRC','descripcion'=>'Grecia');
            $catalogo[] = array('id'=>'80','codigo'=>'GRL','descripcion'=>'Groenlandia');
            $catalogo[] = array('id'=>'81','codigo'=>'GLP','descripcion'=>'Guadalupe');
            $catalogo[] = array('id'=>'82','codigo'=>'GUM','descripcion'=>'Guam');
            $catalogo[] = array('id'=>'83','codigo'=>'GTM','descripcion'=>'Guatemala');
            $catalogo[] = array('id'=>'84','codigo'=>'GUF','descripcion'=>'Guayana Francesa');
            $catalogo[] = array('id'=>'85','codigo'=>'GGY','descripcion'=>'Guernsey');
            $catalogo[] = array('id'=>'86','codigo'=>'GIN','descripcion'=>'Guinea');
            $catalogo[] = array('id'=>'87','codigo'=>'GNB','descripcion'=>'Guinea-Bisáu');
            $catalogo[] = array('id'=>'88','codigo'=>'GNQ','descripcion'=>'Guinea Ecuatorial');
            $catalogo[] = array('id'=>'89','codigo'=>'GUY','descripcion'=>'Guyana');
            $catalogo[] = array('id'=>'90','codigo'=>'HTI','descripcion'=>'Haití');
            $catalogo[] = array('id'=>'91','codigo'=>'HND','descripcion'=>'Honduras');
            $catalogo[] = array('id'=>'92','codigo'=>'HKG','descripcion'=>'Hong Kong');
            $catalogo[] = array('id'=>'93','codigo'=>'HUN','descripcion'=>'Hungría');
            $catalogo[] = array('id'=>'94','codigo'=>'IND','descripcion'=>'India');
            $catalogo[] = array('id'=>'95','codigo'=>'IDN','descripcion'=>'Indonesia');
            $catalogo[] = array('id'=>'96','codigo'=>'IRQ','descripcion'=>'Irak');
            $catalogo[] = array('id'=>'97','codigo'=>'IRN','descripcion'=>'Irán (la República Islámica de)');
            $catalogo[] = array('id'=>'98','codigo'=>'IRL','descripcion'=>'Irlanda');
            $catalogo[] = array('id'=>'99','codigo'=>'BVT','descripcion'=>'Isla Bouvet');
            $catalogo[] = array('id'=>'100','codigo'=>'IMN','descripcion'=>'Isla de Man');
            $catalogo[] = array('id'=>'101','codigo'=>'CXR','descripcion'=>'Isla de Navidad');
            $catalogo[] = array('id'=>'102','codigo'=>'NFK','descripcion'=>'Isla Norfolk');
            $catalogo[] = array('id'=>'103','codigo'=>'ISL','descripcion'=>'Islandia');
            $catalogo[] = array('id'=>'104','codigo'=>'CYM','descripcion'=>'Islas Caimán (las)');
            $catalogo[] = array('id'=>'105','codigo'=>'CCK','descripcion'=>'Islas Cocos (Keeling)');
            $catalogo[] = array('id'=>'106','codigo'=>'COK','descripcion'=>'Islas Cook (las)');
            $catalogo[] = array('id'=>'107','codigo'=>'FRO','descripcion'=>'Islas Feroe (las)');
            $catalogo[] = array('id'=>'108','codigo'=>'SGS','descripcion'=>'Georgia del sur y las islas sandwich del sur');
            $catalogo[] = array('id'=>'109','codigo'=>'HMD','descripcion'=>'Isla Heard e Islas McDonald');
            $catalogo[] = array('id'=>'110','codigo'=>'FLK','descripcion'=>'Islas Malvinas [Falkland] (las)');
            $catalogo[] = array('id'=>'111','codigo'=>'MNP','descripcion'=>'Islas Marianas del Norte (las)');
            $catalogo[] = array('id'=>'112','codigo'=>'MHL','descripcion'=>'Islas Marshall (las)');
            $catalogo[] = array('id'=>'113','codigo'=>'PCN','descripcion'=>'Pitcairn');
            $catalogo[] = array('id'=>'114','codigo'=>'SLB','descripcion'=>'Islas Salomón (las)');
            $catalogo[] = array('id'=>'115','codigo'=>'TCA','descripcion'=>'Islas Turcas y Caicos (las)');
            $catalogo[] = array('id'=>'116','codigo'=>'UMI','descripcion'=>'Islas de Ultramar Menores de Estados Unidos (las)');
            $catalogo[] = array('id'=>'117','codigo'=>'VGB','descripcion'=>'Islas Vírgenes (Británicas)');
            $catalogo[] = array('id'=>'118','codigo'=>'VIR','descripcion'=>'Islas Vírgenes (EE.UU.)');
            $catalogo[] = array('id'=>'119','codigo'=>'ISR','descripcion'=>'Israel');
            $catalogo[] = array('id'=>'120','codigo'=>'ITA','descripcion'=>'Italia');
            $catalogo[] = array('id'=>'121','codigo'=>'JAM','descripcion'=>'Jamaica');
            $catalogo[] = array('id'=>'122','codigo'=>'JPN','descripcion'=>'Japón');
            $catalogo[] = array('id'=>'123','codigo'=>'JEY','descripcion'=>'Jersey');
            $catalogo[] = array('id'=>'124','codigo'=>'JOR','descripcion'=>'Jordania');
            $catalogo[] = array('id'=>'125','codigo'=>'KAZ','descripcion'=>'Kazajistán');
            $catalogo[] = array('id'=>'126','codigo'=>'KEN','descripcion'=>'Kenia');
            $catalogo[] = array('id'=>'127','codigo'=>'KGZ','descripcion'=>'Kirguistán');
            $catalogo[] = array('id'=>'128','codigo'=>'KIR','descripcion'=>'Kiribati');
            $catalogo[] = array('id'=>'129','codigo'=>'KWT','descripcion'=>'Kuwait');
            $catalogo[] = array('id'=>'130','codigo'=>'LAO','descripcion'=>'Lao, (la) República Democrática Popular');
            $catalogo[] = array('id'=>'131','codigo'=>'LSO','descripcion'=>'Lesoto');
            $catalogo[] = array('id'=>'132','codigo'=>'LVA','descripcion'=>'Letonia');
            $catalogo[] = array('id'=>'133','codigo'=>'LBN','descripcion'=>'Líbano');
            $catalogo[] = array('id'=>'134','codigo'=>'LBR','descripcion'=>'Liberia');
            $catalogo[] = array('id'=>'135','codigo'=>'LBY','descripcion'=>'Libia');
            $catalogo[] = array('id'=>'136','codigo'=>'LIE','descripcion'=>'Liechtenstein');
            $catalogo[] = array('id'=>'137','codigo'=>'LTU','descripcion'=>'Lituania');
            $catalogo[] = array('id'=>'138','codigo'=>'LUX','descripcion'=>'Luxemburgo');
            $catalogo[] = array('id'=>'139','codigo'=>'MAC','descripcion'=>'Macao');
            $catalogo[] = array('id'=>'140','codigo'=>'MDG','descripcion'=>'Madagascar');
            $catalogo[] = array('id'=>'141','codigo'=>'MYS','descripcion'=>'Malasia');
            $catalogo[] = array('id'=>'142','codigo'=>'MWI','descripcion'=>'Malaui');
            $catalogo[] = array('id'=>'143','codigo'=>'MDV','descripcion'=>'Maldivas');
            $catalogo[] = array('id'=>'144','codigo'=>'MLI','descripcion'=>'Malí');
            $catalogo[] = array('id'=>'145','codigo'=>'MLT','descripcion'=>'Malta');
            $catalogo[] = array('id'=>'146','codigo'=>'MAR','descripcion'=>'Marruecos');
            $catalogo[] = array('id'=>'147','codigo'=>'MTQ','descripcion'=>'Martinica');
            $catalogo[] = array('id'=>'148','codigo'=>'MUS','descripcion'=>'Mauricio');
            $catalogo[] = array('id'=>'149','codigo'=>'MRT','descripcion'=>'Mauritania');
            $catalogo[] = array('id'=>'150','codigo'=>'MYT','descripcion'=>'Mayotte');
            $catalogo[] = array('id'=>'151','codigo'=>'MEX','descripcion'=>'Mexico');
            $catalogo[] = array('id'=>'152','codigo'=>'FSM','descripcion'=>'Micronesia (los Estados Federados de)');
            $catalogo[] = array('id'=>'153','codigo'=>'MDA','descripcion'=>'Moldavia (la República de)');
            $catalogo[] = array('id'=>'154','codigo'=>'MCO','descripcion'=>'Mónaco');
            $catalogo[] = array('id'=>'155','codigo'=>'MNG','descripcion'=>'Mongolia');
            $catalogo[] = array('id'=>'156','codigo'=>'MNE','descripcion'=>'Montenegro');
            $catalogo[] = array('id'=>'157','codigo'=>'MSR','descripcion'=>'Montserrat');
            $catalogo[] = array('id'=>'158','codigo'=>'MOZ','descripcion'=>'Mozambique');
            $catalogo[] = array('id'=>'159','codigo'=>'NAM','descripcion'=>'Namibia');
            $catalogo[] = array('id'=>'160','codigo'=>'NRU','descripcion'=>'Nauru');
            $catalogo[] = array('id'=>'161','codigo'=>'NPL','descripcion'=>'Nepal');
            $catalogo[] = array('id'=>'162','codigo'=>'NIC','descripcion'=>'Nicaragua');
            $catalogo[] = array('id'=>'163','codigo'=>'NER','descripcion'=>'Níger (el)');
            $catalogo[] = array('id'=>'164','codigo'=>'NGA','descripcion'=>'Nigeria');
            $catalogo[] = array('id'=>'165','codigo'=>'NIU','descripcion'=>'Niue');
            $catalogo[] = array('id'=>'166','codigo'=>'NOR','descripcion'=>'Noruega');
            $catalogo[] = array('id'=>'167','codigo'=>'NCL','descripcion'=>'Nueva Caledonia');
            $catalogo[] = array('id'=>'168','codigo'=>'NZL','descripcion'=>'Nueva Zelanda');
            $catalogo[] = array('id'=>'169','codigo'=>'OMN','descripcion'=>'Omán');
            $catalogo[] = array('id'=>'170','codigo'=>'NLD','descripcion'=>'Países Bajos (los)');
            $catalogo[] = array('id'=>'171','codigo'=>'PAK','descripcion'=>'Pakistán');
            $catalogo[] = array('id'=>'172','codigo'=>'PLW','descripcion'=>'Palaos');
            $catalogo[] = array('id'=>'173','codigo'=>'PSE','descripcion'=>'Palestina, Estado de');
            $catalogo[] = array('id'=>'174','codigo'=>'PAN','descripcion'=>'Panamá');
            $catalogo[] = array('id'=>'175','codigo'=>'PNG','descripcion'=>'Papúa Nueva Guinea');
            $catalogo[] = array('id'=>'176','codigo'=>'PRY','descripcion'=>'Paraguay');
            $catalogo[] = array('id'=>'177','codigo'=>'PER','descripcion'=>'Perú');
            $catalogo[] = array('id'=>'178','codigo'=>'PYF','descripcion'=>'Polinesia Francesa');
            $catalogo[] = array('id'=>'179','codigo'=>'POL','descripcion'=>'Polonia');
            $catalogo[] = array('id'=>'180','codigo'=>'PRT','descripcion'=>'Portugal');
            $catalogo[] = array('id'=>'181','codigo'=>'PRI','descripcion'=>'Puerto Rico');
            $catalogo[] = array('id'=>'182','codigo'=>'GBR','descripcion'=>'Reino Unido (el)');
            $catalogo[] = array('id'=>'183','codigo'=>'CAF','descripcion'=>'República Centroafricana (la)');
            $catalogo[] = array('id'=>'184','codigo'=>'CZE','descripcion'=>'República Checa (la)');
            $catalogo[] = array('id'=>'185','codigo'=>'MKD','descripcion'=>'Macedonia (la antigua República Yugoslava de)');
            $catalogo[] = array('id'=>'186','codigo'=>'COG','descripcion'=>'Congo');
            $catalogo[] = array('id'=>'187','codigo'=>'COD','descripcion'=>'Congo (la República Democrática del)');
            $catalogo[] = array('id'=>'188','codigo'=>'DOM','descripcion'=>'República Dominicana (la)');
            $catalogo[] = array('id'=>'189','codigo'=>'REU','descripcion'=>'Reunión');
            $catalogo[] = array('id'=>'190','codigo'=>'RWA','descripcion'=>'Ruanda');
            $catalogo[] = array('id'=>'191','codigo'=>'ROU','descripcion'=>'Rumania');
            $catalogo[] = array('id'=>'192','codigo'=>'RUS','descripcion'=>'Rusia, (la) Federación de');
            $catalogo[] = array('id'=>'193','codigo'=>'ESH','descripcion'=>'Sahara Occidental');
            $catalogo[] = array('id'=>'194','codigo'=>'WSM','descripcion'=>'Samoa');
            $catalogo[] = array('id'=>'195','codigo'=>'ASM','descripcion'=>'Samoa Americana');
            $catalogo[] = array('id'=>'196','codigo'=>'BLM','descripcion'=>'San Bartolomé');
            $catalogo[] = array('id'=>'197','codigo'=>'KNA','descripcion'=>'San Cristóbal y Nieves');
            $catalogo[] = array('id'=>'198','codigo'=>'SMR','descripcion'=>'San Marino');
            $catalogo[] = array('id'=>'199','codigo'=>'MAF','descripcion'=>'San Martín (parte francesa)');
            $catalogo[] = array('id'=>'200','codigo'=>'SPM','descripcion'=>'San Pedro y Miquelón');
            $catalogo[] = array('id'=>'201','codigo'=>'VCT','descripcion'=>'San Vicente y las Granadinas');
            $catalogo[] = array('id'=>'202','codigo'=>'SHN','descripcion'=>'Santa Helena, Ascensión y Tristán de Acuña');
            $catalogo[] = array('id'=>'203','codigo'=>'LCA','descripcion'=>'Santa Lucía');
            $catalogo[] = array('id'=>'204','codigo'=>'STP','descripcion'=>'Santo Tomé y Príncipe');
            $catalogo[] = array('id'=>'205','codigo'=>'SEN','descripcion'=>'Senegal');
            $catalogo[] = array('id'=>'206','codigo'=>'SRB','descripcion'=>'Serbia');
            $catalogo[] = array('id'=>'207','codigo'=>'SYC','descripcion'=>'Seychelles');
            $catalogo[] = array('id'=>'208','codigo'=>'SLE','descripcion'=>'Sierra leona');
            $catalogo[] = array('id'=>'209','codigo'=>'SGP','descripcion'=>'Singapur');
            $catalogo[] = array('id'=>'210','codigo'=>'SXM','descripcion'=>'Sint Maarten (parte holandesa)');
            $catalogo[] = array('id'=>'211','codigo'=>'SYR','descripcion'=>'Siria, (la) República Árabe');
            $catalogo[] = array('id'=>'212','codigo'=>'SOM','descripcion'=>'Somalia');
            $catalogo[] = array('id'=>'213','codigo'=>'LKA','descripcion'=>'Sri Lanka');
            $catalogo[] = array('id'=>'214','codigo'=>'SWZ','descripcion'=>'Suazilandia');
            $catalogo[] = array('id'=>'215','codigo'=>'ZAF','descripcion'=>'Sudáfrica');
            $catalogo[] = array('id'=>'216','codigo'=>'SDN','descripcion'=>'Sudán (el)');
            $catalogo[] = array('id'=>'217','codigo'=>'SSD','descripcion'=>'Sudán del Sur');
            $catalogo[] = array('id'=>'218','codigo'=>'SWE','descripcion'=>'Suecia');
            $catalogo[] = array('id'=>'219','codigo'=>'CHE','descripcion'=>'Suiza');
            $catalogo[] = array('id'=>'220','codigo'=>'SUR','descripcion'=>'Surinam');
            $catalogo[] = array('id'=>'221','codigo'=>'SJM','descripcion'=>'Svalbard y Jan Mayen');
            $catalogo[] = array('id'=>'222','codigo'=>'THA','descripcion'=>'Tailandia');
            $catalogo[] = array('id'=>'223','codigo'=>'TWN','descripcion'=>'Taiwán (Provincia de China)');
            $catalogo[] = array('id'=>'224','codigo'=>'TZA','descripcion'=>'Tanzania, República Unida de');
            $catalogo[] = array('id'=>'225','codigo'=>'TJK','descripcion'=>'Tayikistán');
            $catalogo[] = array('id'=>'226','codigo'=>'IOT','descripcion'=>'Territorio Británico del Océano Índico (el)');
            $catalogo[] = array('id'=>'227','codigo'=>'ATF','descripcion'=>'Territorios Australes Franceses (los)');
            $catalogo[] = array('id'=>'228','codigo'=>'TLS','descripcion'=>'Timor-Leste');
            $catalogo[] = array('id'=>'229','codigo'=>'TGO','descripcion'=>'Togo');
            $catalogo[] = array('id'=>'230','codigo'=>'TKL','descripcion'=>'Tokelau');
            $catalogo[] = array('id'=>'231','codigo'=>'TON','descripcion'=>'Tonga');
            $catalogo[] = array('id'=>'232','codigo'=>'TTO','descripcion'=>'Trinidad y Tobago');
            $catalogo[] = array('id'=>'233','codigo'=>'TUN','descripcion'=>'Túnez');
            $catalogo[] = array('id'=>'234','codigo'=>'TKM','descripcion'=>'Turkmenistán');
            $catalogo[] = array('id'=>'235','codigo'=>'TUR','descripcion'=>'Turquía');
            $catalogo[] = array('id'=>'236','codigo'=>'TUV','descripcion'=>'Tuvalu');
            $catalogo[] = array('id'=>'237','codigo'=>'UKR','descripcion'=>'Ucrania');
            $catalogo[] = array('id'=>'238','codigo'=>'UGA','descripcion'=>'Uganda');
            $catalogo[] = array('id'=>'239','codigo'=>'URY','descripcion'=>'Uruguay');
            $catalogo[] = array('id'=>'240','codigo'=>'UZB','descripcion'=>'Uzbekistán');
            $catalogo[] = array('id'=>'241','codigo'=>'VUT','descripcion'=>'Vanuatu');
            $catalogo[] = array('id'=>'242','codigo'=>'VAT','descripcion'=>'Santa Sede[Estado de la Ciudad del Vaticano] (la)');
            $catalogo[] = array('id'=>'243','codigo'=>'VEN','descripcion'=>'Venezuela, República Bolivariana de');
            $catalogo[] = array('id'=>'244','codigo'=>'VNM','descripcion'=>'Viet Nam');
            $catalogo[] = array('id'=>'245','codigo'=>'WLF','descripcion'=>'Wallis y Futuna');
            $catalogo[] = array('id'=>'246','codigo'=>'YEM','descripcion'=>'Yemen');
            $catalogo[] = array('id'=>'247','codigo'=>'DJI','descripcion'=>'Yibuti');
            $catalogo[] = array('id'=>'248','codigo'=>'ZMB','descripcion'=>'Zambia');
            $catalogo[] = array('id'=>'249','codigo'=>'ZWE','descripcion'=>'Zimbabue');
            $catalogo[] = array('id'=>'250','codigo'=>'ZZZ','descripcion'=>'Países no declarados');


            $r_alta_bd = (new _defaults())->alta_defaults(catalogo: $catalogo, entidad: $this);
            if (errores::$error) {
                $error = $this->error->error(mensaje: 'Error al insertar', data: $r_alta_bd);
                print_r($error);
                exit;
            }
            $_SESSION['init'][$tabla] = true;

        }

    }

}