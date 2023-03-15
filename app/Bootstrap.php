<?php

class Bootstrap {
    private $controller;
    private $action;
    private $argument;
    private $request;

    public function __construct($request)
    {
        $this->request = str_replace(ROOT_DOMAIN, "/", $request);
        $this->action = 'index';
        $this->argument = '';
        $this->processRequest();
    }

    public function createController()
    {
        if(is_object($this->controller)) {
            $parents = class_parents($this->controller);
            if(in_array("Controller", $parents)){
                if(method_exists($this->controller, $this->action))
                {
                    return $this->controller;
                } else {
                    //Metoda nie istnieje
                    echo '<h2>Metoda nie istnieje</h2>';
                    return;
                }
            } else {
                //Klasa nie rozszerza klasy Controller
                echo '<h2>Klasa nie rozszerza klasy Controller</h2>';
                return;
            }
        } else {
            // Klasa kontrolera nie znaleziona
            echo '<h2>Nie udało się utworzyć obiektu</h2>';
            return;
        }
    }

    private function processRequest()
    {
        if($this->request == '/') {
            $this->controller = new HomeController($this->action, $this->argument);
            return;
        }

        $uriExploded = explode("?", $this->request);
        if (count($uriExploded) < 2) {
            $controllerUri = $this->request;
        }       
        else {
            $controllerUri = $uriExploded[0];
            $queryString = $uriExploded[1];
        }

        $components = explode("/", $controllerUri);
        $componentsCount = count($components);

        try {
            $controllerName=ucfirst(strtolower($components[1]));
            $controllerClass = $controllerName . "Controller";

            if(!class_exists($controllerClass))
                throw new Exception("Nie znaleziono klasy kontrolera");

            switch ($componentsCount) {
                case 2: 
                    // www + controller
                    $this->action = 'index';
                    break;
                case 3:
                    // www + controller + method
                    $this->action = $components[2];
                    break;
                case 4:
                    // www + controller + action + method + argument
                    $this -> action = $components[2];
                    $this -> argument = $components[3];
                    break;
                default:

                    throw new Exception("Błędny adres URL");
            }

            $this->controller = new $controllerClass($this->action, $this->argument);
        }
        catch (Exception $e) {
            $this->action = 'error';
            $this->argument = $e->getMessage();
            $this->controller = new HomeController($this->action, $this->argument);
        }
    }
}