<?php
require_once("config.php");

class PDODatabase
{
    public $connection;

    function __construct()
    {
        $this->open_connection();
    }

    public function open_connection()
    {
        $dsn = "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        try {
            $this->connection = new PDO($dsn, DB_USER, DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $PDOException) {
            throw new PDOException($PDOException->getMessage(), (int)$PDOException->getCode());
        }
    }

    public function close_connection()
    {
        try {
            $this->connection = NULL;
        } catch (PDOException $PDOException) {
            die($PDOException->getMessage());
        }
    }

    public function query($sql)
    {
        try {
            $query = $this->connection->query($sql);
            $result = $query->fetchAll();
        } catch (PDOException $PDOException) {
            $result = $PDOException->getMessage();
        }
        return $result;
    }
}

$db = new PDODatabase();
