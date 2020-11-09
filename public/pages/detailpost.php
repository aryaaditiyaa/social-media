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
$post_id = $_GET['pid'];
$post = Post::cari_dgn_id($post_id);
$post_user = User::cari_dgn_id($post['user_id']);
$user = new User;

?>

<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>
    <link rel="stylesheet" href="../css/detailpost.css">

    <main role="main" class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card">
                    <div>
                        <img src="../images/<?php echo $post['photo'] ?>" class="img-fluid">
                    </div>
                    <div class="card-footer">
                        <i class="far fa-heart float-left" aria-hidden="true"></i>
                        <i class="far fa-comment float-right" aria-hidden="true"></i>
                    </div>
                    <div class="p-3">
                        <span class="d-block font-weight-bold"><?php echo $post_user['nama'] ?></span>
                        <span><?php echo $post['keterangan'] ?></span>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="detailBox">
                    <div class="titleBox">
                        <label>Comment Box</label>
                    </div>
                    <div class="commentBox">

                        <p class="taskDescription">Lorem Ipsum is simply dummy text of the printing and typesetting
                            industry.</p>
                    </div>
                    <div class="actionBox">
                        <ul class="commentList">
                            <li>
                                <div class="commenterImage">
                                    <img src="http://lorempixel.com/50/50/people/6"/>
                                </div>
                                <div class="commentText">
                                    <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>

                                </div>
                            </li>
                            <li>
                                <div class="commenterImage">
                                    <img src="http://lorempixel.com/50/50/people/7"/>
                                </div>
                                <div class="commentText">
                                    <p class="">Hello this is a test comment and this comment is particularly very long
                                        and it goes on and on and on.</p> <span
                                            class="date sub-text">on March 5th, 2014</span>

                                </div>
                            </li>
                            <li>
                                <div class="commenterImage">
                                    <img src="http://lorempixel.com/50/50/people/9"/>
                                </div>
                                <div class="commentText">
                                    <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>

                                </div>
                            </li>
                        </ul>
                        <form class="form-inline" role="form">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Your comments"/>
                            </div>
                            <div class="form-group pl-2">
                                <button class="btn btn-info">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main><!-- /.container -->
<?php require_once("../layouts/footer.php") ?>