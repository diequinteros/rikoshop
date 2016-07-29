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
                        <title>Paises</title>";
                        include '../../inc/styles2.php';
    $head .= "<meta charset='utf-8'>
                </head>
                <body>
                <?php include '../../inc/menu2.php'; ?>
                    <div class='card-panel paneles'>
                        <div class='titulo'>
                            <h3>Agregar un Pais</h3>
                        </div>";
    print $head;
    $id = null;
    $nombre_pais = null;
}
else{
    $head = "";
    $head .= "<!DOCTYPE html>
                <html lang='es'>
                    <head>
                        <title>Paises</title>";
                        include '../../inc/styles2.php';
    $head .= "<meta charset='utf-8'>
                </head>
                <body>
                <?php include '../../inc/menu2.php'; ?>
                    <div class='card-panel paneles'>
                        <div class='titulo'>
                            <h3>Modificar un Pais</h3>
                        </div>";
    print $head;
    $id = strip_tags(trim(base64_decode($_GET['id'])));
    $sql = "SELECT * FROM paises WHERE id_pais = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $nombre_pais = $data['nombre_pais'];
}

if(!empty($_POST))
{
  	$nombre_pais = strip_tags(trim($_POST['pais']));
    //Se declaran las consultas
    try 
    {
      	if($id == null){
        	$sql = "INSERT INTO paises(nombre_pais) VALUES(?)";
            $params = array($nombre_pais);
        }
        else
        {
            $sql = "UPDATE paises SET nombre_pais = ? WHERE id_pais = ?";
            $params = array($nombre_pais, $id);
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
                        <i class='material-icons prefix'>flag</i>
                        <input id='pais' type="text" name='pais' class='validate' length='50' maxlength='50' value='<?php print(htmlspecialchars($nombre_pais)); ?>'/>
                        <label class="active" for='pais'>Nombre del País</label>
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