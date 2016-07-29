 <!DOCTYPE html>
  <html>
    <head>
      <?php
       include '../inc/styles.php' 
       ?>
      <link type="text/css" rel="stylesheet" href="../css/cmarca.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    </head>
    <body class="purple lighten-5">
      <?php
        include("scrud/update_categoria.php");
        include("../inc/menu2.php");
        if(!$_SESSION['tipo']==1){
          header("location: ../public/login.php");
        }  
        ?>  
      <br>
      <!-- C O N T E N E D O R -->
      <div id="contenedor" class="container white z-depth-5">  
          <h2 class="center-align">Agregar categoria</h2>
           <form  action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
               <div class="input-field col s6">
                    <input  name="categoria" type="text" class="validate" value="<?php print(htmlspecialchars($ncategoria)); ?>">
                    <label for="categoria">Categoria</label>
               </div>
               <div class="input-field col s12">
                  <textarea name="descripcion" class="materialize-textarea" ><?php print(htmlspecialchars($descripcion)); ?></textarea>
                  <label for="descripcion">Descripción</label>
               </div>
               <div class="row">
                   <button name="agregar" type="submit" value = "agregar" class="waves-effect waves-light btn col s12 m3 l3 offset-m2 offset-l2 light-blue"><i class="material-icons left">create</i>Guardar</button>
                   <button name="cancelar" type="reset" value = "cancelar" class="waves-effect waves-light btn col s12 m3 l3 offset-m2 offset-l2 red"><i class="material-icons left">clear</i>Cancelar</button>
               </div>
           </form>     
      </div>
      <!-- F I N - C O N T E N E D O R -->
      <?php 
        include '../inc/scripts.php'
      ?>
      <?php include("../inc/menu2.php");?>
    </body>
  </html>