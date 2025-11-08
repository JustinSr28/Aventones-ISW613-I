<?php
require_once "../common/Rides.php";
session_start();

$idRide = $_GET['id'];
$idUser = $_SESSION['idUser'];

$departureFrom = $_POST['departure-from'];
$arriveTo = $_POST['arrive-to'];
$time = $_POST['time'];
$seats = $_POST['seats'];
$fee = $_POST['fee'];
$plate = $_POST['plate'];
$status = "active";


$days = isset($_POST['days']) ? implode(",", $_POST['days']) : "";


$rideObj = new Rides();
$idVehicle = $rideObj->foundIdVehicleByPlate($plate);


$result = $rideObj->UpdateRide(
    $idRide,
    $idUser,
    $departureFrom,
    $arriveTo,
    $time,
    $days,
    $fee,
    $seats,
    $status,
    $idVehicle
);

if ($result === true) {
    header("Location: ../pages/myRides.php");
    exit();
} else {
    echo $result;
}
?>
