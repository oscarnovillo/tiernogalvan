<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 03/06/2018
 * Time: 22:57
 */
/**
 * CRON - para enviar correos masivamente
 *
 * Recupera los datos de la tabla ENVIAR_CORREOS
 * y la recorre enviando ofertas de trabajo para toda persona apuntada en un ciclo de formación definida en su perfil
 *
 */
require_once '../../vendor/autoload.php';

use config\ConfigBolsaTrabajo;
use servicios\bolsaTrabajo\BolsaTrabajoServicios;

$servicios = new BolsaTrabajoServicios();

$servicios->enviarCorreoMasivo(ConfigBolsaTrabajo::LIMITE_CORREOS_POR_HORA);