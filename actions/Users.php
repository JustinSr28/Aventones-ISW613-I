<?php
require_once "../common/conectionBD.php";

class Users {
    private $conexion;
    private $uploadDir = "../images/users/";    
    private $picturePath;
    private $token = "x";        
    private $state = "activo";   

    public function __construct() {
        $db = new ConnectionBD(); 
        $this->conexion = $db->getConnection();
    }


   public function login($gmail, $password) {
    $sql = "SELECT * FROM users WHERE gmail = '$gmail'";
    $result = $this->conexion->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verifica si el usuario está activo
        if ($user['state'] == 'active') {

            // Verifica la contraseña
            if (password_verify($password, $user['password'])) {
                return $user; //Login exitoso
            } else {
                return "Wrong Password"; //Contraseña incorrecta
            }

        } else {
            return "Inactive User."; //Usuario inactivo
        }
    } else {
        return "User not found"; //No se encontró el usuario
    }
}


    // Método para insertar usuario
    public function insertUser($name, $lastName, $ID, $birthDate, $gmail, $password, $address, $phoneNumber, $role, $file) {
        
        $this->picturePath = $this->uploadImage($file);

        
        $encryptedPass = password_hash($password, PASSWORD_BCRYPT); // Encriptar contraseña

        // Sentencia SQL
        $sql = "INSERT INTO users (ID, name, lastName, gmail, phoneNumber, picture, password, idRole, token, state)
                VALUES ($ID, '$name', '$lastName', '$gmail', '$phoneNumber', '$this->picturePath', '$encryptedPass', $role, '$this->token', '$this->state')";

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

    public function loadUsers(){
        $sql = "SELECT * FROM users";
        $result = $this->conexion->query($sql);
        $users = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }

}
?>



















