<?php
namespace utils\ventaLibros;

class ConstantesVentas{
    const VENTAS_PAGE = "ventaLibros/venta-libros.html";
    
    const ACCION_ADD_LIBRO = "add_libro";
    const ACCION_EDIT_LIBRO = "edit_libro";
    const ACCION_DEL_LIBRO = "del_libro";
    const ACCION_RES_LIBRO = "res_libro";
    
    const ERROR = "Ha ocurrido un error.";
    const VENTA_CORRECTA = "Tu libro se ha puesto a la venta.";
    const VENTA_RESERVADA = "Tu reserva se ha realizado correctamente. Hemos informado al vendedor para que se ponga en contacto contigo.";
    const ERROR_MISMO_USER = "No puedes reservar tus propios libros.";
    const VENTA_EDITADA = "Tu libro se ha editado correctamente.";
    const ERROR_EDITAR = "No se ha podido editar la publicación.";
    const VENTA_BORRADA = "Tu libro se ha borrado correctamente.";
    const ERROR_BORRAR = "No se ha podido borrar la publicación.";
    const ERROR_VENDER = "No se puede asignar ese estado si nadie ha reservado el libro.";
    
    const PARAM_ID_VENTA = "id_venta";
    const PARAM_ID_VENDEDOR = "id_vendedor";
    const PARAM_TITULO = "titulo";
    const PARAM_ISBN = "isbn";
    const PARAM_PRECIO = "precio";
    const PARAM_ASIGNATURA = "asignatura";
    const PARAM_CURSO = "curso";
    const PARAM_ESTADO = "estado";
    const PARAM_FILTRO_ASIG = "filtro_asig";
    const PARAM_FILTRO_CURSO = "filtro_curso";
    const PARAM_ORDEN = "orden";
    const PARAM_PAGINA = "page";
    
    const EMAIL_SUBJECT = "Han reservado tu libro";
}


