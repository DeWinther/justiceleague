<?php

include("../util/db.php");

class CreateQuestionRequest
{

    public function handle(){

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

        $sql = "INSERT INTO `question` (author_id, category, question) VALUES ('$user_id', '$category', '$question')";
        if ($conn->query($sql) != TRUE)
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
            header("location: ../view/create_question.php?error");
        }
        $conn->close();
    }
}