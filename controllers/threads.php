<?php

class ThreadsController extends Controller
{
    public function index(){
		$model = new Thread();
		$this->returnView('index', $model->Index());
	}

	public function getName() {
		return 'threads';
	}

	public function create() {
		if(!isset($_SESSION['is_logged_in'])){
			header('Location: '.ROOT_URL.'threads');
		}
		$model = new Thread();

		if($model -> add())
		{
			Messages::setMessage('Dodano', 'success');
			$this->redirect('threads');
		} else {
			Messages::setMessage('Próba nie udana', 'error');
			$this->redirect('threads', 'add');
		}	
    }

	public function add() {
		if(!isset($_SESSION['is_logged_in'])){
			header('Location: '.ROOT_URL.'threads');
		}
		$this->returnView('add');
	}

	public function edit($id) {
		if(!isset($_SESSION['is_logged_in'])){
			header('Location: '.ROOT_URL.'threads');
		}
		$model = new Thread();
		$this->returnView('edit', $model->get($id));
	}
    
	public function change($id) {
		if(!isset($_SESSION['is_logged_in'])){
			header('Location: '.ROOT_URL.'threads');
		}
		$model = new Thread();
		if($model->change($id))
		{
			Messages::setMessage('Zmiany zakończone pomyślnie', 'success');
		} else {
			Messages::setMessage('Nieudana próba zmiany', 'error');
		}
		$this->redirect('threads');
	}

	public function remove($id) {
		if(!isset($_SESSION['is_logged_in'])){
			header('Location: '.ROOT_URL.'threads');
		}

		$model = new Thread();
		if($model->remove($id))
		{
			Messages::setMessage('Usunięto poprawnie', 'success');
		} else {
			Messages::setMessage('Nie usunięto', 'error');
		}
		$this->redirect('threads');
	}
}