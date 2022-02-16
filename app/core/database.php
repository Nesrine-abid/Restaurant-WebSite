<?php

class Database
{
	public static $con = null;
	private $conn;
	public function __construct()
	{
		try {
			$string = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";";
			$this->conn = new PDO($string, DB_USER, DB_PASS);

		}
		catch (PDOExecption $e) {

			die($e->getMessage());
		}
	}
	public function connect()
	{
		return $this->conn;
	}

	public static function getInstance()
	{
		if (self::$con) {
			return self::$con;
		}
		return $instance = new self();
	}


	public function read($query, $data = [])
	{
		$array = array();

		$stm = $this->conn->prepare($query);
		$result = $stm->execute($data);
		if ($result) {
			$data = $stm->fetchAll(PDO::FETCH_OBJ);
			if (is_array($data) && count($data) > 0) {
				return $data;
			}
		}
		return $array;
	}

	// not expecting any data like delete 
	public function write($query, $data = [])
	{
		$stm = $this->conn->prepare($query);
		$result = $stm->execute($data);
		if ($result) {
			return true;
		}
		return false;
	}


}

/*$db = Database::getInstance(); $data = array(); $resultat = $db->read("SELECT comment , fullName from comments , users where  users.id = comments.id_user");
 
$data['filtered_cat'] = $resultat; show($data['filtered_cat']);*/