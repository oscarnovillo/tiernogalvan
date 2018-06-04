<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 01/05/2018
 * Time: 17:28
 */

namespace utils\bolsaTrabajo;


class ConstantesBolsaTrabajo
{
    /**
     * campos objeto oferta
     */
    const TITULO_OFERTA = "titulo_oferta";
    const DESCRIPCION_OFERTA = "descripcion_oferta";
    const REQUISITOS_OFERTA = "requisitos_oferta";
    const EMPRESA_OFERTA = "empresa_oferta";
    const WEB_OFERTA = "web_oferta";
    const EMAIL_OFERTA = "email_oferta";
    const TELEFONO_OFERTA = "telefono_oferta";
    const VACANTE_OFERTA = "vacante_oferta";
    const SALARIO_OFERTA = "salario_oferta";
    const LOCALIZACION_OFERTA = "localizacion_oferta";
    const CADUCIDAD_OFERTA = "caducidad_oferta";

    /**
     * Actiones principales
     */
    const CREAR_OFERTA_TRABAJO = "crear_oferta";
    const VER_OFERTA_TRABAJO = "ver_oferta";
    const BORRAR_OFERTA_TRABAJO = "borrar_oferta";
    const MIS_OFERTAS_TRABAJO = "mis_ofertas";
    const MI_PERFIL_TRABAJO = "mi_perfil";
    const EDITAR_PERFIL_TRABAJO = "editar_perfil";
    const EDITAR_PERFIL_TRABAJO_CONFIG = "editar_perfil_config";
    const REQUEST_OPERATION_TRABAJO = "request_operation";

    /**
     * Acciones secundarias
     */
    const TAREA = "tarea";
    const ID_OFERTA = "id_oferta";
    const PAGINA_OFERTA = "page";
    const ORDEN = "orden";
    const ID_FP = "fp_oferta";
    const LIMIT = "limit";
    const RESPONSE_JSON = "response_json";
    const ID_OWNER_OFERTA = "id_owner";
    const NUEVA_OFERTA = "nueva_oferta";
    const UPDATE_OFERTA = "update_oferta";
    const OPERACION = "operacion";
    const ID_PERFIL_PERSONA = "id_perfil";

    /**
     * tareas
     */
    const INSERT = "insert";
    const UPDATE = "update";
    const OFERTA_FP_CODES = "oferta_fp_codes";
    const PAGINACION_OFERTAS = "pagination";
    const PAGINACION_SIZE = "size";
    const UPLOAD_FILE = "upload_file";
    const APUNTAR_OFERTA = "apuntar_oferta";
    const CONTADOR = "CONTADOR";


    /**
     *
     * Templates Correo
     *
     */
    const TEMPLATE_CONFIRMACION_OFERTA_ALUMN = "bolsaTrabajo/confirmacion-apuntar-oferta.html";
    const TEMPLATE_CONFIRMACION_OFERTA_EMPRESA = "bolsaTrabajo/confirmacion-apuntar-oferta-empresa.html";
    const TEMPLATE_NUEVA_OFERTA_INFO = "nueva-oferta-template.html";

}