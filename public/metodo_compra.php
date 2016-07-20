<!DOCTYPE html>
<?php
    require("../bibliotecas/database.php");
    require("../bibliotecas/validator.php"); 
    Database::connect();
    //SI no se esta logueado no podra acceder al carrito
    if(!isset($_SESSION['id_usuario']))
    {
        //header('location:index.php');
        $_SESSION['id_usuario'] = 1;
    }
    //Si el post y get estan llenos se agregan productos al carrito
    if(!empty($_POST) && !empty($_GET))
        {
            $id = null;
            $id = ["id"];
            $cant = $_POST['canti'];
            try 
            {
                if($id != null && $cant != "")
                {
                    $sql = "INSERT INTO selecciones(id_producto, id_usuario, cantidad) VALUES(?, ?, ?)";
                    $params = array($id, $_SESSION['id_usuario'], $cant);
                }
            }
            catch (Exception $error)
            {
                print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
            }
        }
     
?>

  <html>
    <head>
      <?php include '../inc/styles.php' ?>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    </head>
    <body class="purple lighten-5">
    <?php include '../inc/menu2.php' ?>
      <!-- Fin de nav -->
      <h1> Shopping card <i class="material-icons md-48">shopping_cart</i> </h1>
      <div class="container">
          <!-- Inicio carta -->
          <div class="card">
              <!-- Inicio tabla -->
            <table>
                <thead>
                    <tr>
                        <th data-field="product">Producto</th>
                        <th data-field="product-text"></th>
                        <th data-field="price">Precio</th>
                        <th data-field="quantity">Cantidad</th>
                        <th data-field="line_total">Total</th>
                        <th data-field="options">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //Se seleccionan los productos de carrito
                    $sql = "SELECT id_seleccion, selecciones.id_producto, nombre_producto, precio, cantidad FROM selecciones, productos WHERE selecciones.id_producto = productos.id_producto AND selecciones.id_usuario = $_SESSION[id_usuario] AND id_venta = 0";
                    $total = 0;
                    //Se inicia el formulario de paypal
                    print("<form name='pagar_con_paypal' method='post' action='https://www.sandbox.paypal.com/cgi-bin/webscr' />");
                    ?>
                    <input type="hidden" name="cmd"  value="_cart" /> 
                    <input type="hidden" name="upload" value="1">
                    <!-- Este es el correo del vendedor -->  
                    <input type="hidden" name="business" value="diegoquinteros02.04.97@gmail.com" />
                    <?php
                    $num = 1;
                    //Se imprime cada producto del carrito
                    foreach (Database::$connection->query($sql) as $datos) {
                        $tbl = "
                                <tr>";
                                //Se imprime la primer imagen del producto
                                $imgc = "SELECT imagen FROM imagenes WHERE id_producto = $datos[id_producto] LIMIT 0,1";
                                $img = Database::getRow($imgc, null);
                        $tbl .=    "<td><img class='responsive img' width='150' src='data:image/*;base64,$img[imagen]'></td>
                                    <td>$datos[nombre_producto]</td>
                                    <td>$datos[precio]</td>
                                    <td>$datos[cantidad]</td>";
                        $to = $datos['precio']*$datos['cantidad'];
                        $total = $total + $to;            
                        $tbl .=    "<td>$to</td>
                                    <td><a href='elimpro.php?idselec=$datos[id_seleccion]'><i class='material-icons'>close</i></a></td>
                                </tr>";
                                ?> 
                                <input type="hidden" name="item_name_<?php echo $num;?>" value="<?php echo $datos['nombre_producto']; ?>" /> 
                                <input type="hidden" name="quantity_<?php echo $num;?>" value="<?php echo $datos['cantidad']; ?>" /> 
                                <input type="hidden" name="amount_<?php echo $num;?>" value="<?php echo $datos['precio']; ?>" />
                                <?php 
                                $num = $num + 1;       
                        print($tbl);
                    }
                    Database::$connection = null;
                    Database::desconnect();
                    ?>
                </tbody>
            </table>
            <!-- Fin tabla -->
            <div class="divider"></div>
            <!-- Fila -->
            <div class="row">
                <div class="col s6 l4 offset-s6 offset-l8">
                <?php
                   print("Subtotal: $".$total); 
                ?>
                    <br>
                    Envio: $0.00
                    <div class="divider"></div>
                    <h4><?php
                   print("Total: $".$total); 
                ?></h4>
                </div>
            </div>
            <!-- Fin fila -->
            <div class="divider"></div>
            <div id="fila-metodo-compra" class="row">
                <div class="col s6 l4 offset-s6 offset-l8"> 
                    <button type="submit" class="waves-effect waves-light btn"><i class="material-icons right">attach_money</i>Pagar</button>
                </div>
                <input type="hidden" name="return" value="http://localhost/ecomerce/public/limpiarcarrito.php?tot=<?php echo($total); ?>">
                <input type="hidden" name="cancel_return" value="http://localhost/ecomerce/public/limpiarcarrito.php?tot=<?php echo($total); ?>">
                </form>        
            </div>
          </div>
          <!-- Fin carta -->
      </div>
      </body>
      <?php include '../inc/scripts.php' ?>
        <?php include '../inc/footer2.php' ?>
  </html>