<?php
    			require("../bibliotecas/database.php");
				Database::connect();
    			if(isset($_POST['txtBuscar']) != "")
    			{
    				$buscar = strip_tags(trim($_POST['txtBuscar']));
    				$consulta = "SELECT id_comentario, usuario, comentarios.id_usuario, titulo, contenido FROM comentarios, usuarios WHERE comentarios.id_usuario = usuarios.id_usuario AND (titulo LIKE '%$buscar%' OR contenido LIKE '%$buscar%')";
    			}
    			else
    			{
    				$consulta = "SELECT id_comentario, usuario, comentarios.id_usuario, titulo, contenido FROM comentarios, usuarios WHERE comentarios.id_usuario = usuarios.id_usuario";
    			}
    			
    			$tabla = ""; //Arreglo de datos
    			foreach(Database::$connection->query($consulta) as $datos)
    			{
					$dataE = base64_encode($datos['id_comentario']);
					$tabla .= "<ul class='collection'>";
					$tabla .= "<li class='collection-item dismissable'>";
						$tabla .= "<div>";     							
							$tabla .= "<p id='texto_tabla'>";
							$tabla .= "<strong>Usuario: </strong>".htmlspecialchars($datos['id_comentario'])."<br>";
								$tabla .= "<strong>Usuario: </strong>".htmlspecialchars($datos['usuario'])."<br>";
								$tabla .= "<strong>Titulo: </strong>".htmlspecialchars($datos['titulo'])."<br>";
								$tabla .= "<strong>Contenido: </strong type = 'password'>".htmlspecialchars($datos['contenido'])."<br>";
							$tabla .= "</p>";
							$tabla .= "<div class = 'row'>";
							$tabla .= "<a class='btn waves-effect waves-light red col s12 m4 l2 offset-l1 offset-m1' href='delete_coment.php?id=$datos[id_comentario]'>Eliminar<i id='img_btn' class='material-icons left'>delete</i></a>";
							$tabla .= "</div>";
						$tabla .= "</div>";
					$tabla .= "</li>";
					$tabla .= "</ul>";
    			}
    			print($tabla);
    			Database::$connection = null;
				Database::desconnect();
    		?>