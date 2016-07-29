<?php
	require("../bibliotecas/database.php");
	$id = null;
    if(!empty($_GET['id'])) {
        $id = strip_tags(trim(base64_decode($_GET['id'])));
    }
    if($id == null) {
        header("location: read_ofertacat.php");
    }
    
	if(!empty($_POST))
	{
		//Post values
		//Se sanean los datos con strip_tags
		$categoria = strip_tags(trim($_POST['idcategoria']));
	    $porcentaje = strip_tags(trim($_POST['porcentaje']));
	    function mthModificar($categoria, $porcentaje, $id)
	    {

			Database::connect();
	        Database::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $sql = "UPDATE ofertas_categoria SET id_categoria = ?, porcentaje = ? WHERE id_oferta_c = ?";
	        $stmt = Database::$connection->prepare($sql);
	        $stmt->execute(array($categoria, $porcentaje, $id));
	        Database::$connection = null;
			Database::desconnect();
		}
	    	if($categoria != null && $porcentaje != null)
			{
			mthModificar($categoria, $porcentaje, $id);
			?>
			<script language="javascript">
       		alert("Datos modificados");	 
        	</script>
			<?php
			header("location: read_ofertacat.php");
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
        $sql = "SELECT * FROM ofertas_categoria WHERE id_oferta_c = $id";
        $stmt = Database::$connection->prepare($sql);
		$stmt->execute();
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		Database::$connection = null;
		Database::desconnect();
		$categoria = $data['id_categoria'];
	    $porcentaje = $data['porcentaje'];
	}
?>