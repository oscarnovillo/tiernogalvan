<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace utils;

use utils\Constantes;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

/**
 * Description of TwigViewer
 *
 * @author user
 */
class TwigViewer {

    //put your code here
    private static $_instance;
    private $loader;
    private $twig;

    private function __construct() {

        $this->loader = new FilesystemLoader(Constantes::TWIG_FOLDER);
        $this->twig = new Environment($this->loader);
    }

    public static function getInstance() {

        if (!isset(self::$_instance)) {
            self::$_instance = new TwigViewer();
        }

        if (!isset(self::$_instance)) {
            throw new Exception('twig viewer not configured');
        }

        return self::$_instance;
    }

    public function viewPage($page, $parameters = NULL) {
        if ($parameters == NULL) {
            $parameters = array();
        }
        echo $this->twig->render($page . ".twig", $parameters);
    }

}
