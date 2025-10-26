<?php
require_once "../common/conectionBD.php";

class Users {
    private $conexion;
    private $uploadDir = "../images/users/";    
    private $picturePath;
   

    public function __construct() {
        $db = new ConnectionBD(); 
        $this->conexion = $db->getConnection();
    }

    // Método para insertar usuario
    public function insertUser($name, $lastName, $ID, $birthDate, $gmail, $password, $address, $phoneNumber, $role, $file,$token) {
        
        $this->picturePath = $this->uploadImage($file);
        $encryptedPass = password_hash($password, PASSWORD_BCRYPT); // Encriptar contraseña

        // Sentencia SQL
        $sql = "INSERT INTO users (ID, name, lastName, gmail, phoneNumber, picture, password, role, token, status)
                VALUES ($ID, '$name', '$lastName', '$gmail', '$phoneNumber', '$this->picturePath', '$encryptedPass', '$role', '$token', 'inactive')";

        // Ejecutar consulta
        if ($this->conexion->query($sql) === TRUE) {
            return true;
        } else {
            return "Error: " . $sql . "<br>" . $this->conexion->error;
        }

        // Cerrar conexión
        $this->conexion->close();
    }

    // Subida de imagen
    private function uploadImage($file) {
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }

        if (!empty($file['name'])) {
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION) ?: 'jpg');
            $newName = uniqid("user_", true) . "." . $ext;
            $dest = $this->uploadDir . $newName;

            if (move_uploaded_file($file['tmp_name'], $dest)) {
                return "images/users/" . $newName;
            } else {
                die("Error uploading the photo.");
            }
        }

        return "images/users/default.jpg";
    }

    // Método para cargar todos los usuarios
    public function loadUsers() {
        $sql = "SELECT * from users";
        $result = $this->conexion->query($sql);
        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }

    public function updateStatus($status,$id){
        $sql = "UPDATE users SET status = '$status' WHERE idUser = $id";  
        mysqli_query($this -> conexion, $sql);
    }

    public function activateUser($token){
        $sql = "UPDATE users SET status= 'active' WHERE token = '$token'";
        mysqli_query($this -> conexion, $sql);

    }

    public function getLoginData($email){
        $sql = "SELECT * FROM users WHERE gmail = '$email'";
        return mysqli_query($this->conexion, $sql);
    }

}
?>



















