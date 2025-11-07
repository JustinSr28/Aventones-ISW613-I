<?php
require_once "../common/conectionBD.php"; 
class Bookings{

    private $conexion;

    public function __construct() {
        $db = new ConnectionBD(); 
        $this->conexion = $db->getConnection();
    }

    public function insertBooking($idRide, $idUser) {
        $query = "INSERT INTO bookings (idRide, idUser, status) VALUES ($idRide, $idUser, 'pending')";
        mysqli_query($this->conexion, $query);
    }

    public function loadBookings($idUser){
        $query = "SELECT b.idBooking, u.name, u.lastName, r.origin, r.destination, b.status FROM bookings b JOIN users u ON b.idUser = u.idUser JOIN rides r ON b.idRide = r.idRide JOIN users d ON r.idUser = d.idUser WHERE u.idUser = $idUser OR r.idUser = $idUser;";
        $result = mysqli_query($this->conexion, $query);
        $bookings = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $bookings[] = $row;
        }
        return $bookings; 
    }

    public function updateStatus($idBooking,$status){
        $query = "UPDATE bookings SET status = '$status' WHERE idBooking = $idBooking";
        mysqli_query($this->conexion, $query);
    }

    

}
?>