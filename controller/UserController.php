<?php

session_start();

//include(ROOT_DIR . '/middleware/CheckUserRole.php');

class UserController
{
    private $function;

    public function __construct($function){

        $this->function = $function;
    }

    public function determineFunction(){
        switch ($this->function){

            case 'delete':
                $this->delete();
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

    private function delete(){
        include_once(ROOT_DIR . '/requests/user/DeleteUserRequest.php');

        (new DeleteUserRequest())->handle();

        header("location:". JS ."/view/admin/users/all_users.php?success");

    }
}