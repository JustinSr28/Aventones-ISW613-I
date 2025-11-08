<?php

require_once "../common/Bookings.php";

session_start();
$idUser = $_SESSION['idUser'];

$idRide = null; // valor por defecto

if (isset($_POST['idRide'])) {
    $idRide = $_POST['idRide'];
} elseif (isset($_GET['idRide'])) {
    $idRide = $_GET['idRide'];
}

$bookings = new Bookings();
$bookings -> insertBooking($idRide, $idUser);

header("Location: ../pages/searchRides.php");
?>