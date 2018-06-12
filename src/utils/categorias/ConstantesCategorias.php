<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace utils\categorias;

class ConstantesCategorias{
    const GET_CATEGORIES = "SELECT * FROM categorias order by Categoria";
    const INSERT_CATEGORY = "INSERT INTO categorias(Categoria) VALUES (?)";
    const UPDATE_CATEGORY = "UPDATE categorias SET Categoria=? WHERE idCategorias = ?" ;
    const DELETE_CATEGORY ="DELETE FROM categorias WHERE idCategorias = ?";
    const CREAR_CATEGORIA = "crear_categoria";
    const NOMBRE_CATEGORIA = "categoria";
    const ID_CATEGORIA = "idcategoria";
    const MODIFICAR_CATEGORIA = "modificar_categoria";
    const OLD_CATEGORY = "categoria_antigua";
    const BORRAR_CATEGORIA = "borrar_categoria";
    
    const ERROR_INSERT_CATEGORIA = "Error al crear una nueva categoria";
    const ERROR_UPDATE_CATEGORIA = "Error al modificar la categoria";
    const ERROR_DELETE_CATEGORIA = "Error al borrar la categoria";
    const ERROR_GET_CATEGORIA = "Error al mostrar los datos de las categorias";
    
    
    const CATEGORIA_CREADA = "La categoria se ha creado correctamente";
    const CATEGORIA_ACTUALIZADA = "La categoria se ha actualizado correctamente";
    const CATEGORIA_BORRADA = "La categoria se ha borrado correctamente";
}