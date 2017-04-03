<?php

//include('/util/db.php');



class CheckUserRole
{

    function isAdmin(){

        $conn = dbConnect("justice_league");

        $id = $_SESSION['user_id'];


        $sql = "SELECT * FROM `roles` WHERE user_id =".$_SESSION['user_id'];

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