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
use function Latitude\QueryBuilder\fn;
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

    /**
     *
     * Recupera todas las ofertas de la base de datos
     * @param $limit
     * @param $offset
     * @return array|null
     */
    public function getAllOfertasDB($count_per_page, $page_number, $orden)
    {
        $page_number -= 1;

        $next_offset = $page_number * $count_per_page;


        $engine = new MySqlEngine();
        $factory = new QueryFactory($engine);
        $query = $factory
            ->select()
            ->from(ConstantesBD::TABLA_OFERTA)
            ->orderBy(ConstantesBD::CREACION, $orden)
            ->offset($next_offset)
            ->limit($count_per_page)
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

    public function getOfertasByFpCodeAndTimeDB($count_per_page, $page_number, $idFp, $orden)
    {
        $page_number -= 1;

        $next_offset = $page_number * $count_per_page;

        $engine = new MySqlEngine();
        $factory = new QueryFactory($engine);
        $aliasOfertaEstudios = "A_OFER_EST";
        $aliasOfertas = "A_OFER";
        $query = $factory
            ->select()
            ->from(alias(ConstantesBD::TABLA_OFERTA, $aliasOfertas))
            ->join(alias(ConstantesBD::TABLA_OFERTA_ESTUDIOS, $aliasOfertaEstudios)
                , on($aliasOfertas . "." . ConstantesBD::ID_OFERTA, $aliasOfertaEstudios . "." . ConstantesBD::ID_OFERTA))
            ->where(field($aliasOfertaEstudios . '.' . ConstantesBD::ID_ESTUDIO)->eq($idFp))
            ->orderBy($aliasOfertas . '.' . ConstantesBD::CREACION, $orden)
            ->offset($next_offset)
            ->limit($count_per_page)
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

    public function getSizeOfertasDB()
    {
        $engine = new MySqlEngine();
        $factory = new QueryFactory($engine);
        $query = $factory
            ->select(fn('COUNT', ConstantesBD::ID_OFERTA))
            ->from(ConstantesBD::TABLA_OFERTA)
            ->compile();

        $dbConnection = null;
        $numOfertas = null;
        try {

            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();

            //recuperar Ofertas de Trabajo
            $stmt = $db->prepare($query->sql());
            $stmt->execute($query->params());
            $numOfertas = $stmt->fetch(\PDO::FETCH_NUM);


        } catch (\Exception $exception) {
            echo $exception->getMessage();
        } finally {
            $dbConnection->disconnect();
        }
        return $numOfertas;
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

    public function updateOfertaDB($oferta)
    {
        $engine = new MySqlEngine();
        $factory = new QueryFactory($engine);
        $query = $factory
            ->update(ConstantesBD::TABLA_OFERTA, [
                //ConstantesBD::ID_OFERTA => $oferta->id_oferta,
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
                //, ConstantesBD::ID_USER => $oferta->id_user_oferta
            ])->where(field(ConstantesBD::ID_OFERTA)->eq($oferta->id_oferta))
            ->compile();


        $dbConnection = null;
        try {

            $dbConnection = new DBConnection();

            $db = $dbConnection->getConnection();
            $db->beginTransaction();
            //update en la tabla oferta de trabajo
            $stmt = $db->prepare($query->sql());
            $stmt->execute($query->params());


            //borramos los registros en la tabla
            $query2 = $factory->delete(ConstantesBD::TABLA_OFERTA_ESTUDIOS)
                ->where(field(ConstantesBD::ID_OFERTA)->eq($oferta->id_oferta))
                ->compile();

            $stmt = $db->prepare($query2->sql());
            $stmt->execute($query2->params());

            //insert tabla oferta Estudios
            $query3 = $factory->insert(ConstantesBD::TABLA_OFERTA_ESTUDIOS)
                ->columns(ConstantesBD::ID_OFERTA, ConstantesBD::ID_ESTUDIO);
            foreach ($oferta->fp_oferta as $codeFp) {
                $query3->values($oferta->id_oferta, $codeFp);
            }
            $query3->compile();
            $stmt = $db->prepare($query3->sql($engine));
            $stmt->execute($query3->params($engine));
            $db->commit();


        } catch (\Exception $exception) {
            $db->rollBack();
            echo $exception->getMessage();
        } finally {
            $dbConnection->disconnect();
        }

        return $oferta;

    }

    public function deleteOfertaDB($idOferta, $idOwner)
    {
        $engine = new MySqlEngine();
        $factory = new QueryFactory($engine);
        $query = $factory->delete(ConstantesBD::TABLA_OFERTA)
            ->where(field(ConstantesBD::ID_OFERTA)->eq($idOferta))
            ->andWhere(field(ConstantesBD::ID_USER)->eq($idOwner))
            ->compile();

        $dbConnection = null;
        $resultado = false;
        try {

            $dbConnection = new DBConnection();

            $db = $dbConnection->getConnection();

            $stmt = $db->prepare($query->sql());
            $stmt->execute($query->params());

            $resultado = true;

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        } finally {
            $dbConnection->disconnect();
        }

        return $resultado;

    }
}//fin clase