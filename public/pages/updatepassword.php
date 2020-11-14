<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/session.php");

$logged = 0;
if (isset($session)) {
    $logged = $session->user_sudahlogin();
}
$user = new User;
if (!empty($_POST['newpass'])) {

    $user->id = $logged;
    $user->password = $_POST['newpass'];
    $user->changePassword();

    $response = array(
        'pesan' => "<div class='alert alert-info role='alert'>Password berhasil diganti</div>"
    );
    echo json_encode($response);
}

