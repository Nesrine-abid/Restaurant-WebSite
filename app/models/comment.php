<?php

class Comment

{

    public function add_Comment($id_user)
    {
        $db = Database::getInstance();
        $data = array();
        if (isset($_GET['message'])) {
            $data['comment'] = $_GET['message'];
            $data['id_user'] = $id_user;
            $query = "insert into comments (id_user,comment) values (:id_user,:comment)";
            $resultat = $db->write($query, $data);
        }

    }

    public function getComments()
    {
        $db = Database::getInstance();
        $sql1 = "SELECT * from comments";
        $resultat1 = $db->read($sql1);

        if (count($resultat1) > 15) {
            $min = count($resultat1) - 15 + 1;
            $max = count($resultat1);
        }
        else {
            $min = 1;
            $max = count($resultat1);
        }

        $sql = "SELECT comment , fullName from comments , users where id_comment BETWEEN ' $min' AND  '$max' AND users.id = comments.id_user";
        $resultat = $db->read($sql);

        return $resultat;
    }







}