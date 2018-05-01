<?php

/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 01/05/2018
 * Time: 17:20
 */

namespace model;

class OfertaTrabajo
{

    public $id;
    public $titulo;
    public $descripcion;
    public $requisitos;
    public $empresa;
    public $web;
    public $email;
    public $telefono;
    public $vacantes;
    public $salario;
    public $localizacion;
    public $caducidad;

    function __construct($titulo, $descripcion, $requisitos, $empresa, $web, $email, $telefono, $vacantes, $salario, $localizacion, $caducidad)
    {
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->requisitos = $requisitos;
        $this->empresa = $empresa;
        $this->web = $web;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->vacantes = $vacantes;
        $this->salario = $salario;
        $this->localizacion = $localizacion;
        $this->caducidad = $caducidad;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo): void
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getRequisitos()
    {
        return $this->requisitos;
    }

    /**
     * @param mixed $requisitos
     */
    public function setRequisitos($requisitos): void
    {
        $this->requisitos = $requisitos;
    }

    /**
     * @return mixed
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * @param mixed $empresa
     */
    public function setEmpresa($empresa): void
    {
        $this->empresa = $empresa;
    }

    /**
     * @return mixed
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * @param mixed $web
     */
    public function setWeb($web): void
    {
        $this->web = $web;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono): void
    {
        $this->telefono = $telefono;
    }

    /**
     * @return mixed
     */
    public function getVacantes()
    {
        return $this->vacantes;
    }

    /**
     * @param mixed $vacantes
     */
    public function setVacantes($vacantes): void
    {
        $this->vacantes = $vacantes;
    }

    /**
     * @return mixed
     */
    public function getSalario()
    {
        return $this->salario;
    }

    /**
     * @param mixed $salario
     */
    public function setSalario($salario): void
    {
        $this->salario = $salario;
    }

    /**
     * @return mixed
     */
    public function getLocalizacion()
    {
        return $this->localizacion;
    }

    /**
     * @param mixed $localizacion
     */
    public function setLocalizacion($localizacion): void
    {
        $this->localizacion = $localizacion;
    }

    /**
     * @return mixed
     */
    public function getCaducidad()
    {
        return $this->caducidad;
    }

    /**
     * @param mixed $caducidad
     */
    public function setCaducidad($caducidad): void
    {
        $this->caducidad = $caducidad;
    }

}
