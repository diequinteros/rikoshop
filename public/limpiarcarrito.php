<?php
require('../bibliotecas/database.php');
//Si el id de usuario y la varible get tot estan puesta deja pasar, si no se regresa al index
if(isset($_SESSION['id_usuario']) && !empty($_GET['tot'])){
    //Se inserta en la tabla ventas el id y el total de la venta
    $sql = "INSERT INTO ventas(id_usuario, total) VALUES(?, ?)";
    $ar = array($_SESSION['id_usuario'] , $_GET['tot']);
    Database::executeRow($sql,$ar);
    //Se seleccionan la selecciones del usuario que no ha comprado 
    $sqlselec = "SELECT id_seleccion, selecciones.id_producto, cantidad, existencia FROM selecciones, productos WHERE selecciones.id_producto = productos.id_producto  AND id_usuario = $_SESSION[id_usuario] AND id_venta = 0";
    foreach (Database::getRows($sqlselec,null) as $producs) {
        //Se resta a las existencias la cantidad de producto que el cliente compra
        $cant = $producs['existencia']-$producs['cantidad'];
        //Se actualiza las existencas del producto
        $sqldis = "UPDATE productos SET existencia = $cant WHERE id_producto = $producs[id_producto]";
        Database::executeRow($sqldis,null);
        //Se actualizan las selecciones y pasan a estar vendidas
        $sqlvent = "UPDATE selecciones SET id_venta = (SELECT MAX(id_venta) FROM ventas WHERE id_usuario = $_SESSION[id_usuario]) WHERE id_seleccion = $producs[id_seleccion]";
        Database::executeRow($sqlvent, null);
    }
    //se regresa al inicio
    header('location:index.php');
}
else{
    header('location:index.php');
}
?>