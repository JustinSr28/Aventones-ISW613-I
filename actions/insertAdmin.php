<?php
require_once "../common/Users.php";

session_start();

if (!isset($_SESSION['idUser'])) {
    header("Location: ../index.html");
    exit();
}


$user = new Users();

    $resultado = $user->insertUser(
        $_POST['first-name'],
        $_POST['last-name'],
        $_POST['id-card'],
        $_POST['birth-date'],
        $_POST['gmail'],
        $_POST['password'],
        $_POST['address'],
        $_POST['phone-number'],
        "Admin",
        $_FILES['user-photo']
    );

    echo $resultado === true ? "Usuario registrado correctamente" : $resultado; //ternario

    
?>