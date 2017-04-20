<?php

//include('../config.php');
//include(ROOT_DIR . "/util/db.php");

class CheckUserRole
{

    function isAdmin(){

        $instance = DbConnector::getInstance();
        $conn = $instance->getConnection();
//
        $id = $_SESSION['user_id'];

        $sql = "SELECT * FROM `roles` WHERE user_id ='$id'";

        $result = $conn->query($sql);


        $role = $result->fetch_array();

        if(is_null($role)){
            return false;
        }
        if($role['role'] == 'admin'){
            return true;
        }

        return false;
    }

}

?>