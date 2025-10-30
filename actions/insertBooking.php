<?php 
require_once "../common/Bookings.php";

$booking = new Bookings();

session_start();

$idUser = $_SESSION['idUser'];
$idRide = $_GET['id'];

$result = $booking -> insertBooking($idRide, $idUser);

?>