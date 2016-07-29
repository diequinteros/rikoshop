<?php
require("../bibliotecas/database.php");
	if(!empty($_POST))
	{
		//Campos del formulario.
		//Se sanean los datos con la funcion strip_tags()
		$nmarca = strip_tags(trim($_POST['nmarca']));

	    function mthAgregar($nmarca)
	    {
	    	
			Database::connect();
	        Database::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $sql = "INSERT INTO marcas(marca) values(?)";
			//Se prepara la sentencia sql
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