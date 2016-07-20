<?php
	if(!empty($_POST))
	{
		//Campos del formulario.
        $usuario = $_POST['usuario'];
		$email = $_POST['email'];
		$clave = $_POST['clave'];
		$clave2 = $_POST['clave2'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
	    function mthAgregar($usuario, $email, $clave, $nombre, $apellido)
	    {
	    	require("../bibliotecas/database.php");
			Database::connect();
	        Database::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $sql = "INSERT INTO usuarios(usuario, id_tipo, email, clave, nombre, apellido) values(?, 1, ?, ?, ?, ?)";
	        $stmt = Database::$connection->prepare($sql);
	        $stmt->execute(array($usuario, $email, $clave, $nombre, $apellido));
	        Database::$connection = null;
	        Database::desconnect();
		}
		if($usuario != null && $email != null && $clave == $clave2 && $clave != null && $nombre != null && $apellido != null)
		{
		mthAgregar($usuario, $email, $clave, $nombre, $apellido);
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