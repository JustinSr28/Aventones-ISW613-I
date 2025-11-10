<?php
require_once "../common/Users.php";

session_start();

$user = new Users();

    $resultado = $user->insertUser(
        $_POST['first-name'],
        $_POST['last-name'],
        $_POST['id-card'],
        $_POST['birth-date'],
        $_POST['email'],
        $_POST['password'],
        $_POST['address'],
        $_POST['phone-number'],
        "Admin",
        $_FILES['user-photo'],
        "0"
    );

    echo $resultado === true ? "Usuario registrado correctamente" : $resultado; //ternario
    header("Location: ../pages/allUsers.php");

    
?>