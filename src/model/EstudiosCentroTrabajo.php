<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 15/05/2018
 * Time: 15:10
 */

namespace model;


class EstudiosCentroTrabajo
{
    public $ID_FP;
    public $TITULO;

    /**
     * EstudiosCentroTrabajo constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getIDFP()
    {
        return $this->ID_FP;
    }

    /**
     * @param mixed $ID_FP
     */
    public function setIDFP($ID_FP): void
    {
        $this->ID_FP = $ID_FP;
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


}//fin clase