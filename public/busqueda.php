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
       include '../inc/menu2.php';
       if(!empty($_POST)){
          if(strip_tags(trim($_POST["search"]))!=null)
          {
              $dataE = base64_encode($_POST['search']);
              header("location: busqueda.php?busque={$dataE}");
          }
      } 
      ?>
      <br>
      <nav class="container blue darken-1 z-depth-2">
            <form>
                <div class="input-field">
                    <input id="search" type="search" required>
                    <label for="search"><i class="material-icons">search</i></label>
                    <i class="material-icons">close</i>
                </div>
            </form>
      </nav>
      <!-- C O N T E N E D O R -->
      <div class="container white z-depth-5">  
        <!-- E N C A B E Z A D O - D E - P A G I N A -->
        <h2>Busqueda</h2>
        <li class="divider"></li>
        <br>
        <div class = "row">
        <?php
        $busque = null;
        if(!empty($_GET['busque'])) {
            $busque = strip_tags(trim(base64_decode($_GET['busque'])));
        }
        if($busque == null) {
            header("location: index.php");
        }
        
        Database::connect();
        $page = null;
        if(!empty($_GET['page'])) {
            $page = strip_tags(trim($_GET['page']));
        }
        if($page == null) {
            $page = 1;
        }
        if($page == "" || $page == "1")
        {
            $page1 = 0;
        }
        else {
            $page1 = ($page*5)-5; 
        }
        $consulta = "SELECT * FROM productos WHERE nombre_producto LIKE '%$busque%' LIMIT $page1,24";
        foreach(Database::$connection->query($consulta) as $datos)
    			{
                    $datosE = base64_encode($datos['id_producto']);
                    $card = "       <!-- TARJETA 1 -->
                    <div class='card col s12 m6 l4'>
                        <div class='card-image waves-effect waves-block waves-light'>";
                        $consuimg = "SELECT imagen FROM imagenes WHERE id_producto = $datos[id_producto] LIMIT 0,1";
                        $img = Database::getRow($consuimg , null);
                        $card .= "<img src='data:image/*;base64,$img[imagen]' class='activator' height='300'>";
                        $card .= "</div>
                        <div class='card-content'>";
                        $card .= "<span class='card-title activator grey-text text-darken-4'>".htmlspecialchars($datos['nombre_producto'])."<i class='material-icons right'>more_vert</i></span>";
                        $card .= "<p><a href='detalles_producto.php?id={$datosE}'>Mas información</a></p>";
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
            $cons2 = ("SELECT COUNT(id_producto) FROM productos WHERE nombre_producto LIKE '%$busque%'");
            $parametros = null;
            $filas = Database::getRow($cons2, $parametros);
            $filas = $filas[0]/24;
            $filas = ceil($filas);
                if($page == 1)
                {
                    $pagi = "<li class='disabled'><a><i class='material-icons'>chevron_left</i></a></li>";
                }
                else {
                    $pagi = "<li class='waves-efect'><a href='busqueda.php?busque=$busque&&page=($page-1)'><i class='material-icons'>chevron_left</i></a></li>";
                }
                for($i = 1; $i<=$filas; $i++) {
                    if($page==$i)
                    {
                     $pagi .= "<li class='active blue'><a href='busqueda.php?busque=$busque&&page=$i'>$i</a></li>";
                    }
                    else{
                        $pagi .= "<li class='waves-effect'><a href='busqueda.php?busque=$busque&&page=$i'>$i</a></li>";
                    }
                }
                if($page == $filas)
                {
                    $pagi .= "<li class='disabled'><a><i class='material-icons'>chevron_right</i></a></li>";
                }
                else {
                    $pagi .= "<li class='waves-efect'><a href='busqueda.php?busque=$busque&&page=($page+1)'><i class='material-icons'>chevron_right</i></a></li>";
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