<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 28/05/2018
 * Time: 19:35
 */

namespace model;


class PerfilBolsaTrabajo
{
    public $ID_PERFIL;
    public $NOMBRE;
    public $APELLIDOS;
    public $FP_CODE;
    public $TELEFONO;
    public $EMAIL;
    public $FOTO;
    public $PERFIL_EXTERNO;
    public $CV;
    public $LINK_INTERES;
    public $COMENTARIO;
    public $EXPERIENCIA;
    public $ULTIMA_EDICION;
    public $RECIBIR_OFERTAS;
    public $BUSCA_TRABAJO;

    /**
     * PerfilBolsaTrabajo constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getIDPERFIL()
    {
        return $this->ID_PERFIL;
    }

    /**
     * @param mixed $ID_PERFIL
     */
    public function setIDPERFIL($ID_PERFIL): void
    {
        $this->ID_PERFIL = $ID_PERFIL;
    }

    /**
     * @return mixed
     */
    public function getNOMBRE()
    {
        return $this->NOMBRE;
    }

    /**
     * @param mixed $NOMBRE
     */
    public function setNOMBRE($NOMBRE): void
    {
        $this->NOMBRE = $NOMBRE;
    }

    /**
     * @return mixed
     */
    public function getAPELLIDOS()
    {
        return $this->APELLIDOS;
    }

    /**
     * @param mixed $APELLIDOS
     */
    public function setAPELLIDOS($APELLIDOS): void
    {
        $this->APELLIDOS = $APELLIDOS;
    }

    /**
     * @return mixed
     */
    public function getFPCODE()
    {
        return $this->FP_CODE;
    }

    /**
     * @param mixed $FP_CODE
     */
    public function setFPCODE($FP_CODE): void
    {
        $this->FP_CODE = $FP_CODE;
    }

    /**
     * @return mixed
     */
    public function getTELEFONO()
    {
        return $this->TELEFONO;
    }

    /**
     * @param mixed $TELEFONO
     */
    public function setTELEFONO($TELEFONO): void
    {
        $this->TELEFONO = $TELEFONO;
    }

    /**
     * @return mixed
     */
    public function getEMAIL()
    {
        return $this->EMAIL;
    }

    /**
     * @param mixed $EMAIL
     */
    public function setEMAIL($EMAIL): void
    {
        $this->EMAIL = $EMAIL;
    }

    /**
     * @return mixed
     */
    public function getFOTO()
    {
        return $this->FOTO;
    }

    /**
     * @param mixed $FOTO
     */
    public function setFOTO($FOTO): void
    {
        $this->FOTO = $FOTO;
    }

    /**
     * @return mixed
     */
    public function getPERFILEXTERNO()
    {
        return $this->PERFIL_EXTERNO;
    }

    /**
     * @param mixed $PERFIL_EXTERNO
     */
    public function setPERFILEXTERNO($PERFIL_EXTERNO): void
    {
        $this->PERFIL_EXTERNO = $PERFIL_EXTERNO;
    }

    /**
     * @return mixed
     */
    public function getCV()
    {
        return $this->CV;
    }

    /**
     * @param mixed $CV
     */
    public function setCV($CV): void
    {
        $this->CV = $CV;
    }

    /**
     * @return mixed
     */
    public function getLINKINTERES()
    {
        return $this->LINK_INTERES;
    }

    /**
     * @param mixed $LINK_INTERES
     */
    public function setLINKINTERES($LINK_INTERES): void
    {
        $this->LINK_INTERES = $LINK_INTERES;
    }

    /**
     * @return mixed
     */
    public function getCOMENTARIO()
    {
        return $this->COMENTARIO;
    }

    /**
     * @param mixed $COMENTARIO
     */
    public function setCOMENTARIO($COMENTARIO): void
    {
        $this->COMENTARIO = $COMENTARIO;
    }

    /**
     * @return mixed
     */
    public function getEXPERIENCIA()
    {
        return $this->EXPERIENCIA;
    }

    /**
     * @param mixed $EXPERIENCIA
     */
    public function setEXPERIENCIA($EXPERIENCIA): void
    {
        $this->EXPERIENCIA = $EXPERIENCIA;
    }

    /**
     * @return mixed
     */
    public function getULTIMAEDICION()
    {
        return $this->ULTIMA_EDICION;
    }

    /**
     * @param mixed $ULTIMA_EDICION
     */
    public function setULTIMAEDICION($ULTIMA_EDICION): void
    {
        $this->ULTIMA_EDICION = $ULTIMA_EDICION;
    }

    /**
     * @return mixed
     */
    public function getRECIBIROFERTAS()
    {
        return $this->RECIBIR_OFERTAS;
    }

    /**
     * @param mixed $RECIBIR_OFERTAS
     */
    public function setRECIBIROFERTAS($RECIBIR_OFERTAS): void
    {
        $this->RECIBIR_OFERTAS = $RECIBIR_OFERTAS;
    }

    /**
     * @return mixed
     */
    public function getBUSCATRABAJO()
    {
        return $this->BUSCA_TRABAJO;
    }

    /**
     * @param mixed $BUSCA_TRABAJO
     */
    public function setBUSCATRABAJO($BUSCA_TRABAJO): void
    {
        $this->BUSCA_TRABAJO = $BUSCA_TRABAJO;
    }


}