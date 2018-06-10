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
    const INSERT_DOCUMENT = "INSERT INTO documentos(idDocumento, Documento,idCategoria) VALUES (?,?,?)";
    const UPDATE_DOCUMENT = "UPDATE documentos SET Documento=? WHERE  idDocumento=?";
    const DELETE_DOCUMENT ="DELETE FROM documentos WHERE idDocumento = ?";
    const SUBIDA_FICHERO = "upload_file";
    const BORRAR_FICHERO = "borrar_fichero";
    const MODIFICAR_FICHERO = "modifciar_fichero";
    const DOCUMENTO = "documento";
    const IDDOCUMENTO = "iddocumento";
    const OLDDOCUMENT = "olddocument";
}