<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 01/05/2018
 * Time: 22:18
 */

namespace dao\bolsaTrabajo;


use Latitude\QueryBuilder\Engine\CommonEngine;
use Latitude\QueryBuilder\QueryFactory;
use utils\bolsaTrabajo\ConstantesBolsaTrabajo;

class BolsaTrabajoDAO
{
    //TODO - temporal hasta tener una base de datos real
    public function insertOfertaDB($oferta)
    {
        $factory = new QueryFactory(new CommonEngine());
        $query = $factory
            ->insert('OfertaTrabajo', [
                ConstantesBolsaTrabajo::TITULO_OFERTA => $oferta->titulo_oferta
                , ConstantesBolsaTrabajo::DESCRIPCION_OFERTA => $oferta->descripcion_oferta
                , ConstantesBolsaTrabajo::EMPRESA_OFERTA => $oferta->empresa_oferta
                , ConstantesBolsaTrabajo::WEB_OFERTA => $oferta->web_oferta
                , ConstantesBolsaTrabajo::EMAIL_OFERTA => $oferta->email_oferta
                , ConstantesBolsaTrabajo::TELEFONO_OFERTA => $oferta->telefono_oferta
                , ConstantesBolsaTrabajo::REQUISITOS_OFERTA => $oferta->requisitos_oferta
                , ConstantesBolsaTrabajo::VACANTE_OFERTA => $oferta->vacante_oferta
                , ConstantesBolsaTrabajo::SALARIO_OFERTA => $oferta->salario_oferta
                , ConstantesBolsaTrabajo::LOCALIZACION_OFERTA => $oferta->localizacion_oferta
                , ConstantesBolsaTrabajo::CADUCIDAD_OFERTA => $oferta->caducidad_oferta
            ])
            ->compile();
        //echo $query->sql();
        // var_dump($query->params());
        //Tiene que devolver el objeto con ID
        return true;
    }

    //contruir llamada
    public function verOfertaDB($idOferta)
    {
        return true;

    }

    //construir query
    public function getOfertasByIdOwner($idOwner)
    {
        return true;
    }
}//fin clase