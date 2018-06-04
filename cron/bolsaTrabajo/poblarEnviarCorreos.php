<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 03/06/2018
 * Time: 16:42
 */


/**
 * CRON - para rellenar la tabla ENVIAR_OFERTAS.
 * Esta tabla contiene la ID_OFERTA e ID_USER.
 * A cada uno de los Users se le enviará un correo con la oferta asociada, esto lo hace otro script
 *
 *
 */

require_once '../../vendor/autoload.php';

use servicios\bolsaTrabajo\BolsaTrabajoServicios;

$servicios = new BolsaTrabajoServicios();

$servicios->recuperarOfertasANotificar();