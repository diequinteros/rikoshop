<?php
	if(!empty($_POST))
	{
		//Campos del formulario.
		$pais = strip_tags(trim($_POST['cmbPais']));
        $estado = strip_tags(trim($_POST['nestado']));
        $ciudad = strip_tags(trim($_POST['nciudad']));
        $direccion = strip_tags(trim($_POST['ndireccion']));
        $telefono = strip_tags(trim($_POST['telefono']));

	    function mthAgregar($pais, $estado, $ciudad, $direccion, $telefono)
	    {
	    	require("../bibliotecas/database.php");
			Database::connect();
	        Database::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $sql = "INSERT INTO sucursales(id_pais, estado, ciudad, direccion, telefono) values(?, ?, ?, ?, ?)";
	        $stmt = Database::$connection->prepare($sql);
	        $stmt->execute(array($pais, $estado, $ciudad, $direccion, $telefono));
	        Database::$connection = null;
	        Database::desconnect();
		}
		if($pais != null && $direccion != null)
		{
		mthAgregar($pais, $estado, $ciudad, $direccion, $telefono);
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