<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 01/05/2018
 * Time: 17:12
 */

namespace servicios\bolsaTrabajo;


use dao\bolsaTrabajo\BolsaTrabajoDAO;
use Respect\Validation\Validator as v;
use Carbon\Carbon;
use utils\bolsaTrabajo\ConstantesBolsaTrabajo;

class BolsaTrabajoServicios
{
    public function insertNuevaOferta($oferta)
    {
        $dao = new BolsaTrabajoDAO();
        return $dao->insertOfertaDB($oferta);
    }

    public function verOferta($idOferta)
    {
        $dao = new BolsaTrabajoDAO();
        return $dao->verOfertaDB($idOferta);
    }

    public function tratarParametrosNuevaOferta($json)
    {
        return $this->validarOferta($json);
    }

    public function validarOferta($ofertaNueva)
    {
        $isValid = false;
        $validador = v::attribute(ConstantesBolsaTrabajo::TITULO_OFERTA, v::stringType()->length(10, 200))
            ->attribute(ConstantesBolsaTrabajo::DESCRIPCION_OFERTA, v::stringType()->length(10, 1000))
            ->attribute(ConstantesBolsaTrabajo::REQUISITOS_OFERTA, v::stringType()->length(10, 750))
            ->attribute(ConstantesBolsaTrabajo::EMAIL_OFERTA, v::optional(v::stringType()->length(10, 80)))
            ->attribute(ConstantesBolsaTrabajo::EMPRESA_OFERTA, v::optional(v::stringType()->length(10, 50)))
            ->attribute(ConstantesBolsaTrabajo::WEB_OFERTA, v::optional(v::stringType()->length(10, 80)))
            ->attribute(ConstantesBolsaTrabajo::LOCALIZACION_OFERTA, v::optional(v::stringType()->length(10, 85)))
            ->attribute(ConstantesBolsaTrabajo::TELEFONO_OFERTA, v::optional(v::stringType()->length(8, 15)))
            ->attribute(ConstantesBolsaTrabajo::VACANTE_OFERTA, v::optional(v::numeric()))
            ->attribute(ConstantesBolsaTrabajo::SALARIO_OFERTA, v::optional(v::floatVal()))//no funciona con Coma
            ->attribute(ConstantesBolsaTrabajo::CADUCIDAD_OFERTA, v::date('Y-m-d')->between(Carbon::now(), Carbon::now()->addMonth(3)));
        if ($validador->validate($ofertaNueva)) {
            $fp_array_oferta = $ofertaNueva->fp_oferta;

            $isValid = $this->validarFpCodes($fp_array_oferta);
        }
        return $isValid;
    }

    public function validarFpCodes($fp_array_oferta)
    {
        $isValid = false;
        if (is_array($fp_array_oferta)) {
            foreach ($fp_array_oferta as $item) {
                if (v::stringType()->length(1, 100)->validate($item)) {
                    $isValid = true;
                }
            }
        }
        return $isValid;
    }

    public function misOfertas($idOwner)
    {
        $dao = new BolsaTrabajoDAO();
        return $dao->getOfertasByIdOwner($idOwner);
    }
}