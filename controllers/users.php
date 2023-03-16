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

    public function login()
    {
        $this->returnView('login');
    }

    public function authenticate()
    {
        $model = new User();

        if($model->login())
        {
            Messages::setMessage("Zalogowano", "success");
            $this->redirect('home');
        } else {
            Messages::setMessage("Nie udało się zalogować", "error");
            $this->redirect('users','login'); 
        }

    }

    public function logout()
    {
            unset($_SESSION['is_logged_in']);
            unset($_SESSION['user_data']);
            Messages::setMessage("Wylogoano","success");
            $this->redirect('home');
    }
}