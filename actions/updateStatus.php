<?php
require_once "../common/conectionBD.php";
require_once "../common/Users.php";

$id     = $_POST['id'];
$status = $_POST['state'];

$db = new ConnectionBD();
$conn = $db->getConnection();

$users = new Users();
$users -> updateStatus($status,$id);
?>

