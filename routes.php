<?php

/**
 * Created by IntelliJ IDEA.
 * User: DeWinther
 * Date: 4/1/2017
 * Time: 3:32 PM
 */


include('config.php');

if(isset($_GET['origin']) && isset($_GET['function'])){

    $routes = new routes($_GET['function'], $_GET['origin']);

    $routes->determineOrigin();
}else{
    echo "Error:" ;
    header("location: ". ROOT_DIR ."/view/create_question.php?error");
}

class routes
{

    private $function;

    private $origin;

    public function __construct($function, $origin){

        $this->function = $function;

        $this->origin = $origin;

    }

    public function determineOrigin(){

        switch ($this->origin){

            case 'access':
                $this->login();
                break;
            case 'question':
                $this->question();
                break;
            case 'category':
                $this->category();
                break;
            case 'users':
                $this->users();
                break;
            case 'answer':
                $this->answer();
                break;
            default:
                http_response_code(404);
                include('view/404.php'); // provide your own HTML for the error page
                die();
                break;

        }

    }

    private function login(){


        include_once('controller/LoginController.php');

        (new LoginController($this->function))->determineFunction();
    }

    private function question(){


        include_once(ROOT_DIR.'/controller/questionController.php');

        $question = new questionController($this->function);

        $question->determineFunction();
    }

    private function category(){

        include_once(ROOT_DIR.'/controller/categoryController.php');

        $category = new categoryController($this->function);

        $category->determineFunction();
    }

    private function users(){

        include_once(ROOT_DIR.'/controller/UserController.php');

        $users = new UserController($this->function);

        $users->determineFunction();
    }

    private function answer() {

        include_once(ROOT_DIR. '/controller/answerController.php');

        $answer = new answerController($this->function);
        $answer->determineFunction();
    }


}