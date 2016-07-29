 <!DOCTYPE html>
  <html>
    <head>
      <?php include '../inc/styles.php' ?>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    </head>
    <body class="purple lighten-5">
      <?php
      require("../../bibliotecas/database.php");
       include('../inc/menu2.php'); 
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
      <!-- C O N T E N E D O R -->
      <h2 class="center-align">Categorias</h2>
      <div class="container white z-depth-5">
      <div class="collection">
      <a href="http://localhost/ecomerce/admin/read_usuario.php" class="collection-item">Administradores</a>
      <a href="http://localhost/ecomerce/admin/read_categoria.php" class="collection-item">Categoria</a>
      <a href="http://localhost/ecomerce/admin/read_cliente.php" class="collection-item">Clientes</a>
      <a href="http://localhost/ecomerce/admin/read_coment.php" class="collection-item">Comentarios</a>
      <a href="http://localhost/ecomerce/admin/read_ofertacat.php" class="collection-item">Ofertas por categorias</a>
      <a href="http://localhost/ecomerce/admin/read_producto.php" class="collection-item">Productos</a>
      <a href="http://localhost/ecomerce/admin/read_sucursal.php" class="collection-item">Sucursales</a>
      <a href="http://localhost/ecomerce/admin/read_ventas.php" class="collection-item">Ventas</a>
      </div>
      <!-- F I N - P R O D U C T O S - M A S - V E N D I D O -->          
      </div>
      <!-- F I N - C O N T E N E D O R -->
      <?php include '../inc/scripts.php' ?>
    </body>
        <?php include '../inc/footer2.php' ?>
  </html>