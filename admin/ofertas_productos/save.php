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
                        <title>Ofertas por Producto</title>";
                        include '../../inc/styles2.php';
    $head .= "<meta charset='utf-8'>
                </head>
                <body>
                <?php include '../../inc/menu2.php'; ?>
                    <div class='card-panel paneles'>
                        <div class='titulo'>
                            <h3>Agregar una Oferta</h3>
                        </div>";
    print $head;
    $id = null;
    $id_producto = null;
    $porcentaje = null;
}
else{
    $head = "";
    $head .= "<!DOCTYPE html>
                <html lang='es'>
                    <head>
                        <title>Ofertas por Producto</title>";
                        include '../../inc/styles2.php';
    $head .= "<meta charset='utf-8'>
                </head>
                <body>
                <?php include '../../inc/menu2.php'; ?>
                    <div class='card-panel paneles'>
                        <div class='titulo'>
                            <h3>Modificar una Oferta</h3>
                        </div>";
    print $head;
    $id = strip_tags(trim($_GET['id']));
    $sql = "SELECT * FROM ofertas_producto WHERE id_oferta_p = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $id_producto = $data['id_producto'];
    $porcentaje = $data['porcentaje'];
}

if(!empty($_POST))
{
  	$id_producto = strip_tags(trim($_POST['id_producto']));
    $porcentaje = strip_tags(trim($_POST['porcentaje']));
    //Se declaran las consultas
    try 
    {
      	if($id == null){
        	$sql = "INSERT INTO ofertas_producto(id_producto, porcentaje) VALUES(?, ?)";
            $params = array($id_producto, $porcentaje);
        }
        else
        {
            $sql = "UPDATE ofertas_producto SET id_producto = ?, porcentaje = ? WHERE id_oferta_p = ?";
            $params = array($id_producto, $porcentaje, $id);
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
                        <!-- Mediante las siguientes sentencias se llena el comboBox con los datos de Productos -->
                        <?php
                        $sql = "SELECT id_producto, nombre_producto FROM productos";
                        $data = Database::getRows($sql, null);
                        $combo = "<br><select class='browser-default' name='id_producto' required>";
                        if($id_producto == null)
                        {
                            $combo .= "<option value='' disabled selected>Seleccione un producto</option>";
                        }
                        foreach($data as $row)
                        {
                            $combo .= "<option value='$row[0]'";
                            if(isset($_POST['id_producto']) == $row[0] || $id_producto == $row[0])
                            {
                                $combo .= " selected";
                            }
                            $combo .= ">$row[1]</option>";
                        }	
                        $combo .= "</select>
                                <label class='active' style='text-transform: capitalize;'>Productos</label>";
                        print($combo);
                        ?>
                    </div>
                    <br>
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>%</i>
                        <input id='porcentaje' type="text" name='porcentaje' class='validate' length='4' maxlength='4' value='<?php print($porcentaje); ?>'/>
                        <label class="active" for='porcentaje'>Porcentaje</label>
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