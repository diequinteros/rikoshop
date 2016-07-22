<?php
	require("../bibliotecas/database.php");
	$id = null;
    if(!empty($_GET['id'])) {
        $id = $_GET['id'];
    }
    if($id == null) {
        header("location: read_categoria.php");
    }
    
	if(!empty($_POST))
	{
		//Post values
		$ncategoria = strip_tags(trim($_POST['categoria']));
	    $descripcion = strip_tags(trim($_POST['descripcion']));
	    function mthModificar($ncategoria, $descripcion, $id)
	    {

			Database::connect();
	        Database::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $sql = "UPDATE categorias SET categoria = ?, descripcion_cat = ? WHERE id_categoria = ?";
	        $stmt = Database::$connection->prepare($sql);
	        $stmt->execute(array($ncategoria, $descripcion, $id));
	        Database::$connection = null;
			Database::desconnect();
		}
	    	if($ncategoria != null)
			{
			mthModificar($ncategoria, $descripcion, $id);
			?>
			<script language="javascript">
       		alert("Datos modificados");	 
        	</script>
			<?php
			header("location: read_categoria.php");
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
        $sql = "SELECT * FROM categorias WHERE id_categoria = $id";
        $stmt = Database::$connection->prepare($sql);
		$stmt->execute();
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		Database::$connection = null;
		Database::desconnect();
		$ncategoria = $data['categoria'];
	    $descripcion = $data['descripcion_cat'];
	}
?>