<?php
require_once "../common/Rides.php";
require_once "../common/Bookings.php";

session_start();

if (!isset($_SESSION['idUser']) || !isset($_SESSION['role'])) {
    header("Location: ../pages/login.php");
    exit();
}

$idRide = $_GET['id'];
$idUser = $_SESSION['idUser'];

$rideObj = new Rides();
$bookingObj = new Bookings();

$status = $bookingObj->getBookingsByRide($idRide);  //Si existe un booking activo del ride


if (!$status) {  //Si NO existe, puede desactivarse
    $result = $rideObj->desactivateRide($idRide, $idUser);
} else {    //SI existe, no puede desactivarse
    $result = "Cannot deactivate ride with active bookings.";
}

if ($result === true) {
    header("Location: ../pages/myRides.php");
    exit();
} else {
    header("Location: ../pages/myRides.php?error=" . urlencode($result)); //Mandamos el error
    exit();
}

