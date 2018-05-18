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


}