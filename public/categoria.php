 <!DOCTYPE html>
 <?php
    require("../bibliotecas/database.php");
 ?>
  <html>
    <head>
      <?php include '../inc/styles.php' ?>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    </head>
    <body class="purple lighten-5">
      <?php
       include('../inc/menu2.php');
       $id = null;
       if(!empty($_POST)){
          if($_POST["search"]!=null)
          {
              $dataE = base64_encode($_POST['search']);
              header("location: busqueda.php?busque={$dataE}");
          }
      }
       //Se verifica que la variable id de categoria este cargada
       if(!empty($_GET['id'])) {
            $id = strip_tags(trim(base64_decode($_GET['id'])));
        }
        else {
            header("location:index.php");
        }
        if($id == null) {
            header("location: index.php");
        }
        
        $nombc = "SELECT categoria FROM categorias WHERE id_categoria = ?";
        $ar = array($id);
        $nombre = Database::getRow($nombc, $ar); 
       ?>
      <?php
      if(!empty($_POST)){
          if($_POST["search"]!=null)
          {
              header("location: busqueda.php?busque=$_POST[search]");
          }
      }
      ?>
      <br>
      <nav class="container blue darken-1 z-depth-2">
            <form method='post' class='row' enctype='multipart/form-data'>
                <div class="input-field">
                    <input id="search" name = "search" type="search" required>
                    <label for="search"><i class="material-icons">search</i></label>
                    <i class="material-icons">close</i>
                </div>
            </form>
        </nav>
      <!-- C O N T E N E D O R -->
      <div class="container white z-depth-5">  
        <!-- E N C A B E Z A D O - D E - P A G I N A -->
        <h2><?php print(htmlspecialchars($nombre['categoria'])); ?></h2>
        <li class="divider"></li>
        <br>
        <div class = "row">
        <?php
        Database::connect();
        $page = null;
        //Se toma la variable de paginacion
        if(!empty($_GET['page'])) {
            $page = strip_tags(trim($_GET['page']));
        }
        //Si la variable de paginacion esta vacia se pone como 1
        if($page == null) {
            $page = 1;
        }
        //Si la variable es 1 el limite empezara desde 0
        if($page == "" || $page == "1")
        {
            $page1 = 0;
        }
        else {
            //Se multiplica la pagina por el numero de items que se muestran (24) y se restan 24 para poder empezar desde el siguiente producto 
            $page1 = ($page*24)-24; 
        }
        //Se selecionan 24 productos empezando por el numero de la variable $page1
        $consulta = "SELECT * FROM productos WHERE id_categoria = $id LIMIT $page1,24";
        foreach(Database::$connection->query($consulta) as $datos)
    			{
                    $datosE = base64_encode($datos['id_producto']);
                    //Se imprimen cada producto
                    $card = "       <!-- TARJETA 1 -->
                    <div class='card col s12 m6 l4'>
                        <div class='card-image waves-effect waves-block waves-light'>";
                        $consuimg = "SELECT imagen FROM imagenes WHERE id_producto = $datos[id_producto] LIMIT 0,1";
                        $img = Database::getRow($consuimg , null);
                        $card .= "<img src='data:image/*;base64,$img[imagen]' class='activator' height='300'>";
                        $card .= "</div>
                        <div class='card-content'>";
                        $card .= "<span class='card-title activator grey-text text-darken-4'>".htmlspecialchars($datos['nombre_producto'])."<i class='material-icons right'>more_vert</i></span>";
                        $card .= "<p><a href='detalles_productos.php?id={$datosE}'>Mas información</a></p>";
                        $card .= "</div>
                        <div class='card-reveal'>";
                        $card .= "<span class='card-title grey-text text-darken-4'>".htmlspecialchars($datos['nombre_producto'])."<i class='material-icons right'>close</i></span>";
                        $card .=  "<p>".htmlspecialchars($datos['descripcion_pro'])."</p>
                        </div>
                    </div>";
                    print($card);
    			}
        ?>
        </div>
        <!--Paginacion-->
        <div class="row">
            <ul class="pagination">
            <?php
            //Se cuentan los productos
            $cons2 = ("SELECT COUNT(id_producto) FROM productos WHERE id_categoria = '$id'");
            $parametros = null;
            $filas = Database::getRow($cons2, $parametros);
            $filas = $filas[0]/24;
            $filas = ceil($filas);
            //Si la paginacion es 1, el 1 estara deshabilitado
                if($page == 1)
                {
                    $pagi = "<li class='disabled'><a><i class='material-icons'>chevron_left</i></a></li>";
                }
                //caso contrario esta habilitado
                else {
                    $pagi = "<li class='waves-efect'><a href='categoria.php?id=$id&&page=($page-1)'><i class='material-icons'>chevron_left</i></a></li>";
                }
                //Se imprime cada pagina, si la pagina que se imprimio concide con el numero de pagina que se imprime se imprimira seleccionado
                for($i = 1; $i<=$filas; $i++) {
                    if($page==$i)
                    {
                     $pagi .= "<li class='active blue'><a href='categoria.php?id=$id&&page=$i'>$i</a></li>";
                    }
                    //Si no solo se imprimira
                    else{
                        $pagi .= "<li class='waves-effect'><a href='categoria.php?id=$id&&page=$i'>$i</a></li>";
                    }
                }
                //Al igual que si la pagina es la primera, si es la ultima se vera deshabilitada o no
                if($page == $filas)
                {
                    $pagi .= "<li class='disabled'><a><i class='material-icons'>chevron_right</i></a></li>";
                }
                else {
                    $pagi .= "<li class='waves-efect'><a href='categoria.php?id=$id&&page=($page+1)'><i class='material-icons'>chevron_right</i></a></li>";
                }
                print($pagi);
                Database::$connection = null;
				Database::desconnect();  
            ?>
            </ul>
        </div>
      </div>
      <!-- F I N - C O N T E N E D O R -->
      <?php include '../inc/scripts.php' ?>
    </body>
        <?php include '../inc/footer2.php' ?>
  </html>