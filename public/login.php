<!-- Primero referenciamos los archivos que enlazan las clases de conexion, las consultas y las validaciones -->
<?php
require("../bibliotecas/database.php");
//Se revisa que los campos esten vacios para validarlos y se empieza con los procesos
if(!empty($_POST))
{
  	$usuario = $_POST['usuario'];
  	$clave = $_POST['clave'];
  	try
    {
		//Se verifica que el usuario y la clave no esten vacios
      	if($usuario != "" && $clave != "")
  		{
			//Se realiza la consulta para ver si el usuario ingresado es de un administrador o un cliente
			//Se evalua el tipo de usuario para dicha tarea
  			$sql = "SELECT * FROM usuarios WHERE usuario = ?";
		    $param = array($usuario);
		    $data = Database::getRow($sql, $param);
		    if($data != null)
		    {
		    	$hash = $data['clave'];
				$tipo = $data['id_tipo'];
		    	if($clave == $hash) 
				//Una vez analizados los datos ingresados, se filtra por el tipo de usuario
		    	{
					$_SESSION['id_usuario'] = $data['id_usuario'];
						$_SESSION['nombre_usuario'] = $data['usuario'];
						$_SESSION['tipo'] = $data['id_tipo'];
					if($tipo == 1){
						
						header("location: ../admin/index.php");
					}
					if($tipo == 2){
						header("location: index.php");
					}
				}
				else 
				{
					throw new Exception("La clave ingresada es incorrecta.");
				}
		    }
			//Si la consulta no devuelve valores, el usuario no existe
		    else
		    {
				throw new Exception("No existe usuario con ese usuario.");
		    }
	  	}
	  	else
	  	{
	    	throw new Exception("Debe ingresar un codigo y una clave.");
	  	}
    }
	//Por medio de este catch se capturan todos los errores que pueden surgir
    catch (Exception $error)
    {
        print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
    }
}
?>
<!-- Se crea el formulario de login -->
<!-- Se especifica el tipo de documento, html -->
<!DOCTYPE html>
<!-- Se especifica el idioma del sitio, español -->
<html lang='es'>
	<head>
		<title>Iniciar Sesion</title>
		<!-- Se relaciona el archivo que referencia las hojas de estilo del sitio -->
		<?php include '../inc/styles.php'; ?>
		<meta charset="utf-8">
	</head>
	<body>
	<?php include '../inc/menu2.php'; ?>
		<div class="log_form">
			<div class="center-align" id="log_tt">
				<h3>Iniciar Sesión</h3>
			</div>
			<!-- Se crea el formulario de login -->
			<form class='row' method='post'>
				<div class='row'>
					<div class='input-field col m6 offset-m3 s12'>
						<i class='material-icons prefix'>person_pin</i>
						<input id='usuario' type='text' name='usuario' class='validate black-text' required/>
						<label class='active black-text' for='usuario'>Usuario</label>
					</div>
					<div class='input-field col m6 offset-m3 s12'>
						<i class='material-icons prefix'>vpn_key</i>
						<input id='clave' type='password' name='clave' class="validate black-text" required/>
						<label class='active black-text' for='clave'>Clave</label>
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