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
                        <title>Marcas</title>";
                        include '../../inc/styles2.php';
    $head .= "<meta charset='utf-8'>
                </head>
                <body>
                <?php include '../../inc/menu2.php'; ?>
                    <div class='card-panel paneles'>
                        <div class='titulo'>
                            <h3>Agregar una Marca</h3>
                        </div>";
                         if(!$_SESSION['tipo']==1){
          header("location: ../../public/login.php");
        }
    print $head;
    $id = null;
    $nombre_marca = null;
}
else{
    $head = "";
    $head .= "<!DOCTYPE html>
                <html lang='es'>
                    <head>
                    <title>Marcas</title>";
                        include '../../inc/styles2.php';
    $head .= "<meta charset='utf-8'>
                </head>
                <body>
                <?php include '../../inc/menu2.php'; ?>
                    <div class='card-panel paneles'>
                        <div class='titulo'>
                            <h3>Modificar una Marca</h3>
                        </div>";
                         if(!$_SESSION['tipo']==1){
          header("location: ../../public/login.php");
        }
    print $head;
    $id = strip_tags(trim(base64_decode($_GET['id'])));
    $sql = "SELECT * FROM marcas WHERE id_marca = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $nombre_marca = $data['marca'];
}

if(!empty($_POST))
{
  	$nombre_marca = strip_tags(trim($_POST['marca']));
    //Se declaran las consultas
    try 
    {
      	if($id == null){
        	$sql = "INSERT INTO marcas(marca) VALUES(?)";
            $params = array($nombre_marca);
        }
        else
        {
            $sql = "UPDATE marcas SET marca = ? WHERE id_marca = ?";
            $params = array($nombre_marca, $id);
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
            <form method='post' enctype='multipart/form-data' autocomplete="off">
                <div class='row titulo'>
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>store</i>
                        <input id='marca' type='text' name='marca' class='validate' length='25' maxlength='25' value='<?php print(htmlspecialchars($nombre_marca)); ?>' required/>
                        <label class="active" for='marca'>Marca</label>
                    </div>
                    <br>
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