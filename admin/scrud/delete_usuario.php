<?php
    $id = null;
    if(!empty($_GET['id'])) {
        $id = strip_tags(trim($_GET['id']));
    }
    if($id == null) {
        header("location: read_usuario.php");
    }
    // Delete Data
    if(!empty($_POST)) {
        require("../bibliotecas/database.php");
        Database::connect();   
        $id = strip_tags(trim($_POST['id']));
        Database::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
        $stmt = Database::$connection->prepare($sql);
        $stmt->execute(array($id));
        Database::$connection = null;
        Database::desconnect();
        header("location: read_usuario.php");
    }
?>