<?php
session_start();

include('../../../config.php');

include_once(ROOT_DIR .'/util/csrf_token.php');
$token = (new csrf_token())->createToken();

//Checks if user is logged in, otherwise redirect to login.
if (isset($_SESSION['username']) && $_SESSION['loggedin'] == true && $_SESSION['admin'] == true)
{

}
else
{
    header("location: ". __DIR__."/view/login.php?auth");
    exit;
}
$questionId = 1;

include(ROOT_DIR ."/view/admin/navigation.php");
include_once(ROOT_DIR ."/model/answer.php");
$answer = (new answer())->getAnswerById($questionId);
//var_dump($answer);

include_once(ROOT_DIR ."/model/question.php");
$question = (new question())->getQuestionById($questionId);
//var_dump($question);

?>

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../css/iburn.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

<center><h1>Answer</h1></center>

<div class="container" style="margin-top: 30px">
    <table class="table table-bordered table-responsive table-hover">
        <thead>
        <th>Author</th>
        <th>Answer</th>
        <th>?</th>
        </thead>

        <tbody>


<?php

$test = new answer();

if (!is_null($answer))
{
    foreach ($answer as $answer)
    {
        echo
            '<tr>' .
            '<td>' . $test->getAuthor($answer["author_id"])  . '</td>' .
            '<td>' . $answer["answer"] . '</td> <br>' .
            '<td>' . '</td> <br>' .
            '<td><i class="fa fa-cogs"></i></td>' .
        //'<form action="../../../routes.php?function=delete&origin=question" method="post">'
        '<td>' .
        '<input type="hidden" name="to_delete" value="'. $answer["id"] .'">' .
        '<input type="hidden" name="return_to" value="answer">' .
        '<button class="deleteButton"><i class="fa fa-trash-o"></i></button>' .
        '</td>' .
        '</form>'.
        '</tr>';
    }
}
else
{
    echo "0 results";
}
?>
        </tbody>
    </table>
    <br>

<form action="../../../routes.php?function=answer&origin=answer" method="post">
    <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
    <input type="hidden" name="questionId" value="<?php echo $questionId; ?>">
<textarea class="form-control" rows="3" name="answer"></textarea>
    <input class="standardButton marginTop" type="submit" value="Submit">
</form>




