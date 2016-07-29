<?php
	require("../bibliotecas/database.php");
	$id = null;
    if(!empty($_GET['id'])) {
        $id = strip_tags(trim(base64_decode($_GET['id'])));
    }
    if($id == null) {
        header("location: read_sucursal.php");
    }
    
	if(!empty($_POST))
	{
		//Post values
		$pais = strip_tags(trim($_POST['cmbpais']));
	    $estado = strip_tags(trim($_POST['estado']));
		$ciudad = strip_tags(trim($_POST['ciudad']));
		$direccion = strip_tags(trim($_POST['direccion']));
		$telefono = strip_tags(trim($_POST['telefono']));
	    function mthModificar($pais, $estado, $ciudad, $direccion, $telefono, $id)
	    {

			Database::connect();
	        Database::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $sql = "UPDATE sucursales SET id_pais = ?, estado = ?, ciudad = ?, direccion = ?, telefono = ? WHERE id_sucursales = ?";
	        $stmt = Database::$connection->prepare($sql);
	        $stmt->execute(array($pais, $estado, $ciudad, $direccion, $telefono, $id));
	        Database::$connection = null;
			Database::desconnect();
		}
	    	if($pais != null && $estado != null && $$ciudad != null && $direccion != null && telefono != null)
			{
			mthModificar($pais, $estado, $ciudad, $direccion, $telefono, $id);
			?>
			<script language="javascript">
       		alert("Datos modificados");	 
        	</script>
			<?php
			header("location: read_sucursal.php");
			}
			else {
				?>
				<script languaje = "javascript">
				alert("No se han guardado los datos por falta de un campo");
				</script>
				<?php
			}
	}
	else
	{
		Database::connect();
		Database::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM sucursales WHERE id_sucursales = $id";
        $stmt = Database::$connection->prepare($sql);
		$stmt->execute();
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		Database::$connection = null;
		Database::desconnect();
		$pais = $data['id_pais'];
	    $estado = $data['estado'];
		$ciudad = $data['ciudad'];
		$direccion = $data['direccion'];
		$telefono = $data['telefono'];
	}
?>