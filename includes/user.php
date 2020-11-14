<?php
require_once('database.php');

class User
{
    protected static $namatable = "users";
    public $id;
    public $email;
    public $password;
    public $nama;
    public $namabelakang;
    public $photo;
    public $created_at;
    public $updated_at;

    public function create()
    {
        global $db;
        $hasil = 0;
        $conn = $db->connection;
        $this->created_at = date('Y-m-d H:i:s');

        $data = [
            'email' => $this->email,
            'nama' => $this->nama,
            'password' => password_hash($this->password, PASSWORD_DEFAULT),
            'namabelakang' => $this->namabelakang,
            'photo' => $this->photo,
            'created_at' => $this->created_at
        ];

        $sql = "INSERT INTO " . self::$namatable . " (email, nama, password, namabelakang, photo, created_at)";
        $sql .= " VALUES (:email, :nama, :password, :namabelakang, :photo, :created_at)";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute($data);
            $hasil = $conn->lastInsertId();
        } catch (Exception $exception) {
            $hasil = 0;
        }

        return $hasil;
    }

    public function update()
    {
        global $db;
        $hasil = 0;
        $conn = $db->connection;
        $this->updated_at = date('Y-m-d H:i:s');

        $data = [
            'email' => $this->email,
            'nama' => $this->nama,
            'password' => password_hash($this->password, PASSWORD_DEFAULT),
            'namabelakang' => $this->namabelakang,
            'photo' => $this->photo,
            'updated_at' => $this->updated_at,
            'id' => $this->id
        ];

        $sql = "UPDATE " . self::$namatable;
        $sql .= " SET email=:email, nama=:nama, namabelakang=:namabelakang, photo=:photo, updated_at=:updated_at";
        $sql .= " WHERE id:id";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute($data);
        } catch (Exception $exception) {
            $hasil = 0;
        }

        return $hasil;
    }

    public function delete()
    {
        global $db;
        $hasil = 0;
        $conn = $db->connection;

        $sql = "DELETE FROM " . self::$namatable;
        $sql .= " WHERE id=?";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $this->id);
            $hasil = $stmt->execute();
        } catch (Exception $exception) {
            $hasil = 0;
        }

        return $hasil;
    }

    public static function authenticate($email = '', $password = '')
    {
        global $db;
        $hasil = 0;
        $conn = $db->connection;

        $data = [
            ':email' => $email
        ];

        $sql = "SELECT * FROM " . self::$namatable . " WHERE (email = :email)";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute($data);
        } catch (Exception $exception) {
            $hasil = 0;
        }

        $row = $stmt->fetch();
        if (is_array($row)) {
            if (password_verify($password, $row['password'])) {
                $hasil = $row['id'];
            }
        }

        return $hasil;
    }

    public function changePassword()
    {
        global $db;
        $hasil = 0;
        $conn = $db->connection;

        $newpassword = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "UPDATE " . self::$namatable . " SET password = :passwd WHERE id = :id";

        $data = [
            ':passwd' => $newpassword,
            ':id' => $this->id
        ];

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute($data);
        } catch (Exception $exception) {
            $hasil = 0;
        }

        return $hasil;
    }

    public static function allUser()
    {
        global $db;
        $hasil = 0;
        $conn = $db->connection;

        $sql = "SELECT * FROM " . self::$namatable;
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $hasil = $stmt->fetchAll();
        } catch (Exception $exception) {
            $hasil = 0;
        }

        return $hasil;
    }

    public function cari_dgn_id($id)
    {
        global $db;
        $hasil = 0;
        $conn = $db->connection;

        $sql = "SELECT * FROM " . self::$namatable;
        $sql .= " WHERE id=:id LIMIT 1";

        $data = [
            ':id' => $id
        ];

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute($data);
            $hasil = $stmt->fetch();
        } catch (Exception $exception) {
            $hasil = 0;
        }

        return $hasil;
    }

    public function username($id)
    {
        global $db;
        $hasil = 0;
        $conn = $db->connection;

        $sql = "SELECT nama FROM " . self::$namatable;
        $sql .= " WHERE id = :id LIMIT 1";

        $data = [
            'id' => $id
        ];

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute($data);
            $hasil = $stmt->fetch();
        } catch (Exception $exception) {
            $hasil = 0;
        }

        return $hasil;
    }

    public function userphoto($id)
    {
        global $db;
        $hasil = 0;
        $conn = $db->connection;

        $sql = "SELECT photo FROM " . self::$namatable;
        $sql .= " WHERE id = :id LIMIT 1";

        $data = [
            'id' => $id
        ];

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute($data);
            $hasil = $stmt->fetch();
        } catch (Exception $exception) {
            $hasil = 0;
        }

        return $hasil['photo'];
    }
}