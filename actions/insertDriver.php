<?php

require_once "../common/Users.php";
require_once "../actions/Email.php";

session_start();


$email = new Email();
$user = new Users();

$firstName = $_POST['first-name'];
$mail =  $_POST['email'];
$status = "pending";

if ($user->checkEmailExists($mail)) {
    header("Location: ../pages/userRegistration.php?error=" . urlencode("Email already registered"));
    exit();
}

$token = bin2hex(random_bytes(16));

    $resultado = $user->insertUser(
        $firstName,
        $_POST['last-name'],
        $_POST['id-card'],
        $_POST['birth-date'],
        $mail,
        $_POST['password'],
        $_POST['address'],
        $_POST['phone-number'],
        "Driver",
        $_FILES['user-photo'],
        $token,
        $status
    );

    echo $resultado === true ? "Usuario registrado correctamente" : $resultado; //ternario
    if($resultado){
        $email->send($mail, $firstName, "Hello $firstName! Activate your account now", "Link: http://shey.web/pages/accountActivation.php?token=$token</b>");
    }
   header("Location: ../pages/login.php");
    exit();
?>