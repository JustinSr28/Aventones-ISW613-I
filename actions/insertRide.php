<?php 
require_once "../common/Rides.php";

$departureFrom = $_POST['departure-from'];
$arriveTo = $_POST['arrive-to'];
$time = $_POST['time'];
$seats = $_POST['seats'];
$fee = $_POST['fee'];
$plate = $_POST['plate'];
$status = 'active';

if (isset($_POST['days'])) {
    $days = implode(",", $_POST['days']); //Une array a string separado de ,
} else {
    $days = "";
}

session_start();
$idUser = $_SESSION['idUser'];
$rideObj = new Rides();
$result = $rideObj->insertRide($idUser, $departureFrom, $arriveTo, $time, $days, $fee, $seats, $status);


?>
