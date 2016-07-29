<?php
	require("../bibliotecas/database.php");
	require("../bibliotecas/validator.php");
	$id = null;
	$idf1 = null;
	$idf2 = null;
	$idf3 = null;
	$idf4 = null;
    if(!empty($_GET['id'])) {
		//Se sanean los datos con strip_tags y luego se descifran con base64_decode
        $id = strip_tags(trim(base64_decode($_GET['id'])));
		$idf1 = strip_tags(trim(base64_decode($_GET['idf1'])));
		$idf2 = strip_tags(trim(base64_decode($_GET['idf2'])));
		$idf3 = strip_tags(trim(base64_decode($_GET['idf3'])));
		$idf4 = strip_tags(trim(base64_decode($_GET['idf4'])));
    }
    if($id == null) {
        header("location: read_producto.php");
    }
    
	if(!empty($_POST))
	{
		//Se sanean los datos con strip_tags
		$nombre = strip_tags(trim($_POST['nombre']));
        $descripcion = strip_tags(trim($_POST['descripcion']));
        $precio = strip_tags(trim($_POST['precio']));
        $marca = strip_tags(trim($_POST['marca']));
        $categoria = strip_tags(trim($_POST['idcategoria']));
		$existencia = strip_tags(trim($_POST['existencia']));
		$imagen1 = $_FILES['imagen1'];
		$imagen2 = $_FILES['imagen2'];
		$imagen3 = $_FILES['imagen3'];
		$imagen4 = $_FILES['imagen4'];
	    function mthModificar($nombre, $descripcion, $precio, $marca, $categoria, $existencia, $id)
	    {
			Database::connect();
	        Database::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $sql = "UPDATE productos SET nombre_producto = ?, descripcion_pro = ?, precio = ?, id_marca = ?, id_categoria = ?, existencia = ? WHERE id_producto = ?";
	        $stmt = Database::$connection->prepare($sql);
	        $stmt->execute(array($nombre, $descripcion, $precio, $marca, $categoria, $existencia, $id));
	        Database::$connection = null;
			Database::desconnect();
		}
		function mthModificarF($imagen, $id)
	    {
			Database::connect();
	        Database::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $sql = "UPDATE imagenes SET imagen = ? WHERE id_imagen = ?";
	        $stmt = Database::$connection->prepare($sql);
	        $stmt->execute(array($imagen, $id));
	        Database::$connection = null;
			Database::desconnect();
		}
		function mthAgregarF($imagen, $id)
	    {
			Database::connect();
	        Database::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $sql = "INSERT INTO imagenes(imagen, id_producto) values(?, ?)";
	        $stmt = Database::$connection->prepare($sql);
	        $stmt->execute(array($imagen, $id));
	        Database::$connection = null;
			Database::desconnect();
		}

	    if($nombre != null && $descripcion != null && $precio != null && $marca != null && $categoria != null && $existencia != null)
	    {
	    	//Se dispara la función para agregar un producto y se manda de parámetro el nombre de la imagen por defecto.
	    	mthModificar($nombre, $descripcion, $precio, $marca, $categoria, $existencia, $id);
			if($imagen1['name'] != null)
			{
			if($idf1 != null)
			{
				$imagen1x = Validator::validateImage($imagen1);
				if($imagen1x != false)
				{
					mthModificarF($imagen1x, $idf1);
				}
				else {
					throw new Exception("La imagen uno no es una imagen valida");
				}
			}
			else {
				$imagen1x = Validator::validateImage($imagen1);
				if($imagen1x != false)
				{
					mthAgregarF($imagen1x, $id);
				}
				else {
					throw new Exception("La imagen uno no es una imagen valida");
				}
			}
			}
			if($imagen2['name']!=null)
			{
				if($idf2 != null)
				{
					$imagen2x = Validator::validateImage($imagen2);
					if($imagen2x != false)
					{
						mthModificarF($imagen2x, $idf2);
					}
					else {
						throw new Exception("La imagen dos no es una imagen valida");
					}	
				}
				else {
					$imagen2x = Validator::validateImage($imagen2);
					if($imagen2x != false)
					{
						mthAgregarF($imagen2x, $id);
					}
					else {
						throw new Exception("La imagen dos no es una imagen valida");
					}
				}
			}
			if($imagen3['name']!=null)
			{
				if($idf3 != null)
				{
					$imagen3x = Validator::validateImage($imagen3);
					if($imagen3x != false)
					{
						mthModificarF($imagen3x, $idf3);
					}
					else {
						throw new Exception("La imagen tres no es una imagen valida");
					}
				}
				else {
					$imagen3x = Validator::validateImage($imagen3);
					if($imagen3x != false)
					{
						mthAgregarF($imagen3x, $id);
					}
					else {
						throw new Exception("La imagen tres no es una imagen valida");
					}
				}
			}
			if($imagen4['name']!=null)
			{
				if($idf4 != null)
				{
					$imagen4x = Validator::validateImage($imagen4);
					if($imagen4x != false)
					{
						mthModificarF($imagen4x, $idf4);
					}
					else {
						throw new Exception("La imagen cuatro no es una imagen valida");
					}
				}
				else {
					$imagen4x = Validator::validateImage($imagen4);
					if($imagen4x != false)
					{
						mthAgregarF($imagen4x, $id);
					}
					else {
						throw new Exception("La imagen cuatro no es una imagen valida");
					}
				}
			}
			?>
			<script language="javascript">
       		alert("Datos modificados");	 
        	</script>
			<?php
			header("location: read_producto.php");
	    }
	    else
	    {
	    		?>
				<script languaje = "javascript">
				alert("No se han guardado los datos por falta de un campo");
				</script>
				<?php
	    }
	}
	else {
		Database::connect();
		Database::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM productos WHERE id_producto = $id";
        $stmt = Database::$connection->prepare($sql);
		$stmt->execute();
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		//Database::$connection = null;
		$nombre = $data['nombre_producto'];
	    $descripcion = $data['descripcion_pro'];
		$precio = $data['precio'];
		$marca = $data['id_marca'];
		$categoria = $data['id_categoria'];
		$existencia = $data['existencia'];
		if($idf1 != null)
		{
		$sql2 = "SELECT imagen FROM imagenes WHERE id_imagen = $idf1";
        $stmt2 = Database::$connection->prepare($sql2);
		$stmt2->execute();
		$data2 = $stmt2->fetch(PDO::FETCH_ASSOC);
		$imagen1 = $data2['imagen'];
		}
		else {
			$imagen1 = "";
		}
		if($idf2 != null)
		{
		$sql3 = "SELECT imagen FROM imagenes WHERE id_imagen = $idf2";
        $stmt3 = Database::$connection->prepare($sql3);
		$stmt3->execute();
		$data3 = $stmt3->fetch(PDO::FETCH_ASSOC);
		$imagen2 = $data3['imagen'];
		}
		else {
			$imagen2 = "";
		}
		if($idf3 != null)
		{
		$sql4 = "SELECT imagen FROM imagenes WHERE id_imagen = $idf3";
        $stmt4 = Database::$connection->prepare($sql4);
		$stmt4->execute();
		$data4 = $stmt4->fetch(PDO::FETCH_ASSOC);
		$imagen3 = $data4['imagen'];	
		}
		else {
			$imagen3 = "";
		}
		if($idf4 != null)
		{
		$sql5 = "SELECT imagen FROM imagenes WHERE id_imagen = $idf4";
        $stmt5 = Database::$connection->prepare($sql2);
		$stmt5->execute();
		$data5 = $stmt5->fetch(PDO::FETCH_ASSOC);
		$imagen4 = $data5['imagen'];	
		}
		else {
			$imagen4 = "";
		}
		Database::$connection = null;
		Database::desconnect();	
		}
?>