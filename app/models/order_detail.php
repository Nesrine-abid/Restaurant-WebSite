<?php

class Order_detail

{
    public function getAll()
    {
        $db = Database::getInstance();
        $sql = "SELECT * from order_details";
        $resultat = $db->read($sql);
        return $resultat;
    }
    public function Add($id_user, $price)
    {
        $data = array();
        $db = Database::getInstance();
        $data['id_meal'] = $_GET['id_meal'];
        $data['quantity'] = 1;
        $data['id_user'] = $id_user;
        $data['price'] = $price;
        $data['statut'] = "not_delivered";
        $query = "insert into order_details (id_user,id_meal,quantity,price,statut) values (:id_user,:id_meal,:quantity,:price,:statut)";
        $db->write($query, $data);
    }
    public function update($id_user, $quantity)
    {
        $data = array();
        $db = Database::getInstance();
        $data['id_meal'] = $_GET['id_meal'];
        $data['quantity'] = $quantity;
        $data['id_user'] = $id_user;
        $query = "UPDATE `order_details` SET `quantity` = :quantity WHERE `order_details`.`id_user` = :id_user and `order_details`.`id_meal` = :id_meal;";
        $db->write($query, $data);
    }

    public function modifyStatut($id_user,$id_meal)
    {
        $data = array();
        $db = Database::getInstance();
        $data['id_meal'] = $id_meal;
        $data['id_user'] = $id_user;
        $data['statut'] = "delivered";
        $query = "UPDATE `order_details` SET `statut` = :statut WHERE `order_details`.`id_user` = :id_user and `order_details`.`id_meal` = :id_meal;";
        $db->write($query, $data);
    }

    public function getById_user($id_user)
    {
        $data = array();
        $db = Database::getInstance();
        $data['id_user'] = $id_user;
        $data['statut'] = "not_delivered";
        $query = "select id_meal,quantity,price from order_details where id_user=:id_user and statut=:statut";
        $resultat = $db->read($query, $data);
        return $resultat;
    }

	public  function delete($id_user)
	{
        $data = array();
        $db = Database::getInstance();
        $data['id_meal'] = $_GET['id_meal'];
        $data['id_user'] = $id_user;
        $query = " DELETE FROM `order_details` WHERE `order_details`.`id_user` = :id_user and `order_details`.`id_meal` = :id_meal;";
        $db->write($query, $data);
	}
}

