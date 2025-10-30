<?php
require_once "../common/Bookings.php"; 

$idBooking = $_GET['idBooking'];
$action = $_GET['action'];

$bookings = new Bookings();

if ($action === "accept") {
    $bookings -> updateStatus($idBooking,"accepted");
} 
else if ($action === "reject") {
    $bookings -> updateStatus($idBooking,"denied");
}

?>