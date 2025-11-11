<?php
require_once "../common/Users.php";

session_start();

$status = "active";
$mail =  $_POST['email'];


$user = new Users();

if ($user->checkEmailExists($mail)) {
    header("Location: ../pages/newAdmin.php?error=" . urlencode("Email already registered"));
    exit();
}

    $resultado = $user->insertUser(
        $_POST['first-name'],
        $_POST['last-name'],
        $_POST['id-card'],
        $_POST['birth-date'],
        $mail,
        $_POST['password'],
        $_POST['address'],
        $_POST['phone-number'],
        "Admin",
        $_FILES['user-photo'],
        "0",
        $status
    );

    echo $resultado === true ? "Usuario registrado correctamente" : $resultado; 
    header("Location: ../pages/allUsers.php");

    
?>