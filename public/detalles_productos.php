 <!DOCTYPE html>
  <html>
    <head>
      <?php include '../inc/styles.php' ?>
      <?php require '../bibliotecas/database.php'; ?>
      <?php require '../bibliotecas/validator.php'; ?>
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
      <?php
      $valo = 1;
        Database::connect();
        #Se obtiene id del producto
        $id = $_GET ['id'];
        #Se seleccionan los datos del producto seleccionado
        $sql = "SELECT id_producto, nombre_producto, descripcion_pro, precio, marca, categoria FROM productos, marcas, categorias WHERE productos.id_marca = marcas.id_marca AND productos.id_categoria = categorias.id_categoria AND id_producto = ?";
        $params = array($id);
        $data = Database::getRow($sql,$params);
        $nombre_produc = $data['nombre_producto'];
        $descripcion = $data['descripcion_pro'];
        $precio = $data['precio'];
        $marca = $data['marca'];
        $categoria = $data['categoria'];
        #Proceso para agregar comentarios
        if(!empty($_POST))
            {
                //Se obtienen los valores del post
                $_POST = Validator::validateForm($_POST);
                $idusuario = $_SESSION['id_usuario'];
                $titulo = strip_tags(trim($_POST['coment']));
                $contenido = strip_tags(trim($_POST['contecoment']));
                $valo = strip_tags(trim($_POST['valo']));
                //Se verifica que el usuario este logueado
                if($idusuario == "")
                {
                    $idusuario = null;
                }
                else{
                    print("<div class='card-panel red'><i class='material-icons left'>error</i>Debe iniciar sesion</div>");
                }

                try 
                {
                    //Se verifica que esten llenos los campos
                    if($titulo == "" || $contenido == "")
                    {
                        throw new Exception("Datos incompletos.");
                    }
                        $sql = "INSERT INTO comentarios(id_usuario, titulo, contenido, valoracion, id_producto) VALUES(?, ?, ?, ? , ?)";
                        $params = array($_SESSION['id_usuario'], $titulo, $contenido, $valo, 10);
                    Database::executeRow($sql, $params);
                }
                catch (Exception $error)
                {
                    print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
                }
            }    
      ?>
      <!-- C O N T E N E D O R -->
      <div class="container white z-depth-5">
      <h1><?php print($nombre_produc); ?></h1>  
      <div class="row">
        <!-- I N I C I O - D E - S L I D E R -->
        <div class="col s12 m6 l6">
          <div id="este-st" class="slider">
            <ul class="slides materialboxed">
            <?php
              $cons = "SELECT imagen FROM imagenes, productos WHERE imagenes.id_producto = 10";
              $lis = null;
              //Se cargan las imagenes del producto en el slider
              foreach (Database::getRows($cons, null) as $imagenes) {
                  $lis = "<li>
                  <img src='data:image/*;base64,$imagenes[imagen]'>
                <div class='caption center-align'>
                </div>
              </li>";
              print($lis);
              }
             ?>
            </ul>
          </div>
          <a class="waves-effect waves-light btn white black-text" onclick="slides_atras();"><i class="material-icons">keyboard_arrow_left</i></a>
          <a class="waves-effect waves-light btn white black-text" onclick="slides_adelante();"><i class="material-icons">keyboard_arrow_right</i></a>
        </div>
        <!-- F I N - D E - S L I D E R -->
        <!-- P R E C I O - P R O D U C T O -->
        <form action="metodo_compra.php" method="post">
        <div class="col s12 m6 l6">
        <a>
        <?php
        //Se selecciona el promedio de valoraciones del producto
        $sqlvaloraciones = "SELECT AVG(valoracion) prom FROM comentarios WHERE id_producto = $id";
        $prom =Database::getRow($sqlvaloraciones, null);
        $prom = round($prom['prom']);
        print("<h5 class='black-text'>Valoracion:</h5>");
        //Se impreme la valoracion
        for ($i=0; $i < $prom ; $i++) { 
            print("<i class='material-icons yellow-text text-darken-1'>grade</i>");
        }
        ?>
        </a>
        <!-- Se muestras los datos del producto -->
            <li class="divider"></li>
            <h6>Precio: <?php print($precio); ?></h6>
            <li class="divider"></li>
            <h6>Envio: Gratis</h6>
            <li class="divider"></li>
            <h6>Marca: <?php print($marca); ?></h6>
            <li class="divider"></li>
            <div class="row">
            <h6 class="col s6">Cantidad:</h6><input name="canti" type="text" class="validate col s6">
            </div>
            <li class="divider"></li>
            <div>
                <button type = "submit" class="waves-effect waves-light btn"><i class="material-icons right">add_shopping_cart</i>Agregar a carretilla</button>
            </div>
        </div>
        </form>
        <!-- F I N - P R E C I O - P R O D U C T O -->
        </div>
        <!-- D E T A L L E S - D E - P R O D U C T O -->
        <div class="divider"></div>
        <h3>Detalles del producto</h3>
        <ul class="collapsible popout" data-collapsible="accordion">
            <li>
            <!-- Se muestra la descripcion del producto -->
                <div class="collapsible-header">Descripcion</div>
                <div class="collapsible-body"><p><?php print($descripcion); ?></p></div>
            </li>
            <li>
                <div class="collapsible-header">Marca</div>
                <div class="collapsible-body">
                <!-- Se muestra la marca del producto -->
                    <p><?php print($marca); ?></p>
                    </div>
            </li>
         </ul>
         <!-- F I N - D E T A L L E S - D E - P R O D U C T O -->
         <!-- C O M E N T A R I O S -->
         <div>
         <!-- Se cargan los comentarios -->
             <h3>Comentarios:</h3>
               <ul class="collection">
               <?php
               //Se seleccionan los comentarios del producto seleccionado
               $coment = "SELECT usuario, titulo, contenido, valoracion FROM comentarios, usuarios WHERE comentarios.id_usuario = usuarios.id_usuario AND id_producto = $id";
               //Se imprime cada comentario
               foreach (Database::getRows($coment, null) as $comentarios) {
                  $licoment = "<li class='collection-item avatar'>
                        <i class='material-icons circle blue'>person</i>
                        <span class='title'>$comentarios[usuario]</span>
                        <p>$comentarios[titulo]<br>
                        $comentarios[contenido]
                        </p>
                        <a class='secondary-content'>";
                        for ($i=0; $i < $comentarios['valoracion'] ; $i++) { 
                         $licoment .= "<i class='material-icons yellow-text text-darken-1'>grade</i>";   
                        }
                        $licoment .= "</a></li>";
                        print($licoment);
               }
               //Si esta logueado se muestra la opcion de comentar
               if(isset($_SESSION['id_usuario']))
               {
                   //Se imprime el formulario
               $hacercoment ="<form name ='formu' method='post' enctype='multipart/form-data'>
                    <li class='collection-item avatar'>
                        <i class='material-icons circle blue'>person</i> 
                        <span class='title'>Tu</span>
                        <p>
                            <div class='input-field col s6'>
                                <input id='last_name' name = 'coment' type='text' class='validate'>
                                <label for='last_name'>Titulo comentario</label>
                            </div>
                            <br>
                            <div class='input-field col s12'>
                                <textarea id='textarea1' name ='contecoment' class='materialize-textarea'></textarea>
                                <label for='textarea1'>Escribe tu comentario</label>
                            </div>
                        </p>
                        <a class='secondary-content'>Valoracion: <input class = 'hide' id='ivalo' name='valo' type='text' value='1'><i id='v1' class='material-icons yellow-text text-darken-1' onclick ='v1();'>grade</i><i id='v2' class='material-icons grey-text' onclick ='v2();'>grade</i><i id='v3' class='material-icons grey-text' onclick ='v3();'>grade</i><i id='v4' class='material-icons grey-text' onclick ='v4();'>grade</i><i id='v5' class='material-icons grey-text' onclick ='v5();'>grade</i></a>
                        <button type='submit' class='waves-effect waves-light btn blue'><i class='material-icons left'>send</i>Enviar comentario</button>
                    </li>
                    </form>";
                print($hacercoment);
               }
               
               ?>
               
                </ul>
         </div>
         <!-- F I N - C O M E N T A R I O S -->
         <!-- R E L A C I O N A D O S -->
         <h3>Relacionado</h3>
         <div class="row">   
            <!-- T A R J E T A 1 -->
          <div class="card col s12 m6 l4">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="../img/tarjetas/nuevo1.png">
            </div>
            <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">Audifonos sony<i class="material-icons right">more_vert</i></span>
                <p><a href="#">Mas información</a></p>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Audifonos sony<i class="material-icons right">close</i></span>
                <p>Audifonos sony color negro.</p>
            </div>
           </div>
           <!-- T A R J E T A 2 -->
          <div class="card col s12 m6 l4">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="../img/tarjetas/nuevo2.png">
            </div>
            <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">Cable HDMI<i class="material-icons right">more_vert</i></span>
                <p><a href="#">Mas información</a></p>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Cable HDMI<i class="material-icons right">close</i></span>
                <p>Cable HDMI 3mt de largo..</p>
            </div>
           </div>
           <!-- T A R J E T A 3 -->
          <div class="card col s12 m6 l4">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="../img/tarjetas/nuevo3.png">
            </div>
            <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">Powerbank<i class="material-icons right">more_vert</i></span>
                <p><a href="#">Mas información</a></p>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Powerbank<i class="material-icons right">close</i></span>
                <p>Powerbank de 3000 mah con correa.</p>
            </div>
           </div>
         </div>
         <!-- F I N - R E L A C I O N A D O S -->
      </div>
      <!-- F I N - C O N T E N E D O R -->
      <?php include '../inc/scripts.php' ?>
      <script type="text/javascript" src="../js/valoracion.js"></script>
    </body>
        <?php include '../inc/footer2.php' ?>
  </html>