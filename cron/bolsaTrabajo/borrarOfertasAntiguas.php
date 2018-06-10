<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 04/06/2018
 * Time: 23:01
 */
/**
 * Borramos ofertas de trabajo antiguas
 *
 * CRON  - 1 día
 */
require_once '../../vendor/autoload.php';

use servicios\bolsaTrabajo\BolsaTrabajoServicios;

$servicios = new BolsaTrabajoServicios();

$servicios->borrarViejasOfertas();//TODO - mostrar cambios por pantalla para presentación
