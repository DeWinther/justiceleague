<?php

session_start();

if(isset($_GET['function'])){

    $controller = new questionController($_GET['function']);

    $controller->determineFunction();
}else{
    echo "Error:" ;
    header("location: ../view/create_question.php?error");
}
class questionController
{

    private $function;

    public function __construct($function = null){

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
            case 'getUsers':
                    $this->getUsers();
            default:
                    echo "Error:fdsfdsfsd" ;
                    header("location: ../view/create_question.php?error");
                break;

        }

    }

    private function create(){
        include_once('../requests/CreateQuestionRequest.php');
        (new CreateQuestionRequest())->handle();

        echo "New record created successfully <br>";
        header("location: ../view/admin/questions/index.php?success");
    }

    private function update(){
        die('update');
    }

    private function delete(){

        include_once('../requests/DeleteQuestionRequest.php');
        (new DeleteQuestionRequest())->handle();

        echo "Record deleted successfully <br>";
        header("location: ../view/admin/questions/index.php?success");
    }

    private function getUsers(){

    }


}