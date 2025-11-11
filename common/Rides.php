<?php
require_once "conectionBD.php";

class Rides {
	private $conexion;

	public function __construct() {
		$db = new ConnectionBD(); 
		$this->conexion = $db->getConnection();
	}

	function insertRide($idUser, $origin, $destination, $departureTime, $days, $costPerSeat, $availableSeats, $status, $idVehicule){
		$sql = "INSERT INTO rides (idUser, origin, destination, departureTime, rideDate, costPerSeat, availableSeats, status, idVehicle)
                VALUES ($idUser, '$origin', '$destination', '$departureTime', '$days', $costPerSeat, $availableSeats, '$status', $idVehicule)";
	
        if ($this->conexion->query($sql) === TRUE) {
			header("Location: ../pages/myRides.php");
            return true;
        } else {
            return "Error: " . $sql . "<br>" . $this->conexion->error;
        }
	}
	
	public function UpdateRide($idRide, $idUser, $origin, $destination, $departureTime, $days, $costPerSeat, $availableSeats, $status, $idVehicle){
		$sql = "UPDATE rides 
				SET origin = '$origin',
					destination = '$destination',
					departureTime = '$departureTime',
					rideDate = '$days',
					costPerSeat = $costPerSeat,
					availableSeats = $availableSeats,
					status = '$status',
					idVehicle = $idVehicle
				WHERE idRide = $idRide AND idUser = $idUser";
		if ($this->conexion->query($sql) === TRUE) {
			return true;
		} else {
			return "Error updating ride: " . $this->conexion->error;
		}
	}

	public function desactivateRide($idRide, $idUser){
		$sql = "UPDATE rides 
				SET status = 'inactive'
				WHERE idRide = $idRide AND idUser = $idUser";
		if ($this->conexion->query($sql) === TRUE) {
			return true;
		} else {
			return "Error updating ride: " . $this->conexion->error;
		}
	}



	function foundIdVehicleByPlate($plate){
		$sql = "SELECT idVehicle FROM vehicles WHERE plateNumber = '$plate'";
		$result = $this->conexion->query($sql);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			return $row['idVehicle'];
		} else {
			return null;
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

	public function getRideById($idRide) {
		$sql = "SELECT r.*, v.plateNumber, v.brand 
				FROM rides r
				JOIN vehicles v ON r.idVehicle = v.idVehicle
				WHERE r.idRide = $idRide";
            
		$result = $this->conexion->query($sql);

		if ($result->num_rows > 0) {
			return $result->fetch_assoc();
		}
		return null;
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

	public function filter($origin = "",$destination="",$days= [], $orderBy = "departureTime", $order = "ASC"){
		
		if (empty($origin) && empty($destination) && empty($days)) {
        return []; 
    	}

		$sql = "SELECT u.name, u.lastName, r.origin, r.destination, r.availableSeats, c.brand, c.model, r.costPerSeat, r.idRide, c.year 
		FROM rides r 
        JOIN users u ON r.idUser = u.idUser 
        JOIN vehicles c ON r.idVehicle = c.idVehicle 
        WHERE r.status = 'active' AND r.availableSeats > 0";


    	if (!empty($origin)) {
        	$sql .= " AND r.origin = '$origin'";
    	}


    	if (!empty($destination)) {
        	$sql .= " AND r.destination = '$destination'";
    	}

		if (!empty($days)) {
        	$likeConditions = [];
        	foreach ($days as $day) {
            	$likeConditions[] = "r.rideDate LIKE '%$day%'";
        }
        	$sql .= " AND (" . implode(" OR ", $likeConditions) . ")";
    }

		
		if ($orderBy ===  "from") {
        	$sql .= " ORDER BY r.origin $order";
    	} else if ($orderBy === "to") {
        	$sql .= " ORDER BY r.destination $order";
    	} else if ($orderBy === "departureTime") {
        	$sql .= " ORDER BY r.departureTime ASC";
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

	public function loadRideDetails($idRide){
		$sql = "SELECT r.origin,r.destination,r.rideDate,r.departureTime,r.availableSeats,r.costPerSeat,v.plateNumber,v.brand,r.idRide,u.picture, u.name
		FROM rides r 
		JOIN users u ON r.idUser = u.idUser 
		JOIN vehicles v ON r.idVehicle = v.idVehicle 
		WHERE idRide=$idRide;";
		return  mysqli_query($this->conexion, $sql);
	}

	public function updateAvailableSeats($idRide){
		$sql = "UPDATE rides SET availableSeats = availableSeats -1 WHERE idRide = $idRide";  
		mysqli_query($this->conexion, $sql);
	}

	public function getRideByVehicle($idVehicle) {
		
     $query = "SELECT * FROM rides WHERE idVehicle = $idVehicle AND status = 'active'";
     $result = mysqli_query($this->conexion, $query);

       if ($result && $result->num_rows > 0) {
            return true; // Tiene reservas activas
       } else {
            return false; // NO tiene reservas activas
       }
	}	
}

?>