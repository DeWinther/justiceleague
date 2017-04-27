<?php

include(ROOT_DIR."/util/db.php");
include_once(ROOT_DIR . "/util/csrf_token.php");


class CreateQuestionRequest
{

    public function handle(){

        if(!(new csrf_token())->checkToken()){
            header("location: ../view/create_question.php?token_error");
            exit;
        }

        $this->checkInputs();

        $this->persist();


    }

    private function checkInputs(){
        if (isset($_POST["category"]) && isset($_POST["question"]) && $_POST["category"] != "0"){

        }else{
            echo "no data supplied <br>";
            header("location: ../view/create_question.php?error ");
        }

    }

    private function persist(){

        $conn = dbConnect("justice_league");

        //escaping SQL strings.
        $category = mysqli_real_escape_string($conn, $_POST["category"]);
        $question = mysqli_real_escape_string($conn, $_POST["question"]);
        $user_id = $_SESSION['user_id'];
        // should check CSRF token!
        // and prepared statement

        $stmt = $conn->prepare("INSERT INTO `question` (author_id, category, question) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user_id, $category, $question);

        if ($stmt->execute() != TRUE)
        {
            echo "Error: " . "<br>" . $conn->error;
            header("location: ../view/create_question.php?error");
        }
    }
}