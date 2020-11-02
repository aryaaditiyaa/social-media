<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");

$photo_ok = false;
$photo = '';

if (isset($_POST['save'])) {
    $user = new User;
    $file = $_FILES['photo']['name'];

    if (!empty($file)) {
        $type = $_FILES['photo']['type'];
        $photo_ok = typeGambar($type);
        $size = $_FILES['photo']['size'];
        if ($photo_ok && ($size <= 2000000)) {
            $photo = create_image("photo");
        }
    }

    $user->nama = $_POST['nama'];
    $user->namabelakang = $_POST['namabelakang'];
    $user->photo = $photo;
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    $hasil = $user->create();

    if ($hasil) {
        $session->login($hasil);
        $session->nama($user->nama);
        $pesan = "Hi, " . $user->nama . " Welcome.";
        $session->pesan($pesan);
        redirect_ke("http://localhost/social-media/public/");
    } else {
        redirect_ke("http://localhost/social-media/public/pages/register.php");
    }
}

?>

<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>

    <main role="main" class="container">

        <div class="row justify-content-center">
            <div class="col-lg-4">
                <h2 class="my-4">Register Yourself</h2>
                <form action="register.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Belakang</label>
                        <input type="text" class="form-control" name="namabelakang" required>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" class="form-control" name="photo">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-info mt-2" name="save">Register</button>
                </form>
            </div>
        </div>

    </main><!-- /.container -->
<?php require_once("../layouts/footer.php") ?>