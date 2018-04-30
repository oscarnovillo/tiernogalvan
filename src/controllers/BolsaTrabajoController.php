<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 30/04/2018
 * Time: 22:20
 */

namespace controllers;


use utils\ConstantesPaginas;
use utils\TwigViewer;

class BolsaTrabajoController
{

    public function crearOferta(){
        $page = ConstantesPaginas::CREAR_OFERTA_PAGE;
        TwigViewer::getInstance()->viewPage($page);
    }
}