<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");

if (isset($_POST['save'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $loginuid = User::authenticate($email, $password);

    if ($loginuid) {
        $user = User::cari_dgn_id($loginuid);
        $session->login($loginuid);
        $session->nama($user['nama']);
        $pesan = "Welcome back " . $user['nama'];
        $session->pesan($pesan);
        redirect_ke("../");
    } else {
        $pesan = "Email atau password salah, ulangi kembali.";
        $session->pesan($pesan);
        redirect_ke("login.php");
    }
}
?>

<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>
    <main role="main" class="container">

        <?php echo cetak_pesan($pesan) ?>
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <h2 class="my-4">Please Login</h2>
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2" name="save">Submit</button>
                </form>
            </div>
        </div>

    </main><!-- /.container -->
<?php require_once("../layouts/footer.php") ?>