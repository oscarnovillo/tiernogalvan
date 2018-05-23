<?php

/**
 * Description of ConstantesCrudUsers
 *
 * @author Erasto
 */

namespace utils\crudUsers;


class ConstantesCrudUsers {
      
    const INSERT_USER = "insert";
    const INSERT_YES = "Usuario insertado correctamente";
    const INSERT_ERROR = "No se ha podido insertar al usuario";
    const INSERT_NO = "El usuario ya existe";
    
    const UPDATE_USER = "update";
    const UPDATE_YES = "Usuario actualizado correctamente";
    const UPDATE_ERROR = "No se ha podido actualizar al usuario";
    const UPDATE_NO = "El usuario ya existe";
    
    const DELETE_USER = "delete";
    const DELETE_YES = "Usuario borrado correctamente";
    const DELETE_ERROR = "No se ha podido borrar al usuario";
    const DELETE_NO = "El usuario ya existe";
    
    const CRUD_PAGE = "crudUsers/crudUsers.html";
    
    const PARAM_NICK = "nick";
    const PARAM_ID = "id";
    const PARAM_NAME = "nombre";
    const PARAM_PASS = "pass";
    const PARAM_LASTNAME = "apellidos";
    const PARAM_TEL = "telefono";
    const PARAM_EMAIL = "email";
    const PARAM_PERMISSION = "permiso";
}
