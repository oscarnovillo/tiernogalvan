<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 18/05/2018
 * Time: 17:11
 */

namespace utils\bolsaTrabajo;


class MensajesBT
{
    const OPERACION_ACEPTADA = "Operación Aceptada";
    const OPERACION_DENEGADA = "Operación Denegada";

    const ACTUALIZACION_ACEPTADA = "La actualización de sus datos ha sido aceptada";
    const BORRAR_ACEPTADA = "Hemos borrado los datos correctamente";

    const ACTUALIZACION_DENEGADA = "Fallo en la actualización de los datos, por favor revisa que todos los campos cumplen sus reglas";
    const BORRAR_DENEGADA = "Fallo borrando los datos, por favor inténtalo otra vez";

    const ERROR_FALLO_IDENTIFICADOR = "Fallo en la identificación de parametros, por favor estas enviando paramentros erróneos";
    const ERROR_FALLO_IDENTIFICADOR_USER = "Fallo en la identificación del usuari@, hemos perdido tu identificador de usuari@, por favor refresca o vuelve a iniciar sesión";

}