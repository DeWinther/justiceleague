<nav>
    <ul class="nav navbar-nav">
        <a class="navbar-brand brand" href="#">Justice League</a>
        <li><a href="../users/all_users.php">Users</a></li>
        <li><a href="../questions/index.php">Questions</a></li>
        <li><a href="#">Categories</a></li>
    </ul>



    <ul class="nav navbar-nav navbar-right">
        <li><div class="navigationUser">Hi <?php echo ucfirst($_SESSION['username']) ?></div></li>
        <li><a href="../../../logout.php">Sign out</a></li>
    </ul>
</nav>

