<?php
require_once "../common/Users.php"; 

session_start();
$idUser = $_SESSION['idUser'];


$users = new Users();
$users -> updateUser(
        $idUser,
        $_POST['first-name'],
        $_POST['last-name'],
        $_POST['id-card'],
        $_POST['email'],
        $_POST['password'],
        $_POST['address'],
        $_POST['phone-number'],
        $_FILES['user-photo'],
        $_POST['birth-date'],
    );

    header("Location: ../pages/editProfile.php");
    exit();



?>