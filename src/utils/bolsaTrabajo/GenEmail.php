<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 01/06/2018
 * Time: 18:06
 */

namespace utils\bolsaTrabajo;


use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use utils\Constantes;

class GenEmail
{
    //put your code here
    private static $_instance;
    private $loader;
    private $twig;

    private function __construct()
    {

        $this->loader = new FilesystemLoader(Constantes::TWIG_FOLDER);
        $this->twig = new Environment($this->loader);
        $this->twig->addGlobal('userOnline', isset($_SESSION[Constantes::SESS_USER]));
    }

    public static function getInstance()
    {

        if (!isset(self::$_instance)) {
            self::$_instance = new GenEmail();
        }

        if (!isset(self::$_instance)) {
            throw new Exception('twig viewer not configured');
        }

        return self::$_instance;
    }

    public function renderTemplate($page, $parameters = NULL)
    {
        if ($parameters == NULL) {
            $parameters = array();
        }
        return $this->twig->render($page . ".twig", $parameters);
    }
}