<?php

class Meal
{
    public function getAll()
    {
        $db = Database::getInstance();
        $sql = "SELECT * from meals";
        $resultat = $db->read($sql);
        return $resultat;
    }
    public static function getByCategorie($code)
    {
        $data = array();
        $data['code'] = $code;
        $db = Database::getInstance();
        $sql = "SELECT * from meals where code_categorie = :code";
        $resultat = $db->read($sql, $data);
        return $resultat;

    }
    public static function getById($code)
    {
        $data = array();
        $data['code'] = $code;
        $db = Database::getInstance();
        $sql = "SELECT * from meals where id = :code";
        $resultat = $db->read($sql, $data);
        return $resultat;
    }
    public function getBySearch($find)
    {
        $db = Database::getInstance();
        $sql = "SELECT * from meals where name like '%" . $find . "%'";
        $resultat = $db->read($sql);
        return $resultat;

    }
    public function getByPrice($min, $max)
    {
        $db = Database::getInstance();
        $sql = "SELECT * from meals where price BETWEEN ' $min' AND  '$max' ";
        $resultat = $db->read($sql);
        return $resultat;

    }

}