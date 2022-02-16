<?php

class Categorie
{
    public function getAll()
    {
        $db = Database::getInstance();
        $sql = "SELECT * from categorie";
        $resultat = $db->read($sql);
        return $resultat;
    }
}