<!-- Se llaman los diferentes archivos que contienen nuestras clases de conexion y consultas -->
<?php
require("../../bibliotecas/database.php");

//Se realizan los procesos necesarios para modificar e insertar
if(empty($_GET['id'])) 
{
    $head = "";
    $head .= "<!DOCTYPE html>
                <html lang='es'>
                    <head>
                        <title>Redes Sociales</title>";
                        include '../../inc/styles2.php';
    $head .= "<meta charset='utf-8'>
                </head>
                <body>
                <?php include '../../inc/menu2.php'; ?>
                    <div class='card-panel paneles'>
                        <div class='titulo'>
                            <h3>Agregar una Red Social</h3>
                        </div>";
     if(!$_SESSION['tipo']==1){
          header("location: ../../public/login.php");
        }
    print $head;
    $id = null;
    $red = null;
    $url = null;
}
else{
    $head = "";
    $head .= "<!DOCTYPE html>
                <html lang='es'>
                    <head>
                        <title>Redes Sociales</title>";
                        include '../../inc/styles2.php';
    $head .= "<meta charset='utf-8'>
                </head>
                <body>
                <?php include '../../inc/menu2.php'; ?>
                    <div class='card-panel paneles'>
                        <div class='titulo'>
                            <h3>Modificar una Red Social</h3>
                        </div>";
     if(!$_SESSION['tipo']==1){
          header("location: ../../public/login.php");
        }
    print $head;
    $id = strip_tags(trim(base64_decode($_GET['id'])));
    $sql = "SELECT * FROM redes WHERE id_red = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $red = $data['red'];
    $url = $data['url'];
}

if(!empty($_POST))
{
  	$red = strip_tags(trim($_POST['red']));
    $url = strip_tags(trim($_POST['url']));
    //Se declaran las consultas
    try 
    {
      	if($id == null){
        	$sql = "INSERT INTO redes(red, url) VALUES(?, ?)";
            $params = array($red, $url);
        }
        else
        {
            $sql = "UPDATE redes SET red = ?, url = ? WHERE id_red = ?";
            $params = array($red, $url, $id);
        }
        Database::executeRow($sql, $params);
        header("location: index.php");
    }
    //En caso de error se muestra al administrador en turno
    catch (Exception $error)
    {
        print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
    }
}
?>
<!-- Se crea nuestro formulario general ya sea de creacion o modificacion -->
            <form method='post' class='row' enctype='multipart/form-data' autocomplete="off">
                <div class='row'>
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>language</i>
                        <input id='red' type='text' name='red' class='validate' length='25' maxlength='25' value='<?php print(htmlspecialchars($red)); ?>' required/>
                        <label class="active" for='red'>Nombre de la Red</label>
                    </div>
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>link</i>
                        <input id='url' type='text' name='url' class='validate' length='100' maxlength='100' value='<?php print(htmlspecialchars($url)); ?>' required/>
                        <label class="active" for='url'>URL</label>
                    </div>
                </div>
                <div class='titulo'>
                    <a href='index.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
                    <button type='submit' class='btn blue'><i class='material-icons right'>check_circle</i>Guardar</button>
                </div>
            </form>
        </div>
        <!-- Finalmente se relacionan los scripts del sitio -->
        <?php include '../../inc/scripts2.php'; ?>
        <!-- Asi como el footer del sitio -->
	    <?php require("../../inc/footer2.php"); ?>
    </body>
</html>