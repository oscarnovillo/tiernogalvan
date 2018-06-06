<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 19/05/2018
 * Time: 19:44
 */

namespace config;


class ConfigBolsaTrabajo
{
    //Tamaño del texto descriptivo de las ofertas mostradas en la página mostrada
    const LONGITUD_TEXTO_DESCRIPCION = 150;
    //Número de ofertas mostradas por página
    const NUM_RESULTADOS_OFERTAS = 10;

    //Directorio fotos perfiles
    const DIRECTORIO_PERFILES = "img/bolsaTrabajo/perfiles";

    //Limite impuesto por Google
    const LIMITE_CORREOS_POR_DIA = 500;
    //limite para enviar correos por hora
    const LIMITE_CORREOS_POR_HORA = 20;


    //Buzón de Correo
    const MAIL_FROM = "awcrud@gmail.com";
    const MAIL_FROM_BOLSA_DE_TRABAJO = "el.tierno.galvan@gmail.com";
    const SMTP_SERVER = "smtp.gmail.com";
    const SMTP_PORT = 587;
    const MAIL_PASS = "nohay2sin3";
    const EMAIL_ORIGEN = "tierno_galvan@gmail.com";
    const RESPONSABLE_ORIGEN = "IES Tierno Galván - Bolsa de Trabajo";


}