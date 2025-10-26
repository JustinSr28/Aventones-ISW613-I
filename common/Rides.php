<?php
require_once "../common/conectionBD.php";

class Rides {
	private $conexion;

	public function __construct() {
		$db = new ConnectionBD(); 
		$this->conexion = $db->getConnection();
	}

	function insertRide($idUser, $origin, $destination, $departureTime, $rideDate, $costPerSeat, $availableSeats, $status){
		$sql = "INSERT INTO rides (idUser, origin, destination, departureTime, rideDate, costPerSeat, availableSeats, status)
                VALUES ($idUser, '$origin', '$destination', '$departureTime', '$rideDate', $costPerSeat, $availableSeats, '$status')";
		// Ejecutar consulta
        if ($this->conexion->query($sql) === TRUE) {
			header("Location: ../pages/myRides.html");)
            return true;
        } else {
            return "Error: " . $sql . "<br>" . $this->conexion->error;
        }
	}

	function updateSeatsPerRide($idRide, $availableSeats){
		$sql = "UPDATE rides SET availableSeats = $availableSeats WHERE idRide = $idRide";  
		if ($this->conexion->query($sql) === TRUE) {
			return true;
		} else {
			return "Error: " . $sql . "<br>" . $this->conexion->error;
		}
	}

	function updateStatusRide($idRide, $status){
	$sql = "UPDATE rides SET status = '$status' WHERE idRide = $idRide";  

		if ($this->conexion->query($sql) === TRUE) {
			return true;
		} else {
			return "Error: " . $sql . "<br>" . $this->conexion->error;
		}
	}

	// Método para cargar todos los rides de un usuario.
	public function loadRides($idUser) {
		$rides = [];
		$sql = "SELECT * FROM rides where idUser = '$idUser'";  
		$result = $this->conexion->query($sql);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$rides[] = $row;
			}
		}
		return $rides;
	}
}

?>