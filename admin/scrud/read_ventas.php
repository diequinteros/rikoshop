<?php
    			require("../bibliotecas/database.php");
				Database::connect();
    			if(isset($_POST['txtBuscar']) != "")
    			{
    				$buscar = strip_tags(trim($_POST['txtBuscar']));
    				$consulta = "SELECT id_venta, usuario, total, Fecha FROM ventas, usuarios WHERE ventas.id_usuario = usuarios.id_usuario  AND Fecha LIKE '%$buscar%'";
    			}
    			else
    			{
    				$consulta = "SELECT id_venta, usuario, total, Fecha FROM ventas, usuarios WHERE ventas.id_usuario = usuarios.id_usuario";
    			}
    			
    			$tabla = ""; //Arreglo de datos
    			foreach(Database::$connection->query($consulta) as $datos)
    			{
					$dataE = base64_encode($datos['id_venta']);
					$tabla .= "<ul class='collection'>";
					$tabla .= "<li class='collection-item dismissable'>";
						$tabla .= "<div>";     							
							$tabla .= "<p id='texto_tabla'>";
								$tabla .= "<strong>Id de venta: </strong>".htmlspecialchars($datos['id_venta'])."<br>";
								$tabla .= "<strong>Usuario: </strong>".htmlspecialchars($datos['usuario'])."<br>";
								$tabla .= "<strong>Total: </strong>".htmlspecialchars($datos['total'])."<br>";
								$tabla .= "<strong>Fecha: </strong>".htmlspecialchars($datos['Fecha'])."<br>";
							$tabla .= "</p>";
							$tabla .= "<div class = 'row'>";
							$tabla .= "<a class='btn waves-effect waves-light red col s12 m4 l2 offset-l1 offset-m1' href='delete_venta.php?id=$datos[id_venta]'>Eliminar<i id='img_btn' class='material-icons left'>delete</i></a>";
							$tabla .= "</div>";
						$tabla .= "</div>";
					$tabla .= "</li>";
					$tabla .= "</ul>";
    			}
    			print($tabla);
    			Database::$connection = null;
				Database::desconnect();
    		?>