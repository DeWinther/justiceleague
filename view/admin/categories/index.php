<?php
session_start();

include('../../../config.php');

//Checks if user is logged in, otherwise redirect to login.
if (isset($_SESSION['username']) && $_SESSION['loggedin'] == true && $_SESSION['admin'] == true)
{
    // hmm
}
else
{
//    header("location: ". __DIR__."/justiceleague/view/login.php?auth");

    header("location: ../login.php?auth");
    exit;
}
include("../navigation.php");
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

<center><h1>Categories</h1></center>

<div class="container" style="margin-top: 30px">
    <table class="table table-bordered table-responsive table-hover">
        <thead>
        <th>Id</th>
        <th>Category</th>
        <th></th>
        </thead>

        <tbody>
        <?php

//        include('../../../model/category.php');
        require( ROOT_DIR.'/model/category.php' );

        $categories = (new category())->getCategories();
        if (!is_null($categories))
        {
            foreach ($categories as $category)
            {
                echo
                    '<tr>' .
                    '<td>' . $category["id"] . '</td>' .
                    '<td>' . $category["category"] . '</td>' .
                    '<form action="../../../controller/categoryController.php?function=delete" method="post">' .
                    '<td>' .
                    '<input type="hidden" name="to_delete" value="'. $category["id"] .'">' .
                    '<input type="hidden" name="return_to" value="categories">' .
                    '<button class="deleteButton"><i class="fa fa-trash-o"></i></button>' .
//                                    '<input class="btn btn-danger" type="submit" name="submit" value="Delete">' .
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
    <input class="standardButton marginTop" type="button" value="Create Category" onclick="location.href = 'create_category.php'">
</div>
