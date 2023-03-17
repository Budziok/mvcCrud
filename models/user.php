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
				$this->sendEmail($post['email']);
				return true;
			}
		}
		return false;
	}

    public function login() {
		
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		//$password = $this->hashPassword($post['password'], $post['email']);

		if($post['submit']) {

			$this->query('SELECT * FROM users WHERE email = :email');
			$this->bind(':email', $post['email']);
			
			$row = $this->single();

			if($row) {
				if (password_verify($post['password'], $row['password'])) {
					$_SESSION['is_logged_in'] = true;
					$_SESSION['user_data'] = array(
						"id"	=> $row['id'],
						"name"	=> $row['name'],
						"email"	=> $row['email']
					);
				return true;
				}
			}
		}
		return false;
	}

	private function sendEmail($email) {
		$mail = new PHPMailer(true); 
 		$mail->CharSet="UTF-8"; 
 		$mail->isSMTP(); 
 		$mail->Host = "smtp.emaillabs.net.pl";
 		$mail->SMTPAuth = true; 
 		$mail->Username = "xxxx.xxxx"; 
 		$mail->Password = "xxxxxx"; 
 		$mail->SMTPSecure = "ssl"; 
		$mail->Port = 465; 
 		$mail->From = "kbudzik224@gmail.com";
 		$mail->FromName = "Witaj na Forum";
 		$mail->addAddress($email);
 		$mail->isHTML(true);
 		$mail->Subject = "Witaj w gronie użytkowników";
 		$mail->Body = "<i>Witamy w gronie użytkowników</i>";
 		$mail->AltBody = "To jest alternatywna wersja maila.";
 		$mail->send();
	}
}