<nav>
    <ul class="nav navbar-nav">
        <a class="navbar-brand brand" href="#">Justice League</a>
        <li><a href=""">Users</a></li>
        <li><a href=""">Questions</a></li>
        <li><a href="">Categories</a></li>
    </ul>



    <ul class="nav navbar-nav navbar-right">
        <li><div class="navigationUser">Hi <?php echo ucfirst($_SESSION['username']) ?></div></li>
        <li><a href="../../../routes.php?function=logout&origin=access">Sign out</a></li>
    </ul>
</nav>

