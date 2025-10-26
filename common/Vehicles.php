<?php
require_once "../common/conectionBD.php";


Class Vehicles{
	private $conexion;
	private $uploadDir = "../images/vehicles/";    
	private $picturePath;
	private $status = "active";

	public function __construct() {
		$db = new ConnectionBD(); 
		$this->conexion = $db->getConnection();
	}

	// M�todo para insertar veh�culo
	public function insertVehicle($idUser, $plateNumber, $color, $brand, $model, $year, $file, $seatCapacity) {
		
		$this->picturePath = $this->uploadImage($file);
		// Sentencia SQL
		$sql = "INSERT INTO vehicles (idUser, plateNumber, color, brand, model, year, seatCapacity, picture, status)
				VALUES ($idUser, '$plateNumber', '$color', '$brand', '$model', $year, $seatCapacity, '$this->picturePath', '$this->status')";
		// Ejecutar consulta
		if ($this->conexion->query($sql) === TRUE) {
			return true;
		} else {
			return "Error: " . $sql . "<br>" . $this->conexion->error;
		}
		// Cerrar conexi�n
		$this->conexion->close();
	}
	// Subida de imagen
	private function uploadImage($file) {
		if (!is_dir($this->uploadDir)) {
			mkdir($this->uploadDir, 0777, true);
		}
		if (!empty($file['name'])) {
			$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION) ?: 'jpg');
			$newName = uniqid("vehicle_", true) . "." . $ext;
			$dest = $this->uploadDir . $newName;
			if (move_uploaded_file($file['tmp_name'], $dest)) {
				return "images/vehicles/" . $newName;
			} else {
				die("Error uploading the photo.");
			}
		}
		return "images/vehicles/default.jpg";
	}

	// M�todo para cargar todos los veh�culos de un usuario.
	public function loadVehicles($idUser) {
		$vehicles = [];
		$sql = "SELECT * FROM vehicles where idUser = '$idUser'";  
		$result = $this->conexion->query($sql);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$vehicles[] = $row;
			}
		}
		return $vehicles;
	}

	//M�todo para eliminar veh�culo (cambiar estado a inactive)
	public function deleteVehicle($idVehicle) {
		$sql = "UPDATE vehicles SET status = 'inactive' WHERE idVehicle = $idVehicle";  
		if ($this->conexion->query($sql) === TRUE) {
			return true;
		} else {
			return "Error: " . $sql . "<br>" . $this->conexion->error;
		}
	}
}


?>