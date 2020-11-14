<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/post.php");
require_once("../../includes/like.php");
require_once("../../includes/comment.php");

if (isset($session)) {
    $logged = $session->user_sudahlogin();
    if (!$logged) {
        redirect_ke("http://localhost/social-media/public/pages/login.php");
    }
}

$hearticon = '<i class="far fa-heart" aria-hidden="true"></i>';
$total = 0;
$post_id = $_GET['pid'];
$post = Post::cari_dgn_id($post_id);
$post_user = User::cari_dgn_id($post['user_id']);
$user = new User;
$like = new Like;
$like->post_id = $post_id;
$like->user_id = $logged;
$total = $like->totallike($post_id);
$postliked = $like->postliked();

if ($postliked) {
    $hearticon = '<i class="fas fa-heart" aria-hidden="true"></i>';
}

$totalc = 0;
$comment = new Comment;
$comment->post_id = $_GET['pid'];
$comment->user_id = $logged;
$postcomments = $comment->cari_dgn_id();
$totalc = $comment->totalcomment($comment->post_id);

?>

<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>
    <link rel="stylesheet" href="../css/detailpost.css">

    <main role="main" class="container mt-5">
        <input type="hidden" name="post_id" id="post_id" value="<?php echo $post_id ?>">
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $logged ?>">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card">
                    <div>
                        <img src="../images/<?php echo $post['photo'] ?>" class="img-fluid w-100">
                    </div>
                    <div class="card-footer">
                        <div class="float-left">
                            <span id="btnlike"><?php echo $hearticon ?></span>
                            <span id="totallike"><?php echo $total ?></span>
                        </div>
                        <div class="float-right">
                            <i id="commenticon" class="far fa-comment" aria-hidden="true"></i>
                            <span id="totalcomment"><?php echo $totalc ?></span>
                        </div>
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
                        <label>Kotak Komentar</label>
                    </div>
                    <div class="commentBox">
                        <span class="taskDescription">Harap berkomentar dengan sopan.
                        </span>
                    </div>
                    <div class="actionBox">
                        <ul class="commentList">
                            <?php foreach ($postcomments as $item) : ?>
                                <li>
                                    <div class="commenterImage">
                                        <a href="../index.php?visiteduid=<?php echo $item['user_id'] ?>">
                                            <img src="../images/<?php echo $user->userphoto($item['user_id']) ?>"/>
                                        </a>
                                    </div>
                                    <div class="commentText">
                                        <p class=""><?php echo $item['comment'] ?></p>
                                        <span class="date sub-text"><?php echo $item['created_at'] ?></span>

                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <form class="form-inline" role="form">
                            <div class="form-group">
                                <input class="form-control" type="text" id="yourcomment" placeholder="Your comments"/>
                            </div>
                            <div class="form-group pl-2">
                                <button class="btn btn-info" id="sendcomment">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="loade"></div>
        </div>

    </main><!-- /.container -->
<?php require_once("../layouts/footer.php") ?>