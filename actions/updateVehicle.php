<?php
require_once "../common/Vehicles.php";
session_start();

if (!isset($_SESSION['idUser'])) {
    header("Location: ../index.html");
    exit();
}

$idVehicle = $_GET['id'];
$idUser = $_SESSION['idUser'];

$plate = $_POST['plate'];
$color = $_POST['color'];
$brand = $_POST['brand'];
$model = $_POST['model'];
$year = $_POST['year'];
$seats = $_POST['seats'];
$status = 'active';


$vehicleObj = new Vehicles();


$picturePath = null;
if (!empty($_FILES['picture']['name'])) {
    $picturePath = $vehicleObj->uploadImage($_FILES['picture']);
}

$result = $vehicleObj->updateVehicle($idVehicle, $idUser, $plate, $color, $brand, $model, $year, $seats, $picturePath, $status);

if ($result === true) {
    header("Location: ../pages/myVehicles.php");
    exit();
} else {
    echo $result;
}
