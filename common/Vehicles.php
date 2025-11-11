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
	public function uploadImage($file) {
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


	//Obtenemos el Vehiculo mediante la Id.

	public function getVehicleById($idVehicle){
		$sql = "SELECT * FROM vehicles where idVehicle = $idVehicle";
		$result = $this->conexion->query($sql);
		if ($result->num_rows > 0) {
			return $result->fetch_assoc();
		}
	}

	public function updateVehicle($idVehicle, $idUser, $plateNumber, $color, $brand, $model, $year, $seatCapacity, $picturePath = null, $status) {
    if ($picturePath) { //Si trae imagen nueva la guardamos
        $sql = "UPDATE vehicles 
                SET plateNumber = '$plateNumber',
                    color = '$color',
                    brand = '$brand',
                    model = '$model',
					year = $year,
                    seatCapacity = $seatCapacity,
                    picture = '$picturePath',
					status = '$status'
                WHERE idVehicle = $idVehicle AND idUser = $idUser";
    } else {			//Si no trae imagen, o sea es null, simplemente no se actualiza y se conserva la ruta de la imagen anterior
        $sql = "UPDATE vehicles 
                SET plateNumber = '$plateNumber',
                    color = '$color',
                    brand = '$brand',
                    model = '$model',
					year = $year,
                    seatCapacity = $seatCapacity,
					status = '$status'
                WHERE idVehicle = $idVehicle AND idUser = $idUser";
    }

    if ($this->conexion->query($sql) === TRUE) {
        return true;
    } else {
        return "Error updating vehicle: " . $this->conexion->error;
    }
}

	//Actualiza el estado del Vehiculo
	public function desactivateVehicle($idVehicle, $idUser) {
		
	$sql = "UPDATE vehicles SET status = 'inactive' WHERE idVehicle = $idVehicle AND idUser = $idUser";  
	if ($this->conexion->query($sql) === TRUE) {
		return true;
	} else {
		return "Error: " . $sql . "<br>" . $this->conexion->error;
	}
}

	public function isVehicleAssigned($idVehicle){
		$sql = "SELECT COUNT(*) AS total FROM rides WHERE idVehicle = $idVehicle;";
		$result = mysqli_query($this->conexion,$sql);
		
		if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['total'] > 0;
    	}
		 return false; 
	}
}


?>