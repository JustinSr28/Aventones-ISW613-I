<?php
include('../common/Vehicles.php');

session_start();

if (!isset($_SESSION['idUser']) || !isset($_SESSION['role'])) {
    echo "DEBUG: No hay sesión activa. Redirigiendo...";
    header("Location: ../pages/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$idUser = $_SESSION['idUser']; // Obtener el ID del usuario desde la sesi�n
	
	$brand = $_POST['brand'];
	$model = $_POST['model'];
	$plate = $_POST['plate'];
	$year = $_POST['year'];
	$color = $_POST['color'];
	$seats = $_POST['seats'];
	$file = $_FILES['picture'];
	$vehicles = new Vehicles();
	$insertResult = $vehicles->insertVehicle($idUser, $plate, $color, $brand, $model, $year, $file, $seats);


	if ($insertResult === true) {
		header("Location: ../pages/myVehicles.php");
		exit();
	} else {
		echo "Error inserting vehicle: " . $insertResult;
	}
}


?>