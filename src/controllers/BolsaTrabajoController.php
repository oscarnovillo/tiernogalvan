<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 30/04/2018
 * Time: 22:20
 */

namespace controllers;

use Faker\Factory;
use Respect\Validation\Validator as v;
use servicios\bolsaTrabajo\BolsaTrabajoServicios;
use utils\bolsaTrabajo\ConstantesBolsaTrabajo;
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
        $tarea = filter_input(INPUT_GET, ConstantesBolsaTrabajo::TAREA);
        if (isset($action)) {
            switch ($action) {
                case ConstantesBolsaTrabajo::CREAR_OFERTA_TRABAJO:


                    if (isset($tarea) && $tarea === ConstantesBolsaTrabajo::INSERT) {

                        $datos = filter_input(INPUT_GET, ConstantesBolsaTrabajo::NUEVA_OFERTA);
                        $datos = json_decode($datos);
                        $this->crearOfertaForm($datos);

                    }else if (isset($tarea) && $tarea === ConstantesBolsaTrabajo::UPDATE) {

                        $datos = filter_input(INPUT_GET, ConstantesBolsaTrabajo::UPDATE_OFERTA);
                        $datos = json_decode($datos);
                        $this->updateOfertaForm($datos);

                    } else {
                        $this->crearOfertaVista();
                    }

                    break;
                case ConstantesBolsaTrabajo::VER_OFERTA_TRABAJO:
                    $idOferta = filter_input(INPUT_GET, ConstantesBolsaTrabajo::ID_OFERTA);
                    if (v::numeric()->validate($idOferta)) {
                        $respnseJson = filter_input(INPUT_GET, ConstantesBolsaTrabajo::RESPONSE_JSON);
                        $this->verOferta($idOferta, (isset($respnseJson)) ? $respnseJson : false);
                    } else {
                        $this->irAlIndex();
                    }

                    break;
                case ConstantesBolsaTrabajo::MIS_OFERTAS_TRABAJO:
                    $idOwnerOferta = filter_input(INPUT_GET, ConstantesBolsaTrabajo::ID_OWNER_OFERTA);
                    if (v::numeric()->validate($idOwnerOferta)) {
                        $this->misOferta($idOwnerOferta);
                    } else {
                        $this->irAlIndex();
                    }

                    break;

                case ConstantesBolsaTrabajo::REQUEST_OPERATION_TRABAJO;
                    $operacion = filter_input(INPUT_GET, ConstantesBolsaTrabajo::OPERACION);

                    switch ($operacion) {
                        case ConstantesBolsaTrabajo::OFERTA_FP_CODES;
                            $idOferta = filter_input(INPUT_GET, ConstantesBolsaTrabajo::ID_OFERTA);

                            if (v::numeric()->validate($idOferta)) {
                                $servicios = new BolsaTrabajoServicios();
                                $titulos = $servicios->getOfertaFpTitulo($idOferta);//temporal hasta tener base de datos
                                //$titulos = $this->generarTitulos();
                                echo json_encode($titulos);
                            }

                            break;
                    }


                    break;
                case ConstantesBolsaTrabajo::MI_PERFIL_TRABAJO:
                    $idPerfil = filter_input(INPUT_GET, ConstantesBolsaTrabajo::ID_PERFIL_PERSONA);
                    if (v::numeric()->validate($idPerfil)) {
                        $this->miPerfil($idPerfil);
                    } else {
                        $this->irAlIndex();
                    }
                    break;
                case ConstantesBolsaTrabajo::EDITAR_PERFIL_TRABAJO:
                    //añadir campo foto y arreglar form radios
                    $idPerfil = filter_input(INPUT_GET, ConstantesBolsaTrabajo::ID_PERFIL_PERSONA);
                    if (v::numeric()->validate($idPerfil)) {
                        $this->editarPerfil($idPerfil);
                    } else {
                        $this->irAlIndex();
                    }
                    break;

            }
        } else {
            $page = ConstantesPaginas::BOLSA_TRABAJO_PAGE;
            //enviar ofertas de trabajo a la vista principal
            TwigViewer::getInstance()->viewPage($page);

        }
    }


    public function crearOfertaVista()
    {
        $page = ConstantesPaginas::CREAR_OFERTA_PAGE;
        $servicios = new BolsaTrabajoServicios();
        $estudios = (object)[];
        $estudios->FP_ESTUDIOS = $servicios->getEstudiosCentro();

        TwigViewer::getInstance()->viewPage($page, (array)$estudios);
    }

    public function crearOfertaForm($datos)
    {
        $servicios = new BolsaTrabajoServicios();
        if ($servicios->tratarParametrosNuevaOferta($datos)) {
            //comprobar si devuelve un error
            $datos->id_user_oferta = "10";//Temporal hasta tener enlace con usuarios
            $newOfertaDB = $servicios->insertNuevaOferta($datos);


        } else {
            //oferta de trabajo mal hecha
        }

        //var_dump($datos);
        echo json_encode($newOfertaDB);
        return true;
        $page = ConstantesPaginas::CREAR_OFERTA_PAGE;
        TwigViewer::getInstance()->viewPage($page);

    }

    //TODO - Construir funcionalidad
    public function verOferta($idOferta, $responseJson)
    {
        $servicios = new BolsaTrabajoServicios();
        //Comprobar que devuelve - pendiente
        $ofertaDB = $servicios->verOferta($idOferta);
        //$ofertaDB = $this->generarOferta();

        if ($responseJson == true) {
            echo json_encode($ofertaDB);
        } else {
            $page = ConstantesPaginas::VER_OFERTA_PAGE;
            TwigViewer::getInstance()->viewPage($page, (array)$ofertaDB);
        }


    }

    public function misOferta($idOwner)
    {
        $servicios = new BolsaTrabajoServicios();
        //Comprobar que devuelve - pendiente
        $misOfertasDB = $servicios->misOfertas($idOwner);
        //$misOfertasDB = $this->generarMisOfertas();
        $ofertasVista = (object)[];
        $ofertasVista->misOfertas = $misOfertasDB;
        $page = ConstantesPaginas::MIS_OFERTAS_PAGE;
        TwigViewer::getInstance()->viewPage($page, (array)$ofertasVista);

    }

    public function miPerfil($idPerfil)
    {
        $servicios = new BolsaTrabajoServicios();
        //Comprobar que devuelve - pendiente
        $miPerfilDB = $servicios->miPerfil($idPerfil);
        /*$miPerfilDB = $this->generarMisOfertas();
        $ofertasVista = (object)[];
        $ofertasVista->misOfertas = $miPerfilDB;*/
        $page = ConstantesPaginas::MI_PERFIL_PAGE;
        TwigViewer::getInstance()->viewPage($page);

    }

    public function editarPerfil($idPerfil)
    {
        $servicios = new BolsaTrabajoServicios();
        //Comprobar que devuelve - pendiente
        $miPerfilDB = $servicios->miPerfil($idPerfil);
        /*$miPerfilDB = $this->generarMisOfertas();
        $ofertasVista = (object)[];
        $ofertasVista->misOfertas = $miPerfilDB;*/
        $page = ConstantesPaginas::EDITAR_PERFIL_PAGE;
        TwigViewer::getInstance()->viewPage($page);

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
        $fpTargets = [$faker->name, $faker->name, $faker->name];
        $newOfertaDB2->fpTargets = $fpTargets;

        return $newOfertaDB2;
    }
//TODO - Borrar
    public function generarMisOfertas()
    {
        $misOfertillas = [];
        $miOfertaFaker = (object)[];
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $miOfertaFaker->idOferta = $faker->randomDigit;
            $miOfertaFaker->titulo = $faker->realText(80);

            array_push($misOfertillas, $miOfertaFaker);
        }

        return $misOfertillas;
    }
//TODO - Borrar
    public function generarTitulos()
    {
        $misTitulos = [];
        $misTitulosFPFaker = (object)[];
        $faker = Factory::create();

        for ($i = 0; $i < 4; $i++) {
            $misTitulosFPFaker->idFp = $faker->randomDigit;
            $misTitulosFPFaker->nombreFp = $faker->realText(50);

            array_push($misTitulos, $misTitulosFPFaker);
        }

        return $misTitulos;
    }

    private function updateOfertaForm($datos)
    {
        //TODO - pendiente servicios y DAO para UPDATE
        echo var_dump($datos);
    }

}//fin clase