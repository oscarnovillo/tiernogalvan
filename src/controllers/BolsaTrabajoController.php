<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 30/04/2018
 * Time: 22:20
 */

namespace controllers;


use dao\bolsaTrabajo\BolsaTrabajoDAO;
use Faker\Factory;
use servicios\bolsaTrabajo\BolsaTrabajoServicios;
use utils\bolsaTrabajo\ConstantesBolsaTrabajo;
use utils\Constantes;
use utils\ConstantesPaginas;
use utils\TwigViewer;
use Respect\Validation\Validator as v;


class BolsaTrabajoController
{

    /**
     * Función principal encargada de repartir las operaciones que se realizan en la bolsa de trabajo
     */
    //TODO - en construcción
    public function bolsaTrabajoMain()
    {

        $action = filter_input(INPUT_GET, Constantes::PARAMETER_NAME_ACTION);
        $tarea = filter_input(INPUT_GET, ConstantesBolsaTrabajo::TAREA);
        if (isset($action)) {
            switch ($action) {
                case ConstantesBolsaTrabajo::CREAR_OFERTA_TRABAJO:


                    if (isset($tarea) && $tarea === ConstantesBolsaTrabajo::INSERT) {

                        $datos = filter_input(INPUT_GET, ConstantesBolsaTrabajo::NUEVA_OFERTA);
                        $datos = json_decode($datos);
                        $this->crearOfertaForm($datos);

                    } else {
                        $this->crearOfertaVista();
                    }

                    break;
                case ConstantesBolsaTrabajo::VER_OFERTA_TRABAJO:
                    $idOferta = filter_input(INPUT_GET, ConstantesBolsaTrabajo::ID_OFERTA);
                    if (v::numeric()->validate($idOferta)) {
                        $this->verOferta($idOferta);
                    } else {
                        $this->irAlIndex();
                    }

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
            //comprobar si devuelve un error
            $newOfertaDB = $servicios->insertNuevaOferta($datos);
            $newOfertaDB2 = $this->generarOferta();

        } else {
            //oferta de trabajo mal hecha
        }

        //var_dump($datos);
        echo json_encode($newOfertaDB2);
        return true;
        $page = ConstantesPaginas::CREAR_OFERTA_PAGE;
        TwigViewer::getInstance()->viewPage($page);

    }

    //TODO - Construir funcionalidad
    public function verOferta($idOferta)
    {
        $servicios = new BolsaTrabajoServicios();
        //Comprobar que devuelve - pendiente
        $ofertaDB = $servicios->verOferta($idOferta);
        $ofertaDB = $this->generarOferta();

        $page = ConstantesPaginas::VER_OFERTA_PAGE;
        //para enviar tiene que ser array, pero esto creando un objeto, busca solución o mira en documentación twig
        TwigViewer::getInstance()->viewPage($page,(array)$ofertaDB);

    }

    public function irAlIndex()
    {
        $page = ConstantesPaginas::INDEX;
        TwigViewer::getInstance()->viewPage($page);
    }

    //TODO - método temporal para carga las llamadas con datos
    public function generarOferta()
    {
        $newOfertaDB2 = (object)[];
        $faker = Factory::create();
        $newOfertaDB2->id = $faker->randomNumber(3);
        $newOfertaDB2->titulo = $faker->text(80);
        $newOfertaDB2->descripcion = $faker->text(150);
        $newOfertaDB2->requisitos = $faker->text(150);
        $newOfertaDB2->empresa = $faker->name(null);
        $newOfertaDB2->web = $faker->domainName;
        $newOfertaDB2->email = $faker->email;
        $newOfertaDB2->telefono = $faker->phoneNumber;
        $newOfertaDB2->vacantes = $faker->randomNumber(2);
        $newOfertaDB2->salario = $faker->randomNumber(4);
        $newOfertaDB2->localizacion = $faker->city;
        $newOfertaDB2->caducidad = $faker->date('Y-m-d');
        $newOfertaDB2->creacion = $faker->date('Y-m-d');
        $fpTargets = [$faker->name,$faker->name,$faker->name];
        $newOfertaDB2->fpTargets = $fpTargets;

        return $newOfertaDB2;
    }
}