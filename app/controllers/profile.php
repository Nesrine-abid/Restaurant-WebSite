<?php

use function PHPSTORM_META\type;

class Profile extends Controller

{
	function index()
	{
		$user = $this->loadModel("User");
		$meal = $this->loadModel("meal");
		$order_detail = $this->loadModel("Order_detail");
		$id_user = $_SESSION['user_id'];
		$data = array();
		$user_orders = $order_detail->getById_user($id_user);
		foreach ($user_orders as $order) {
			$informationMeal = $meal->getById($order->id_meal);
			$order->name = $informationMeal[0]->name;
			$order->image = $informationMeal[0]->image;
			$data[$order->id_meal] = $order;
		}
		if ($user->check_logged_in()) {
			$data['user'] = $user->user_connected();
			$this->view("Restaurantly/profile", $data);
		}
	}
	public function increaseQuantityMeal()
	{
		$order_detail = $this->loadModel("Order_detail");
		$id_user = $_SESSION['user_id'];
		$user_orders = $order_detail->getById_user($id_user);
		foreach ($user_orders as $order) {
			if (($order->id_meal == $_GET['id_meal'])) {
				$quantity = $order->quantity + 1;
				$price = $order->price;
				$order_detail->update($id_user, $quantity);
			}
		}
		$data = array();
		$data['quantity'] = $quantity;
		$data['total'] = $quantity * $price;
		$data['numberMeals'] = sizeof($user_orders);
		print json_encode($data);
	}
	public function decreaseQuantityMeal()
	{
		$order_detail = $this->loadModel("Order_detail");
		$id_user = $_SESSION['user_id'];
		$user_orders = $order_detail->getById_user($id_user);
		foreach ($user_orders as $order) {
			if (($order->id_meal == $_GET['id_meal'])) {
				$quantity = $order->quantity - 1;
				$price = $order->price;
				$order_detail->update($id_user, $quantity);
			}
		}
		$data = array();
		$data['quantity'] = $quantity;
		$data['total'] = $quantity * $price;
		$data['numberMeals'] = sizeof($user_orders);
		print json_encode($data);
	}


	public function removeMeal()
	{
		$order_detail = $this->loadModel("Order_detail");
		$id_user = $_SESSION['user_id'];
		$user_orders = $order_detail->getById_user($id_user);
		foreach ($user_orders as $order) {
			if (($order->id_meal == $_GET['id_meal'])) {
				$order_detail->delete($id_user);

			}
		}
		$data = sizeof($user_orders) - 1;
		print json_encode($data);
	}

	public function submit()
	{
		$order_detail = $this->loadModel("Order_detail");
		$orders = $this->loadModel("Orders");
		$id_user = $_SESSION['user_id'];
		$delivery_adress = $_GET['addresse'];
		$totalOrder = 0;
		$user_orders = $order_detail->getById_user($id_user);
		foreach ($user_orders as $order) {
			$totalOrder += $order->price * $order->quantity;
			$id_meal = $order->id_meal;
			$order_detail->modifyStatut($id_user, $id_meal);
		}
		$orders->add($id_user, $totalOrder, $delivery_adress);
		$data = sizeof($user_orders);
		print json_encode($data);

	}

	function logout()
	{
		unset($_SESSION['user_id']);
		header("Location:" . ROOT . "login");
		die;
	}
}