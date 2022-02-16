<?php

class Login extends Controller

{
	function index()
	{
		$user = $this->loadModel("User");
		if (isset($_POST['fullName'])) {
			$user->signup($_POST);
		}
		if (isset($_POST['email1'])) {
			$user->login($_POST);
		}
		if ($user->check_logged_in()) {
			$this->view("Restaurantly/index");
		}
		else {
			$this->view("Restaurantly/pages/login");
		}
	}
	function logout()
	{
		unset($_SESSION['user_id']);
		header("Location:" . ROOT . "login");
		die;
	}

}