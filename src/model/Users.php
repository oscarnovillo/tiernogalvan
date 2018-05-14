<?php

namespace model;

/**
 * Description of Users
 *
 * @author Erasto
 */
class Users {
    
    public $id;
    public $nick;
    public $pass;
    public $name;
    public $surname;
    public $telefono;
    public $email;
    public $activo;
    
    function __construct($id, $nick, $pass, $name, $surname, $telefono, $email, $activo) {
        $this->id = $id;
        $this->nick = $nick;
        $this->pass = $pass;
        $this->name = $name;
        $this->surname = $surname;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->activo = $activo;
    }
    
    function getId() {
        return $this->id;
    }

    function getNick() {
        return $this->nick;
    }

    function getPass() {
        return $this->pass;
    }

    function getName() {
        return $this->name;
    }

    function getSurname() {
        return $this->surname;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getEmail() {
        return $this->email;
    }

    function getActivo() {
        return $this->activo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNick($nick) {
        $this->nick = $nick;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setSurname($surname) {
        $this->surname = $surname;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

    

}
