<?php
require("../../lib/conexion.php");
require("../../lib/validator.php");
session_start(true);

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
  	$contraseña = strip_tags(trim($_POST['contraseña']));
  	$nombre = strip_tags(trim($_POST['nombre1']));
    $apellido = strip_tags(trim($_POST['apellido1']));
    $telefono = strip_tags(trim($_POST['telefono']));
    $ocupacion = strip_tags(trim($_POST['ocupacion']));
    $correo = strip_tags(trim($_POST['correo_electronico']));
    $observacion = strip_tags(trim($_POST['observacion']));

    try 
    {
      	if($contraseña != "" && $nombre != "" && $apellido != "" && $telefono != "" && $ocupacion != "" && $correo != "" && $observacion != "")
        {
            $clave = password_hash($clave1, PASSWORD_DEFAULT);
            $sql = "UPDATE ex_alumnos SET contraseña = ?, nombre1= ?, apellido1 = ?, telefono = ?, ocupacion = ?, correo_electronico = ?, observacion = ? WHERE id_exalumnos = ?";
            $params = array($contraseña, $nombre, $apellido, $telefono, $ocupacion, $correo, $observacion, $_SESSION['id_exalumnos']);
        }
        else
        {
            throw new Exception("Debe llenar todos los campos del formulario.");
        }
        Database::executeRow($sql, $params);
        header("location: ../../public/exalumno/index.php");
    }
    catch (Exception $error)
    {
        print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
    }
}
else
{
    $sql = "SELECT contraseña, nombre1, apellido1, telefono, ocupaciones.id_ocupacion, correo_electronico, observacion FROM ex_alumnos, ocupaciones WHERE ex_alumnos.ocupacion = ocupaciones.id_ocupacion AND id_exalumnos = ?";
    $params = array($_SESSION['id_exalumnos']);
    $data = Database::getRows($sql, $params);
    $contraseña = $data[0]['contraseña'];
    $nombre = $data[0]['nombre1'];
    $apellido = $data[0]['apellido1'];
    $telefono = $data[0]['telefono'];
    $ocupacion = $data[0]['id_ocupacion'];
    $correo = $data[0]['correo_electronico'];
    $observacion = $data[0]['observacion'];
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Perfil</title>
        <?php include '../../inc/styles.php'; ?>
        <meta charset="utf-8">
    </head>
    <body>
        <div class="card-panel paneles">
            <form method='post' class='row' enctype='multipart/form-data' autocomplete="off">
                <div class='row'>
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>assignment_ind</i>
                        <input id='nombres' type='text' name='nombres' class='validate' length='50' maxlenght='50' value='<?php print($nombres); ?>' required/>
                        <label for='nombres'>Nombres</label>
                    </div>
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>assignment_ind</i>
                        <input id='apellidos' type='text' name='apellidos' class='validate' length='50' maxlenght='50' value='<?php print($apellidos); ?>' required/>
                        <label for='apellidos'>Apellidos</label>
                    </div>
                </div>
                <div class='row'>
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>email</i>
                        <input id='correo' type='email' name='correo' class='validate' length='100' maxlenght='100' value='<?php print($correo); ?>'/>
                        <label for='correo'>Correo</label>
                    </div>
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>perm_identity</i>
                        <input id='alias' type='text' name='alias' class='validate' length='50' maxlenght='50' value='<?php print($alias); ?>' required/>
                        <label for='alias'>Alias</label>
                    </div>
                </div>
                <div class='row'>
                    <label>CAMBIAR CLAVE</label>
                </div>
                <div class='row'>
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>lock</i>
                        <input id='clave1' type='password' name='clave1' class='validate' length='25' maxlenght='25'/>
                        <label for='clave1'>Clave nueva</label>
                    </div>
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>lock</i>
                        <input id='clave2' type='password' name='clave2' class='validate' length='25' maxlenght='25'/>
                        <label for='clave2'>Confirmar clave</label>
                    </div>
                </div>
                <a href='../main/index.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
                <button type='submit' class='btn blue'><i class='material-icons right'>save</i>Guardar</button>
            </form>
        </div>
        <?php include '../../inc/scripts.php'; ?>
    </body>
</html>