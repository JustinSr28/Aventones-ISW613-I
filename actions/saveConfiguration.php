<?php

require_once "../common/Users.php";

session_start();

if (!isset($_SESSION['idUser']) || !isset($_SESSION['role'])) {
    header("Location: ../pages/login.php");
    exit();
}

$user = new Users();

session_start();
$idUser = $_SESSION['idUser'];

$publicName = $_POST['public-name'];
$publicBio =  $_POST['public-bio'];


$token = bin2hex(random_bytes(16));

/*Se verifica si el usuario ya tiene una configuración previa, sí es así se actualiza la conf, en caso contrario se inserta */

$result = $user->getConfigurationData($idUser);

if (mysqli_num_rows($result) > 0) {
    $user -> updateConfiguration($idUser,$publicName,$publicBio);
}
else{
    $user -> insertConfiguration($idUser,$publicName,$publicBio);
}
header("Location: ../pages/configuration.php");

?>