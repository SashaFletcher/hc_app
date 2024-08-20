<ul class="nav justify-content-end">
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Hi, <?php echo $user->_get()->firstname; ?></a>
    <div class="dropdown-menu dropdown-menu-right bg-dark">
        <a class="dropdown-item bg-dark" href="/settings">Account Settings</a>
        <a class="dropdown-item bg-dark" href="?signout">Sign Out</a>
    </div>
</li>
</ul>