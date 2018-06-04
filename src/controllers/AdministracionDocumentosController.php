<?php

namespace controllers;

use utils\Constantes;
use utils\documentos\ConstantesDocumentos;
use utils\categorias\ConstantesCategorias;
use utils\ConstantesPaginas;
use servicios\documentos\DocumentosService;
use servicios\categorias\CategoriasService;
use utils\TwigViewer;


class AdministracionDocumentosController{
    
    public function documentos() {
        $categorias = new CategoriasService(); 
        $documentos = new DocumentosService();
        /*
         * Se permite crear categorias a los usuarios de administracion
         * y guardar ficheros en ellas
         * Se muestran los ficheros dentro de las categorias
         * 
         */
        $parameters = array();
        
        $page = ConstantesPaginas::ADMINISTRACION_DOCUMENTOS;
        
        $parameters['categorias'] = $categorias->getCategorias();
        if($parameters['categorias'] != -1){
            $parameters['documentos_categoria'] = getCategoryDocuments();
            if($parameters['documentos_categoria'] = -1){
   
                if (isset($_REQUEST[Constantes::PARAMETER_NAME_ACTION])) {
                    $action = $_REQUEST[Constantes::PARAMETER_NAME_ACTION];

                    switch ($action) {
                        /* Ver las tareas de un curso */
                         case ConstantesCategorias::CREAR_CATEGORIA: 
                            if (isset($_REQUEST[ConstantesCategorias::NOMBRE_CATEGORIA])) {
                                $nombre_categoria = $_REQUEST[ConstantesCategorias::NOMBRE_CATEGORIA];
                                $respuesta = $categorias->inserCategoria($nombre_categoria);
                                if( $respuesta > 0){
                                    $path= Constantes::CARPETA_DOCUMENTOS_DIRECCION.'/'.$nombre_categoria;
                                    if (mkdir(path,mode,recursive,context)){
                                        $parameters['correcto'] = "Categoria creada correctamente";
                                    }else{
                                        $categorias->deleteCategoria($respuesta);
                                        $parameters['error'] = "Error al crear la categoria";
                                    }

                                }else{
                                    $parameters['error'] = "Error al crear la categoria";
                                } 
                            }  
                        break;
                        case ConstantesDocumentos::SUBIDA_FICHERO: 
                            if ($_FILES['archivo']['error']>0){
                                 $parameters['error'] = "Error al subir el fichero";
                            }else{
                                $categoria = $_REQUEST[ConstantesCategorias::NOMBRE_CATEGORIA];
                                $idcategoria = $_REQUEST[ConstantesCategorias::ID_CATEGORIA];
                                $respuesta = $documentos->insertDocumento($_FILES['archivo']['name'],$categoria);
                                if($respuesta > 0){
                                    if(move_uploaded_file($_FILES['archivo']['tmp_name'],Constantes::CARPETA_DOCUMENTOS_DIRECCION ."/". $_FILES['archivo']['name'])){
                                        $parameters['correcto'] = "El fichero se ha subido correctamente";
                                    }else{
                                        $documentos->deleteDocumento($respuesta);
                                        $parameters['error'] = "No ha podido subirse el fichero";
                                    }
                                }else{
                                     $parameters['error'] = "No ha podido subirse el fichero";
                                }
                            }
                        break;

                    }
                }
            }else{
                    $parameters['error'] = "No se han podido cargar los documentos de las categorias";

            }
        }else{
            $parameters['error'] = "No se han podido cargar los datos de las categorias";
        }
        TwigViewer::getInstance()->viewPage($page, $parameters);
    }
    
    
    public function getCategoryDocuments(){
        //  Metodo para cargar las categorias con todos los ficheros dentro de estas
        //En caso de error devolvera -1 y se mostrara en la pantalla
        $categorias = new CategoriasService(); 
        $documentos = new DocumentosService();
        
        $documentos_categoria = array();
        $categorias_creadas = $categorias->getCategorias();
        if($categorias_creadas != -1){   
           foreach($categorias_creadas as $categoria){
               $array_intermedio = array();
               $lista_documentos = array();
               $lista_documentos = $documentos->getDocumentos($categoria->idCategoria);
               if($lista_documentos != -1){
                   array_push($array_intermedio,$categoria->Categoria,$lista_documentos);
                   array_push($documentos_categoria,$array_intermedio); 
               }else{
                   return -1;
               }
           }
           return $documentos_categoria;
        }else{
           return -1;
        }
    }
}