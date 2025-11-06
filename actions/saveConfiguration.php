<?php

require_once "../common/Users.php";

$user = new Users();

session_start();
$idUser = $_SESSION['idUser'];

$publicName = $_POST['public-name'];
$publicBio =  $_POST['public-bio'];


$token = bin2hex(random_bytes(16));

$result = $user->getConfigurationData($idUser);

if (mysqli_num_rows($result) > 0) {
    $user -> updateConfiguration($idUser,$publicName,$publicBio);
}
else{
    $user -> insertConfiguration($idUser,$publicName,$publicBio);
}
header("Location: ../pages/configuration.php");

?>