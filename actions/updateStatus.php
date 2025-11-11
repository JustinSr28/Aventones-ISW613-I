<?php
require_once "../common/conectionBD.php";
require_once "../common/Users.php";

session_start();

if (!isset($_SESSION['idUser']) || !isset($_SESSION['role'])) {
    header("Location: ../pages/login.php");
    exit();
}

$id     = $_POST['id'];
$status = $_POST['state'];

$db = new ConnectionBD();
$conn = $db->getConnection();

$users = new Users();
$users -> updateStatus($status,$id);
?>

