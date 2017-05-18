<?php

session_start();

include(ROOT_DIR . '/middleware/CheckUserRole.php');
include_once(ROOT_DIR . "/util/csrf_token.php");


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

        include_once(ROOT_DIR . '/requests/user/GetUserLoginRequest.php');


        (new GetUserLoginRequest())->handle();


//        die(ROOT_DIR . '/middleware/CheckUserRole.php');

//        include_once(ROOT_DIR . '/middleware/CheckUserRole.php');

//        (new CheckUserRole())->isAdmin();

        if((new CheckUserRole())->isAdmin()){

            $_SESSION['admin'] = true;

            header("location: view/admin/questions/index.php?success");
        }else{

            $_SESSION['admin'] = false;

            header("location: view/user/index.php?success");
        }
    }

    private function logout(){

        if(!(new csrf_token())->checkToken()){
//            die('stop1');
//            header("location: ../view/create_question.php?token_error");
            exit;
        }

        session_destroy();

        header("location: view/login.php");
    }

    private function signup(){

        include_once(ROOT_DIR .'/requests/user/CreateUserRequest.php');

        (new CreateUserRequest())->handle();

    }
}