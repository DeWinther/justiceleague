<?php

session_start();

//if(isset($_GET['function']))
//{
//    $controller = new categoryController($_GET['function']);
//    $controller->determineFunction();
//}
//else
//{
//    echo "Error:" ;
//    header("location: ../view/create_question.php?error");
//}

class categoryController
{
    private $function;

    public function __construct($function = null)
    {
        $this->function = $function;
    }

    public function determineFunction()
    {
        switch ($this->function)
        {
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
                break;
            default:
                echo "Error: no CRUD function" ;
                header("location: ../view/create_category.php?error");
                break;
        }
    }

    private function create()
    {
        include_once(ROOT_DIR .'/requests/category/CreateCategoryRequest.php');
        (new CreateCategoryRequest())->handle();

        echo "New record created successfully <br>";
        header("location:". JS ."/view/admin/categories/index.php?success");
    }

    private function update()
    {
        die('update');
    }

    private function delete()
    {
        include_once(ROOT_DIR .'/requests/category/DeleteCategoryRequest.php');
        (new DeleteCategoryRequest())->handle();

        echo "Record deleted successfully <br>";
        header("location:". JS ."/view/admin/categories/index.php?success");
    }

    private function getUsers()
    {

    }

}