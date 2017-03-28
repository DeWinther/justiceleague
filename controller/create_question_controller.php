<?php
session_start();
include("../util/db.php");

if (isset($_POST["category"]) && isset($_POST["question"]) && $_POST["category"] != "0")
{
    $conn = dbConnect("justice_league");

    //escaping SQL strings.
    $category = mysqli_real_escape_string($conn, $_POST["category"]);
    $question = mysqli_real_escape_string($conn, $_POST["question"]);
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO `question` (author_id, category, question) VALUES ('$user_id', '$category', '$question')";
    if ($conn->query($sql) === TRUE)
    {
        echo "New record created successfully <br>";
        header("location: ../view/all_questions.php?success");
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
        header("location: ../view/create_question.php?error");
    }
    $conn->close();
}
else
{
    echo "no data supplied <br>";
    header("location: ../view/create_question.php?error ");
}
?>
