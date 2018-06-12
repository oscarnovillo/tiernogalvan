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
        
        $controller = new AdministracionDocumentosController();
        /*
         * Se permite crear categorias a los usuarios de administracion
         * y guardar ficheros en ellas
         * Se muestran los ficheros dentro de las categorias
         * 
         */
        $parameters = array();
        
        $page = ConstantesPaginas::ADMINISTRACION_DOCUMENTOS;
        
        $ajax = false;
        if (isset($_REQUEST[Constantes::PARAMETER_NAME_ACTION])) {
            $action = $_REQUEST[Constantes::PARAMETER_NAME_ACTION];
            switch ($action) {
                /* Ver las tareas de un curso */
                 case ConstantesCategorias::CREAR_CATEGORIA: 
                    if (isset($_REQUEST[ConstantesCategorias::NOMBRE_CATEGORIA])) {
                        $nombre_categoria = $_REQUEST[ConstantesCategorias::NOMBRE_CATEGORIA];
                        $respuesta = $categorias->inserCategoria($nombre_categoria);
                        if( $respuesta > 0){
                                $parameters['correcto'] = "Categoria creada correctamente";
                            }else{
                                $parameters['error'] = "Error al crear la categoria";
                            }
                    }else{
                            $parameters['error'] = "Error al crear la categoria";
                        }  
                break;
                case ConstantesDocumentos::SUBIDA_FICHERO: 
                    if ($_FILES['archivo']['error']>0){
                         $parameters['error'] = "Error al subir el fichero";
                    }else{
                        if ( isset($_REQUEST[ConstantesCategorias::NOMBRE_CATEGORIA]) && isset($_REQUEST[ConstantesCategorias::ID_CATEGORIA])) {
                            $categoria = $_REQUEST[ConstantesCategorias::NOMBRE_CATEGORIA];
                            $idcategoria = $_REQUEST[ConstantesCategorias::ID_CATEGORIA];
                            $respuesta = $documentos->insertDocumento($_FILES['archivo'],$idcategoria, $categoria);
                            if($respuesta > 0){
                                    $parameters['correcto'] = "El fichero se ha subido correctamente";
                            }else{
                                 $parameters['error'] = "No ha podido subirse el fichero";
                            }
                        }else{
                                 $parameters['error'] = "No ha podido subirse el fichero";
                        }
                    }
                break;
                case ConstantesDocumentos::BORRAR_FICHERO:
                    if ( isset($_REQUEST[ConstantesDocumentos::IDDOCUMENTO]) && isset($_REQUEST[ConstantesDocumentos::DOCUMENTO]) && isset($_REQUEST[ConstantesCategorias::CATEGORIA])) {
                        $id_documento = $_REQUEST[ConstantesDocumentos::IDDOCUMENTO];
                        $categoria = $_REQUEST[ConstantesCategorias::CATEGORIA];
                        $documento = $_REQUEST[ConstantesDocumentos::DOCUMENTO];
                        $respuesta = $documentos->deleteDocumento($id_documento,$categoria,$documento);
                        if( $respuesta > 0){

                                $parameters['correcto'] = "Fichero borrado correctamente";
                        }else{
                            $parameters['error'] = "Error al borrar el fichero";
                        } 
                    }else{
                        $parameters['error'] = "Error al borrar el fichero";
                    }   
                break;
                case ConstantesDocumentos::MODIFICAR_FICHERO: 
                    if ( isset($_REQUEST[ConstantesDocumentos::IDDOCUMENTO]) && isset($_REQUEST[ConstantesDocumentos::DOCUMENTO]) && isset($_REQUEST[ConstantesCategorias::CATEGORIA]) && isset($_REQUEST[ConstantesDocumentos::OLDDOCUMENT])) {
                        $id_documento = $_REQUEST[ConstantesDocumentos::IDDOCUMENTO];
                        $documento = $_REQUEST[ConstantesDocumentos::DOCUMENTO];
                        $categoria = $_REQUEST[ConstantesCategorias::CATEGORIA];
                        $documento_antiguo = $_REQUEST[ConstantesDocumentos::OLDDOCUMENT];
                        $respuesta = $documentos->updateDocumento($id_documento, $documento,$categoria,$documento_antiguo);
                        if( $respuesta > 0){                              
                            $parameters['correcto'] = "Fichero modificado correctamente";
                        }else{
                            $parameters['error'] = "Error al modificar el fichero";
                        } 
                    }else{
                        $parameters['error'] = "Error al modificar el fichero";
                    } 
                break;
                case ConstantesCategorias::MODIFICAR_CATEGORIA:
                     if (isset($_REQUEST[ConstantesCategorias::CATEGORIA]) && isset($_REQUEST[ConstantesCategorias::ID_CATEGORIA]) && isset($_REQUEST[ConstantesCategorias::OLD_CATEGORY])){
                        $categoria_antigua = $_REQUEST[ConstantesCategorias::OLD_CATEGORY];
                        $categoria = $_REQUEST[ConstantesCategorias::CATEGORIA];
                        $id_categoria = $_REQUEST[ConstantesCategorias::ID_CATEGORIA];
                        $respuesta = $categorias->updateCategoria($id_categoria, $categoria,$categoria_antigua);
                        if( $respuesta > 0){                              
                                $parameters['correcto'] = "Carpeta modificada correctamente";
                        }else{
                            $parameters['error'] = "Error al modificar la carpeta";
                        }
                     }else{
                        $parameters['error'] = "Error al modificar la carpeta";
                     }
                break;
                case ConstantesCategorias::BORRAR_CATEGORIA:
                     if (isset($_REQUEST[ConstantesCategorias::CATEGORIA]) && isset($_REQUEST[ConstantesCategorias::ID_CATEGORIA])){
                        $ajax=true;
                        $categoria = $_REQUEST[ConstantesCategorias::CATEGORIA];
                        $id_categoria = $_REQUEST[ConstantesCategorias::ID_CATEGORIA];
                        $respuesta = $categorias->deleteCategoria($id_categoria, $categoria);
                        if( $respuesta > 0){                              
                                $parameters['correcto'] = "Carpeta borrada correctamente";
                        }else{
                            $parameters['error'] = "Error al borrar la carpeta";
                        }
                     }else{
                        $parameters['error'] = "Error al borrar la carpeta";
                     }
                break;
            }
        }
            
        
        $getcategorias = $categorias->getCategorias();
        if($getcategorias != -1){
            $parameters['categorias'] = $getcategorias;
        }else{
            $parameters['error'] = "No se han encontrado categorias";
        }
        $categoriasdocumentos = $controller->getCategoryDocuments();
        if($categoriasdocumentos != -1){
            $parameters['documentos_categoria'] = $categoriasdocumentos;
        }else{
        $parameters['error'] = "No se han encontrado categorias ni documentos";
        }
        if($ajax == false)
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
               $lista_documentos = $documentos->getDocumentos($categoria->idCategorias);
               if($lista_documentos != -1){
                   array_push($array_intermedio,$categoria,$lista_documentos);
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
    
    public function getDocumentsFromCategory($idcategoria){
        $documentos = new DocumentosService();
        $lista_documentos = $documentos->getDocumentos($idcategoria);
        return $lista_documentos;
    }
}