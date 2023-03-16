<?php

class Thread extends Model
{
    public function Index() {
		$this->query('SELECT * FROM threads ORDER BY create_date DESC');
		$rows = $this->resultSet();
		return $rows;
	}
    
	public function get($id) {
		if(intval($id)>0) {
			$this->query('SELECT * FROM threads WEHERE user_id = :id');
			$this->bind('id', $id);
			return $this->single();
		}
		return null;
	}

	public function add()
	{
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if($post['submit'])
		{
			if($post['title'] == '' || $post['content'] == '')
			{
				Messages::setMessage('Proszę uzupełnić wszystkie pola', 'error');
				return;
			}

			$this->query('INSERT INTO threads (title, content, user_id) VALUES (:title, :content, :user_id)');
			$this->bind(':title', $post['title']);
			$this->bind(':content', $post['content']);
			$this->bind(':user_id', $_SESSION['user_data']['id']);
			$this->execute();

			if($this->lastInsertId()){
				return true;
			}
		}

		return false;

	}

	public function change($id)
	{
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if($post['submit']) {
			if($post['title'] == '' || $post['content'] == ''){
				Messages::setMessage('Proszę wypełnić wszystkie pola', 'error');
				return;
			}

			$this->query('UPDATE threads SET title = :title, content = :content WHERE id = :id AND user_id = :user_id;');
			$this->bind(':title', $post['title']);
			$this->bind(':content', $post['content']);
			$this->bind(':id', $id);
			$this->bind(':user_id', $_SESSION['user_data']['id']);
			$this->execute();
		
			if($this->rowCount() > 0){
				return true;
			}
		}
		return false;
	}

	public function remove($id)
	{
		if(intval($id) > 0) {
			
			$this->query('SELECT * FROM threads WHERE id = :id AND user_id = :user_id');
			$this->bind(':id', $id);
			$this->bind(':user_id', $_SESSION['user_data']['id']);

			$row = $this->single();

			if($row) {
				$this->query('DELETE FROM threads WHERE id = :id;');
				$this->bind(':id', $id);
				$this->execute();

				return true;
			}
		}

		return false;
	}
}