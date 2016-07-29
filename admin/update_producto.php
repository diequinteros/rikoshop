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
        include("scrud/update_producto.php");
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
                    <input  name="nombre" type="text" class="validate" value="<?php print(htmlspecialchars($nombre)); ?>">
                    <label for="nombre">Nombre</label>
               </div>
               <div class="input-field col s12">
                  <textarea name="descripcion" class="materialize-textarea"><?php print(htmlspecialchars($descripcion)); ?>"</textarea>
                  <label for="descripcion">Descripción</label>
               </div>
               <div class="input-field col s6">
                    <input  name="precio" type="text" class="validate" value="<?php print(htmlspecialchars($precio)); ?>">
                    <label for="precio">Precio</label>
               </div>
               <div class="input-field col s6">
						      <select name="marca" class="browser-default">
						          <?php
									Database::connect();
						    	    $consulta = "SELECT * FROM marcas";
				    			    $opciones = ""; //Arreglo de datos
				    			    foreach(Database::$connection->query($consulta) as $datos)
				    			    {
									      $opciones .= "<option value='$datos[id_marca]'";
									      if($marca == $datos['id_marca'])
									      {
										      $opciones .= " selected";
									      }
									      $opciones .= ">$datos[marca]</option>";
				    			    }
				    			    print($opciones);
				    			    Database::$connection = null;
									Database::desconnect();
						          ?>
			   			     </select>
					      </div>
                <div class="input-field col s6">
						      <select name="idcategoria" class="browser-default" required>
						          <?php
									Database::connect();
						    	    $consulta = "SELECT * FROM categorias";
				    			    $opciones = ""; //Arreglo de datos
				    			    foreach(Database::$connection->query($consulta) as $datos)
				    			    {
									      $opciones .= "<option value='$datos[id_categoria]'";
									      if($categoria == $datos['id_categoria'])
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
                    <input  name="existencia" type="text" class="validate"  value="<?php print(htmlspecialchars($existencia)); ?>">
                    <label for="existencia">Existencia</label>
               </div>
			   <?php
			   $img = "<img src='data:image/*;base64,$imagen1' class='responsive-img'>";
			   print($img);
			   ?>
                <div class="input-field col s6">
						      <div class="file-field input-field">
					      	  <div id="btn_materialize" class="waves-effect waves-light btn col s12 m3 l3 offset-m2 offset-l2 light-blue">
						          <span><i class="material-icons left">attachment</i>Seleccionar imagen</span>
						          <input name="imagen1" type="file" multiple/>
					      	  </div>
					      	  <input class="file-path validate" type="text" value="<?php print(htmlspecialchars($imagen1)); ?>"/>
					        </div>
					     </div>
				<?php
			   $img = "<img src='data:image/*;base64,$imagen2' class='responsive-img'>";
			   print($img);
			   ?>		 
                <div class="input-field col s6">
						      <div class="file-field input-field">
					      	  <div id="btn_materialize" class="waves-effect waves-light btn col s12 m3 l3 offset-m2 offset-l2 light-blue">
						          <span><i class="material-icons left">attachment</i>Seleccionar imagen</span>
						          <input name="imagen2" type="file" multiple/>
					      	  </div>
					      	  <input class="file-path validate" type="text" value="<?php print(htmlspecialchars($imagen2)); ?>"/>
					        </div>
					     </div>
				<?php
			   $img = "<img src='data:image/*;base64,$imagen3' class='responsive-img'>";
			   print($img);
			   ?>		 
                <div class="input-field col s6">
						      <div class="file-field input-field">
					      	  <div id="btn_materialize" class="waves-effect waves-light btn col s12 m3 l3 offset-m2 offset-l2 light-blue">
						          <span><i class="material-icons left">attachment</i>Seleccionar imagen</span>
						          <input name="imagen3" type="file" multiple/>
					      	  </div>
					      	  <input class="file-path validate" type="text" value="<?php print(htmlspecialchars($imagen3)); ?>"/>
					        </div>
					     </div>
				<?php
			   $img = "<img src='data:image/*;base64,$imagen4' class='responsive-img'>";
			   print($img);
			   ?>
                <div class="input-field col s6">
						      <div class="file-field input-field">
					      	  <div id="btn_materialize" class="waves-effect waves-light btn col s12 m3 l3 offset-m2 offset-l2 light-blue">
						          <span><i class="material-icons left">attachment</i>Seleccionar imagen</span>
						          <input name="imagen4" type="file" multiple/>
					      	  </div>
					      	  <input class="file-path validate" type="text" value="<?php print(htmlspecialchars($imagen4)); ?>"/>
					        </div>
					     </div>
               
               <div class="row">
                   <button name="agregar" type="submit" value = "agregar" class="waves-effect waves-light btn col s12 m3 l3 offset-m2 offset-l2 light-blue"><i class="material-icons left">create</i>Agregar</button>
                   <button name="cancelar" type="reset" value = "cancelar" class="waves-effect waves-light btn col s12 m3 l3 offset-m2 offset-l2 red"><i class="material-icons left">clear</i>Cancelar</button>
               </div>
           </form>     
      </div>
      <!-- F I N - C O N T E N E D O R -->
      <?php include '../inc/scripts.php' ?>
	  <?php include("../inc/footer2.php");?>
    </body>
  </html>