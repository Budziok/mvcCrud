<?php 

class UsersController extends Controller 
{
    public function getName()
    {
        return 'users';
    }

    public function register()
    {
        $this->returnView('register');
    }

    public function createAccount()
    {
        $model = new User();
        
        if($model->register())
        {
            Messages::setMessage("Konto zostało utworzone", "success");
            $this->redirect('users', 'login');
        } else {
            Messages::setMessage("Nie udało się utworzyć konta", "error");
            $this->redirect('users', 'register');
        }

    }
}