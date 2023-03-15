<?php

class ThreadsController extends Controller
{
    public function getName()
    {
        return 'threads';
    }

    public function Index()
    {
        $this->returnView('index');    
    }
    
}