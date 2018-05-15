<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 01/05/2018
 * Time: 22:18
 */

namespace dao\bolsaTrabajo;


use dao\DBConnection;
use Latitude\QueryBuilder\Engine\MySqlEngine;
use Latitude\QueryBuilder\QueryFactory;
use model\EstudiosCentroTrabajo;
use model\OfertaTrabajo;
use utils\bolsaTrabajo\ConstantesBD;
use function Latitude\QueryBuilder\alias;
use function Latitude\QueryBuilder\field;
use function Latitude\QueryBuilder\on;


class BolsaTrabajoDAO
{

    public function insertOfertaDB($oferta)
    {
        $engine = new MySqlEngine();
        $factory = new QueryFactory($engine);
        $query = $factory
            ->insert(ConstantesBD::TABLA_OFERTA, [
                ConstantesBD::ID_OFERTA => null,
                ConstantesBD::TITULO => $oferta->titulo_oferta
                , ConstantesBD::DESCRIPCION => $oferta->descripcion_oferta
                , ConstantesBD::EMPRESA => $oferta->empresa_oferta
                , ConstantesBD::WEB => $oferta->web_oferta
                , ConstantesBD::EMAIL => $oferta->email_oferta
                , ConstantesBD::TELEFONO => $oferta->telefono_oferta
                , ConstantesBD::REQUISITOS => $oferta->requisitos_oferta
                , ConstantesBD::VACANTES => $oferta->vacante_oferta
                , ConstantesBD::SALARIO => $oferta->salario_oferta
                , ConstantesBD::LOCALIZACION => $oferta->localizacion_oferta
                , ConstantesBD::CADUCIDAD => $oferta->caducidad_oferta
                , ConstantesBD::ID_USER => $oferta->id_user_oferta
            ])
            ->compile();

        $dbConnection = null;
        try {

            $dbConnection = new DBConnection();

            $db = $dbConnection->getConnection();
            $db->beginTransaction();
            //insert en la tabla oferta de trabajo
            $stmt = $db->prepare($query->sql());
            $stmt->execute($query->params());

            $oferta->id_oferta = $db->lastInsertId();

            //insert tabla oferta Estudios

            //$factory = new QueryFactory(new MySqlEngine());

            /*$arrayMap = [];
            foreach ($oferta->fp_oferta as $codeFp) {
                $arrayMap[ConstantesBD::ID_OFERTA] = $oferta->id_oferta;
                $arrayMap[ConstantesBD::ID_ESTUDIO] = $codeFp;
            }
                        $query2 = $factory
                            ->insert(ConstantesBD::TABLA_OFERTA_ESTUDIOS)
                            ->map($arrayMap)->compile();*/

            $query2 = $factory->insert(ConstantesBD::TABLA_OFERTA_ESTUDIOS)
                ->columns(ConstantesBD::ID_OFERTA, ConstantesBD::ID_ESTUDIO);
            foreach ($oferta->fp_oferta as $codeFp) {
                $query2->values($oferta->id_oferta, $codeFp);
            }
            $query2->compile();
            $stmt = $db->prepare($query2->sql($engine));
            $stmt->execute($query2->params($engine));
            $db->commit();


        } catch (\Exception $exception) {
            $db->rollBack();
            echo $exception->getMessage();
        } finally {
            $dbConnection->disconnect();
        }

        return $oferta;
    }


    public function verOfertaDB($idOferta)
    {
        $engine = new MySqlEngine();
        $factory = new QueryFactory($engine);
        $query = $factory
            ->select()
            ->from(ConstantesBD::TABLA_OFERTA)
            ->where(field(ConstantesBD::ID_OFERTA)->eq($idOferta))
            ->compile();

        $dbConnection = null;
        $oferta = null;
        try {

            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();

            //recuperar Oferta de Trabajo
            $stmt = $db->prepare($query->sql());
            $stmt->execute($query->params());
            $oferta = $stmt->fetchObject(OfertaTrabajo::class);

            //recuperar titulos para la oferta
            $EstudiosTabla = "ESTUDIOS";
            $OfertaTabla = "OFERTAS";
            $query2 = $factory
                ->select($EstudiosTabla . "." . ConstantesBD::TITULO)
                ->from(alias(ConstantesBD::TABLA_ESTUDIOS_CENTRO, $EstudiosTabla))
                ->join(alias(ConstantesBD::TABLA_OFERTA_ESTUDIOS, $OfertaTabla)
                    , on($EstudiosTabla . "." . ConstantesBD::ID_FP, $OfertaTabla . "." . ConstantesBD::ID_ESTUDIO))
                ->where(field($OfertaTabla . "." . ConstantesBD::ID_OFERTA)->eq($oferta->ID_OFERTA))
                ->compile();

            $stmt = $db->prepare($query2->sql());
            $stmt->execute($query2->params());
            $estudiosOferta = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $oferta->FPTARGETS = $estudiosOferta;


        } catch (\Exception $exception) {
            echo $exception->getMessage();
        } finally {
            $dbConnection->disconnect();
        }
        return $oferta;
    }

    /***
     * Recupera un array con la id y el nombre del Ciclo formativo del centro de estudios
     * @return array
     */
    public function getEstudiosCentroDB()
    {
        $factory = new QueryFactory(new MySqlEngine());
        $query = $factory
            ->select()
            ->from(ConstantesBD::TABLA_ESTUDIOS_CENTRO)
            ->compile();
        $dbConnection = null;
        try {

            $dbConnection = new DBConnection();

            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($query->sql());
            $stmt->execute();
            $estudios = $stmt->fetchAll(\PDO::FETCH_CLASS, EstudiosCentroTrabajo::class);


        } catch (\Exception $exception) {
            echo $exception->getMessage();
        } finally {
            $dbConnection->disconnect();
        }
        return $estudios;
    }

    //construir query
    public function getOfertasByIdOwner($idOwner)
    {
        $engine = new MySqlEngine();
        $factory = new QueryFactory($engine);
        $query = $factory
            ->select()
            ->from(ConstantesBD::TABLA_OFERTA)
            ->where(field(ConstantesBD::ID_USER)->eq($idOwner))
            ->compile();

        $dbConnection = null;
        $ofertasDB = null;
        try {

            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();

            //recuperar Ofertas de Trabajo
            $stmt = $db->prepare($query->sql());
            $stmt->execute($query->params());
            $ofertasDB = $stmt->fetchAll(\PDO::FETCH_CLASS, OfertaTrabajo::class);


        } catch (\Exception $exception) {
            echo $exception->getMessage();
        } finally {
            $dbConnection->disconnect();
        }
        return $ofertasDB;
    }


    public function getFpTitulosByIdOferta($idOferta)
    {

        $engine = new MySqlEngine();
        $factory = new QueryFactory($engine);
        //Recupera los id estudios del centro
        $query = $factory
            ->select()
            ->from(ConstantesBD::TABLA_ESTUDIOS_CENTRO)
            ->compile();

        $EstudiosTabla = "ESTUDIOS";
        $OfertaTabla = "OFERTAS";

        $query2 = $factory
            ->select($EstudiosTabla . "." . ConstantesBD::ID_FP)
            ->from(alias(ConstantesBD::TABLA_ESTUDIOS_CENTRO, $EstudiosTabla))
            ->join(alias(ConstantesBD::TABLA_OFERTA_ESTUDIOS, $OfertaTabla)
                , on($EstudiosTabla . "." . ConstantesBD::ID_FP, $OfertaTabla . "." . ConstantesBD::ID_ESTUDIO))
            ->where(field($OfertaTabla . "." . ConstantesBD::ID_OFERTA)->eq($idOferta))
            ->compile();


        $dbConnection = null;
        $estudiosDBBundle = (object)[];

        try {

            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();

            //recuperar Estudios del centro
            $stmt = $db->prepare($query->sql());
            $stmt->execute($query->params());
            $estudiosDB = $stmt->fetchAll(\PDO::FETCH_CLASS, EstudiosCentroTrabajo::class);


            //recuperamos las id de la oferta
            $stmt = $db->prepare($query2->sql());
            $stmt->execute($query2->params());
            $id_ofertasDB = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $estudiosDBBundle->ESTUDIOS = $estudiosDB;
            $estudiosDBBundle->KEYS = $id_ofertasDB;


        } catch (\Exception $exception) {
            echo $exception->getMessage();
        } finally {
            $dbConnection->disconnect();
        }
        return $estudiosDBBundle;
    }
}//fin clase