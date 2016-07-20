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
      <div class="container white z-depth-5">  
        <!-- E N C A B E Z A D O - D E - P A G I N A -->
        <li class="divider"></li>
        <br>
        <!-- I N I C I O - D E - S L I D E R -->
        <div class="slider">
          <ul class="slides">
            <li>
              <img src="../img/slider/usb1.jpg">
              <div class="caption center-align">
                <h3 class="blue-text text-darken-1">Mira nuestos nuevos USB!</h3>
                
              </div>
            </li>
            <li>
              <img src="../img/slider/usb2.jpg">
              <div class="caption left-align">
                <h3 class="blue-text text-darken-1">Memorias USB con nuevos diseños</h3>
                
              </div>
            </li>
            <li>
              <img src="../img/slider/usb3.jpg">
              <div class="caption right-align">
                <h3 class="blue-text text-darken-1">USB para todos</h3>
              </div>
            </li>
          </ul>
        </div>
        <!-- F I N - D E - S L I D E R -->
        <!-- P R O D U C T O S - N U E V O S -->
        <h2><i class="material-icons md-36">label</i>Productos nuevos</h2>
        <li class="divider"></li>
        <div class="row">
          <!--I N I C I O - T A R J E T A S-->
          <!-- T A R J E T A 1 -->
          <div class="card col s12 m6 l4">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="../img/tarjetas/nuevo1.png">
            </div>
            <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">Audifonos sony<i class="material-icons right">more_vert</i></span>
                <p><a href="detalles_productos2.php">Mas información</a></p>
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
                <p><a href="detalles_productos3.php">Mas información</a></p>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Cable HDMI<i class="material-icons right">close</i></span>
                <p>Cable HDMI 3mt de largo.</p>
            </div>
           </div>
           <!-- T A R J E T A 3 -->
          <div class="card col s12 m6 l4">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="../img/tarjetas/nuevo3.png">
            </div>
            <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">Powerbank<i class="material-icons right">more_vert</i></span>
                <p><a href="detalles_productos.php">Mas información</a></p>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Powerbank<i class="material-icons right">close</i></span>
                <p>Powerbank de 3000 mah con correa.</p>
            </div>
           </div>
           <!-- F I N - T A R J E T A S -->    
        </div>
        <!-- F I N - P R O D U C T O S - N U E V O S -->
        <!-- P R O D U C T O S - M A S - V E N D I D O S -->
        <h2><i class="material-icons md-36">label</i>Productos mas vendidos</h2>
        <li class="divider"></li>
        <div class="row">
          <!--I N I C I O - T A R J E T A S-->
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
           <!-- F I N - T A R J E T A S -->    
        </div>
        <!-- F I N - P R O D U C T O S - M A S - V E N D I D O -->          
      </div>
      <!-- F I N - C O N T E N E D O R -->
      <?php include '../inc/scripts.php' ?>
    </body>
        <?php include '../inc/footer2.php' ?>
  </html>