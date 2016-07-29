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
      <?php include '../inc/menu2.php' ?>
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
      <h2 class="center-align">Sesiones abiertas</h2>
      <div class="container white z-depth-5">
      <ul class="collection">
      <?php
      
      //Se seleccionan el id de categoria y su nombre
      $sql = "SELECT id_sesion, fecha, os FROM sesiones WHERE usuario = ?";
      $params = array($_SESSION['id_usuario']);
      foreach (Database::getRows($sql, $params) as $sesions) {
          $dataE = base64_encode($sesions['id_sesion']);
          //por cada categoria se imprimira su opcion con el nombre y la direccion mas el id de la categoria
          print("<li class='collection-item'><div> Sistema operativo: ".htmlspecialchars($sesions['os'])." Fecha de inicio: ".htmlspecialchars($sesions['fecha'])." <a href='cerrarses.php?id={$dataE}' class='secondary-content'><i class='material-icons'>clear</i></a></div></li>");
      }
      ?>
      </ul>
      <!-- F I N - P R O D U C T O S - M A S - V E N D I D O -->          
      </div>
      <!-- F I N - C O N T E N E D O R -->
      <?php include '../inc/scripts.php' ?>
    </body>
        <?php include '../inc/footer2.php' ?>
  </html>