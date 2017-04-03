<?php

session_start();

//if(isset($_GET['function'])){
//
//    $controller = new questionController($_GET['function']);
//
//    $controller->determineFunction();
//}else{
//    echo "Error:" ;
//    die('ssssss');
//}


class LoginController
{
    private $function;

    public function __construct($function){

        $this->function = $function;
    }

    public function determineFunction(){
        switch ($this->function){

            case 'login':
                $this->login();
                break;
            case 'logout':
                $this->logout();
                break;
            case 'signup':
                $this->signup();
                break;
            default:
                http_response_code(404);
//                    echo $_SERVER['test'];
//                    include('/../view/404.html');// provide your own HTML for the error page
                header('location: view/404.php');
                die();
                break;

        }
    }

    private function login(){

        include_once('requests/user/GetUserLoginRequest.php');

        (new GetUserLoginRequest())->handle();


        include_once('middleware/CheckUserRole.php');

        if((new CheckUserRole())->isAdmin()){

            $_SESSION['admin'] = true;
            header("location: view/admin/questions/index.php?success");
        }else{
            header("location: view/user/index.php?success");
        }
    }

    private function logout(){

        session_destroy();

        header("location: view/login.php");
    }

    private function signup(){

        include_once('requests/user/CreateUserRequest.php');

        (new CreateUserRequest())->handle();

    }
}