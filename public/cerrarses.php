<?php
require("../bibliotecas/database.php");
session_start();
if(isset($_SESSION['id_usuario']) && isset($_GET['id'])){
$id = base64_decode($_GET['id']);
$sql = "DELETE FROM sesiones WHERE id_sesion = ?";
$params = array($id);
Database::executeRow($sql,$params);
header('location:versesiones.php');
}
?>