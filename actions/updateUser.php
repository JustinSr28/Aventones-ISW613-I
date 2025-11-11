<?php
require_once "../common/Users.php"; 

session_start();
if (!isset($_SESSION['idUser']) || !isset($_SESSION['role'])) {
    header("Location: ../pages/login.php");
    exit();
}

$users = new Users();

$idUser = $_SESSION['idUser'];

$picturePath = null;
if (!empty($_FILES['picture']['name'])) { 
    $picturePath = $users->uploadImage($_FILES['picture']);
}


$users -> updateUser(
        $idUser,
        $_POST['first-name'],
        $_POST['last-name'],
        $_POST['id-card'],
        $_POST['email'],
        $_POST['password'],
        $_POST['address'],
        $_POST['phone-number'],
        $picturePath,
        $_POST['birth-date'],
    );

    header("Location: ../pages/editProfile.php");
    exit();

?>