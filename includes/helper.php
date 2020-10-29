<?php

function typeGambar($type)
{
    $typegambar = false;
    $extensions = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');

    if (in_array($type, $extensions)) {
        $typegambar = true;
    }

    return $typegambar;
}

function create_image($photo)
{
    $docroot = $_SERVER['DOCUMENT_ROOT'] . '/social-media/public';
    define('UPLOAD_DIR', $docroot . '/images/');
    $img = base64_encode(file_get_contents($_FILES[$photo]['tmp_name']));
    $img = str_replace('data:image/png;base64, ', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode(($img));
    $basename = uniqid();
    $file = UPLOAD_DIR . $basename . '.png';
    file_put_contents($file, $data);
    return $basename . '.png';
}

function redirect_ke($lokasi = NULL)
{
    if ($lokasi != NULL) {
        header("Location: $lokasi");
        exit;
    }
}

function cetak_pesan($pesan = '')
{
    if (!empty($pesan)) {
        return "<div class=\"alert alert-info alert-dismissible fade show\" role=\"alert\">
        <strong>Info: </strong> {$pesan}
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">&times</span>
        </button>
    </div>";
    } else {
        return "";
    }
}