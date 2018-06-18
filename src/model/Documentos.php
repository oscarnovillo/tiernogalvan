<?php

namespace model;

class Documento{
    public $idDocumentos;
    public $Documento;
    public $Ruta;
    public $idCategoria;
    
    
    public function getDocumento(){
        return  $this->Documento;
    }
    
    public function setDocumento($documento):void{
        $this->Documento = $documento;
    }
    
     public function getRuta(){
        return  $this->Ruta;
    }
    
    public function setRuta($ruta):void{
        $this->Ruta = $ruta;
    }
    
    public function getCategoria(){
        return  $this->idCategoria;
    }
    
    public function setCategoria($idcategoria):void{
        $this->idcategoria = $idcategoria;
    }
}
    

