<?php
session_start();

//Checks if user is logged in, otherwise redirect to login.
if (isset($_SESSION['username']) && $_SESSION['loggedin'] == true)
{
  // hmm
}
else
{
    header("location: login.php?auth");
    exit;
}
include("../nav_bar.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/iburn.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container" style="margin-top: 30px">
    <form action='../util/delete_row.php' method="post">
        <table class="table table-bordered table-responsive table-hover">
            <thead>
            <th>Id</th>
            <th>Author Id</th>
            <th>Category</th>
            <th>Question</th>
            </thead>

            <tbody>
            <?php
            include("../util/db.php");
            $conn = dbConnect("justice_league");

            $sql = "SELECT id, author_id, category, question FROM `question`";
            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {
                while ($row = $result->fetch_assoc())
                {
                    $btnId = $row["id"];
                    echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["author_id"] . "</td>
                        <td>" . $row["category"] . "</td>
                        <td>" . $row["question"] . "</td>
                        <td>
                            <input type=\"hidden\" name=\"to_delete\" value=\"$btnId\">
                            <input type=\"hidden\" name=\"return_to\" value=\"question\">
                            <input class=\"btn btn-danger\" type=\"submit\" name=\"submit\" value=\"Delete\">
                        </td>            
                    </tr>";
                }
            }
            else {
                echo "0 results";
            }
            $conn->close();
            ?>
            </tbody>
        </table>
    </form>
    <input class="btn btn-info" value="Create Question" onclick="location.href = 'create_question.php'">
</div>