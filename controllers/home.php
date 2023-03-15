<?php

class HomeController extends Controller
{
    public function getName()
    {
        return 'home';
    }

    public function index()
    {
        $model = new Home();
        $this->returnView('index',$model->index());
    }
}