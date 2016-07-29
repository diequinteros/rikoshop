<?php
    $id = null;
    if(!empty($_GET['id'])) {
        //Se sanean los datos con la funcion strip_tags()
        $id = strip_tags(trim(base64_decode($_GET['id'])));
    }
    if($id == null) {
        header("location: read_ventas.php");
    }
    // Delete Data
    if(!empty($_POST)) {
        require("../bibliotecas/database.php");
        Database::connect();   
        //Se sanean los datos con la funcion strip_tags()
        $id = strip_tags(trim($_POST['id']));
        Database::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM ventas WHERE id_venta = ?";
        //Se prepara la funcion para evitar sql injection
        $stmt = Database::$connection->prepare($sql);
        $stmt->execute(array($id));
        Database::$connection = null;
        Database::desconnect();
        header("location: read_ventas.php");
    }
?>