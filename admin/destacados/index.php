<!-- Se referencia el archivo de la conexion y nuestras clases -->
<?php require("../../bibliotecas/database.php"); ?>
<!-- Se especifica el tipo de documento "html" -->
<!DOCTYPE html>
<!-- Se especifica el idioma del sitio, en este caso español -->
<html lang="es">
	<head>
		<title>Destacados</title>
		<!-- Se incluye el archivo que llama nuestras hojas de estilo -->
		<?php include '../../inc/styles2.php'; ?>
	</head>
	<body>
	<?php
	 include '../../inc/menu2.php'; 
	 if(!$_SESSION['tipo']==1){
          header("location: ../../public/login.php");
        }  
	 ?>
		<div class="card-panel paneles">
			<!-- Se crea el formulario de busqueda -->
			<div class="titulo">
				<h3>Destacados</h3>
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
				<!-- Se incluye el boton de agregar un nuevo anuncio -->
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
			$sql = "SELECT * FROM destacados WHERE titulo LIKE ? ORDER BY id_destacado";
			$params = array("%$search%");
		}
		else
		{
			$sql = "SELECT * FROM destacados ORDER BY id_destacado";
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
										<th>Imagen</th>
										<th>Título</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>";
				foreach($data as $row)
				{
					$dataE = base64_encode($row['id_destacado']);
					$tabla .= 	"<tr>
									<td>".htmlspecialchars($row['id_destacado'])."</td>
									<td><img class='responsive-img' src='data:image/*;base64,$row[imagen]' width='100'/></td>
									<td>".htmlspecialchars($row[titulo])."</td>
									<td>
										<a href='save.php?id={$dataE}' class='btn blue'><i class='material-icons'>edit</i></a>
										<a href='delete.php?id={$dataE}' class='btn red'><i class='material-icons'>delete</i></a>
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