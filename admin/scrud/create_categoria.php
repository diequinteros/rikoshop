<?php
	if(!empty($_POST))
	{
		//Campos del formulario.
        $categoria = strip_tags(trim($_POST['categoria']));
        $descripcion = strip_tags(trim($_POST['descripcion']));
	    function mthAgregar($categoria, $descripcion)
	    {
	    	require("../bibliotecas/database.php");
			Database::connect();
	        Database::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $sql = "INSERT INTO categorias(categoria, descripcion_cat) values(?, ?)";
	        $stmt = Database::$connection->prepare($sql);
	        $stmt->execute(array($categoria, $descripcion));
	        Database::$connection = null;
			Database::desconnect();
	        
		}
		if($categoria != null && $descripcion != null)
		{
		mthAgregar($categoria, $descripcion);
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