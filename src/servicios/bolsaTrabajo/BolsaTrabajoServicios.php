<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 01/05/2018
 * Time: 17:12
 */

namespace servicios\bolsaTrabajo;


use Carbon\Carbon;
use config\ConfigBolsaTrabajo;
use dao\bolsaTrabajo\BolsaTrabajoDAO;
use model\GenericMessage;
use Respect\Validation\Validator as v;
use Teapot\StatusCode\Http;
use utils\bolsaTrabajo\BuzonCorreo;
use utils\bolsaTrabajo\ConstantesBD;
use utils\bolsaTrabajo\ConstantesBolsaTrabajo;
use utils\bolsaTrabajo\GenEmail;
use utils\bolsaTrabajo\MensajesBT;
use utils\bolsaTrabajo\UploadHandler;
use utils\ConstantesPaginas;


class BolsaTrabajoServicios
{
    public function insertNuevaOferta($oferta)
    {
        $dao = new BolsaTrabajoDAO();
        return $dao->insertOfertaDB($oferta);
    }

    public function verOferta($idOferta)
    {
        $dao = new BolsaTrabajoDAO();
        return $dao->verOfertaDB($idOferta);
    }

    public function getOfertaFpTitulo($idOferta)
    {
        $dao = new BolsaTrabajoDAO();
        return $dao->getFpTitulosByIdOferta($idOferta);
    }

    public function getOfertasByFpIdAndTime($limit, $offset, $fpId, $orden)
    {
        if ($fpId == 0) {//Cuando queremos todas las ofertas del centro

            return $this->getAllOfertas($limit, $offset, $orden);
        }
        return $this->getAllOfertasFilter($limit, $offset, $fpId, $orden);
    }


    public function tratarParametrosOferta($json)
    {
        return $this->validarOferta($json);
    }

    public function getEstudiosCentro()
    {
        $dao = new BolsaTrabajoDAO();
        return $dao->getEstudiosCentroDB();
    }

    public function getSizeOfertas()
    {
        $dao = new BolsaTrabajoDAO();
        return $dao->getSizeOfertasDB();
    }

    public function validarOferta($ofertaNueva)
    {
        $isValid = false;
        $validador = v::attribute(ConstantesBolsaTrabajo::TITULO_OFERTA, v::stringType()->length(10, 200))
            ->attribute(ConstantesBolsaTrabajo::DESCRIPCION_OFERTA, v::stringType()->length(10, 1000))
            ->attribute(ConstantesBolsaTrabajo::REQUISITOS_OFERTA, v::stringType()->length(10, 800))
            ->attribute(ConstantesBolsaTrabajo::EMAIL_OFERTA, v::optional(v::email()->length(4, 80)))
            ->attribute(ConstantesBolsaTrabajo::EMPRESA_OFERTA, v::optional(v::stringType()->length(3, 60)))
            ->attribute(ConstantesBolsaTrabajo::WEB_OFERTA, v::optional(v::stringType()->length(4, 80)))
            ->attribute(ConstantesBolsaTrabajo::LOCALIZACION_OFERTA, v::optional(v::stringType()->length(3, 85)))
            ->attribute(ConstantesBolsaTrabajo::TELEFONO_OFERTA, v::optional(v::stringType()->length(8, 15)))
            ->attribute(ConstantesBolsaTrabajo::VACANTE_OFERTA, v::optional(v::numeric()))
            ->attribute(ConstantesBolsaTrabajo::SALARIO_OFERTA, v::optional(v::stringType()->length(1, 100)))
            ->attribute(ConstantesBolsaTrabajo::CADUCIDAD_OFERTA, v::date('Y-m-d')->between(Carbon::now(), Carbon::now()->addMonth(3)));
        if ($validador->validate($ofertaNueva)) {
            $fp_array_oferta = $ofertaNueva->fp_oferta;

            $isValid = $this->validarFpCodes($fp_array_oferta);
        }
        return $isValid;
    }

    public function validarPerfil($perfil)
    {

        $validador = v::attribute(ConstantesBD::NOMBRE, v::stringType()->length(1, 100))
            ->attribute(ConstantesBD::APELLIDOS, v::stringType()->length(1, 100))
            ->attribute(ConstantesBD::FP_CODE, v::numeric())
            ->attribute(ConstantesBD::COMENTARIO, v::optional(v::stringType()->length(3, 1000)))
            ->attribute(ConstantesBD::EXPERIENCIA, v::optional(v::stringType()->length(3, 1000)))
            ->attribute(ConstantesBD::PERFIL_EXTERNO, v::optional(v::stringType()->length(3, 200)))
            ->attribute(ConstantesBD::LINK_INTERES, v::optional(v::stringType()->length(3, 200)))
            ->attribute(ConstantesBD::EMAIL, v::optional(v::stringType()->length(3, 100)))
            ->attribute(ConstantesBD::TELEFONO, v::optional(v::stringType()->length(6, 12)));

        return $validador->validate($perfil);
    }

    public function validarFpCodes($fp_array_oferta)
    {
        $isValid = false;
        if (is_array($fp_array_oferta)) {
            foreach ($fp_array_oferta as $item) {
                if (v::stringType()->length(1, 100)->validate($item)) {
                    $isValid = true;
                }
            }
        }
        return $isValid;
    }

    public function misOfertas($idOwner)
    {
        $dao = new BolsaTrabajoDAO();
        return $dao->getOfertasByIdOwner($idOwner);
    }

    public function getMiPerfil($idPerfil)
    {
        $dao = new BolsaTrabajoDAO();
        return $dao->getPerfilDB($idPerfil);
    }

    public function actualizarOferta($datos)
    {
        $dao = new BolsaTrabajoDAO();
        return $dao->updateOfertaDB($datos);
    }

    public function borrarOferta($idOferta, $idOwner)
    {
        $dao = new BolsaTrabajoDAO();
        return $dao->deleteOfertaDB($idOferta, $idOwner);
    }


    public function actualizarPerfil($perfil)
    {
        $dao = new BolsaTrabajoDAO();
        $perfil = $this->formatFotoUrl($perfil);

        return $dao->insertOrUpdatePerfilDB($perfil);
    }

    private function formatFotoUrl($perfil)
    {
        if ($perfil->NAME != null && $perfil->UUID != null) {
            $perfil->FOTO = ConfigBolsaTrabajo::DIRECTORIO_PERFILES . '/' . $perfil->UUID . '/' . $perfil->NAME;
        }
        return $perfil;
    }


    public function getAllOfertas($limit, $offset, $orden)
    {
        $dao = new BolsaTrabajoDAO();
        $ofertasDB = $dao->getAllOfertasDB($limit, $offset, $orden);
        if (is_array($ofertasDB)) {
            foreach ($ofertasDB as $item) {
                $item = $this->formatOferta($item);
            }
        }
        return $ofertasDB;
    }

    public function getAllOfertasFilter($limit, $offset, $fpId, $orden)
    {
        $dao = new BolsaTrabajoDAO();
        $ofertasDB = $dao->getOfertasByFpCodeAndTimeDB($limit, $offset, $fpId, $orden);
        if (is_array($ofertasDB)) {
            foreach ($ofertasDB as $item) {
                $item = $this->formatOferta($item);
            }
        }
        return $ofertasDB;
    }

    public function formatOferta($oferta)
    {
        $oferta->CREACION = $this->formatCreacion($oferta->CREACION);
        $oferta->DESCRIPCION = $this->formatTexto($oferta->DESCRIPCION, ConfigBolsaTrabajo::LONGITUD_TEXTO_DESCRIPCION);
        return $oferta;
    }

    public function formatCreacion($creacion)
    {
        $caducidad = Carbon::createFromTimeString($creacion);
        $diferencia = Carbon::now()->diffInDays($caducidad);
        return sprintf(MensajesBT::TIEMPO_TRANSCURRIDO, $diferencia);
    }

    public function formatTexto($texto, $limit)
    {
        if (strlen($texto) > $limit)
            $texto = substr($texto, 0, strrpos(substr($texto, 0, $limit), ' ')) . '...';
        return $texto;
    }

    public function subirArchivo()
    {
        $directorioSubida = ConfigBolsaTrabajo::DIRECTORIO_PERFILES;
        $uploader = new UploadHandler();

        // Specify the list of valid extensions, ex. array("jpeg", "xml", "bmp")
        $uploader->allowedExtensions = array("jpeg", "jpg", "png"); // all files types allowed by default

        // Specify max file size in bytes.
        $uploader->sizeLimit = null;

        // Specify the input name set in the javascript.
        $uploader->inputName = "qqfile"; // matches Fine Uploader's default inputName value by default

        // If you want to use the chunking/resume feature, specify the folder to temporarily save parts.
        $uploader->chunksFolder = "chunks";

        $method = $this->get_request_method();

        if ($method == "POST") {
            header("Content-Type: text/plain");

            // Assumes you have a chunking.success.endpoint set to point here with a query parameter of "done".
            // For example: /myserver/handlers/endpoint.php?done
            if (isset($_GET["done"])) {
                $result = $uploader->combineChunks($directorioSubida);
            } // Handles upload requests
            else {
                // Call handleUpload() with the name of the folder, relative to PHP's getcwd()
                $result = $uploader->handleUpload($directorioSubida);

                // To return a name used for uploaded file you can use the following line.
                $result["uploadName"] = $uploader->getUploadName();
            }

            echo json_encode($result);
        } // for delete file requests
        else if ($method == "DELETE") {
            $result = $uploader->handleDelete($directorioSubida);
            echo json_encode($result);
        } else {
            header("HTTP/1.0 405 Method Not Allowed");
        }


    }

    public function get_request_method()
    {
        global $HTTP_RAW_POST_DATA;

        if (isset($HTTP_RAW_POST_DATA)) {
            parse_str($HTTP_RAW_POST_DATA, $_POST);
        }

        if (isset($_POST["_method"]) && $_POST["_method"] != null) {
            return $_POST["_method"];
        }

        return $_SERVER["REQUEST_METHOD"];
    }

    public function validarPerfilConfig($datosConfig)
    {
        $validador = v::attribute(ConstantesBD::RECIBIR_OFERTAS, v::boolVal())
            ->attribute(ConstantesBD::BUSCA_TRABAJO, v::boolVal());

        return $validador->validate($datosConfig);
    }

    public function actualizarPerfilConfig($datosConfig)
    {
        $dao = new BolsaTrabajoDAO();
        return $dao->updatePerfilDBConfig($datosConfig);
    }

    public function recuperarNombreCiclo($fpCode)
    {
        $estudios = $this->getEstudiosCentro();
        $nombreCiclo = null;
        foreach ($estudios as $estudio) {
            if ($estudio->ID_FP == $fpCode) {
                $nombreCiclo = $estudio->TITULO;
            }
        }
        return $nombreCiclo;
    }

    public function definirInfoOferta($RECIBIR_OFERTAS)
    {
        $responseText = null;
        if ($RECIBIR_OFERTAS == 0) {
            $responseText = MensajesBT::RECIBIR_OFERTAS_OK;
        } else {
            $responseText = MensajesBT::RECIBIR_OFERTAS_NO;
        }
        return $responseText;
    }

    public function definirInfoTrabajo($BUSCA_TRABAJO)
    {
        $responseText = null;
        if ($BUSCA_TRABAJO == 0) {
            $responseText = MensajesBT::BUSCA_TRABAJO_OK;
        } else {
            $responseText = MensajesBT::BUSCA_TRABAJO_NO;
        }
        return $responseText;
    }

    public function comprobarApuntarOferta($idOferta, $idUser)
    {
        $dao = new BolsaTrabajoDAO();
        return $dao->comprobarApuntarDB($idOferta, $idUser);
    }

    public function apuntarseOfertaDB($idOferta, $idUser)
    {
        $dao = new BolsaTrabajoDAO();
        return $dao->insertApuntarDB($idOferta, $idUser);
    }

    public function apuntarEnOferta($idOferta, $idUser)
    {
        $message = null;
        $perfilUser = $this->getMiPerfil($idUser);

        if (is_array($perfilUser) && !empty($perfilUser)) {

            $registroPrevio = $this->comprobarApuntarOferta($idOferta, $idUser);

            if (!$registroPrevio) {
                $ofertaDatos = $this->verOferta($idOferta);
                if (is_object($ofertaDatos) && $ofertaDatos->EMAIL != null) {
                    $servidor = new BuzonCorreo();
                    $aplicante = false;
                    if ($perfilUser[0]->EMAIL != null) {
                        //Enviamos correo de confirmación
                        $ofertaDatos->LINK_OFERTA = $this->formatearOfertaURLEmail(MensajesBT::LINK_OFERTA_TRABAJO, $ofertaDatos->ID_OFERTA);
                        $template = GenEmail::getInstance()->renderTemplate(ConstantesBolsaTrabajo::TEMPLATE_CONFIRMACION_OFERTA_ALUMN, (array)$ofertaDatos);
                        $aplicante = $servidor->enviarCorreo($perfilUser[0]->EMAIL, $perfilUser[0]->NOMBRE, MensajesBT::ASUNTO_CONFIRM_OFERTA, $template);
                    }
                    //enviamos correo a ofertante
                    $perfilUser[0]->TITULO = $ofertaDatos->TITULO;
                    $perfilUser[0]->LINK_PERFIL = $this->formatearOfertaURLEmail(MensajesBT::LINK_PERFIL_USER, $perfilUser[0]->ID_PERFIL);
                    $perfilUser[0]->LINK_OFERTA = $this->formatearOfertaURLEmail(MensajesBT::LINK_OFERTA_TRABAJO, $ofertaDatos->ID_OFERTA);
                    $perfiObject = $perfilUser[0];

                    $template = GenEmail::getInstance()->renderTemplate(ConstantesBolsaTrabajo::TEMPLATE_CONFIRMACION_OFERTA_EMPRESA, (array)$perfiObject);
                    $receptor = $servidor->enviarCorreo($ofertaDatos->EMAIL, $ofertaDatos->EMPRESA, MensajesBT::ASUNTO_CONFIRM_OFERTA_EMPRESA, $template);

                    if ($aplicante && $receptor) {
                        $message = new GenericMessage(MensajesBT::OPERACION_ACEPTADA, MensajesBT::APUNTARSE_TODO_CORRECTO);

                    } elseif ($aplicante && !$receptor) {
                        //ponte en contacto con el ofertante
                        $message = new GenericMessage(MensajesBT::OPERACION_ACEPTADA, MensajesBT::APUNTARSE_FALTA_EMPRESA);


                    } else {
                        //ponte en contacto no tenemos datos suficientes
                        $message = new GenericMessage(MensajesBT::OPERACION_ACEPTADA, MensajesBT::APUNTARSE_FALTAN_COSAS);

                    }

                    $this->apuntarseOfertaDB($idOferta, $idUser);


                } else {
                    http_response_code(Http::BAD_REQUEST);
                    $message = new GenericMessage(MensajesBT::OPERACION_DENEGADA, MensajesBT::APUNTARSE_EMPRESA_NO_EMAIL);
                }

            } else {
                //ya estas apuntad@
                http_response_code(Http::BAD_REQUEST);
                $message = new GenericMessage(MensajesBT::OPERACION_DENEGADA, MensajesBT::APUNTARSE_DENEGACION_REPLICA);
            }


        } else {
            //no existe el user
            http_response_code(Http::BAD_REQUEST);
            $message = new GenericMessage(MensajesBT::OPERACION_DENEGADA, MensajesBT::APUNTARSE_DENEGACION_NO_PERFIL);
        }

        echo json_encode($message);

    }

    private function formatearOfertaURLEmail($ruta, $id)
    {
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
        return $protocol . $_SERVER['HTTP_HOST'] . '/' . $ruta . $id;

    }

    public function recuperarUsersRecibirOferta($idFpCode)
    {
        $dao = new BolsaTrabajoDAO();
        return $dao->getAllUsersANotificarDB($idFpCode);
    }

    /**
     * Metodo encargado de hacer un barrido por todas las ofertas buscando aquellas que no han sido difundidas, para un posterior envío de correos con la oferta
     *
     * Será llamado por CRON - cada - 6 horas
     */
    public function recuperarOfertasANotificar()
    {
        $dao = new BolsaTrabajoDAO();
        $ofertasDB = $dao->getAllOfertasANotificarDB();
        $resultado = true;
        if (is_array($ofertasDB) && !empty($ofertasDB)) {
            foreach ($ofertasDB as $item) {
                $idOferta = $item->ID_OFERTA;
                $usersId = [];
                $fpCodes = $this->getOfertaFpTitulo($item->ID_OFERTA);
                if (is_array($fpCodes->KEYS) && !empty($fpCodes->KEYS) && $resultado) {
                    foreach ($fpCodes->KEYS as $fp_clave) {
                        $userANotificar = $this->recuperarUsersRecibirOferta($fp_clave[ConstantesBD::ID_FP]);
                        if (is_array($userANotificar) && !empty($userANotificar)) {
                            foreach ($userANotificar as $code) {
                                array_push($usersId, $code->ID_PERFIL);
                            }
                        } else {
                            //No hay perfiles
                        }


                    }//fin foreach

                    //insertar en la base de datos para una oferta
                    if (!empty($usersId)) {
                        $resultado = $dao->agregarEnviarOfertas($idOferta, $usersId);
                    }

                } else {
                    //Esta oferta no tiene ciclos asociados
                }
            }//fin foreach

        } else {
            //no tenemos ofertas a difundir
        }


    }

    public function numEmailsEnviados()
    {
        $dao = new BolsaTrabajoDAO();
        return $dao->getCounterEmailDB();
    }

    public function actualizarEmailsEnviados($numero)
    {
        $dao = new BolsaTrabajoDAO();
        return $dao->updateCounterEmailDB($numero);
    }

    /**
     *
     * Método destinado para mandar correos en masa con las nuevas ofertas de trabajo publicadas
     *
     * Utilizado por CRON - cada hora
     * @param $limite
     *
     *
     */

    public function enviarCorreoMasivo($limite)
    {
        $numEnviados = $this->numEmailsEnviados();
        $contador = 0;
        $servidor = new BuzonCorreo();
        $horaActual = Carbon::now()->hour;
        if ($horaActual >= 23) {//reset diario
            $this->actualizarEmailsEnviados(0);
        }
        if ($numEnviados < ConfigBolsaTrabajo::LIMITE_CORREOS_POR_DIA) {
            $dao = new BolsaTrabajoDAO();
            $ofertasAEnviar = $dao->getEmailNoNotificadosDB($limite);
            $ofertaDB = null;
            if (is_array($ofertasAEnviar) && !empty($ofertasAEnviar)) {
                $size = count($ofertasAEnviar);
                for ($i = 0; $i < $size; $i++) {
                    $ofertaTemp = null;
                    $j = $i - 1;

                    if ($ofertaDB == null || $ofertasAEnviar[$i][ConstantesBD::ID_OFERTA] != $ofertasAEnviar[$j][ConstantesBD::ID_OFERTA]) {

                        $ofertaDB = $dao->verOfertaDB($ofertasAEnviar[$i][ConstantesBD::ID_OFERTA]);
                    }
                    $ofertaTemp = $ofertaDB;


                    if (is_object($ofertaTemp)) {
                        $userDB = $dao->getPerfilDB($ofertasAEnviar[$i][ConstantesBD::ID_USER]);

                        $emailUser = $userDB[0]->EMAIL;
                        $emailNombre = $userDB[0]->NOMBRE;
                        $ofertaTemp->LINK_OFERTA = $this->formatearOfertaURLEmail(MensajesBT::LINK_OFERTA_TRABAJO, $ofertaTemp->ID_OFERTA);
                        $template = GenEmail::getInstance()->renderTemplate(ConstantesBolsaTrabajo::TEMPLATE_NUEVA_OFERTA_INFO, (array)$ofertaTemp);

                        $isSend = $servidor->enviarCorreo($emailUser, $emailNombre, MensajesBT::ASUNTO_NUEVA_OFERTA, $template);

                        if ($isSend) {
                            $dao->updateEnviarCorreosDB($ofertasAEnviar[$i][ConstantesBD::ID_NOTIFICAR]);
                            $contador++;
                            sleep(1);//para  no saturar el servidor de correo
                        }


                    }
                }//fin for

                $dao->updateCounterEmailDB($numEnviados + $contador);
            }


        } else {
            //Te has pasado del límite
        }

    }

    /**
     * Método que borra todas las ofertas de trabajo antiguas - más de 3 meses
     *
     * llamado por CRON - cada día
     *
     */

    //TODO - pendiente de pulir el borrado
    public function borrarViejasOfertas(){
        $dao = new BolsaTrabajoDAO();
        $dao->deleteOldOfertasDB();
    }


}//fin clase