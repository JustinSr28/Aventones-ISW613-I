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
			header("Location: ../pages/myRides.html");
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

	// Metodo para cargar todos los rides de un usuario.
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

	private function fetchRides($sql) {
    	$rides = [];
    	$result = mysqli_query($this->conexion, $sql);

    	if ($result && $result->num_rows > 0) {
        	while ($row = $result->fetch_assoc()) {
            	$rides[] = $row;
        	}
    	}
    	return $rides;
	}

	public function getOrigin(){
		$sql = "SELECT DISTINCT r.origin FROM rides r;";
		return $this->fetchRides($sql);
	}

	public function getDestination(){
		$sql = "SELECT DISTINCT r.destination FROM rides r;";
		return $this->fetchRides($sql);
	}
	public function filter($origin = "",$destination="",$days= []){
		$sql = "SELECT u.name, u.lastName, r.origin, r.destination, r.availableSeats, c.brand, c.model, r.costPerSeat, r.idRide 
		FROM rides r 
        JOIN users u ON r.idUser = u.idUser 
        JOIN vehicles c ON r.idVehicle = c.idVehicle 
        WHERE 1=1";


    	if (!empty($origin)) {
        	$sql .= " AND r.origin = '$origin'";
    	}


    	if (!empty($destination)) {
        	$sql .= " AND r.destination = '$destination'";
    	}

    	if (!empty($days)) {
       		$daysString = "'" . implode("','", $days) . "'";
        	$sql .= " AND r.rideDate IN ($daysString)";
		}

    	$result = mysqli_query($this->conexion, $sql);

  
    	if ($result) {
        	return mysqli_fetch_all($result, MYSQLI_ASSOC);
   	    } 
		else {
        	echo "Error en la consulta: " . mysqli_error($this->conexion);
        	return [];
    	}

	}

}

?>