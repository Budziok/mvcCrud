<?php

class HomeController extends Controller
{
    public function getName()
    {
        return 'home';
    }

    public function Index()
    {
        $model = new Home();
        $this->returnView('index');    
    }
    
}