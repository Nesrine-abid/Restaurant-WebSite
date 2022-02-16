<?php

class Orders

{
    public function getAll()
    {
        $db = Database::getInstance();
        $sql = "SELECT * from orders";
        $resultat = $db->read($sql);
        return $resultat;
    }
    public function Add($id_user, $total,$delivery_adress)
    {
        $data = array();
        $db = Database::getInstance();
        $data['id_order'] = null;
        $data['id_user'] = $id_user;
        $data['delivery_adress'] = $delivery_adress;
        $data['status'] = 'en attente';
        $data['total_order'] = $total;
        $query = "insert into orders (id_order,id_user,date_order,delivery_adress,status,total_order) values (:id_order,:id_user,Sysdate(),:delivery_adress,:status,:total_order)";
        $db->write($query, $data);
    }
}