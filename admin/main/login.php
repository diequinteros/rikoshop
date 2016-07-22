<!-- Primero referenciamos los archivos que enlazan las clases de conexion, las consultas y las validaciones -->
<?php
require("../../lib/conexion.php");
require("../../lib/validator.php");
session_start(true);

//Se revisa que los campos esten vacios para validarlos y se empieza con los procesos
if(!empty($_POST))
{
	$_POST = validator::validateForm($_POST);
  	$codigo = $_POST['codigo'];
  	$clave = $_POST['clave'];
  	try
    {
		//Se verifica que el codigo y la clave no esten vacios
      	if($codigo != "" && $clave != "")
  		{
			  //Se realiza la consulta para ver si el codigo ingresado es de un ex-alumno, un alumno o un administrador
			  //Primero se evalua si es ex-alumno
  			$sql = "SELECT * FROM ex_alumnos WHERE id_exalumnos = ?";
		    $param = array($codigo);
		    $data = Database::getRows($sql, $param);
		    if($data != null)
		    {
		    	$hash = $data[0]['contraseña'];
		    	if($clave == $hash) 
				//Si es ex-alumno, redirecciona al sitio publico del ex-alumno
		    	{
			    	$_SESSION['id_exalumnos'] = $codigo;
			      	$_SESSION['nombre_usuario'] = $data[0]['nombre1']." ".$data[0]['apellido1'];
			      	header("location: ../../dashboard/main/profile.php");
				}
				else 
				{
					throw new Exception("La clave ingresada es incorrecta.");
				}
		    }
			//Si no es ex-alumno continua evaluando las siguientes posibilidades
			//Se prueba si es alumno
		    else
		    {
		    	$sql = "SELECT * FROM alumnos WHERE carnet = ?";
				$param = array($codigo);
				$data = Database::getRows($sql, $param);
				if($data != null)
				//Si es asi, redirecciona al sitio publico del alumno
				{
					$hash = $data[0]['contraseña'];
					if($clave == $hash) 
					{
						$_SESSION['carnet'] = $data[0]['carnet'];
						$_SESSION['nombre_usuario'] = $data[0]['nombre1']." ".$data[0]['nombre2']." ".$data[0]['apellido1']." ".$data[0]['apellido2'];
						header("location: ../../public/alumno/index.php");
					}
					else 
					{
						throw new Exception("La clave ingresada es incorrecta2.");
					}
				}
				//Como ultima instancia prueba a ver si el codigo es de un administrador
				else 
				{
					$sql = "SELECT * FROM administradores WHERE codigo_admin = ?";
					$param = array($codigo);
					$data = Database::getRows($sql, $param);
					if($data != null)
					//Si es asi, redirecciona al sitio privado o a la dashboard siendo estos los accesos del administrador
					{
						$hash = $data[0]['contraseña_admin'];
						if($clave == $hash) 
						{
							$_SESSION['codigo_admin'] = $data[0]['codigo_admin'];
							$_SESSION['nombre_usuario'] = "Administrador";
							header("location: index.php");
						}
						else 
						{
							throw new Exception("La clave ingresada es incorrecta3.");
						}
					}
					//De lo contrario se le muestra un mensaje al usuario, advirtiendole que no existe usuario con ese codigo
					else
					{
						throw new Exception("No existe usuario con ese código.");
					}
				}
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
		<?php include '../../inc/styles.php'; ?>
		<meta charset="utf-8">
	</head>
	<body class="orange darken-3">
		<div class="orange darken-3 log_form">
			<div class="titulo" id="log_tt">
				<h3>Iniciar Sesión</h3>
			</div>
			<!-- Se crea el formulario de login -->
			<form class='row' method='post'>
				<div class='row'>
					<div class='input-field col m6 offset-m3 s12'>
						<i class='material-icons prefix'>person_pin</i>
						<input id='codigo' type='text' name='codigo' class='validate black-text' required/>
						<label class='active black-text' for='codigo'>Código</label>
					</div>
					<div class='input-field col m6 offset-m3 s12'>
						<i class='material-icons prefix'>vpn_key</i>
						<input id='clave' type='password' name='clave' class="validate black-text" required/>
						<label class='active black-text' for='clave'>Clave</label>
					</div>
				</div>
				<div class="titulo" id="log_btn">
					<button type='submit' class='btn blue'><i class='material-icons right'>swap_horiz</i>Aceptar</button>
				</div>
			</form>
		</div>
		<div class='orange darken-1 log_foot'>
		</div>
		<!-- Por ultimo se relaciona el archivo que enlaza los scripts del sitio -->
		<?php include '../../inc/scripts.php'; ?>
	</body>
</html>