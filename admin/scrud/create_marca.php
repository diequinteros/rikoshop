<?php
	if(!empty($_POST))
	{
		//Campos del formulario.
		$nmarca = $_POST['nmarca'];

	    function mthAgregar($nmarca)
	    {
	    	require("../bibliotecas/database.php");
			Database::connect();
	        Database::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $sql = "INSERT INTO marcas(marca) values(?)";
	        $stmt = Database::$connection->prepare($sql);
	        $stmt->execute(array($nmarca));
	        Database::$connection = null;
	        Database::desconnect();
		}
		if($nmarca != null)
		{
		mthAgregar($nmarca);
		echo "<label id='laToas' onfocus='Materialize.toast('I am a toast', 4000)'></label>";
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