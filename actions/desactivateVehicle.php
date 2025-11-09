<?php
require_once "../common/Vehicles.php";
require_once "../common/Rides.php";

session_start();

if (!isset($_SESSION['idUser'])) {
    header("Location: ../index.html");
    exit();
}
$idVehicle = $_GET['id'];
$idUser = $_SESSION['idUser'];

$vehicleObj = new Vehicles();
$rideObj = new Rides();


$status = $rideObj->getRideByVehicle($idVehicle); 

// Si NO tiene rides activos, se puede desactivar
if (!$status) { 
    $result = $vehicleObj->desactivateVehicle($idVehicle, $idUser);
} else {
    $result = "Cannot deactivate Vehicle with active Ride.";
}

if ($result === true) {
    header("Location: ../pages/myVehicles.php");
    exit();
} else {
    header("Location: ../pages/myVehicles.php?error=" . urlencode($result)); //mandamos el error
    exit();
}

