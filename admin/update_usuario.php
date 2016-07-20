 <!DOCTYPE html>
  <html>
    <head>
      <?php include '../inc/styles.php' ?>
      <link type="text/css" rel="stylesheet" href="css/cmarca.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    </head>
    <body class="purple lighten-5">
    <?php include("../inc/menu2.php");?>
      <?php
        include("scrud/create_usuario.php");
        ?>  
      <!--?php include 'inc/menu.php' ?>-->
      <br>
      <!-- C O N T E N E D O R -->
      <div id="contenedor" class="container white z-depth-5">  
          <h2 class="center-align">Agregar administrador</h2>
           <form  action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
               <div class="input-field col s6">
                    <input disabled name="usuario" type="text" class="validate" value="<?php print($usuario); ?>">
                    <label for="usuario">Nombre usuario</label>
               </div>
               <div class="input-field col s6">
                    <input  name="email" type="text" class="validate" value="<?php print($email); ?>">
                    <label for="email">E-mail</label>
               </div>
               <div class="input-field col s6">
                    <input  name="nombre" type="text" class="validate"  value="<?php print($nombre); ?>">
                    <label for="nombre">Nombre</label>
               </div>
               <div class="input-field col s6">
                    <input  name="apellido" type="text" class="validate"  value="<?php print($apellido); ?>">
                    <label for="apellido">Apellido</label>
               </div>
               <div class="row">
                   <button name="agregar" type="submit" value = "agregar" class="waves-effect waves-light btn col s12 m3 l3 offset-m2 offset-l2 light-blue"><i class="material-icons left">create</i>Modificar</button>
                   <a name="cancelar" href="read_usuario.php" value = "cancelar" class="waves-effect waves-light btn col s12 m3 l3 offset-m2 offset-l2 red"><i class="material-icons left">clear</i>Cancelar</a>
               </div>
           </form>     
      </div>
      <!-- F I N - C O N T E N E D O R -->
      <?php include '../inc/scripts.php' ?>
      <?php include("../inc/footer2.php");?>
    </body>
  </html>