<?php

session_start();

//if(isset($_GET['function'])){
//
//    $controller = new questionController($_GET['function']);
//
//    $controller->determineFunction();
//}else{
//    echo "Error:" ;
//    header("location: ../view/create_question.php?error");
//}
class questionController
{

    private $function;

    public function __construct($function){

        $this->function = $function;

//        $this->determineFunction();
    }

    public function determineFunction(){


        switch ($this->function){

            case 'create':
                    $this->create();
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

    private function create(){
        include_once(ROOT_DIR.'/requests/question/CreateQuestionRequest.php');
        (new CreateQuestionRequest())->handle();

//        echo "New record created successfully <br>";
        header("location:". JS. "/view/admin/questions/index.php?success");
    }

    private function update(){
        die('update');
    }

    private function delete(){

        include_once(ROOT_DIR.'/requests/question/DeleteQuestionRequest.php');
        (new DeleteQuestionRequest())->handle();

        echo "Record deleted successfully <br>";
        header("location:". JS ."/view/admin/questions/index.php?success");
    }

    private function getUsers(){

    }


}