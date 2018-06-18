<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace utils;

use utils\bolsaTrabajo\ConstantesBolsaTrabajo;
use utils\Constantes;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

/**
 * Description of TwigViewer
 *
 * @author user
 */
class TwigViewer
{

    //put your code here
    private static $_instance;
    private $loader;
    private $twig;

    private function __construct()
    {

        $filter = new \Twig_Filter('html_entity_decode', 'html_entity_decode');
        $this->loader = new FilesystemLoader(Constantes::TWIG_FOLDER);
        $this->twig = new Environment($this->loader, array(
            'debug' => in_array($_SERVER['REMOTE_ADDR'], ["127.0.0.1", "::1"]) ? true:false
        ));
        $this->twig->addFilter($filter);
        $this->twig->addExtension(new \Twig_Extension_Debug());
        $this->twig->addGlobal('userOnline', isset($_SESSION[Constantes::SESS_USER]));
        if (isset($_SESSION[Constantes::SESS_USER])){
            $this->twig->addGlobal('user_keys', $_SESSION[Constantes::SESS_USER]);
        }
        $this->twig->addGlobal(ConstantesBolsaTrabajo::BOLSA_PERMISOS, isset($_SESSION[ConstantesBolsaTrabajo::TIPO_PERMISO]));
    }

    public static function getInstance()
    {

        if (!isset(self::$_instance)) {
            self::$_instance = new TwigViewer();
        }

        if (!isset(self::$_instance)) {
            throw new Exception('twig viewer not configured');
        }

        return self::$_instance;
    }

    public function viewPage($page, $parameters = NULL)
    {
        if ($parameters == NULL) {
            $parameters = array();
        }
        echo $this->twig->render($page . ".twig", $parameters);
    }

}
