<?php

require_once "../common/Bookings.php"; 

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