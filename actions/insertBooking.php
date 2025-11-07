<?php

require_once "../common/Bookings.php";

session_start();
$idUser = $_SESSION['idUser'];
$idRide = $_GET['idRide'];

$bookings = new Bookings();
$bookings -> insertBooking($idRide, $idUser);

header("Location: ../pages/searchRides.php");
?>