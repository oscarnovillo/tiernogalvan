<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 18/05/2018
 * Time: 17:09
 */

namespace model;


class GenericMessage
{
    public $TITULO;
    public $TEXTO;
    public $LINK;

    /**
     * GenericMessage constructor.
     * @param $TITULO
     * @param $TEXTO
     */
    public function __construct($TITULO, $TEXTO)
    {
        $this->TITULO = $TITULO;
        $this->TEXTO = $TEXTO;
    }

    /**
     * @return mixed
     */
    public function getLINK()
    {
        return $this->LINK;
    }

    /**
     * @param mixed $LINK
     */
    public function setLINK($LINK): void
    {
        $this->LINK = $LINK;
    }


}