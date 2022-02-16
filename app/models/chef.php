<?php

class Chef
{
    public function getAll()
    {
        $db = Database::getInstance();
        $sql = "SELECT * from chefs";
        $resultat = $db->read($sql);
        return $resultat;
    }



}