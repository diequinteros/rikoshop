<?php
//Se relaciona la clase de la conexion a nuestra base
require("../bibliotecas/database.php");
if(!empty($_POST))
            {
if(isset($_POST["g-recaptcha-response"]) && $_POST["g-recaptcha-response"])
	{
		//clave secreta proporcionada por recaptcha
		$clasecre = "6LdaPiYTAAAAAECt8Uy-aydBMZM_S4nIwS9Jjs1m";
		//ip de maquina que accesa a nuestro sitio
		$ip = $_SERVER["REMOTE_ADDR"];
		//respuesta del captcha
		$captcha = $_POST["g-recaptcha-response"];
		//resultado devuelto de la pagina verificadora de google
		$resultado = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$clasecre&&response=$captcha&&remoteip=$ip");
		//decodificamos el json y lo asignamos a una variable
		$array = json_decode($resultado, TRUE);
		//comprobamos si nos devuelve success (exito)
        
                if($array["success"])
                {
                    
                        //Se declaran las variables de la consulta
                        $usuario = $_POST['usuario'];
                        $id_tipo = 2;
                        $email = $_POST['email'];
                        $clave1 = $_POST['clave1'];
                        $clave2 = $_POST['clave2'];
                        $id_pais = $_POST['id_pais'];
                        $estado = $_POST['estado'];
                        $ciudad = $_POST['ciudad'];
                        $direccion = $_POST['direccion'];
                        $codigo_postal = $_POST['codigo_postal'];
                        $tarjeta = $_POST['tarjeta'];
                        $telefono = $_POST['telefono'];
                        $nombre = $_POST['nombre'];
                        $apellido = $_POST['apellido'];
                        try 
                        {
                            if(trim($usuario) != "" && trim($email) != "" && trim($clave1) != "" && trim($clave2) != "" && trim($id_pais) != "" && trim($estado) != "" && trim($ciudad) != "" && trim($direccion) != "" && trim($codigo_postal) != "" && trim($tarjeta) != "" && trim($telefono) != "" && trim($nombre) != "" && trim($apellido) != "")
                            {
                                if($clave1 == $clave2){
                                    if($clave1 != $usuario){
                                        //Se agregan los datos
                                        $clave = password_hash($clave1, PASSWORD_DEFAULT);
                                        $sql = "INSERT INTO usuarios (usuario, id_tipo, email, clave, id_pais, estado, ciudad, direccion, codigo_postal, tarjeta, telefono, nombre, apellido) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                        $params = array($usuario, $id_tipo, $email, $clave, $id_pais, $estado, $ciudad, $direccion, $codigo_postal, $tarjeta, $telefono, $nombre, $apellido);
                                    }
                                    else{
                                        //Si la clave es igual al nombre de usuario, no deja pasar
                                        throw new Exception("La clave y el nombre de usuario no pueden ser iguales.");
                                    }
                                }
                                else{
                                    //Si las claves no son iguales, no deja pasar
                                    throw new Exception("Las claves no coinciden.");
                                }
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
                else {
                    //si no nos muestra un mensaje diciendo que verifiquemos
                    print("<div class='card-panel red'><i class='material-icons left'>error</i>Debe comprobar que es humano.</div>");
                    }
                
            }
            else 
            {
                //si no nos muestra un mensaje diciendo que verifiquemos
                print("<div class='card-panel red'><i class='material-icons left'>error</i>Debe comprobar que es humano.</div>");
            }
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Registro</title>
        <!-- Se enlazan las hojas de estilo del sitio -->
        <?php include '../inc/styles.php'; ?>
        <meta charset="utf-8">
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body>
    <?php include '../inc/menu2.php'; ?>
        <div class="center-align">
            <h3>Registro de Usuario</h3>
        </div>
        <div class="card-panel paneles">
            <form method='post' class='row' enctype='multipart/form-data' autocomplete="off">
                <div class='row'>
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>account_circle</i>
                        <input id='usuario' type='text' name='usuario' class='validate' length='50' maxlength='50' required/>
                        <label class="active" for='usuario'>Usuario:</label>
                    </div>
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>email</i>
                        <input id='email' type='text' name='email' class='validate' length='100' maxlength='100' required/>
                        <label class="active" for='email'>E-mail:</label>
                    </div>
                </div>
                <div class='row'>
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>lock</i>
                        <input id='clave1' type='password' name='clave1' class="validate black-text" required/>
                        <label class="active" for='clave1'>Clave:</label>
                    </div>
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>lock</i>
                        <input id='clave2' type='password' name='clave2' class="validate black-text" required/>
                        <label class="active" for='clave2'>Confirmar Clave:</label>
                    </div>
                </div>
                <div class='row'>
                    <div class='input-field col s12 m6'>
                        <!-- Mediante las siguientes sentencias se llena el comboBox con los datos de Paises -->
                        <?php
                        $sql = "SELECT * FROM paises";
                        $data = Database::getRows($sql, null);
                        $combo = "<br><select class='browser-default' name='id_pais' required>";
                        $combo .= "<option value='' disabled selected>Seleccione un pais</option>";
                        foreach($data as $row)
                        {
                            $combo .= "<option value='$row[0]'";
                            $combo .= ">$row[1]</option>";
                        }	
                        $combo .= "</select>
                                <label class='active' style='text-transform: capitalize;'>Pais:</label>";
                        print($combo);
                        ?>
                    </div>
                    <div class='file-field input-field col s12 m6'>
                        <i class='material-icons prefix'>flag</i>
                        <input id='estado' type='text' name='estado' class='validate' length='50' maxlength='50' required/>
                        <label class="active" for='estado'>Estado:</label>
                    </div>
                </div>
                <div class='row'>
                    <div class='file-field input-field col s12 m6'>
                        <i class='material-icons prefix'>business</i>
                        <input id='ciudad' type='text' name='ciudad' class='validate' length='100' maxlength='100' required/>
                        <label class="active" for='ciudad'>Ciudad:</label>
                    </div>
                    <div class='file-field input-field col s12 m6'>
                        <i class='material-icons prefix'>room</i>
                        <input id='direccion' type='text' name='direccion' class='validate' length='200' maxlength='200' required/>
                        <label class="active" for='direccion'>Dirección:</label>
                    </div>
                </div>
                <div class='row'>
                    <div class='file-field input-field col s12 m6'>
                        <i class='material-icons prefix'>web</i>
                        <input id='codigo_postal' type='text' name='codigo_postal' class='validate' length='10' maxlength='10' required/>
                        <label class="active" for='codigo_postal'>Código Postal:</label>
                    </div>
                    <div class='file-field input-field col s12 m6'>
                        <i class='material-icons prefix'>vignette</i>
                        <input id='tarjeta' type='text' name='tarjeta' class='validate' length='20' maxlength='20' required/>
                        <label class="active" for='tarjeta'>Tarjeta:</label>
                    </div>
                </div>
                <div class='row'>
                    <div class='file-field input-field col s12 m4'>
                        <i class='material-icons prefix'>phone</i>
                        <input id='telefono' type='text' name='telefono' class='validate' length='10' maxlength='10' required/>
                        <label class="active" for='telefono'>Teléfono:</label>
                    </div>
                    <div class='file-field input-field col s12 m4'>
                        <i class='material-icons prefix'>account_circle</i>
                        <input id='nombre' type='text' name='nombre' class='validate' length='20' maxlength='20' required/>
                        <label class="active" for='nombre'>Nombre:</label>
                    </div>
                    <div class='file-field input-field col s12 m4'>
                        <i class='material-icons prefix'>account_circle</i>
                        <input id='apellido' type='text' name='apellido' class='validate' length='20' maxlength='20' required/>
                        <label class="active" for='apellido'>Apellido:</label>
                    </div>
                </div>
                <div class="col l1 offset-l1 push l10">
					<div class="g-recaptcha" data-sitekey="6LdaPiYTAAAAAGgQYXiaVM743IvkkZ6uzZtE8-vy"></div>
				</div>
                <div class='center-align'>
                    <a href='index.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
                    <button type='submit' class='btn blue'><i class='material-icons right'>check_circle</i>Guardar</button>
                </div>
            </form>
        </div>
        <?php include '../inc/scripts.php'; ?>
    </body>
</html>