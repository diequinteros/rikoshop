<?php
    			require("../bibliotecas/database.php");
				Database::connect();
    			if(isset($_POST['txtBuscar']) != "")
    			{
    				$buscar = $_POST['txtBuscar'];
    				$consulta = "SELECT id_usuario, usuario, email, clave, nombre, apellido, tipo FROM usuarios, tipo_usuario WHERE usuarios.id_tipo = tipo_usuario.id_tipo AND usuarios.id_tipo = 2 AND usuario LIKE '%$buscar%'";
    			}
    			else
    			{
    				$consulta = "SELECT id_usuario, usuario, email, clave, nombre, apellido, tipo FROM usuarios, tipo_usuario WHERE usuarios.id_tipo = tipo_usuario.id_tipo AND usuarios.id_tipo = 2";
    			}
    			
    			$tabla = ""; //Arreglo de datos
    			foreach(Database::$connection->query($consulta) as $datos)
    			{
					$tabla .= "<ul class='collection'>";
					$tabla .= "<li class='collection-item dismissable'>";
						$tabla .= "<div>";     							
							$tabla .= "<p id='texto_tabla'>";
								$tabla .= "<strong>Usuario: </strong>$datos[usuario]<br>";
								$tabla .= "<strong>E-mail: </strong>$datos[email]<br>";
								$tabla .= "<strong>Contraseña: </strong type = 'password'>$datos[clave]<br>";
								$tabla .= "<strong>Nombre: </strong>$datos[nombre]<br>";
								$tabla .= "<strong>Apellido: </strong>$datos[apellido]<br>";
								$tabla .= "<strong>Tipo: </strong>$datos[tipo]<br>";
							$tabla .= "</p>";
							$tabla .= "<div class = 'row'>";
							$tabla .= "<a class='btn waves-effect waves-light red col s12 m4 l2 offset-l1 offset-m1' href='delete_cliente.php?id=$datos[id_usuario]'>Eliminar<i id='img_btn' class='material-icons left'>delete</i></a>";
							$tabla .= "</div>";
						$tabla .= "</div>";
					$tabla .= "</li>";
					$tabla .= "</ul>";
    			}
    			print($tabla);
    			Database::$connection = null;
				Database::desconnect();
    		?>