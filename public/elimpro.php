<?php
require("../bibliotecas/database.php");
include("../inc/styles.php");
    if(!empty($_GET['idselec']))
    {
        $idselec = $_GET['idselec'];
    }
    else{
    header("location: metodo_compra.php");
    }
    
        try 
	{
		//Se borra el producto del carrito
		$sql = "DELETE FROM selecciones WHERE id_seleccion = ?";
	    $params = array($idselec);
	    Database::executeRow($sql, $params);
		//Se vuelve a cargar el carrito
	    header("location: metodo_compra.php");
	} 
	catch (Exception $error) 
	{
		print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
	}
    
?>
<?php
include("../inc/scripts.php");
?>
