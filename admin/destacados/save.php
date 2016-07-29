<!-- Se llaman los diferentes archivos que contienen nuestras clases de conexion y consultas -->
<?php
require("../../bibliotecas/database.php");
require("../../bibliotecas/imagen.php");

//Se realizan los procesos necesarios para modificar e insertar
if(empty($_GET['id'])) 
{
    $head = "";
    $head .= "<!DOCTYPE html>
                <html lang='es'>
                    <head>
                        <title>Destacados</title>";
                        include '../../inc/styles2.php';
    $head .= "<meta charset='utf-8'>
                </head>
                <body>
                <?php include '../../inc/menu2.php'; ?>
                    <div class='card-panel paneles'>
                        <div class='titulo'>
                            <h3>Agregar un anuncio</h3>
                        </div>";
    print $head;
    $id = null;
    $imagen = null;
    $titulo = null;
}
else{
    $head = "";
    $head .= "<!DOCTYPE html>
                <html lang='es'>
                    <head>
                        <title>Destacados</title>";
                        include '../../inc/styles2.php';
    $head .= "<meta charset='utf-8'>
                </head>
                <body>
                <?php include '../../inc/menu2.php'; ?>
                    <div class='card-panel paneles'>
                        <div class='titulo'>
                            <h3>Modificar un anuncio</h3>
                        </div>";
    print $head;
    $id = strip_tags(trim(base64_decode($_GET['id'])));
    $sql = "SELECT * FROM destacados WHERE id_destacado = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $imagen = $data['imagen'];
    $titulo = $data['titulo'];
}

if(!empty($_POST))
{
  	$archivo = $_FILES['imagen'];
    $titulo = strip_tags(trim($_POST['titulo']));
    if($archivo['name'] != null)
    {
        $base64 = Imagen::validateImage($archivo);
        if($base64 != false)
        {
            $imagen = $base64;
        }
        else
        {
            throw new Exception("La imagen seleccionada no es valida.");
        }
    }
    else
    {
        if($imagen == null)
        {
            throw new Exception("Debe seleccionar una imagen.");
        }
    }
    //Se declaran las consultas
    try 
    {
      	if($id == null){
        	$sql = "INSERT INTO destacados(imagen, titulo) VALUES(?, ?)";
            $params = array($imagen, $titulo);
        }
        else
        {
            $sql = "UPDATE destacados SET imagen = ?, titulo = ? WHERE id_destacado = ?";
            $params = array($imagen, $titulo, $id);
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
                    <div class='file-field input-field col s12 m6'>
                        <div class='btn'>
                                <span>Imagen</span>
                                <input type='file' name='imagen'>
                        </div>
                        <div class='file-path-wrapper'>
                            <input class='file-path validate' type='text' placeholder='Seleccione una imagen (PNG/JPG/GIF)'>
                        </div>
                    </div>
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>edit</i>
                        <input id='titulo' type="text" name='titulo' class='validate' length='50' maxlength='50' value='<?php print(htmlspecialchars($titulo)); ?>'/>
                        <label class="active" for='titulo'>Título</label>
                    </div>
                </div>
                <br>
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