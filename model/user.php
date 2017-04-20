<?php

include(ROOT_DIR . "/util/db.php");

class user
{
    private $id;
    private $email;
    private $username;

    public function getAllUsers()
    {
        $instance = DbConnector::getInstance();
        $conn = $instance->getConnection();

        $sql = "SELECT id, username, email, password FROM `user`";
        $results = $conn->query($sql);

        foreach ($results as $result){
            $users[] = $result;
        }

        return $users;
    }
}