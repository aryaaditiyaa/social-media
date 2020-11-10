<?php
require_once('database.php');

class Like
{
    protected static $namatable = "likes";
    public $id;
    public $user_id;
    public $post_id;
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
            'post_id' => $this->post_id,
            'created_at' => $this->created_at
        ];

        $sql = "INSERT INTO " . self::$namatable . " (user_id, post_id,, created_at)";
        $sql .= " VALUES (:user_id, :post_id, :created_at)";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute($data);
            $hasil = $conn->lastInsertId();
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

        $data = [
            'user_id' => $this->user_id,
            'post_id' => $this->post_id
        ];

        $sql = "DELETE FROM " . self::$namatable;
        $sql .= " WHERE user_id=user_id AND post_id=post_id";

        try {
            $stmt = $conn->prepare($sql);
            $hasil = $stmt->execute($data);
        } catch (Exception $exception) {
            $hasil = 0;
        }

        return $hasil;
    }

    public function postliked()
    {
        global $db;
        $hasil = 0;
        $conn = $db->connection;

        $data = [
            'user_id' => $this->user_id,
            'post_id' => $this->post_id
        ];

        $sql = "DELETE COUNT(*) AS num FROM " . self::$namatable;
        $sql .= " WHERE user_id=user_id AND post_id=post_id";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute($data);
            $result = $stmt->fetch();
            $hasil = $result['num'];
        } catch (Exception $exception) {
            $hasil = 0;
        }

        return $hasil;
    }

    public static function totallike($pid)
    {
        global $db;
        $hasil = 0;
        $conn = $db->connection;

        $sql = "SELECT COUNT(*) AS num FROM  " . self::$namatable;
        $sql .= " WHERE post_id = :pid";

        $data = [
            'pid' => $pid
        ];

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute($data);
            $result = $stmt->fetch();
            $hasil = $result['num'];
        } catch (Exception $exception) {
            $hasil = 0;
        }

        return $hasil;
    }
}