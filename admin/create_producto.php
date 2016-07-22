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
        include("scrud/create_producto.php");
        ?>  
      <!--?php include 'inc/menu.php' ?>-->
      <br>
      <!-- C O N T E N E D O R -->
      <div id="contenedor" class="container white z-depth-5">  
          <h2 class="center-align">Agregar un producto</h2>
           <form  action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
               <div class="input-field col s6">
                    <input  name="nombre" type="text" class="validate">
                    <label for="nombre">Nombre</label>
               </div>
               <div class="input-field col s12">
                  <textarea name="descripcion" class="materialize-textarea"></textarea>
                  <label for="descripcion">Descripción</label>
               </div>
               <div class="input-field col s6">
                    <input  name="precio" type="text" class="validate">
                    <label for="precio">Precio</label>
               </div>
               <div class="input-field col s6">
						      <select name="marca" class="browser-default" required>
						          <option value="" disabled selected>Seleccione la marca</option>
						          <?php
								  	Database::connect();
						    	    $consulta = "SELECT * FROM marcas";
				    			    $opciones = ""; //Arreglo de datos
				    			    foreach(Database::$connection->query($consulta) as $datos)
				    			    {
									      $opciones .= "<option value='$datos[id_marca]'";
									      if(isset($tipo) == $datos['id_marca'])
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
                    <input  name="existencia" type="text" class="validate">
                    <label for="existencia">Existencia</label>
               </div>
                <div class="input-field col s6">
						      <div class="file-field input-field">
					      	  <div id="btn_materialize" class="waves-effect waves-light btn col s12 m3 l3 offset-m2 offset-l2 light-blue">
						          <span><i class="material-icons left">attachment</i>Seleccionar imagen</span>
						          <input name="imagen" type="file" multiple/>
					      	  </div>
					      	  <input class="file-path validate" type="text"/>
					        </div>
					     </div>
                <div class="input-field col s6">
						      <div class="file-field input-field">
					      	  <div id="btn_materialize" class="waves-effect waves-light btn col s12 m3 l3 offset-m2 offset-l2 light-blue">
						          <span><i class="material-icons left">attachment</i>Seleccionar imagen</span>
						          <input name="imagen2" type="file" multiple/>
					      	  </div>
					      	  <input class="file-path validate" type="text"/>
					        </div>
					     </div>
                <div class="input-field col s6">
						      <div class="file-field input-field">
					      	  <div id="btn_materialize" class="waves-effect waves-light btn col s12 m3 l3 offset-m2 offset-l2 light-blue">
						          <span><i class="material-icons left">attachment</i>Seleccionar imagen</span>
						          <input name="imagen3" type="file" multiple/>
					      	  </div>
					      	  <input class="file-path validate" type="text"/>
					        </div>
					     </div>
                <div class="input-field col s6">
						      <div class="file-field input-field">
					      	  <div id="btn_materialize" class="waves-effect waves-light btn col s12 m3 l3 offset-m2 offset-l2 light-blue">
						          <span><i class="material-icons left">attachment</i>Seleccionar imagen</span>
						          <input name="imagen4" type="file" multiple/>
					      	  </div>
					      	  <input class="file-path validate" type="text"/>
					        </div>
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