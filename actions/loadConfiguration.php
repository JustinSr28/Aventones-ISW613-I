<?php

session_start();

if (!isset($_SESSION['idUser'])) {
    header("Location: ../index.html");
    exit();
}

?>