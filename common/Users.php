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
        $sql = "INSERT INTO users (ID, name, lastName, gmail, phoneNumber, picture, password, role, token, status,birthDate,address)
                VALUES ($ID, '$name', '$lastName', '$gmail', '$phoneNumber', '$this->picturePath', '$encryptedPass', '$role', '$token', 'pending', '$birthDate', '$address')";

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

    public function insertConfiguration($idUser,$publicName,$publicBio){
        $sql = "INSERT INTO configuration (idUser,publicname,publicbio) VALUES ($idUser,'$publicName','$publicBio');";
        mysqli_query($this -> conexion, $sql);
        $this->conexion->close();
    }

    public function updateConfiguration($idUser,$publicName,$publicBio){
        $sql = "UPDATE configuration SET publicname = '$publicName', publicbio = '$publicBio' WHERE idUser = $idUser";
        mysqli_query($this -> conexion, $sql);
    }

    public function getConfigurationData($idUser){
        $sql = "SELECT * FROM configuration WHERE idUser = $idUser";
        return mysqli_query($this -> conexion, $sql);
    }

    public function updateUser($idUser,$name, $lastName, $ID, $gmail, $password, $address, $phoneNumber,  $file,$birthDate){
        $this->picturePath = $this->uploadImage($file);
        $encryptedPass = password_hash($password, PASSWORD_BCRYPT); 
        $sql = "UPDATE users  
        SET ID = $ID ,name = '$name', lastName = '$lastName', gmail = '$gmail', phoneNumber = '$phoneNumber', picture = '$this->picturePath', password = '$encryptedPass', birthDate = '$birthDate' ,address = '$address'  WHERE idUser = $idUser";
        mysqli_query($this -> conexion, $sql);
    }

    public function loadUserData($idUser){
        $sql = "SELECT ID,name,lastName,gmail,phoneNumber,picture,password,birthDate,address FROM users WHERE idUser = $idUser";
        return  mysqli_query($this -> conexion, $sql);
    }



    

}
?>



















