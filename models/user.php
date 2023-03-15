<?php 

class User extends Model 
{
    public function register() {

		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if($post['submit']) {
			if($post['name'] == '' || $post['email'] == '' || $post['password'] == ''){
				Messages::setMessage('Proszę wypełnić wszystkie pola', 'error');
				return;
			}

			$password = password_hash($post['password'], PASSWORD_DEFAULT);

			$this->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
			$this->bind(':name', $post['name']);
			$this->bind(':email', $post['email']);
			$this->bind(':password', $password);
			$this->execute();
			
			if($this->lastInsertId()){
				return true;
			}
		}
		return false;
	}

    // public function login() {}
}