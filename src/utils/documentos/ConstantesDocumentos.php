<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace utils\documentos;

class ConstantesDocumentos{
    const GET_DOCUMENTS = "SELECT * FROM documentos order by Documento";
    const GET_DOCUMENT_CATEGORY = "SELECT * FROM documentos WHERE idCategoria = ? order by Documento";
    const INSERT_DOCUMENT = "INSERT INTO documentos(Documento,idCategoria) VALUES (?,?)";
    const UPDATE_DOCUMENT = "UPDATE documentos SET Documento=? WHERE  idDocumentos=? and idCategoria = ? ";
    const DELETE_DOCUMENT ="DELETE FROM documentos WHERE idDocumentos = ?";
    const SUBIDA_FICHERO = "upload_file";
    const BORRAR_FICHERO = "borrar_fichero";
    const MODIFICAR_FICHERO = "modificar_fichero";
    const DOCUMENTO = "documento";
    const IDDOCUMENTO = "iddocumento";
    const OLD_DOCUMENT ="fichero_antiguo";
    const BORRAR_DOCUMENTO_CATEGORIA = "DELETE FROM DOCUMENTOS WHERE idCategoria = ?";
    const DOCUMENTOS_CATEGORIA = "doc_categoria";
    
    const ERROR_INSERT_DOCUMENTO = "Error al subir el documento";
    const ERROR_UPDATE_DOCUMENTO = "Error al modificar el documento";
    const ERROR_DELETE_DOCUMENTO = "Error al borrar el documento";
    const ERROR_GET_DOCUMENTO = "Error al mostrar los datos de los documentos";
    
    
    const DOCUMENTO_CREADO = "El documento se ha creado correctamente";
    const DOCUMENTO_ACTUALIZADO = "El documento se ha actualizado correctamente";
    const DOCUMENTO_BORRADO = "El documento se ha borrado correctamente";
}