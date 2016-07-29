<?php
	require("../bibliotecas/database.php");
	require("../bibliotecas/validator.php");
	if(!empty($_POST))
	{
		//Campos del formulario.
		//Se sanean los datos obtenidos con post
		$nombre = strip_tags(trim($_POST['nombre']));
        $descripcion = strip_tags(trim($_POST['descripcion']));
        $precio = strip_tags(trim($_POST['precio']));
        $marca = strip_tags(trim($_POST['marca']));
        $categoria = strip_tags(trim($_POST['idcategoria']));
		$existencia = strip_tags(trim($_POST['existencia']));
		$imagen = $_FILES['imagen'];
		$imagen2 = $_FILES['imagen2'];
		$imagen3 = $_FILES['imagen3'];
		$imagen4 = $_FILES['imagen4'];
	    function mthAgregar($nombre, $descripcion, $precio, $marca, $categoria, $existencia)
	    {
			Database::connect();
	        Database::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $sql = "INSERT INTO productos(nombre_producto, descripcion_pro, precio, id_marca, id_categoria, existencia) values(?, ?, ?, ?, ?, ?)";
			//Se sanean los datos obtenidos con post
	        $stmt = Database::$connection->prepare($sql);
	        $stmt->execute(array($nombre, $descripcion, $precio, $marca, $categoria, $existencia));
	        Database::$connection = null;
			Database::desconnect();
		}
		function mthAgregarF($imagen)
	    {
			Database::connect();
	        Database::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $sql = "INSERT INTO imagenes(id_producto, imagen) values((SELECT MAX(id_producto) FROM productos), ?)";
	        $stmt = Database::$connection->prepare($sql);
	        $stmt->execute(array($imagen));
	        Database::$connection = null;
			Database::desconnect();
		}

	    if($imagen['name'] == null && $imagen2['name'] == null && $imagen3['name'] == null && $imagen4['name'] == null) //Si no se ha seleccionado una imagen para el producto.
	    {
	    	//Se dispara la función para agregar un producto y se manda de parámetro el nombre de la imagen por defecto.
	    	mthAgregar($nombre, $descripcion, $precio, $marca, $categoria, $existencia);
	    }
	    else //Si el usuario ha seleccionado una imagen para el producto.
	    {
	    	$error = "";
	    	if($imagen['type'] == "image/jpeg" || $imagen['type'] == "image/png" || $imagen['type'] == "image/x-icon" || $imagen['type'] == "image/gif")
	        {

			        //Se dispara la función para agregar un producto y se manda de parámetro el nombre de la imagen.
					mthAgregar($nombre, $descripcion, $precio, $marca, $categoria, $existencia);
					if($imagen['name'] != null)
					{
						$imagenx = Validator::validateImage($imagen);
						if($imagenx != false)
						{
						mthAgregarF($imagenx);
						}
						else{
							throw new Exception("La imagen numero uno no es valida");
						}
					}
					if($imagen2['name']!=null)
					{
						$imagen2x = Validator::validateImage($imagen2);
						if($imagen2x != false)
						{
							mthAgregarF($imagen2x);
						}
						else {
							throw new Exception("La imagen numero dos no es valida");
						}
					}
					if($imagen3['name']!=null)
					{
						$imagen3x = Validator::validateImage($imagen3);
						if($imagen3x != false)
						{
							mthAgregarF($imagen3x);
						}
						else {
							throw new Exception("La imagen numero tres no es valida");
						}
					}
					if($imagen4['name']!=null)
					{
						$imagen4x = Validator::validateImage($imagen4);
						if($imagen4x != false)
						{
							mthAgregarF($imagen4x);
						}
						else {
							throw new Exception("La imagen numero cuatro no es valida");
						}
					}
				//}
				//else
				//{
					$error = "La dimensión de la imagen no es apropiada.";
				//}
	    	}
	    	else
	    	{
	    		$error = "El formato de la imagen no es válido.";
	    	}
	    }
	}
?>