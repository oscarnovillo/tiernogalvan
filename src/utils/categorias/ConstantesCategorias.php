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
    const UPDATE_CATEGORY = "UPDATE categorias SET Categoria=? WHERE Categoria = ?" ;
    const DELETE_CATEGORY ="DELETE FROM categorias WHERE idCategoria = ?";
    const CREAR_CATEGORIA = "crear_categoria";
    const NOMBRE_CATEGORIA = "categoria";
    const ID_CATEGORIA = "idcategoria";
    const MODIFICAR_CATEGORIA = "modificar_categoria";
    const OLD_CATEGORY = "categoria_antigua";
    
}