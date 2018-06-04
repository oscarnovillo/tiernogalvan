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
        
        $getcategorias = $categorias->getCategorias();
        if($getcategorias != -1){
            $parameters['categorias'] = $getcategorias;

            $categoriasdocumentos = getCategoryDocuments();
            if($categoriasdocumentos != -1){
                $parameters['documentos_categoria'] = $categoriasdocumentos;
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
                                    if (mkdir(path)){
                                        $parameters['correcto'] = "Categoria creada correctamente";
                                    }else{
                                        $categorias->deleteCategoria($respuesta);
                                        $parameters['error'] = "Error al crear la categoria";
                                    }

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
                                $respuesta = $documentos->deleteDocumento($id_documento);
                                if( $respuesta > 0){
                                    $path= Constantes::CARPETA_DOCUMENTOS_DIRECCION.'/'.$categoria.'/'.$documento;
                                    if (unlink($path)){
                                        $parameters['correcto'] = "Fichero borrado correctamente";
                                    }else{
                                        $categorias->deleteCategoria($respuesta);
                                        $parameters['error'] = "Error al borrar el fichero";
                                    }

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
                                $respuesta = $documentos->updateDocumento($id_documento, $documento);
                                if( $respuesta > 0){
                                    $old= Constantes::CARPETA_DOCUMENTOS_DIRECCION.'/'.$categoria.'/'.$documento_antiguo;
                                    $new = Constantes::CARPETA_DOCUMENTOS_DIRECCION.'/'.$categoria.'/'.$documento;
                                    if (rename($old,$new)){
                                        $parameters['correcto'] = "Fichero modificado correctamente";
                                    }else{
                                         $documentos->updateDocumento($id_documento, $documento_antiguo);
                                        $parameters['error'] = "Error al modificar el fichero";
                                    }

                                }else{
                                    $parameters['error'] = "Error al modificar el fichero";
                                } 
                            }else{
                                $parameters['error'] = "Error al modificar el fichero";
                            } 
                        break;
                        case ConstantesCategorias::MODIFICAR_CATEGORIA:
                             if (isset($_REQUEST[ConstantesCategorias::CATEGORIA]) && isset($_REQUEST[ConstantesCategorias::OLDCATEGORY])){
                                
                                $categoria = $_REQUEST[ConstantesCategorias::CATEGORIA];
                                $categoria_antigua = $_REQUEST[ConstantesCategorias::OLDCATEGORY];
                                $respuesta = $categorias->updateCategoria($id_documento, $categoria);
                                if( $respuesta > 0){
                                    $old= Constantes::CARPETA_DOCUMENTOS_DIRECCION.'/'.$categoria_antigua;
                                    $new = Constantes::CARPETA_DOCUMENTOS_DIRECCION.'/'.$categoria;
                                    if (rename($old,$new)){
                                        $parameters['correcto'] = "Carpeta modificada correctamente";
                                    }else{
                                        $categorias->updateCategoria($id_documento, $categoria_antigua);
                                        $parameters['error'] = "Error al modificar la carpeta";
                                    }
                                }else{
                                    $parameters['error'] = "Error al modificar la carpeta";
                                }
                             }else{
                                $parameters['error'] = "Error al modificar la carpeta";
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