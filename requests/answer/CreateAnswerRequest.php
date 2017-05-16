<?php

include(ROOT_DIR . "/util/db.php");
include_once(ROOT_DIR . '/util/inputCleaner.php');
include_once(ROOT_DIR . "/util/csrf_token.php");

class CreateAnswerRequest
{
    private $conn;

    public function handle()
    {
        if(!(new csrf_token())->checkToken()){
            header("location: ../view/answer_question.php?token_error");
            exit;
        }

        $instance = DbConnector::getInstance();
        $this->conn = $instance->getConnection();

        $this->checkInputs();
        $this->persist();
    }

    private function checkInputs(){

        if (isset($_POST["answer"]))
        {
            $_POST['answer'] = cleanInput($_POST['answer']);
            //If special chars was detected
            if($_POST['answer'] == 'hell-no')
            {
                $_SESSION['msg'] = 'Input contained illegal characters';
                header("location:". JS. "/view/user/answer_index.php?question=". $_POST['questionId']);
                exit;
            }
        }
        else
        {
            echo "no data supplied <br>";
            header("location: ../view/answer_question.php?error ");
        }
    }

    private function persist(){

        //escaping SQL strings.
        $answer = mysqli_real_escape_string($this->conn, $_POST["answer"]);

        $question_id = $_POST["questionId"];
        $user_id = $_SESSION['user_id'];
        // should check CSRF token!

        $stmt = $this->conn->prepare("INSERT INTO `answer` (question_id, answer, user_id) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $question_id, $answer, $user_id);

        if ($stmt->execute() != TRUE)
        {
            echo "Error: " . "<br>" . $this->conn->error;
            header("location: ../view/admin/answer/index.php?error");
        }
    }
}