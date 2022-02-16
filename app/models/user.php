<?php

class User

{

	private $error = "";
	public function signup($POST)
	{
		$db = Database::getInstance();
		$data = array();
		$data['fullName'] = trim($POST['fullName']);
		$data['email'] = trim($POST['email']);
		$data['password'] = trim($POST['password']);
		$password2 = trim($POST['password2']);
		if ($data['password'] !== $password2) {
			$this->error .= "Passwords do not match <br>";
		}
		if (strlen($data['password']) < 6) {
			$this->error .= "Password must be at least 6 caracters long <br>";
		}
		// check if email already exists
		$sql = "select * from users where email = :email limit 1";
		$arr['email'] = $data['email'];
		$check = $db->read($sql, $arr);
		if (is_array($check)) {
			$this->error .= "this email is already in use <br>";
		}
		if ($this->error == "") {
			//save to database
			$data['rank'] = "customer";
			$data['password'] = hash('sha1', $data['password']);
			$query = "insert into users (fullName,email,password,rank) values (:fullName,:email,:password,:rank)";
			$result = $db->write($query, $data);
			if ($result) {
				header("Location:" . ROOT . "login");
				die;
			}
		}
		$_SESSION['error'] = $this->error;
	}

	public function login($GET)
	{

		$db = Database::getInstance();
		$data = array();
		if (isset($GET['email1'])) {
			$data['email'] = trim($GET['email1']);
			$data['password'] = trim($GET['password1']);

			if ($this->error == "") {

				//confirm
				$data['password'] = hash('sha1', $data['password']);
				$sql = "select * from users where email = :email and password = :password limit 1";
				$check = $db->read($sql, $data);
				show($check);
				if (is_array($check)) {
					$_SESSION['user_id'] = $check[0]->id;
					if ($check[0]->rank == 'customer') {
						header("Location:" . ROOT . "home");
					}
					else {
						header("Location: http://localhost/projet/E-COMMERCE-ADMIN/public/index.html");
					}
					die;
				}

			}
			$_SESSION['error'] = $this->error;
		}
	}
	function check_logged_in()
	{
		if (isset($_SESSION['user_id'])) {

			return true;
		}
		return false;
	}
	function user_connected()
	{
		if (isset($_SESSION['user_id'])) {
			$db = Database::getInstance();
			$id = $_SESSION['user_id'];
			$sql = "select * from users where id = $id limit 1";
			$check = $db->read($sql);
			return $check[0];
		}
	}
	function logout()
	{
		unset($_SESSION['user_id']);
		header("Location:" . ROOT . "login");
		die;
	}
	public function getAll()
	{
		$db = Database::getInstance();
		$sql = "SELECT * from users";
		$resultat = $db->read($sql);
		return $resultat;
	}


}