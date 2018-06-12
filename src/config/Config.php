<?php

namespace config;
/*
 * INFORMACIÓN IMPORTANTE, LEER:
 * SE USA LA DB ACTUAL, NO SE MODIFICA YA QUE AHORRAMOS TIEMPO PARA EL TRABAJO GRUPAL.
 * SI TENÍAIS UNA DB ANTIGUA, EXPORTARLA Y LUEGO LA IMPORTÁIS EN LA ACTUAL.
 * LA CONEXIÓN ACTUAL SÓLO SE USARÁ PARA ESTE PROYECTO.
 * PENSAR QUE SI SEGUÍS USANDO OTRA, OS VA A TOCAR PASARLO IGUALMENTE,
 * LA BASE DE DATOS EN EL INSTI VA A ESTAR CENTRALIZADA.
 * AHORRÁOS TRABAJO PARA DENTRO DE DOS SEMANAS :)
 */
class Config
{

    const MAIL_SERVER = "smtp.gmail.com";
    const MAIL_USER = "el.tierno.galvan@gmail.com";
    const MAIL_NAME = 'IES Enrique Tierno Galván';
    const MAIL_PASSWORD = "nohay2sin3";
    const MAIL_PORT = 587;

    /*
     * La configuración de aquí abajo cita si se debe alertar cuando
     * se agregue una incidencia a los TIC's y admins por email a modo de notificación
     * o no.
     */
    const SEND_MAIL_ADMIN_ALERT = true;

    const DB_SERVER_NAME = "db4free.net:3307";
    const DB_USER_NAME = "appbanco";
    const DB_PASSWORD = "appbanco";
    const DB_DATABASE = "appbanco";
    
}
