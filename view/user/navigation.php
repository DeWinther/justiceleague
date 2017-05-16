<?php include_once('../../config.php')?>

<nav>
    <ul class="nav navbar-nav">
        <a class="navbar-brand brand" href="index.php">Justice League</a>
        <li><a href="create_question.php">Create Question</a></li>
    </ul>



    <ul class="nav navbar-nav navbar-right">
        <li><div class="navigationUser">Hi <?php echo ucfirst($_SESSION['username']) ?></div></li>
        <li><a href="../../routes.php?function=logout&origin=access">Sign out</a></li>
    </ul>
</nav>
