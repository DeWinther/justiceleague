<?php

if(isset($_GET['function'])){

    $controller = new questionController($_GET['function']);

    $controller->determineFunction();
}else{
    echo "Error:" ;
    die('ssssss');
}

class LoginController
{

}