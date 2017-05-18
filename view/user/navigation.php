<?php

    include_once('../../config.php');
    include_once(ROOT_DIR .'/util/csrf_token.php');
    $token = (new csrf_token())->createToken();
?>

<nav>
    <ul class="nav navbar-nav">
        <a class="navbar-brand brand" href="index.php">Justice League</a>
        <li><a href="create_question.php">Create Question</a></li>
    </ul>



    <ul class="nav navbar-nav navbar-right">
        <li><div class="navigationUser">Hi <?php echo ucfirst($_SESSION['username']) ?></div></li>
        <li><form action="../../routes.php?function=logout&origin=access" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
                <input type="submit" value="Sign Out" class="signOutFormButton">
            </form></li>
    </ul>
</nav>
