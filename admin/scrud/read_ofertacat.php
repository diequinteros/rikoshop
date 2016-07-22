<?php
    			require("../bibliotecas/database.php");
				Database::connect();
    			if(isset($_POST['txtBuscar']) != "")
    			{
    				$buscar = strip_tags(trim($_POST['txtBuscar']));
    				$consulta = "SELECT id_oferta_c, ofertas_categoria.id_categoria, categoria, porcentaje FROM ofertas_categoria, categorias WHERE categorias.id_categoria = ofertas_categoria.id_categoria AND categorias.categoria LIKE '%$buscar%'";
    			}
    			else
    			{
    				$consulta = "SELECT id_oferta_c, ofertas_categoria.id_categoria, categoria, porcentaje FROM ofertas_categoria, categorias WHERE categorias.id_categoria = ofertas_categoria.id_categoria";
    			}
    			
    			$tabla = ""; //Arreglo de datos
    			foreach(Database::$connection->query($consulta) as $datos)
    			{
					$tabla .= "<ul class='collection'>";
					$tabla .= "<li class='collection-item dismissable'>";
						$tabla .= "<div>";     							
							$tabla .= "<p id='texto_tabla'>";
								$tabla .= "<strong>Categoria: </strong>$datos[categoria]<br>";
								$tabla .= "<strong>Porcentaje: </strong>$datos[porcentaje]<br>";
							$tabla .= "</p>";
							$tabla .= "<div class = 'row'>";
							$tabla .= "<a class='btn waves-effect waves-light light-blue col s12 m4 l2' href='update_ofertacat.php?id=$datos[id_oferta_c]'>Modificar<i id='img_btn' class='material-icons left'>mode_edit</i></a>";
							$tabla .= "<a class='btn waves-effect waves-light red col s12 m4 l2 offset-l1 offset-m1' href='delete_ofertacat.php?id=$datos[id_categoria]'>Eliminar<i id='img_btn' class='material-icons left'>delete</i></a>";
							$tabla .= "</div>";
						$tabla .= "</div>";
					$tabla .= "</li>";
					$tabla .= "</ul>";
    			}
    			print($tabla);
    			Database::$connection = null;
				Database::desconnect();
    		?>