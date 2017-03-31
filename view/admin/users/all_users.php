<?php
session_start();

//Checks if user is logged in, otherwise redirect to login.
if (isset($_SESSION['username']) && $_SESSION['loggedin'] == true)
{
    //..
}
else {
    header("location: login.php?auth");
    exit;
}
include("../../navigation.php");
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

<center><h1>Users</h1></center>
<div class="container" style="margin-top: 30px">
    <form action="../../../util/delete_row.php" method="post">
        <table class="table table-bordered table-responsive table-hover">
            <thead>
                <th>Id</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th></th>
            </thead>

            <tbody>
                <?php
                    include("../../../util/db.php");
                    $conn = dbConnect("justice_league");

                    $sql = "SELECT id, username, email, password FROM `user`";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc())
                        {
                            echo
                                '<tr>' .
                                    '<td>' . $row["id"] . '</td>' .
                                    '<td>' . $row["username"] . '</td>' .
                                    '<td>' . $row["email"] . '</td>' .
                                    '<td>' . $row["password"] . '</td>' .
                                    '<td>' .
                                        '<input type="hidden" name="to_delete" value="'. $row["id"] .'">' .
                                        '<input type="hidden" name="return_to" value="user">' .
                                        '<button class="deleteButton"><i class="fa fa-trash-o"></i></button>' .
                                    '</td>' .
                                '</tr>';
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
</div>

<?php
//    $id = 11;
//    if($_GET["id"]==12)
//    {
//        include 'index.php';
//    }
//    else if($_GET["id"]==11)
//    {
//        include 'signup.php';
//    }
//?>
<!---->
<!--<a href="?id=11">My Link is Awesome</a>-->
<!--<a href="?id=12">My Link is Awesome</a>-->

</body>
</html>



