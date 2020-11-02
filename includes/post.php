<?php
require_once('database.php');

class Post
{
    protected static $namatable = "posts";
    public $id;
    public $user_id;
    public $keterangan;
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
            'user_id' => $this->user_id,
            'keterangan' => $this->keterangan,
            'photo' => $this->photo,
            'created_at' => $this->created_at
        ];

        $sql = "INSERT INTO " . self::$namatable . " (user_id, keterangan, photo, created_at)";
        $sql .= " VALUES (:user_id, :keterangan, :photo, :created_at)";

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
            'user_id' => $this->user_id,
            'keterangan' => $this->keterangan,
            'photo' => $this->photo,
            'updated_at' => $this->updated_at,
            'id' => $this->id
        ];

        $sql = "UPDATE " . self::$namatable;
        $sql .= " SET keterangan=:keterangan, photo=:photo, updated_at=:updated_at";
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

    public function cari_userpost($uid)
    {
        global $db;
        $hasil = 0;
        $conn = $db->connection;

        $sql = "SELECT * FROM " . self::$namatable;
        $sql .= " WHERE user_id = :uid";

        $data = [
            'uid' => $uid
        ];

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute($data);
            $hasil = $stmt->fetchAll();
        } catch (Exception $exception) {
            $hasil = 0;
        }

        return $hasil;
    }

    public static function total_semua($uid)
    {
        global $db;
        $hasil = 0;
        $conn = $db->connection;

        $sql = "SELECT COUNT(*) AS num FROM  " . self::$namatable;
        $sql .= " WHERE user_id = :uid";

        $data = [
            'uid' => $uid
        ];

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute($data);
            $hasil = $stmt->fetch();
        } catch (Exception $exception) {
            $hasil = 0;
        }

        return $hasil['num'];
    }
}