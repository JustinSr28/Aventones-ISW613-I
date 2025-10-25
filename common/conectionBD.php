<?php
class ConnectionBD {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "aventones";
    private $conn;

    public function __construct() {
        $this->conexion();
    }

    private function conexion() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>
