 <!DOCTYPE html>
  <html>
    <head>
      <?php include '../inc/styles.php' ?>
      <link type="text/css" rel="stylesheet" href="../css/cmarca.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    </head>
    <body class="purple lighten-5">
      <?php
      include("../inc/menu2.php");
        include("scrud/create_ofertacat.php")
        ?>  
      <br>
      <!-- C O N T E N E D O R -->
      <div id="contenedor" class="container white z-depth-5">  
          <h2 class="center-align">Agregar oferta por categoria</h2>
           <form  action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
               <div class="input-field col s6">
						      <select name="idcategoria" class="browser-default" required>
						          <option value="" disabled selected>Seleccione la categoria</option>
						          <?php
                      Database::connect();
						    	    $consulta = "SELECT * FROM categorias";
				    			    $opciones = ""; //Arreglo de datos
				    			    foreach(Database::$connection->query($consulta) as $datos)
				    			    {
									      $opciones .= "<option value='$datos[id_categoria]'";
									      if(isset($tipo) == $datos['id_categoria'])
									      {
										      $opciones .= " selected";
									      }
									      $opciones .= ">$datos[categoria]</option>";
				    			    }
				    			    print($opciones);
				    			    Database::$connection = null;
                      Database::desconnect();
						          ?>
			   			     </select>
					      </div>
               <div class="input-field col s6">
                    <input  name="porcentaje" type="text" class="validate">
                    <label for="porcentaje">Descuento en decimal</label>
               </div>
               <div class="row">
                   <button name="agregar" type="submit" value = "agregar" class="waves-effect waves-light btn col s12 m3 l3 offset-m2 offset-l2 light-blue"><i class="material-icons left">create</i>Agregar</button>
                   <button name="cancelar" type="reset" value = "cancelar" class="waves-effect waves-light btn col s12 m3 l3 offset-m2 offset-l2 red"><i class="material-icons left">clear</i>Cancelar</button>
               </div>
           </form>     
      </div>
      <!-- F I N - C O N T E N E D O R -->
      <?php
       include('../inc/scripts.php');
       include("../inc/footer2.php"); 
       ?>
    </body>
  </html>