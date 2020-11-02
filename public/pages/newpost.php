<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/post.php");

$photo_ok = false;
$photo = '';
$logged = 0;

if (isset($session)) {
    $logged = $session->user_sudahlogin();
    if (!$logged) {
        redirect_ke("http://localhost/social-media/public/pages/login.php");
    }
}

if (isset($_POST['save'])) {
    $post = new Post;
    $file = $_FILES['photo']['name'];

    if (!empty($file)) {
        $type = $_FILES['photo']['type'];
        $photo_ok = typeGambar($type);
        $size = $_FILES['photo']['size'];
        if ($photo_ok && ($size <= 2000000)) {
            $photo = create_image("photo");
        }
    }

    $post->user_id = $logged;
    $post->keterangan = $_POST['keterangan'];
    $post->photo = $photo;
    $hasil = $post->create();

    if ($hasil) {
        $pesan = "Post Anda berhasil ditambah ke timeline.";
        $session->pesan($pesan);
        redirect_ke("http://localhost/social-media/public/");
    } else {
        redirect_ke("http://localhost/social-media/public/pages/newpost.php");
    }
}

?>

<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>

    <main role="main" class="container">

        <div class="row justify-content-center">
            <div class="col-lg-4">
                <h2 class="my-4">Make New Post</h2>
                <form action="newpost.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" class="form-control-file" name="photo">
                    </div>
                    <div class="form-group">
                        <label>Keterangan/Caption</label>
                        <textarea class="form-control" name="keterangan" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-info mt-2" name="save">Post</button>
                </form>
            </div>
        </div>

    </main><!-- /.container -->
<?php require_once("../layouts/footer.php") ?>