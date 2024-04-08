<?php
class Database {
    private $host;
    private $db_name;
    private $username;
    private string $password;
    public $conn;

    public function __construct() {
        $this->host = $_ENV['DB_HOST'] ?? 'rain.o2switch.net';
        $this->db_name = $_ENV['DB_NAME'] ?? 'zcmw0804_cesi_web';
        $this->username = $_ENV['DB_USERNAME'] ?? 'zcmw0804_cesi_web';
        $this->password = $_ENV['DB_PASSWORD'] ?? 'V9XTw0LUqCq~';
        if (empty($this->db_name) || empty($this->username) || empty($this->password)) {
            throw new Exception('Database credentials are not set');
        }
    }
    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->exec('set names utf8');
        } catch(PDOException $exception) {
            echo 'Erreur de connexion : ' . $exception->getMessage();
        }

        return $this->conn;
    }
}