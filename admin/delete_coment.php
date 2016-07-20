 <!DOCTYPE html>
  <html>
    <head>
      <?php include '../inc/styles.php' ?>
      <link type="text/css" rel="stylesheet" href="../css/cmarca.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    </head>
    <body class="purple lighten-5">
      <?php
        include("scrud/delete_comentario.php");
        ?>  
      <br>
      <!-- C O N T E N E D O R -->
      <div id="contenedor" class="container white z-depth-5">  
        <form method="post" name="frmMenu" enctype="multipart/form-data" class="center-align">  
          <input type="hidden" name="id" value="<?php print($id);?>"/>
            	<button class="btn waves-effect waves-light btn-large red" type="submit" name="action">
            		Si<i id="img_btn" class="material-icons left">delete</i>
			  	    </button>
            	<a class="waves-effect waves-light btn btn-large light-blue" href="read_coment.php">
            		No<i id="img_btn" class="material-icons left">refresh</i>
            	</a>
         </form>     
      </div>
      <!-- F I N - C O N T E N E D O R -->
      <?php include '../inc/scripts.php' ?>
    </body>
  </html>