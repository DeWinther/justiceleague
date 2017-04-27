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

        if(!isset($_SESSION['csrf_token'])){
            $_SESSION['csrf_token'] = $token;
            return $token;
        }else{
            return $_SESSION['csrf_token'];
        }


    }

    public function checkToken(){
        if(isset($_POST['csrf_token'])){
            if($_SESSION['csrf_token'] == $_POST['csrf_token']) return true;
            else{
                return false;
            }
        }
        elseif (isset($_GET['csrf_token'])){
//            die($_SESSION['csrf_token']);
            if($_SESSION['csrf_token'] == $_GET['csrf_token']) return true;
            else{
                return false;
            }
        }else{
            die('test');
            return false;
        }
    }
}