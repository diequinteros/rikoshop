<?php
	require("../bibliotecas/database.php");
	$id = null;
    if(!empty($_GET['id'])) {
		//se sanean los datos con strip_tags
        $id = strip_tags(trim(base64_decode($_GET['id'])));
    }
    if($id == null) {
        header("location: read_usuario.php");
    }
    
	if(!empty($_POST))
	{
		//Post values
		//Campos del formulario.
		//Se sanean los datos con strip_tags
        $usuario = strip_tags(trim($_POST['usuario']));
		$email = strip_tags(trim($_POST['email']));
		$nombre = strip_tags(trim($_POST['nombre']));
		$apellido = strip_tags(trim($_POST['apellido']));
	    function mthModificar($email, $nombre, $apellido, $id)
	    {
			Database::connect();
	        Database::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $sql = "UPDATE usuarios SET email = ?, nombre = ?, apellido = ? WHERE id_usuario = ?";
	        $stmt = Database::$connection->prepare($sql);
	        $stmt->execute(array($ncategoria, $descripcion, $id));
	        Database::$connection = null;
			Database::desconnect();
		}
	    	if($ncategoria != null)
			{
			mthModificar($email, $nombre, $apellido, $id);
			?>
			<script language="javascript">
       		alert("Datos modificados");	 
        	</script>
			<?php
			header("location: read_usuarios.php");
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
        $sql = "SELECT * FROM usuarios WHERE id_usuario = $id";
        $stmt = Database::$connection->prepare($sql);
		$stmt->execute();
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		Database::$connection = null;
		Database::desconnect();
		$usuario = $data['usuario']
		$email = $data['email']
		$nombre = $data['nombre'];
	    $apellido = $data['apellido'];
	}
?>