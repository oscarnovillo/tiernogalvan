<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace model;

class Categoria{
    
    public $Categoria;
    
    public function getCategoria(){
        return  $this->Categoria;
    }
    
    public function setCategoria($categoria):void{
        $this->Categoria = $categoria;
    }
}
