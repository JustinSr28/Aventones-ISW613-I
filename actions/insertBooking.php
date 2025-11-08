<?php

require_once "../common/Bookings.php";
require_once "../common/Rides.php";

session_start();

if (!isset($_SESSION['idUser'])) {
    header("Location: ../pages/login.php");
    exit;
}

$idUser = $_SESSION['idUser'];

$idRide = null; 

if (isset($_POST['idRide'])) {
    $idRide = $_POST['idRide'];
} elseif (isset($_GET['idRide'])) {
    $idRide = $_GET['idRide'];
}

$rides = new Rides();
$bookings = new Bookings();
$result = $bookings -> insertBooking($idRide, $idUser);

if ($result) {
    $rides-> updateAvailableSeats($idRide);
} else {
    mysqli_error($this->conexion);
}

header("Location: ../pages/searchRides.php");
?>