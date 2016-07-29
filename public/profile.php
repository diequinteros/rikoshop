<?php
//Se relaciona la clase de la conexion a nuestra base
require("../bibliotecas/database.php");

if(!empty($_POST))
{
    //Se declaran las variables de la consulta
  	$usuario = strip_tags(trim($_POST['usuario']));
  	$email = strip_tags(trim($_POST['email']));
    $clave = strip_tags(trim($_POST['clave']));
    $id_pais = strip_tags(trim($_POST['id_pais']));
    $estado = strip_tags(trim($_POST['estado']));
    $ciudad = strip_tags(trim($_POST['ciudad']));
    $direccion = strip_tags(trim($_POST['direccion']));
    $codigo_postal = strip_tags(trim($_POST['codigo_postal']));
    $tarjeta = strip_tags(trim($_POST['tarjeta']));
    $telefono = strip_tags(trim($_POST['telefono']));
    $nombre = strip_tags(trim($_POST['nombre']));
    $apellido = strip_tags(trim($_POST['apellido']));
    try 
    {
      	if($usuario != "" && $email != "" && $clave != "" && $id_pais != "" && $estado != "" && $ciudad != "" && $direccion != "" && $codigo_postal != "" && $tarjeta != "" && $telefono != "" && $nombre != "" && $apellido != "")
        {
            //Se actualizan los datos
            $clave = password_hash($clave, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET usuario = ?, email = ?, clave = ?, id_pais = ?, estado = ?, ciudad = ?, direccion = ?, codigo_postal = ?, tarjeta = ?, telefono = ?, nombre = ?, apellido = ? WHERE id_usuario = ?";
            $params = array($usuario, $email, $clave, $id_pais, $estado, $ciudad, $direccion, $codigo_postal, $tarjeta, $telefono, $nombre, $apellido, $_SESSION['id_usuario']);
        }
        else
        {
            //Si se deja algun campo vacio el sistema no deja pasar
            throw new Exception("Debe llenar todos los campos del formulario.");
        }
        Database::executeRow($sql, $params);
        header("location: index.php");
    }
    catch (Exception $error)
    {
        print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
    }
}
else
{
    $sql = "SELECT * FROM usuarios, paises WHERE usuarios.id_pais = paises.id_pais AND id_usuario = ?";
    $params = array($_SESSION['id_usuario']);
    $data = Database::getRow($sql, $params);
    $usuario = $data['usuario'];
  	$email = $data['email'];
    $clave = $data['clave'];
    $id_pais = $data['id_pais'];
    $estado = $data['estado'];
    $ciudad = $data['ciudad'];
    $direccion = $data['direccion'];
    $codigo_postal = $data['codigo_postal'];
    $tarjeta = $data['tarjeta'];
    $telefono = $data['telefono'];
    $nombre = $data['nombre'];
    $apellido = $data['apellido'];
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Perfil</title>
        <!-- Se enlazan las hojas de estilo del sitio -->
        <?php include '../inc/styles.php'; ?>
        <meta charset="utf-8">
    </head>
    <body>
    <?php include '../inc/menu2.php'; ?>
        <div class="titulo">
            <h3>Tu perfil</h3>
        </div>
        <div class="card-panel paneles">
            <form method='post' class='row' enctype='multipart/form-data' autocomplete='off'>
                <div class='row'>
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>account_circle</i>
                        <input id='usuario' type='text' name='usuario' class='validate' length='50' maxlength='50' value='<?php print($usuario); ?>' required/>
                        <label class="active" for='usuario'>Usuario:</label>
                    </div>
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>email</i>
                        <input id='email' type='text' name='email' class='validate' length='100' maxlength='100' value='<?php print($email); ?>' required/>
                        <label class="active" for='email'>E-mail:</label>
                    </div>
                </div>
                <div class='row'>
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>lock</i>
                        <input id='clave' type='text' name='clave' class='validate' length='25' maxlenght='25' value='<?php print($clave); ?>'/>
                        <label class="active" for='clave'>Clave:</label>
                    </div>
                    <div class='input-field col s12 m6'>
                        <!-- Mediante las siguientes sentencias se llena el comboBox con los datos de Paises -->
                        <?php
                        $sql = "SELECT * FROM paises";
                        $data = Database::getRows($sql, null);
                        $combo = "<br><select class='browser-default' name='id_pais' required>";
                        if($id_pais == null)
                        {
                            $combo .= "<option value='' disabled selected>Seleccione un pais</option>";
                        }
                        foreach($data as $row)
                        {
                            $combo .= "<option value='$row[0]'";
                            if(isset($_POST['id_pais']) == $row[0] || $id_pais == $row[0])
                            {
                                $combo .= " selected";
                            }
                            $combo .= ">$row[1]</option>";
                        }	
                        $combo .= "</select>
                                <label class='active' style='text-transform: capitalize;'>Pais:</label>";
                        print($combo);
                        ?>
                    </div>
                </div>
                <div class='row'>
                    <div class='file-field input-field col s12 m6'>
                        <i class='material-icons prefix'>flag</i>
                        <input id='correo_electronico' type='text' name='estado' class='validate' length='100' maxlength='100' value='<?php print($estado); ?>'/>
                        <label class="active" for='estado'>Estado:</label>
                    </div>
                    <div class='file-field input-field col s12 m6'>
                        <i class='material-icons prefix'>business</i>
                        <input id='ciudad' type='text' name='ciudad' class='validate' length='100' maxlength='100' value='<?php print($ciudad); ?>'/>
                        <label class="active" for='ciudad'>Ciudad:</label>
                    </div>
                </div>
                <div class='row'>
                    <div class='file-field input-field col s12 m6'>
                        <i class='material-icons prefix'>room</i>
                        <input id='direccion' type='text' name='direccion' class='validate' length='200' maxlength='200' value='<?php print($direccion); ?>'/>
                        <label class="active" for='direccion'>Dirección:</label>
                    </div>
                    <div class='file-field input-field col s12 m6'>
                        <i class='material-icons prefix'>web</i>
                        <input id='codigo_postal' type='text' name='codigo_postal' class='validate' length='10' maxlength='10' value='<?php print($codigo_postal); ?>'/>
                        <label class="active" for='codigo_postal'>Código Postal:</label>
                    </div>
                </div>
                <div class='row'>
                    <div class='file-field input-field col s12 m6'>
                        <i class='material-icons prefix'>vignette</i>
                        <input id='tarjeta' type='text' name='tarjeta' class='validate' length='20' maxlength='20' value='<?php print($tarjeta); ?>'/>
                        <label class="active" for='tarjeta'>Tarjeta:</label>
                    </div>
                    <div class='file-field input-field col s12 m6'>
                        <i class='material-icons prefix'>business</i>
                        <input id='ciudad' type='text' name='ciudad' class='validate' length='100' maxlength='100' value='<?php print($ciudad); ?>'/>
                        <label class="active" for='ciudad'>Ciudad:</label>
                    </div>
                </div>
                <div class='titulo'>
                    <a href='index.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
                    <button type='submit' class='btn blue'><i class='material-icons right'>check_circle</i>Guardar</button>
                </div>
                <div>
                    <a href='versesiones.php' class='btn grey'><i class='material-icons right'></i>Ver sesiones abiertas</a>
                </div>
            </form>
        </div>
        <?php include '../inc/scripts.php'; ?>
    </body>
</html>