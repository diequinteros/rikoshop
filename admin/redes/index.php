<!-- Se referencia el archivo de la conexion y nuestras clases -->
<?php require("../../bibliotecas/database.php"); ?>
<!-- Se especifica el tipo de documento "html" -->
<!DOCTYPE html>
<!-- Se especifica el idioma del sitio, en este caso español -->
<html lang="es">
	<head>
		<title>Redes Sociales</title>
		<!-- Se incluye el archivo que llama nuestras hojas de estilo -->
		<?php include '../../inc/styles2.php'; ?>
	</head>
	<body>
	<?php include '../../inc/menu2.php'; ?>
		<div class="card-panel paneles">
			<!-- Se crea el formulario de busqueda -->
			<div class="titulo">
				<h3>Redes Sociales</h3>
			</div>
			<br>
			<form method='post' class='row' autocomplete="off">
				<div class='input-field col s6 m4'>
					<i class='material-icons prefix'>search</i>
					<input id='buscar' type='text' name='buscar' class='validate'/>
					<label for='buscar' class='active'>Búsqueda</label>
				</div>
				<div class='input-field col s6 m4'>
					<button type='submit' class='btn grey left'><i class='material-icons right'>pageview</i>Buscar</button> 	
				</div>
				<!-- Se incluye el boton de agregar una nueva red social  -->
				<div class='input-field col s12 m4'>
					<a href='save.php' class='btn indigo'><i class='material-icons right'>add_circle</i>Nuevo</a>
				</div>
			</form>
		</div>
		<!-- Se realizan las operaciones de busqueda con la consulta "SELECT" -->
		<?php
		if(!empty($_POST))
		{
			$search = strip_tags(trim($_POST['buscar']));
			$sql = "SELECT * FROM redes WHERE red LIKE ? ORDER BY id_red";
			$params = array("%$search%");
		}
		else
		{
			$sql = "SELECT * FROM redes ORDER BY id_red";
			$params = null;
		}
		//A traves de un arreglo se muestran los datos en la tabla 
		$data = Database::getRows($sql, $params);
		if($data != null)
		{
			$tabla = 	"<div class='card-panel paneles'>
							<table class='centered striped responsive-table'>
								<thead>
									<tr>
										<th>ID</th>
										<th>Red Social</th>
										<th>URL</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>";
				foreach($data as $row)
				{
					$tabla .= 	"<tr>
									<td>$row[id_red]</td>
									<td>$row[red]</td>
									<td>$row[url]</td>
									<td>
										<a href='save.php?id=$row[id_red]' class='btn blue'><i class='material-icons'>edit</i></a>
										<a href='delete.php?id=$row[id_red]' class='btn red'><i class='material-icons'>delete</i></a>
									</td>
								</tr>";
				}
				$tabla .= "</tbody>
						</table>
					</div>";
			print($tabla);
		}
		else
		{
			print("<br><div class='card-panel paneles'><i class='material-icons left'>warning</i>No hay registros.</div>");
		}
	?>
	<!-- Se incluye el archivo que referencia los scripts del sitios -->
	<?php include '../../inc/scripts2.php'; ?>
	</body>
	<!-- Asi como el footer del sitio -->
	<?php require("../../inc/footer2.php"); ?>
</html>