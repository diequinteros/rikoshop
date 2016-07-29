<?php
    $id = null;
    if(!empty($_GET['id'])) {
        $id = strip_tags(trim(base64_decode($_GET['id'])));
    }
    if($id == null) {
        header("location: read_producto.php");
    }
    // Delete Data
    if(!empty($_POST)) {
        require("../bibliotecas/database.php");
        Database::connect();   
        $id = strip_tags(trim($_POST['id']));
        Database::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM sucursales WHERE id_sucursales = ?";
        $stmt = Database::$connection->prepare($sql);
        $stmt->execute(array($id));
        $sql = "DELETE FROM imagenes WHERE id_producto = ?";
        $stmt = Database::$connection->prepare($sql);
        $stmt->execute(array($id));
        Database::$connection = null;
        Database::desconnect();
        header("location: read_producto.php");
    }
?>