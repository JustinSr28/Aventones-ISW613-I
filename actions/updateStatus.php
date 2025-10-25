<?php
require_once "../common/conectionBD.php";

$id     = $_POST['id'];
$status = $_POST['state'];

$db = new ConnectionBD();
$conn = $db->getConnection();


$sql = "UPDATE users SET status = '$status' WHERE idUser = $id";  
$conn->query($sql);
$conn->close();

