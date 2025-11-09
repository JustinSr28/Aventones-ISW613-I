<?php 
require_once "../common/Rides.php";
session_start();

if (!isset($_SESSION['idUser'])) {
    header("Location: ../index.html");
    exit();
}

$departureFrom = $_POST['departure-from'];
$arriveTo = $_POST['arrive-to'];
$time = $_POST['time'];
$seats = $_POST['seats'];
$fee = $_POST['fee'];
$plate = $_POST['plate'];
$status = 'active';

$days = isset($_POST['days']) ? implode(",", $_POST['days']) : "";

session_start();
$idUser = $_SESSION['idUser'];

$rideObj = new Rides();
$idVehicle = $rideObj->foundIdVehicleByPlate($plate);

$result = $rideObj->insertRide($idUser, $departureFrom, $arriveTo, $time, $days, $fee, $seats, $status, $idVehicle);
?>

