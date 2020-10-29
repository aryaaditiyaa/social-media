<?php

$logged = false;
$nama = '';
if (isset($session)) {
    $logged = $session->user_sudahlogin();
    $nama = $session->nama();
}

?>
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top py-2">
    <div class="container">
        <a class="navbar-brand" href="http://localhost/paw-tugas-uts/public">Social Media</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav m-auto">
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/social-media/public/">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">
                        User
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">
                        Post
                    </a>
                </li>
            </ul>
            <div class="navbar-nav">
                <?php if (!$logged) : ?>
                    <a href="http://localhost/social-media/public/pages/login.php"
                       class="btn btn-outline-success my-2 my-sm-0">Login</a>
                    <a href="http://localhost/social-media/public/pages/register.php"
                       class="btn btn-success my-2 my-sm-0 ml-2">Register</a>
                <?php endif ?>
                <?php if ($logged) : ?>
                    <a class="nav-link">Hi <?php echo $nama ?></a>
                    <a href="http://localhost/social-media/public/pages/logout.php"
                       class="btn btn-outline-danger my-2 my-sm-0 ml-2">Logout</a>
                <?php endif ?>
            </div>
        </div>
    </div>
</nav>