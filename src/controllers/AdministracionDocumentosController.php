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
        if(isset($_SESSION[Constantes::SESS_USER]->id_rol))
            $id_rol = $_SESSION[Constantes::SESS_USER]->id_rol;
        else
            $id_rol =-1;
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
        $parameters['rol'] = $id_rol;
        $ajax = false;
        if ($id_rol == Constantes::ID_ROL_ADMIN){
            if (isset($_REQUEST[Constantes::PARAMETER_NAME_ACTION])) {
                $action = $_REQUEST[Constantes::PARAMETER_NAME_ACTION];
                switch ($action) {
                    /* Ver las tareas de un curso */
                     case ConstantesCategorias::CREAR_CATEGORIA: 
                        if (isset($_REQUEST[ConstantesCategorias::NOMBRE_CATEGORIA])) {
                            $nombre_categoria = $_REQUEST[ConstantesCategorias::NOMBRE_CATEGORIA];
                            $respuesta = $categorias->inserCategoria($nombre_categoria);
                            if( $respuesta > 0){
                                    $parameters['correcto'] = ConstantesCategorias::CATEGORIA_CREADA;
                                }else{
                                    $parameters['error'] = ConstantesCategorias::ERROR_INSERT_CATEGORIA;
                                }
                        }else{
                                $parameters['error'] = ConstantesCategorias::ERROR_INSERT_CATEGORIA;
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
                                        $parameters['correcto'] = ConstantesDocumentos::DOCUMENTO_CREADO;
                                }else{
                                     $parameters['error'] = ConstantesDocumentos::ERROR_INSERT_DOCUMENTO;
                                }
                            }else{
                                     $parameters['error'] = ConstantesDocumentos::ERROR_INSERT_DOCUMENTO;
                            }
                        }
                    break;
                    case ConstantesDocumentos::BORRAR_FICHERO:
                        if ( isset($_REQUEST[ConstantesDocumentos::IDDOCUMENTO]) && isset($_REQUEST[ConstantesDocumentos::OLD_DOCUMENT]) && isset($_REQUEST[ConstantesCategorias::NOMBRE_CATEGORIA])) {
                            $id_documento = $_REQUEST[ConstantesDocumentos::IDDOCUMENTO];
                            $categoria = $_REQUEST[ConstantesCategorias::NOMBRE_CATEGORIA];
                            $documento = $_REQUEST[ConstantesDocumentos::OLD_DOCUMENT];
                            $respuesta = $documentos->deleteDocumento($id_documento,$categoria,$documento);
                            if( $respuesta > 0){

                                    $parameters['correcto'] = ConstantesDocumentos::DOCUMENTO_BORRADO;
                            }else{
                                $parameters['error'] = ConstantesDocumentos::ERROR_DELETE_DOCUMENTO;
                            } 
                        }else{
                            $parameters['error'] = ConstantesDocumentos::ERROR_DELETE_DOCUMENTO;
                        }   
                    break;
                    case ConstantesDocumentos::MODIFICAR_FICHERO: 
                        if ( isset($_REQUEST[ConstantesDocumentos::IDDOCUMENTO]) && isset($_REQUEST[ConstantesDocumentos::DOCUMENTO]) && isset($_REQUEST[ConstantesCategorias::NOMBRE_CATEGORIA]) && isset($_REQUEST[ConstantesCategorias::ID_CATEGORIA]) && isset($_REQUEST[ConstantesDocumentos::OLD_DOCUMENT])) {
                            $id_documento = $_REQUEST[ConstantesDocumentos::IDDOCUMENTO];
                            $documento = $_REQUEST[ConstantesDocumentos::DOCUMENTO];
                            $categoria = $_REQUEST[ConstantesCategorias::NOMBRE_CATEGORIA];
                            $idcategoria =$_REQUEST[ConstantesCategorias::ID_CATEGORIA];
                            $documento_antiguo = $_REQUEST[ConstantesDocumentos::OLD_DOCUMENT];
                            $respuesta = $documentos->updateDocumento($id_documento, $documento,$categoria,$documento_antiguo,$idcategoria);
                            if( $respuesta > 0){                              
                                $parameters['correcto'] = ConstantesDocumentos::DOCUMENTO_ACTUALIZADO;
                            }else{
                                $parameters['error'] = ConstantesDocumentos::ERROR_UPDATE_DOCUMENTO;
                            } 
                        }else{
                            $parameters['error'] = ConstantesDocumentos::ERROR_UPDATE_DOCUMENTO;
                        } 
                    break;
                    case ConstantesCategorias::MODIFICAR_CATEGORIA:
                         if (isset($_REQUEST[ConstantesCategorias::NOMBRE_CATEGORIA]) && isset($_REQUEST[ConstantesCategorias::ID_CATEGORIA]) && isset($_REQUEST[ConstantesCategorias::OLD_CATEGORY])){
                            $categoria_antigua = $_REQUEST[ConstantesCategorias::OLD_CATEGORY];
                            $categoria = $_REQUEST[ConstantesCategorias::NOMBRE_CATEGORIA];
                            $id_categoria = $_REQUEST[ConstantesCategorias::ID_CATEGORIA];
                            $respuesta = $categorias->updateCategoria($categoria,$id_categoria, $categoria_antigua);
                            if( $respuesta > 0){                              
                                    $parameters['correcto'] = ConstantesCategorias::CATEGORIA_ACTUALIZADA;
                            }else{
                                $parameters['error'] = ConstantesCategorias::ERROR_UPDATE_CATEGORIA;
                            }
                         }else{
                            $parameters['error'] = ConstantesCategorias::ERROR_UPDATE_CATEGORIA;
                         }
                    break;
                    case ConstantesCategorias::BORRAR_CATEGORIA:
                         if (isset($_REQUEST[ConstantesCategorias::NOMBRE_CATEGORIA]) && isset($_REQUEST[ConstantesCategorias::ID_CATEGORIA])){

                            $categoria = $_REQUEST[ConstantesCategorias::NOMBRE_CATEGORIA];
                            $id_categoria = $_REQUEST[ConstantesCategorias::ID_CATEGORIA];
                            $respuesta = $categorias->deleteCategoria($id_categoria, $categoria);
                            if( $respuesta > 0){                              
                                    $parameters['correcto'] = ConstantesCategorias::CATEGORIA_BORRADA;
                            }else{
                                $parameters['error'] = ConstantesCategorias::ERROR_DELETE_CATEGORIA;
                            }
                         }else{
                            $parameters['error'] = ConstantesCategorias::ERROR_DELETE_CATEGORIA;
                         }
                    break;
                    case ConstantesDocumentos::DOCUMENTOS_CATEGORIA:
                        if (isset($_REQUEST[ConstantesCategorias::ID_CATEGORIA])){
                           $id = $_REQUEST[ConstantesCategorias::ID_CATEGORIA];
                           $ajax = true;
                           $listaDocumentos =$controller->getDocumentsFromCategory($id);
                           echo json_encode($listaDocumentos);
                        }else{
                           echo ConstantesDocumentos::ERROR_GET_DOCUMENTO;
                        }
                    break;
                }
            }else{
                $parameters['error'] = 'No se ha encontrado parametro accion';
            }
        }else{
            $parameters['error'] = 'No tienes permiso para realizar esta accion';
        }    
        
        $getcategorias = $categorias->getCategorias();
        if($getcategorias != -1){
            $parameters['categorias'] = $getcategorias;
        }else{
            $parameters['error'] = ConstantesCategorias::ERROR_GET_CATEGORIA;
        }
        $categoriasdocumentos = $controller->getCategoryDocuments();
        if($categoriasdocumentos != -1){
            $parameters['documentos_categoria'] = $categoriasdocumentos;
        }else{
            $parameters['error'] = ConstantesDocumentos::ERROR_GET_DOCUMENTO;
        }
        if ($id_rol == Constantes::ID_ROL_ADMIN || $id_rol == Constantes::ID_ROL_PROFESOR){
            if($ajax == false)
                TwigViewer::getInstance()->viewPage($page, $parameters);
        }else{
            $pagina = ConstantesPaginas::ACCESO_PROHIBIDO;
            TwigViewer::getInstance()->viewPage($pagina, $parameters);
        }
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
        if($lista_documentos != -1){
            return $lista_documentos;
        }else{
           return 'Error al recuperar los documentos de la categoria';
        }
    }
}