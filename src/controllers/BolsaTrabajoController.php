<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 30/04/2018
 * Time: 22:20
 */

namespace controllers;


use dao\bolsaTrabajo\BolsaTrabajoDAO;
use servicios\bolsaTrabajo\BolsaTrabajoServicios;
use utils\Constantes;
use utils\ConstantesPaginas;
use utils\TwigViewer;


class BolsaTrabajoController
{

    /**
     * Función principal encargada de repartir las operaciones que se realizan en la bolsa de trabajo
     */
    //TODO - en construcción
    public function bolsaTrabajoMain()
    {

        $action = filter_input(INPUT_GET, Constantes::PARAMETER_NAME_ACTION);
        $tarea = filter_input(INPUT_GET, Constantes::TAREA);
        if (isset($action)) {
            switch ($action) {
                case Constantes::CREAR_OFERTA_TRABAJO:


                    if (isset($tarea) && $tarea === Constantes::INSERT) {

                        $datos = filter_input(INPUT_GET, Constantes::NUEVA_OFERTA);
                        $datos = json_decode($datos);
                        $this->crearOfertaForm($datos);

                    } else {
                        $this->crearOfertaVista();
                    }

                    break;
                case Constantes::VER_OFERTA_TRABAJO:
                    $this->verOferta();
                    break;

            }
        } else {
            $page = ConstantesPaginas::INDEX;
            TwigViewer::getInstance()->viewPage($page);

        }
    }

    //TODO - Construir funcionalidad
    public function crearOfertaVista()
    {
        $page = ConstantesPaginas::CREAR_OFERTA_PAGE;
        TwigViewer::getInstance()->viewPage($page);
    }

    public function crearOfertaForm($datos)
    {
        $servicios = new BolsaTrabajoServicios();
        if ($servicios->tratarParametrosNuevaOferta($datos)) {
            $dao = new BolsaTrabajoDAO();
            $dao->insertOferta($datos);
        }

        var_dump($datos);
        return $datos;
        $page = ConstantesPaginas::CREAR_OFERTA_PAGE;
        TwigViewer::getInstance()->viewPage($page);

    }

    //TODO - Construir funcionalidad
    public function verOferta()
    {
        $page = ConstantesPaginas::INDEX;
        TwigViewer::getInstance()->viewPage($page);
        echo "ssdsdsdsdsfdss";
    }
}