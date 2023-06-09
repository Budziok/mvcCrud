<?php 

abstract class Controller {
    private $request;
    private $action;
    abstract function getName();

    public function __construct($action, $request = null)
    {
        $this->action = $action;
        $this->request = $request;
    }

    public function executeAction()
    {
        return $this->request = null ?
        $this->{$this->action}() : $this->{$this->action}($this->request) ;
    }

    protected function returnView($window, $model = null, $isChildView = true) {
		$view = 'views/'. $this->getName() . '/' . $window. '.php';
		if($isChildView){
			require('views/main.php');
		} else {
			require($view);
		}
	}
    
    protected function redirect($controller, $action=null)
    {
        $url = ROOT_URL . $controller;
        if (!empty($action))
            $url .= "/$action";
        header("Location:$url");
    }
}