<?php
$datos;
$datos2;
    			
				Database::connect();
    			if(isset($_POST['txtBuscar']) != "")
    			{
    				$buscar = strip_tags(trim($_POST['txtBuscar']));
    				$consulta = "SELECT id_producto, nombre_producto, descripcion_pro, precio, marcas.marca, categorias.categoria, existencia FROM productos, marcas, categorias WHERE productos.id_marca = marcas.id_marca AND productos.id_categoria = categorias.id_categoria AND nombre_producto LIKE '%$buscar%'";
					
    			}
    			else
    			{
    				$consulta = "SELECT id_producto, nombre_producto, descripcion_pro, precio, marcas.marca, categorias.categoria, existencia FROM productos, marcas, categorias WHERE productos.id_marca = marcas.id_marca AND productos.id_categoria = categorias.id_categoria";
					
    			}
    			$datos = "";
				
    			$tabla = ""; //Arreglo de datos
    			foreach(Database::$connection->query($consulta) as $datos)
    			{
					$idfo1 = null;
					$idfo2 = null;
					$idfo3 = null;
					$idfo4 = null;
					$tabla .= "<ul class='collection'>";
					$tabla .= "<li class='collection-item dismissable'>";
						$tabla .= "<div>";
						$consulta2 = "SELECT id_imagen, imagen, imagenes.id_producto FROM imagenes, productos WHERE imagenes.id_producto = productos.id_producto AND imagenes.id_producto = '$datos[id_producto]'";
						foreach (Database::$connection ->query($consulta2) as $datos2) {
						$tabla .= "<img id='foto_perfil' src='data:image/*;base64,$datos2[imagen]' class='responsive-img' width='230'>";
						if($idfo1 == null)
						{
							$idfo1 = base64_encode($datos2['id_imagen']);
						}
						else {
							if($idfo2 == null)
							{
								$idfo2 = base64_encode($datos2['id_imagen']);
							}
							else {
								if($idfo3 == null)
								{
									$idfo3 = base64_encode($datos2['id_imagen']);
								}
								else {
									if($idfo4 == null)
									{
										$idfo4 = base64_encode($datos2['id_imagen']);
									}
								}
							}
						}	
						}
						$dataE = base64_encode($datos['id_producto']);     							
							$tabla .= "<p id='texto_tabla'>";
							//Se usa htmlspecialchars para escapar los datos
								$tabla .= "<strong>Nombre producto: </strong>".htmlspecialchars($datos['nombre_producto'])."<br>";
								$tabla .= "<strong>Descripcion: </strong>".htmlspecialchars($datos['descripcion_pro'])."<br>";
								$tabla .= "<strong>Precio: </strong>".htmlspecialchars($datos[precio])."<br>";
								$tabla .= "<strong>Marca: </strong>".htmlspecialchars($datos['marca'])."<br>";
								$tabla .= "<strong>Existencias: </strong>".htmlspecialchars($datos['existencia'])."<br>";
								
							$tabla .= "</p>";
							$tabla .= "<div class = 'row'>";
							$tabla .= "<a class='btn waves-effect waves-light light-blue col s12 m4 l2' href='update_producto.php?id=$datos[id_producto]&idf1=$idfo1&idf2=$idfo2&idf3=$idfo3&idf4=$idfo4'>Modificar<i id='img_btn' class='material-icons left'>mode_edit</i></a>";
							$tabla .= "<a class='btn waves-effect waves-light red col s12 m4 l2 offset-l1 offset-m1' href='delete_producto.php?id=$datos[id_producto]'>Eliminar<i id='img_btn' class='material-icons left'>delete</i></a>";
							$tabla .= "</div>";
						$tabla .= "</div>";
					$tabla .= "</li>";
					$tabla .= "</ul>";
    			}
    			print($tabla);
    			Database::$connection = null;
				Database::desconnect();
    		?>