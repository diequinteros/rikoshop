 <!DOCTYPE html>
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
      <h2 class="center-align">Categorias</h2>
      <div class="container white z-depth-5">
      <div class="collection">
      <?php
      require("../bibliotecas/database.php");
      //Se seleccionan el id de categoria y su nombre
      $sql = "SELECT id_categoria, categoria FROM categorias";
      foreach (Database::getRows($sql, null) as $categorias) {
          $dataE = base64_encode($categorias['id_categoria']);
          //por cada categoria se imprimira su opcion con el nombre y la direccion mas el id de la categoria
          print("<a href=categoria.php?id={$dataE} class='collection-item'>$categorias[categoria]</a>");
      }
      ?>
      </div>
      <!-- F I N - P R O D U C T O S - M A S - V E N D I D O -->          
      </div>
      <!-- F I N - C O N T E N E D O R -->
      <?php include '../inc/scripts.php' ?>
    </body>
        <?php include '../inc/footer2.php' ?>
  </html>