<?php

require_once "../common/Bookings.php";
require_once "../common/Rides.php";

session_start();

if (!isset($_SESSION['idUser']) || !isset($_SESSION['role'])) {
    header("Location: ../pages/login.php");
    exit();
}

$idUser = $_SESSION['idUser'];

$idRide = null; 

if (isset($_POST['idRide'])) {
    $idRide = $_POST['idRide'];
} elseif (isset($_GET['idRide'])) {
    $idRide = $_GET['idRide'];
}

/*Se guardan los bookings, se recibe como parametro el id de ride que fue reservado y el usuario quien realizó la reservación */

$rides = new Rides();
$bookings = new Bookings();
$result = $bookings -> insertBooking($idRide, $idUser);

if ($result) {
    $rides-> updateAvailableSeats($idRide);
} else {
    echo($result);
}

header("Location: ../pages/bookings.php");
?>