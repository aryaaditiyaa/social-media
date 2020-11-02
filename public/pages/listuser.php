<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/post.php");

if (isset($session)) {
    $logged = $session->user_sudahlogin();
    if (!$logged) {
        redirect_ke("http://localhost/social-media/public/pages/login.php");
    }
}

$users = User::allUser();
?>

<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>

    <main role="main" class="container">
        <div class="row justify-content-center">
            <h2 class="my-4">List User</h2>
        </div>
        <div class="row justify-content-center">
            <?php foreach ($users as $user) : ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <img src="../images/<?php echo $user['photo'] ?>" class="card-img-top"
                             style="max-height: 200px; object-fit: cover; object-position: center">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $user['nama'] ?></h5>
                            <a href="../index.php?visiteduid=<?php echo $user['id'] ?>" class="btn btn-info mt-2">Kunjungi</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </main><!-- /.container -->
<?php require_once("../layouts/footer.php") ?>