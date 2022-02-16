<?php

class Home extends Controller

{
	function index()
	{
		$user = $this->loadModel("User");
		if ($user->check_logged_in()) {
			$data['logged_in'] = true;
		}
		//$id_user = $_SESSION['user_id'];
		$categorie = $this->loadModel("Categorie");
		$meal = $this->loadModel("Meal");
		$chef = $this->loadModel("Chef");
		$comment = $this->loadModel("Comment");
		$categories = $categorie->getAll();
		$meals = $meal->getAll();
		$chefs = $chef->getAll();
		$comments = $comment->getComments();
		$data['categorie'] = $categories;
		$data['meals'] = $meals;
		$data['chefs'] = $chefs;
		$data['comments'] = $comments;
		$data['page_title'] = "Restaurantly";
		$this->view("Restaurantly/index", $data);
	}
	public function all()
	{
		$meal = $this->loadModel("Meal");
		$meals = $meal->getAll();
		if (count($meals) > 0) {
			foreach ($meals as $meal) {
				echo '<div class="row menu-container" data-aos="fade-up" data-aos-delay="200">';
				echo '<div class="col-lg-6 menu-item filter-starters">';
				echo '<img src="' . $meal->image . '"class="menu-img" alt="">';
				echo '<div class="menu-content">';
				echo '<a href="menu">' . $meal->name . '</a><span> ' . $meal->price . '</span>';
				echo '</div>';
				echo '<div class="menu-ingredients">';
				echo $meal->description;
				echo '</div>';
				echo '</div>';
				echo '</div>';
			}
		}
		else {
			echo '<div class="row menu-container" data-aos="fade-up" data-aos-delay="200">';
			echo '<div class="col-lg-6 menu-item filter-starters">';
			echo '</div>';
			echo '</div>';
		}
	}
	public function addToCart()
	{
		$order_detail = $this->loadModel("Order_detail");
		$id_user = $_SESSION['user_id'];
		//$orders_details = $order_detail->getAll();
		//$data['orders_details'] = $orders_details;
		$user_orders = $order_detail->getById_user($id_user);
		$update = false;
		foreach ($user_orders as $order) {
			if (($order->id_meal == $_GET['id_meal'])) {
				$quantity = $order->quantity +1;
				$order_detail->update($id_user, $quantity);
				$update = true;
			}
		}
		if ($update == false) {
			$meal = $this->loadModel("Meal");
			$data['meal'] = $meal->getById($_GET['id_meal']);
			$order_detail->add($id_user, $data['meal'][0]->price);
		}
	}
	public function search()
	{

		if (isset($_GET['find'])) {
			$find = $_GET['find'];
			$meal = $this->loadModel("Meal");
			$searched_meals = $meal->getBySearch($find);
			echo '<br>';
			if (count($searched_meals) > 0) {
				foreach ($searched_meals as $meal) {
					echo '<div class="col-lg-6  ">';
					echo '<img src="' . $meal->image . '"class="menu-img" 
				style="width: 80px;border-radius: 50%;float: left;margin-right:20px;margin-bottom:60px;border: 3px solid rgba(255, 255, 255, 0.2);"
				alt="">';
					echo '<div class="menu-content">';
					echo '<a href="#menu">' . $meal->name . '</a><span> ' . $meal->price . ' € </span>';
					echo '</div>';
					echo '<div class="menu-ingredients">';
					echo $meal->description;
					echo '</div>';
					echo '<br>';
					echo '<div>';
					echo ' <a href="#menu" onclick="add(' . $meal->id . ')" class="book-a-table-btn scrollto "><img
					src="ASSETS/img/panier.png" style="width:45px; height:30px ;padding-right:20px"
					alt="">Add to
                        cart</a>';
					echo '<br><br>';
					echo '</div>';
					echo '</div>';
				}
			}

		}
	}
	public function filterByPrice()
	{
		if ((isset($_GET['min'])) && (isset($_GET['max']))) {
			$min = $_GET['min'];
			$max = $_GET['max'];
			$meal = $this->loadModel("Meal");
			$price_between_meals = $meal->getByPrice($min, $max);
			echo '<br>';
			if (count($price_between_meals) > 0) {
				foreach ($price_between_meals as $meal) {
					echo '<div class="col-lg-6  ">';
					echo '<img src="' . $meal->image . '"class="menu-img" 
							style="width: 80px;border-radius: 50%;float: left;margin-right:20px;margin-bottom:60px;border: 3px solid rgba(255, 255, 255, 0.2);"
							alt="">';
					echo '<div class="menu-content">';
					echo '<a href="#menu">' . $meal->name . '</a><span> ' . $meal->price . ' € </span>';
					echo '</div>';
					echo '<div class="menu-ingredients">';
					echo $meal->description;
					echo '</div>';
					echo '<br>';
					echo '<div>';
					echo ' <a href="#menu" onclick="add(' . $meal->id . ')" class="book-a-table-btn scrollto "><img
					src="ASSETS/img/panier.png" style="width:45px; height:30px ;padding-right:20px"
					alt="">Add to
									cart</a>';
					echo '<br><br>';
					echo '</div>';
					echo '</div>';
				}
			}
			else {
				echo 'Sorry No meals found ';
			}

		}
	}



	public function filterByCategorie()
	{
		$code = $_GET['code'];
		$meal = $this->loadModel("Meal");
		$meals = $meal->getByCategorie($code);
		if ($code == 0) {
			$meals = $meal->getAll();
			echo '<br>';
			if (count($meals) > 0) {
				foreach ($meals as $meal) {
					echo '<div class="col-lg-6 ">';
					echo '<img src="' . $meal->image . '"class="menu-img"                     
					style="width: 80px;border-radius: 50%;float: left;margin-right:20px;margin-bottom:60px;border: 3px solid rgba(255, 255, 255, 0.2);"
					alt="">';
					echo '<div class="menu-content">';
					echo '<a href="#menu">' . $meal->name . '</a><span> ' . $meal->price . ' €</span>';
					echo '</div>';
					echo '<div class="menu-ingredients">';
					echo $meal->description;
					echo '</div>';
					echo '<br>';
					echo '<div>';
					echo ' <a href="#menu" onclick="add(' . $meal->id . ')" class="book-a-table-btn scrollto "><img
					src="ASSETS/img/panier.png" style="width:45px; height:30px ;padding-right:20px"
					alt="">Add to
							cart</a>';
					echo '<br><br>';
					echo '</div>';
					echo '</div>';

				}
			}
		}
		if (count($meals) > 0) {
			echo '<br>';
			foreach ($meals as $meal) {
				echo '<div class="col-lg-6  ">';
				echo '<img src="' . $meal->image . '"class="menu-img" 
				style="width: 80px;border-radius: 50%;float: left;margin-right:20px;margin-bottom:60px;border: 3px solid rgba(255, 255, 255, 0.2);"
				alt="">';
				echo '<div class="menu-content">';
				echo '<a href="#menu">' . $meal->name . '</a><span> ' . $meal->price . ' € </span>';
				echo '</div>';
				echo '<div class="menu-ingredients">';
				echo $meal->description;
				echo '</div>';
				echo '<br>';
				echo '<div>';
				echo ' <a href="#menu" onclick="add(' . $meal->id . ')" class="book-a-table-btn scrollto "><img
				src="ASSETS/img/panier.png" style="width:45px; height:30px ;padding-right:20px"
				alt="">Add to
                        cart</a>';
				echo '<br><br>';
				echo '</div>';
				echo '</div>';
			}
			echo '<br><br><br>';

		}
		else {
			echo '<div class="row menu-container" data-aos="fade-up" data-aos-delay="200">';
			echo '<div class="col-lg-6 menu-item filter-starters">';
			echo '</div>';
			echo '</div>';

		}
	}

	public function comment()
	{
		$id_user = $_SESSION['user_id'];
		$comment = $this->loadModel("Comment");

		if (isset($_GET['message'])) {
			$comment->add_Comment($id_user);

			echo '<div style="text-align: center;"><br><p style="font-size:12px; color:white;">Thank you for your feedback</p></div>';

		}


	}
    public function signIn()
    {
        if (isset($_GET['message'])) {
            echo '<div style="text-align: center;"><br><p style="font-size:12px; color:white;">You need to sign in to send your feedback !</p></div>';
        }
    }

}
