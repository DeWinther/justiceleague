<?php
session_start();

include('../../config.php');

//Checks if user is logged in, otherwise redirect to login.
if (isset($_SESSION['username']) && $_SESSION['loggedin'] == true && !isset($_SESSION['admin']))
{
    // hmm
}
else
{
    header("location: ../login.php?auth");
    exit;
}
include(ROOT_DIR ."/view/user/navigation.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/iburn.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

<center><h1>Questions</h1></center>

<div class="container" style="margin-top: 30px">
    <table class="table table-bordered table-responsive table-hover">
        <thead>
        <th>Author</th>
        <th>Category</th>
        <th>Question</th>
        </thead>

        <tbody>
        <?php

        include(ROOT_DIR .'/model/question.php');

        $questions = (new question())->getQuestions();
        $test = new question();
        if (!is_null($questions)) {
            foreach ($questions as $question){

                echo
                    '<tr>' .
                    '<td>' . $test->getAuthor($question["author_id"])  . '</td>' .
                    '<td>' . $question["category"] . '</td>' .
                    '<td>' . $question["question"] . '</td>' .
                    '</tr>';
            }
        }
        else {
            echo "0 results";
        }



        ?>
        </tbody>
    </table>
    <input class="standardButton marginTop" type="button" value="Create Question" onclick="location.href = 'create_question.php'">
</div>