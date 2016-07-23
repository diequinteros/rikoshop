<?php
    			require("../bibliotecas/database.php");
				Database::connect();
    			if(isset($_POST['txtBuscar']) != "")
    			{
    				$buscar = strip_tags(trim($_POST['txtBuscar']));
    				$consulta = "SELECT id_sucusales, paises.nombre_pais, estado, ciudad, direccion, telefono FROM sucursales, paises WHERE sucursales.id_pais = paises.id_pais  AND paises.nombre_pais LIKE '%$buscar%'";
    			}
    			else
    			{
    				$consulta = "SELECT id_sucusales, sucursales.id_pais, paises.id_pais, paises.nombre_pais, estado, ciudad, direccion, telefono FROM sucursales, paises WHERE sucursales.id_pais = paises.id_pais";
    			}
    			
    			$tabla = ""; //Arreglo de datos
    			foreach(Database::$connection->query($consulta) as $datos)
    			{
					$tabla .= "<ul class='collection'>";
					$tabla .= "<li class='collection-item dismissable'>";
						$tabla .= "<div>";     							
							$tabla .= "<p id='texto_tabla'>";
								$tabla .= "<strong>Pais: </strong>".htmlspecialchars($datos['nombre_pais'])."<br>";
								$tabla .= "<strong>Estado: </strong>".htmlspecialchars($datos['estado'])."<br>";
								$tabla .= "<strong>Ciudad: </strong>".htmlspecialchars($datos['ciudad'])."<br>";
								$tabla .= "<strong>Direccion: </strong>".htmlspecialchars($datos['direccion'])."<br>";
								$tabla .= "<strong>Telefono: </strong>".htmlspecialchars($datos['telefono'])."<br>";
							$tabla .= "</p>";
							$tabla .= "<div class = 'row'>";
							$tabla .= "<a class='btn waves-effect waves-light light-blue col s12 m4 l2' href='update_sucursal.php?id=$datos[id_sucusales]'>Modificar<i id='img_btn' class='material-icons left'>mode_edit</i></a>";
							$tabla .= "<a class='btn waves-effect waves-light red col s12 m4 l2 offset-l1 offset-m1' href='delete_sucursal.php?id=$datos[id_sucusales]'>Eliminar<i id='img_btn' class='material-icons left'>delete</i></a>";
							$tabla .= "</div>";
						$tabla .= "</div>";
					$tabla .= "</li>";
					$tabla .= "</ul>";
    			}
    			print($tabla);
    			Database::$connection = null;
				Database::desconnect();
    		?>