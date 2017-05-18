<?php

session_start();

class answerController
{
    private $function;

    public function __construct($function){

        $this->function = $function;
    }

    public function determineFunction() {

        switch ($this->function){

            case 'answer':
                $this->answer();
                break;
            case 'update':
                $this->update();
                break;
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


    public function answer() {
        include_once(ROOT_DIR.'/requests/answer/CreateAnswerRequest.php');
        (new CreateAnswerRequest())->handle();

//        echo "New record created successfully <br>";
        if(isset($_SESSION['admin'])){
            header("location:". JS. "/view/admin/answer/index.php?question=". $_POST['questionId'] ."&success");
        }else{
            header("location:". JS. "/view/user/answer_index.php?question=". $_POST['questionId'] ."&success");
        }
    }
}