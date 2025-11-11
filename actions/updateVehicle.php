<?php
require_once "../common/Vehicles.php";
session_start();

if (!isset($_SESSION['idUser']) || !isset($_SESSION['role'])) {
    echo "DEBUG: No hay sesión activa. Redirigiendo...";
    header("Location: ../pages/login.php");
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


$picturePath = null; //Establecimos por defecto el valor en nulo
if (!empty($_FILES['picture']['name'])) {  //Si se recibe un archivo, entonces ejecutamos la funcion que me crea la ruta de la imagen subida
    $picturePath = $vehicleObj->uploadImage($_FILES['picture']); //Se crea la ruta de la imagen
}

$result = $vehicleObj->updateVehicle($idVehicle, $idUser, $plate, $color, $brand, $model, $year, $seats, $picturePath, $status); //Actualizamos Vehiculo

if ($result === true) {
    header("Location: ../pages/myVehicles.php");
    exit();
} else {
    echo $result;
}
