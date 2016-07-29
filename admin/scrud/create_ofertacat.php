<?php
	if(!empty($_POST))
	{
		//Campos del formulario.
		//Se sanean los campos obtenidos
        $idcategoria = strip_tags(trim($_POST['idcategoria']));
        $porcentaje = strip_tags(trim($_POST['porcentaje']));
	    function mthAgregar($idcategoria, $porcentaje)
	    {
	    	require("../bibliotecas/database.php");
			Database::connect();
	        Database::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $sql = "INSERT INTO ofertas_categoria(id_categoria, porcentaje) values(?, ?)";
	        $stmt = Database::$connection->prepare($sql);
	        $stmt->execute(array($idcategoria, $porcentaje));
	        Database::$connection = null;
	        Database::desconnect();
		}
		if($idcategoria != null && $porcentaje != null)
		{
		mthAgregar($idcategoria, $porcentaje);
		?>
		<script language="javascript">
       		alert("Datos guardados");	 
        </script>
		<?php 
		}
        else {
			?>
			<script language="javascript">
       		alert("Llene los campos");	 
        	</script>
			<?php
		}
	}
?>