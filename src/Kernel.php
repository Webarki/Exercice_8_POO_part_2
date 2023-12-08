<?php

namespace App\src;

use App\src\Controller\TwigController;

/**
 * Class Noyau Routeur 
 */
class Kernel extends TwigController
{
    public function start()
    {
        // var_dump($_SERVER);
        $params = [];
        $params = explode("/", $_SERVER["PATH_INFO"]);
        // var_dump($params[1]);
        if (!empty($params[1]) && isset($params[1]) && $params[1] != $params[1] . '/ ') {
            $controller = "\\App\\src\\Controller\\" . ucfirst($params[1]) . "Controller";
            //  var_dump($controller);
            //var_dump($params);
            $method = (isset($params[2])) ? $params[2] :  "index";
            //var_dump($method);
            $data = (isset($params[3])) ? $params[3] :  "";
            // var_dump($data);
            $controllers = new $controller();
            if (method_exists($controllers, $method)) {
                (isset($data)) ? $controllers->$method($data) : $controllers->$method();
            } else {
                http_response_code(404);
                echo 'Désoler aucune méthode nommé ' . $method . ' n\éxiste dans le controller ' . ucfirst($params[1]) . 'Controller';
            }
        } else {
            $controller = new TwigController();
            $controller->index();
        }
    }
}
