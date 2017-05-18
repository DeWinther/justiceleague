<?php

include(ROOT_DIR."/util/db.php");
include_once(ROOT_DIR . '/util/inputCleaner.php');
include_once(ROOT_DIR . "/util/csrf_token.php");


class CreateQuestionRequest
{

    public function handle(){

        if(!(new csrf_token())->checkToken()){
            header("location: ../view/create_question.php?token_error");
            exit;
        }

        $instance = DbConnector::getInstance();
        $this->conn = $instance->getConnection();

        $this->checkInputs();

        $this->persist();

    }

    private function checkInputs()
    {
        if (isset($_POST["category"]) && isset($_POST["question"]) && $_POST["category"] != "0")
        {
            $_POST['question'] = cleanInput($_POST['question']);
            //If special chars was detected
            if($_POST['question'] == 'hell-no')
            {
                $_SESSION['msg'] = 'Input contained illegal characters';
                header("location:". JS. "/view/user/index.php");
                exit;
            }

        }else
            {
            echo "no data supplied <br>";
            header("location: ../view/create_question.php?error ");
        }

    }

    private function persist(){
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png'){

        }else{
            $_SESSION['msg'] = 'Image must be in format jpg, jpeg or png';
            if($_SESSION['admin'] == true){
                header("location:". JS. "/view/admin/question/create_question.php");
                exit;

            }else{
                header("location:". JS. "/view/user/create_question.php");
                exit;
            }

        }

        $customName = time() * 60 .'.' . $ext;

        $uploaddir =  ROOT_DIR . '/images/questions/';

        $uploadfile = $uploaddir . $customName;

        move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);


        //escaping SQL strings.
        $category = mysqli_real_escape_string($this->conn, $_POST["category"]);
        $question = mysqli_real_escape_string($this->conn, $_POST["question"]);

        $user_id = $_SESSION['user_id'];
        $filename = $customName;

        $stmt = $this->conn->prepare("INSERT INTO `question` (author_id, category, question, filename) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $user_id, $category, $question, $filename);

        if ($stmt->execute() != TRUE)
        {
            echo "Error: " . "<br>" . $this->conn->error;
            header("location: ../view/create_question.php?error");
        }
    }
}