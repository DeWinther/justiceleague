<?php

/**
 * Created by IntelliJ IDEA.
 * User: DeWinther
 * Date: 27/04/2017
 * Time: 14.05
 */
class csrf_token
{


    public function createToken(){
        $token = md5(uniqid(rand(), true));

        $_SESSION['csrf_token'] = $token;

        return $token;
    }

    public function checkToken(){
        if($_SESSION['csrf_token'] == $_POST['csrf_token']) return true;
        else{
            return false;
        }

    }
}