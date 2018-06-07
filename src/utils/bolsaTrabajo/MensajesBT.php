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

    const INSERCION_ACEPTADA = "La insersión de sus datos ha sido aceptada";
    const ACTUALIZACION_ACEPTADA = "La actualización de sus datos ha sido aceptada";
    const BORRAR_ACEPTADA = "Hemos borrado los datos correctamente";

    const INSERCION_DENEGADA = "Fallo en la creación, por favor revisa que todos los campos cumplen sus reglas";
    const INSERCION_DENEGADA_FALLO_DB = "Fallo en la creación, por favor revisa que todos los campos cumplen sus reglas y trata de rellenar todos los campos";
    const ACTUALIZACION_DENEGADA = "Fallo en la actualización de los datos, por favor revisa que todos los campos cumplen sus reglas";
    const BORRAR_DENEGADA = "Fallo borrando los datos, por favor inténtalo otra vez";

    const LINK_OFERTA_TRABAJO = "index.php?c=bolsa_trabajo&a=ver_oferta&id_oferta=";
    const LINK_PERFIL_USER = "index.php?c=bolsa_trabajo&a=mi_perfil&id_perfil=";

    const ERROR_FALLO_IDENTIFICADOR = "Fallo en la identificación de parametros, por favor estas enviando paramentros erróneos";
    const ERROR_FALLO_INTERNO = "Error en el servidor, por favor refresca la página(F5) y vuelve a intentarlo";
    const ERROR_FALLO_CONFIG_USER = "Error en el servidor, para modificar estas opciones, primero tienes que rellenar los datos del perfil";
    const ERROR_FALLO_IDENTIFICADOR_USER = "Fallo en la identificación del usuari@, hemos perdido tu identificador de usuari@, por favor refresca o vuelve a iniciar sesión";


    const TIEMPO_TRANSCURRIDO = "Hace %d días";
    const RECIBIR_OFERTAS_NO = "No Estoy interesad@ en recibir ofertas de Trabajo";
    const RECIBIR_OFERTAS_OK = "Estoy dispuest@ a recibir ofertas de Trabajo";
    const BUSCA_TRABAJO_OK = "En búsqueda activa de empleo";
    const BUSCA_TRABAJO_NO = "No busco empleo en estos momentos";
    const ASUNTO_CONFIRM_OFERTA = "Te acabas de apuntar a una oferta de Empleo";
    const ASUNTO_CONFIRM_OFERTA_EMPRESA = "Una persona esta interesada por tu oferta de empleo";
    const ASUNTO_NUEVA_OFERTA = "Tenemos una nueva oferta de trabajo para tí";

    const APUNTARSE_TODO_CORRECTO = "Felicidades! te acabas de apuntar correctamente a una oferta de trabajo, recibiras un e-mail con más detalles";
    const APUNTARSE_FALTA_EMPRESA = "Acabas de apuntarte a esta oferta de trabajo, pero no hemos podido contactar con la persona responsable, Por favor, trata de ponerte en contacto con ella y pactad una entrevista";
    const APUNTARSE_FALTAN_COSAS = "Acabas de apuntarte a esta oferta de trabajo, pero nos faltan datos de las dos parte. Por favor trata de pactar una entrevista con la persona responsable de la oferta por sus medios de contacto";
    const APUNTARSE_EMPRESA_NO_EMAIL = "La empresa ofertante no ha dejado un email de contacto. Por favor, trata de ponerte en contacto con ell@s por otros medios";
    const APUNTARSE_DENEGACION_REPLICA = "Ya te has apuntado a esta oferta de trabajo, no puedes repetir esta acción";
    const APUNTARSE_DENEGACION_NO_PERFIL = "No puedes utilizar este servicio, primero tienes que rellenar los datos personales de tu perfil, es lo que el/la ofertante tendrá en cuenta para su proceso de selección";

    const NUM_REGISTROS_BORRADOS = "Número de registros borrados: %d ";
    const USER_AGREGADO_COLA = "User %s enviad@ a EnviarCorreos ";
    const NUM_CORREOS_ENVIADOS = "Número de ofertas de trabajo enviadas: %d ";

}