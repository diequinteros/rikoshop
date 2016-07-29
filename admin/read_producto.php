 <!DOCTYPE html>
   <?php
    require("../bibliotecas/database.php");
  ?>
  <html>
    <head>
      <?php include '../inc/styles.php' ?>
      <link type="text/css" rel="stylesheet" href="../css/cmarca.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    </head>
    <body class="purple lighten-5">
    <?php
     include("../inc/menu2.php");
    if(!$_SESSION['tipo']==1){
          header("location: ../public/login.php");
        }  
    ?>
      <br>
      <!-- C O N T E N E D O R -->
      <div id="contenedor" class="container white z-depth-5">  
          <h2 class="center-align">Registros de categoria</h2>
           <form  action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
               <div class = "row">
               <div class="input-field col s12 m8 l4">
		          	  <i class="material-icons prefix">search</i>
		          	  <input id="icon_nombre" type="text" class="validate" name="txtBuscar"/>
		          	  <label for="icon_nombre">Búsqueda personalizada</label>
		           </div>
		           <button class="btn waves-effect waves-light btn-large light-blue col s12 m4 l2 offset-m1 offset-l1" type="submit" name="action">
		     		        Buscar<i id="img_btn" class="material-icons left md-36">search</i>
			  	     </button>
				       <a class="btn waves-effect waves-light btn-large red col s2 s12 m4 l2 offset-m1 offset-l1" href="../index.php">
			    	          Cancelar<i id="img_btn" class="material-icons left md-36">clear</i>
			         </a>
               <a class="btn waves-effect waves-light btn-large red col s2 s12 m4 l2 offset-m1 offset-l1" href="http://localhost/rikoshop/admin/create_producto.php">
			    	          Nuevo registro<i id="img_btn" class="material-icons left md-36"></i>
			         </a>
               </div>
               <?php
               include 'scrud/read_producto.php' 
               ?>
           </form>     
      </div>
      <!-- F I N - C O N T E N E D O R -->
      <?php include '../inc/scripts.php' ?>
      <?php include("../inc/footer2.php");?>
    </body>
  </html>