<?php
    			
				Database::connect();
    			if(isset($_POST['txtBuscar']) != "")
    			{
    				$buscar = strip_tags(trim($_POST['txtBuscar']));
    				$consulta = "SELECT id_usuario, usuario, email, clave, nombre, apellido, tipo FROM usuarios, tipo_usuario WHERE usuarios.id_tipo = tipo_usuario.id_tipo AND usuarios.id_tipo = 2 AND usuario LIKE '%$buscar%'";
    			}
    			else
    			{
    				$consulta = "SELECT id_usuario, usuario, email, clave, nombre, apellido, tipo FROM usuarios, tipo_usuario WHERE usuarios.id_tipo = tipo_usuario.id_tipo AND usuarios.id_tipo = 2";
    			}
    			
    			$tabla = ""; //Arreglo de datos
    			foreach(Database::$connection->query($consulta) as $datos)
    			{
					$dataE = base64_encode($datos['id_usuario']);
					$tabla .= "<ul class='collection'>";
					$tabla .= "<li class='collection-item dismissable'>";
						$tabla .= "<div>";     							
							$tabla .= "<p id='texto_tabla'>";
								$tabla .= "<strong>Usuario: </strong>".htmlspecialchars($datos['usuario'])."<br>";
								$tabla .= "<strong>E-mail: </strong>".htmlspecialchars($datos['email'])."<br>";
								$tabla .= "<strong>Contraseña: </strong type = 'password'>".htmlspecialchars($datos['clave'])."<br>";
								$tabla .= "<strong>Nombre: </strong>".htmlspecialchars($datos['nombre'])."<br>";
								$tabla .= "<strong>Apellido: </strong>".htmlspecialchars($datos['apellido'])."<br>";
								$tabla .= "<strong>Tipo: </strong>".htmlspecialchars($datos['tipo'])."<br>";
							$tabla .= "</p>";
							$tabla .= "<div class = 'row'>";
							$tabla .= "<a class='btn waves-effect waves-light light-blue col s12 m4 l2' href='update_usuario.php?id=$datos[id_usuario]'>Modificar<i id='img_btn' class='material-icons left'>mode_edit</i></a>";
							$tabla .= "<a class='btn waves-effect waves-light red col s12 m4 l2 offset-l1 offset-m1' href='delete_usuario.php?id=$datos[id_usuario]'>Eliminar<i id='img_btn' class='material-icons left'>delete</i></a>";
							$tabla .= "</div>";
						$tabla .= "</div>";
					$tabla .= "</li>";
					$tabla .= "</ul>";
    			}
    			print($tabla);
    			Database::$connection = null;
				Database::desconnect();
    		?>