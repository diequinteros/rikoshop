<!-- Primero referenciamos los archivos que enlazan las clases de conexion, las consultas y las validaciones -->
<?php
require("../bibliotecas/database.php");
//Se revisa que los campos esten vacios para validarlos y se empieza con los procesos
if(!empty($_POST))
{
  	$respuesta = $_POST['respuesta'];
  	try
    {
		//Se verifica que el usuario y la clave no esten vacios
      	if(strip_tags(trim($respuesta)) != "")
  		{
			//Se realiza la consulta para ver si el usuario ingresado existe y extraer su pregunta de recuperación
  			$sql = "SELECT * FROM usuarios WHERE usuario = ? AND respuesta = ?";
		    $param = array($_SESSION['usuario'], $respuesta);
		    $data = Database::getRow($sql, $param);
		    if($data != null)
		    {
		    	header("location: recuperar3.php");
		    }
			//Si la consulta no devuelve valores, el usuario no existe
		    else
		    {
				throw new Exception("Respuesta equivocada");
		    }
	  	}
	  	else
	  	{
	    	throw new Exception("Debes ingresar una respuesta");
	  	}
    }
	//Por medio de este catch se capturan todos los errores que pueden surgir
    catch (Exception $error)
    {
        print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
    }
}
else
{
    $sql = "SELECT * FROM usuarios WHERE usuario = ?";
    $params = array($_SESSION['usuario']);
    $data = Database::getRow($sql, $params);
    $pregunta = $data['pregunta'];
    $respuesta = $data['respuesta'];
}
?>
<!-- Se crea el formulario de login -->
<!-- Se especifica el tipo de documento, html -->
<!DOCTYPE html>
<!-- Se especifica el idioma del sitio, español -->
<html lang='es'>
	<head>
		<title>Recuperación</title>
		<!-- Se relaciona el archivo que referencia las hojas de estilo del sitio -->
		<?php include '../inc/styles.php'; ?>
		<meta charset="utf-8">
	</head>
	<body>
	<?php include '../inc/menu2.php'; ?>
		<div class="log_form">
			<div class="center-align" id="log_tt">
				<h3>Recuperar contraseña</h3>
			</div>
			<!-- Se crea el formulario de login -->
			<form class='row' method='post'>
				<div class='row'>
					<div class='input-field col m12 offset-m3 s12'>
						<i class='material-icons prefix'>lightbulb_outline</i>
						<input id='pregunta' type='text' name='pregunta' class='validate'  value='<?php print($pregunta); ?>' disabled/>
						<label class='active black-text' for='pregunta'>Pregunta:</label>
					</div>
                    <div class='input-field col m12 offset-m3 s12'>
						<i class='material-icons prefix'>settings_voice</i>
						<input id='respuesta' type='text' name='respuesta' class='validate' required/>
						<label class='active black-text' for='respuesta'>Respuesta:</label>
					</div>
				</div>
				<div class="center-align">
					<button type='submit' class='btn blue'><i class='material-icons right'>swap_horiz</i>Aceptar</button>
				</div>
			</form>
		</div>
		<!-- Por ultimo se relaciona el archivo que enlaza los scripts del sitio -->
		<?php include '../inc/scripts.php'; ?>
		<!-- Asi como el footer del sitio -->
	    <?php require("../inc/footer2.php"); ?>
	</body>
</html>