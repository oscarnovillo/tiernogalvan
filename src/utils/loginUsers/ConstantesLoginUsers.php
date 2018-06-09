<?php


/**
 * Description of ConstantesLoginUsers
 *
 * @author Erasto
 */

namespace utils\loginUsers;

class ConstantesLoginUsers {
    
    const ACCION_NO = "Parametro acción inválido APAGA EL PC Y SAL PITANDO";
    const MAL_CAMPO = "Tienes mal algún campo";
    const PARAMETROS_MAL = "Nick o Contraseña inválidos";
    const LOGIN_NO = "Nick inválido";
    const LOGIN_ERROR = "Contraseña inválida";
    
    /********REQUEST*********/
    const PARAM_NICK = "nick";
    const PARAM_PASS = "pass";
    const PARAM_NOMBRE = "nombre";
    const PARAM_APELLIDOS = "apellidos";
    const PARAM_TELEFONO = "telefono";
    const PARAM_EMAIL = "email";
    const COD_ACT = "cod_act";
    const PARAM_PALABRA_CLAVE = "palabra_clave";
    
    /********PAGES*********/
    const LOGIN_PAGE = "login/inicio.html";
    const REGISTRO_PAGE = "login/registro.html";
    const START_PAGE = "index.html";
    const RECUPERAR_PAGE = "login/recuperarPass.html";
    const SETTINGS_PAGE = "login/settingsUsers.html";
    
    //********LOGIN CASE*********//
    const LOGIN_USER = "login";
    const ACTIVO_NO = "Esta cuenta no esta activada";
    
    //********REGISTER CASE*********//
    const REGISTER_USER = "registrar";
    const PERMISO_FAIL = "La palabra clave es incorrecta";
    const SENT_EMAIL = "Se acaba de mandar un email a tu correo con el código de activación";
    const INVALID_USER = "Usuario inválido";
    const REGISTRO_ERROR = "Ha ocurrido un error al registrar";
    
    //********ACTIVAR CASE*********//  
    const ACTIVATE_USER = "activar";
    const INVALID_COD = "Código de activación inválido";
    const CUENTA_ACTIVADA = "Se ha activado la cuenta con éxito";
    const ACTIVAR_FAIL = "No se ha podido activar la cuenta, habla con el responsable y que te proporcione una nueva cuenta";
    
    //********RECUPERAR CASE*********//
    const RECUPERATE_PASS = "recuperarPass";
    const UPDATE_PASS_FAIL = "Fallo al generar parámetros";
    
    //********CHANGE CASE*********//
    const CHANGE_PASS = "cambiar_pass";
    const NUEVO_PASS = "nuevo_pass";
    const NEW_PASS = "new_pass";
    const PASS_UP_YES = "Contraseña cambiada correctamente";
    const PASS_UP_NO = "No se ha podido cambiar la contraseña";
    
   
    //********MAIL*********//  
    const ASUNTO_MAIL = "Registro IES Enrique Tierno Galván";
    const EMAIL_SENT = "Hemos enviado un nuevo password a tu email";
    const CONTENIDO_RECUPERACION_MAIL = "Hemos enviado un nuevo password a tu email";
    
    //********RANDOM NUM*********//  
    const TAMAÑO_RANDOM = 20;
    const TAMAÑO_GENERAR_PASS = 4;
    
    
    
    
    
    
    
    
    
}
