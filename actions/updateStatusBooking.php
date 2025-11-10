<?php

require_once "../common/Bookings.php"; 

session_start();

if (!isset($_SESSION['idUser']) || !isset($_SESSION['role'])) {
    echo "DEBUG: No hay sesión activa. Redirigiendo...";
    header("Location: ../pages/login.php");
    exit();
}

$idBooking = $_GET['id'];
$action = $_GET['action'];

$bookings = new Bookings();

if ($action === "accept") {
    $bookings -> updateStatus($idBooking,"accepted");
    header("Location: ../pages/bookings.php");
} 
else if ($action === "reject") {
    $bookings -> updateStatus($idBooking,"cancelled");
    header("Location: ../pages/bookings.php");
}

?>