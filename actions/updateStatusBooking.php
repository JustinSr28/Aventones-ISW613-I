<?php

require_once "../common/Bookings.php"; 

session_start();

if (!isset($_SESSION['idUser']) || !isset($_SESSION['role'])) {
    header("Location: ../pages/login.php");
    exit();
}

$idBooking = $_GET['id'];
$action = $_GET['action'];

$bookings = new Bookings();

//Este script se encarga de actualizar el estado de unbooking,según la acción recibida mediante el método get.

if ($action === "accept") {
    $bookings -> updateStatus($idBooking,"accepted");
    header("Location: ../pages/bookings.php");
} 
else if ($action === "reject") {
    $bookings -> updateStatus($idBooking,"cancelled");
    header("Location: ../pages/bookings.php");
}

?>