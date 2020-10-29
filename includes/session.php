<?php

class Session
{
    public $pesan = '';
    private $sudahlogin = false;
    public $uid;
    public $nama;

    function __construct()
    {
        session_start();
        $this->check_pesan();
        $this->periksa_login();
        $this->check_nama();
    }

    private function periksa_login()
    {
        if (isset($_SESSION['uid'])) {
            $this->uid = $_SESSION['uid'];
            $this->sudahlogin = true;
        } else {
            unset($this->uid);
            $this->sudahlogin = false;
        }
    }

    public function login($uid)
    {
        if ($uid) {
            $this->uid = $_SESSION['uid'] = $uid;
            $this->sudahlogin = true;
        }
    }

    public function user_sudahlogin()
    {
        return $this->sudahlogin;
    }

    public function check_nama()
    {
        if (isset($_SESSION['nama'])) {
            $this->nama = $_SESSION['nama'];
        } else {
            $this->nama = '';
        }
    }

    public function pesan($txt = '')
    {
        if (!empty($txt)) {
            $_SESSION['pesan'] = $txt;
        } else {
            return $this->pesan;
        }
    }

    public function nama($namauser = "")
    {
        if (!empty($namauser)) {
            $_SESSION['nama'] = $namauser;
        } else {
            return $this->nama;
        }
    }

    private function check_pesan()
    {
        if (isset($_SESSION['pesan'])) {
            $this->pesan = $_SESSION['pesan'];
            unset($_SESSION['pesan']);
        } else {
            $this->pesan = "";
        }
    }

    public function logout()
    {
        unset($_SESSION['uid']);
        unset($_SESSION['nama']);
        unset($this->nama);
        unset($this->uid);
        $this->sudahlogin = false;
    }
}

$session = new Session;
$pesan = $session->pesan();
$nama = $session->nama();
?>