<?php


/**
 * Description of ConstantesLoginUsers
 *
 * @author Erasto
 */

namespace utils\loginUsers;

class ConstantesLoginUsers {
    
    const PARAM_NICK = "nick";
    const PARAM_PASS = "pass";
    const PARAM_NOMBRE = "nombre";
    const PARAM_APELLIDOS = "apellidos";
    const PARAM_TELEFONO = "telefono";
    const PARAM_EMAIL = "email";
    const COD_ACT = "cod_act";
    const PARAM_PALABRA_CLAVE = "palabra_clave";
    
    const REGISTER_USER = "registrar";
    const LOGIN_USER = "login";
    
    const LOGIN_PAGE = "login/inicio.html";
    const REGISTRO_PAGE = "login/registro.html";
    const START_PAGE = "index.html";
    const RECUPERAR_PAGE = "login/recuperarPass.html";
    
    const LOGIN_YES = "Bienvenido";
    const LOGIN_NO = "Nick o Contraseña inválidos";
    const LOGIN_ERROR = "Nick o Contraseña inválidos";
    
    const INVALID_USER = "Usuario inválido";
    const REGISTRO_ERROR = "Ha ocurrido un error al registrar";
    const PERMISO_FAIL = "La palabra clave es incorrecta";
    const SENT_EMAIL = "Se acaba de mandar don email a tu correo con el código de activación";
    
    const ACTIVATE_USER = "activar";
    
    const TAMAÑO_RANDOM = 20;
    const TAMAÑO_GENERAR_PASS = 4;
    
    const ACTIVO_NO = "Esta cuenta no esta activada";
    const INVALID_COD = "Código de activación inválido";
    const CUENTA_ACTIVADA = "Se ha activado la cuenta con éxito";
    const ACTIVAR_FAIL = "No se ha podido activar la cuenta";
    
    const RECUPERATE_PASS = "recuperarPass";
    const EMAIL_SENT = "Hemos enviado un nuevo password a tu email";
    
    
    
    
}
