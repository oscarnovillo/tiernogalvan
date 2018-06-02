<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 15/05/2018
 * Time: 10:12
 */

namespace utils\bolsaTrabajo;


class ConstantesBD
{
    /**
     * Tablas
     */
    const TABLA_OFERTA = "OFERTA";
    const TABLA_ESTUDIOS_CENTRO = "ESTUDIOS_CENTRO";
    const TABLA_ESTUDIOS_ALUMNO = "ESTUDIOS_ALUMNO";
    const TABLA_OFERTA_ESTUDIOS = "OFERTA_ESTUDIOS";
    const TABLA_PERFIL_ALUMNO = "PERFIL_ALUMNO";
    const TABLA_APUNTARSE_OFERTA = "APUNTARSE_OFERTA";

    /**
     * Columnas
     */

    /**
     * Oferta
     */
    const ID_OFERTA = "ID_OFERTA";
    const TITULO = "TITULO";
    const DESCRIPCION = "DESCRIPCION";
    const EMPRESA = "EMPRESA";
    const WEB = "WEB";
    const EMAIL = "EMAIL";
    const TELEFONO = "TELEFONO";
    const REQUISITOS = "REQUISITOS";
    const VACANTES = "VACANTES";
    const SALARIO = "SALARIO";
    const LOCALIZACION = "LOCALIZACION";
    const CADUCIDAD = "CADUCIDAD";
    const CREACION = "CREACION";
    const ID_USER = "ID_USER";

    /**
     * Estudios centro
     */
    const ID_FP = "ID_FP";

    /**
     * Tabla oferta estudios
     *
     */

    const ID_ESTUDIO = "ID_ESTUDIO";

    /**
     *
     * Tablas Perfil - Alumno
     *
     */

    const ID_PERFIL = "ID_PERFIL";
    const NOMBRE = "NOMBRE";
    const APELLIDOS = "APELLIDOS";
    const FP_CODE = "FP_CODE";
    const FOTO = "FOTO";
    const PERFIL_EXTERNO = "PERFIL_EXTERNO";
    const CV = "CV";
    const LINK_INTERES = "LINK_INTERES";
    const COMENTARIO = "COMENTARIO";
    const EXPERIENCIA = "EXPERIENCIA";
    const ULTIMA_EDICION = "ULTIMA_EDICION";
    const RECIBIR_OFERTAS = "RECIBIR_OFERTAS";
    const BUSCA_TRABAJO = "BUSCA_TRABAJO";


    /**
     * Tabla Estudios Alumno
     *
     */

    const  ID_ALUMNO = "ID_ALUMNO";


    /**
     * Tabla apuntarse oferta
     */
    const ID_APUNTAR = "ID_APUNTAR";
    const NOTIFICADO = "NOTIFICADO";


}//FIN CLASE