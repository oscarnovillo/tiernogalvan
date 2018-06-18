<?php

/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 01/05/2018
 * Time: 17:20
 */

namespace model;

class OfertaTrabajo
{

    public $ID_OFERTA;
    public $TITULO;
    public $DESCRIPCION;
    public $EMPRESA;
    public $WEB;
    public $EMAIL;
    public $TELEFONO;
    public $REQUISITOS;
    public $VACANTES;
    public $SALARIO;
    public $LOCALIZACION;
    public $CADUCIDAD;
    public $CREACION;
    public $ID_USER;

    /**
     * OfertaTrabajo constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getIDOFERTA()
    {
        return $this->ID_OFERTA;
    }

    /**
     * @param mixed $ID_OFERTA
     */
    public function setIDOFERTA($ID_OFERTA): void
    {
        $this->ID_OFERTA = $ID_OFERTA;
    }

    /**
     * @return mixed
     */
    public function getTITULO()
    {
        return $this->TITULO;
    }

    /**
     * @param mixed $TITULO
     */
    public function setTITULO($TITULO): void
    {
        $this->TITULO = $TITULO;
    }

    /**
     * @return mixed
     */
    public function getDESCRIPCION()
    {
        return $this->DESCRIPCION;
    }

    /**
     * @param mixed $DESCRIPCION
     */
    public function setDESCRIPCION($DESCRIPCION): void
    {
        $this->DESCRIPCION = $DESCRIPCION;
    }

    /**
     * @return mixed
     */
    public function getEMPRESA()
    {
        return $this->EMPRESA;
    }

    /**
     * @param mixed $EMPRESA
     */
    public function setEMPRESA($EMPRESA): void
    {
        $this->EMPRESA = $EMPRESA;
    }

    /**
     * @return mixed
     */
    public function getWEB()
    {
        return $this->WEB;
    }

    /**
     * @param mixed $WEB
     */
    public function setWEB($WEB): void
    {
        $this->WEB = $WEB;
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
    public function getREQUISITOS()
    {
        return $this->REQUISITOS;
    }

    /**
     * @param mixed $REQUISITOS
     */
    public function setREQUISITOS($REQUISITOS): void
    {
        $this->REQUISITOS = $REQUISITOS;
    }

    /**
     * @return mixed
     */
    public function getVACANTES()
    {
        return $this->VACANTES;
    }

    /**
     * @param mixed $VACANTES
     */
    public function setVACANTES($VACANTES): void
    {
        $this->VACANTES = $VACANTES;
    }

    /**
     * @return mixed
     */
    public function getSALARIO()
    {
        return $this->SALARIO;
    }

    /**
     * @param mixed $SALARIO
     */
    public function setSALARIO($SALARIO): void
    {
        $this->SALARIO = $SALARIO;
    }

    /**
     * @return mixed
     */
    public function getLOCALIZACION()
    {
        return $this->LOCALIZACION;
    }

    /**
     * @param mixed $LOCALIZACION
     */
    public function setLOCALIZACION($LOCALIZACION): void
    {
        $this->LOCALIZACION = $LOCALIZACION;
    }

    /**
     * @return mixed
     */
    public function getCADUCIDAD()
    {
        return $this->CADUCIDAD;
    }

    /**
     * @param mixed $CADUCIDAD
     */
    public function setCADUCIDAD($CADUCIDAD): void
    {
        $this->CADUCIDAD = $CADUCIDAD;
    }

    /**
     * @return mixed
     */
    public function getCREACION()
    {
        return $this->CREACION;
    }

    /**
     * @param mixed $CREACION
     */
    public function setCREACION($CREACION): void
    {
        $this->CREACION = $CREACION;
    }

    /**
     * @return mixed
     */
    public function getIDUSER()
    {
        return $this->ID_USER;
    }

    /**
     * @param mixed $ID_USER
     */
    public function setIDUSER($ID_USER): void
    {
        $this->ID_USER = $ID_USER;
    }


}//fin clase
