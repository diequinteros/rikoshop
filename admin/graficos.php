<html>
  <?php
  ob_start();
   require("../bibliotecas/database.php");  
  
   ?>
    <head>
      <?php
       include("../inc/styles.php"); 
       ?>   
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <!-- NAV -->
    <?php
     include("../inc/menu2.php")
     ?>
    <body class="grey lighten-3">
      <!-- Categorias -->
      <div id="cont" class="container">

      <div class='card-panel z-depth-3' id="espesoli"></div>
      <br>
      <div class='card-panel z-depth-3' id="ocupaex"></div>
      <br>
        <div class='card-panel z-depth-3' id="practpro"></div>
        <br>
        <div class='card-panel z-depth-3' id="empreesta"></div>
        <br>
      <div class='card-panel z-depth-3' id="espedepar"></div>
      </div>
      </div>
      <?php
       include("../inc/scripts.php"); 
       ?>
<!-- INICIO DE GRAFICOS -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script type="text/javascript">
      
      // Se carga la api de visualizacion y el paquete corecharts de google
      google.charts.load('current', {'packages':['corechart','bar']});

      // Se hace un callback para que corra cuando el visualizador este cargado
      google.charts.setOnLoadCallback(drawChart);

      // Callback que crea y llena la tabla de datos
      // Se crea el grafico y se le pasan los datos y se dibuja
      function drawChart() {

        // Se crea la tabla de datos
        var data = new google.visualization.DataTable();
        //Se agrega la columna de tipo string  con titulo Topping
        data.addColumn('string', 'Titulo');
        //Se agrega la columna de tipo numero con titulo Slices
        data.addColumn('number', 'Usuarios');
        //Se agregan las filas
        <?php
        $sql1 = "SELECT COUNT(id_seleccion) FROM selecciones WHERE id_venta IS NOT NULL";
        $usuariocompra = Database::getRow($sql1, null);
        $sql2 = "SELECT COUNT(id_usuario) FROM usuarios WHERE id_tipo = 2";
        $usuario = Database::getRow($sql2, null);
        $usuarionocompra = $usuario[0] - $usuariocompra[0];
        if($usuariocompra[0] == null)
        {
            $usuariocompra[0] = 0;
        }
        if($usuarionocompra == null)
        {
            $usuarionocompra = 0;
        }
        print("data.addRows([
          ['Usuarios registrados que han hecho minimo una compra.', ".$usuariocompra[0]."],
          ['Usuarios registrados que no han comprado nada.', ".$usuarionocompra."],
        ]);");
        ?>
        // Se definen las opciones del grafico
        var options = {'title':'Grafico de usuarios y sus compras',
                       'width':900,
                       'height':650};

        // Se instancia y dibuja nuestro grafico, ademas se pasan las opciones.
        var chart = new google.visualization.PieChart(document.getElementById('practpro'));
        chart.draw(data, options);
      }
  </script>
      <script type="text/javascript">
      //google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Categoria', 'Productos vendidos'],
          <?php
          $HPro = 0;
          $sqlcat = "SELECT id_categoria, categoria FROM categorias";
          $cat = Database::getRows($sqlcat, null);
          
          foreach($cat as $cate)
          {
            $sqlcantCat = "SELECT SUM(cantidad) FROM selecciones, productos, categorias WHERE selecciones.id_producto = productos.id_producto AND productos.id_categoria = categorias.id_categoria AND id_venta IS NOT NULL AND categorias.id_categoria = ?";
            $par = array($cate['id_categoria']);
            $CC = Database::getRow($sqlcantCat, $par);
            if($CC[0] == null)
            {
              $CC[0] = 0;
            }
            print("['".$cate['categoria']."', ".$CC[0]."],");
            $HPro = $HPro + 95;
          }
          ?>
          
        ]);

        var options = {
          width: 900,
          height: <?php print($HPro); ?>,
          legend: { position: 'none' },
          chart: { title: 'Grafico numero de productos vendidos por categoria' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Cantidad'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('ocupaex'));
        chart.draw(data, options);
      };
    </script>
      <script type="text/javascript">
      //google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Usuario', 'Total'],
          <?php
          $HPro = 0;
          $sqlusus = "SELECT id_usuario, usuario FROM usuarios WHERE id_tipo = 2";
          $usus = Database::getRows($sqlusus, null);
          $ar;
          foreach($usus as $usuarios)
          {
            $sqlTotal = "SELECT SUM(total) FROM ventas, usuarios WHERE ventas.id_usuario = usuarios.id_usuario AND usuarios.id_usuario = ?";
            $par = array($usuarios['id_usuario']);
            $T = Database::getRow($sqlTotal, $par);
            if($T[0] == null)
            {
              $T[0] = 0;
            }
            $ar[$usuarios['usuario']] = $T[0];  
          }
          arsort($ar);
          $num = 0;
          foreach($ar as $key => $arreglo ){
              if($num < 5){
                  $num = $num + 1;
                  print("['".$key."', ".$arreglo."],");
              }
          }
          ?>
        ]);

        var options = {
          width: 900,
          height: <?php print($HPro); ?>,
          legend: { position: 'none' },
          chart: { title: 'Grafico numero de productos vendidos por categoria' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Cantidad'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('empreesta'));
        chart.draw(data, options);
      };
    </script>
    <script type="text/javascript">
    // Se hace un callback para que corra cuando el visualizador este cargado
      google.charts.setOnLoadCallback(drawChartEmp);

      // Callback que crea y llena la tabla de datos
      // Se crea el grafico y se le pasan los datos y se dibuja
      function drawChartEmp() {

        // Se crea la tabla de datos
        var data3 = new google.visualization.DataTable();
        //Se agrega la columna de tipo string  con titulo titulo
        data3.addColumn('string', 'Titulo');
        //Se agrega la columna de tipo numero con titulo empresas
        data3.addColumn('number', 'Empresas');
        //Se agregan las filas
        <?php
        $sqlE1 = "SELECT COUNT(id_empresa) FROM empresas WHERE codigo_empresa IS NULL AND contraseña_empre IS NULL";
        $empreN = Database::getRow($sqlE1, null);
        $sqlE2 = "SELECT COUNT(id_empresa) FROM empresas WHERE codigo_empresa IS NOT NULL AND contraseña_empre IS NOT NULL";
        $empreS = Database::getRow($sqlE2, null);
        if($empreN[0] == null)
        {
            $empreN[0] = 0;
        }
        if($empreS == null)
        {
            $empreS[0] = 0;
        }
        print("data3.addRows([
          ['Empresas que aun no pueden iniciar sesion en el sistema', ".$empreN[0]."],
          ['Empresas que pueden iniciar sesion en el sistema', ".$empreS[0]."],
        ]);");
        ?>
        // Se definen las opciones del grafico
        var options3 = {'title':'Grafico de empresas y su estado en el sistema',
                       'width':900,
                       'height':650};

        // Se instancia y dibuja nuestro grafico, ademas se pasan las opciones.
        var chart = new google.visualization.PieChart(document.getElementById('empreesta'));
        chart.draw(data3, options3);
      }
  </script>
        <script type="text/javascript">
      //google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff3);
      function drawStuff3() {
        var data4 = new google.visualization.arrayToDataTable([
          ['Documentos', 'Alumnos que lo han entregado'],
          <?php
          $sqlADA = "SELECT COUNT(id_registropp) FROM registrospp WHERE acuerdo IS NOT NULL";
          $acuerdo = Database::getRow($sqlADA, null);
          $sqlADB = "SELECT COUNT(id_registropp) FROM registrospp WHERE bitacora IS NOT NULL";
          $bitacora = Database::getRow($sqlADB, null);
          $sqlADC = "SELECT COUNT(id_registropp) FROM registrospp WHERE carta IS NOT NULL";
          $carta = Database::getRow($sqlADC, null);
            print("['Acuerdo', ".$acuerdo[0]."],");
            print("['Bitacora', ".$bitacora[0]."],");
            print("['Carta', ".$carta[0]."],");
          ?>
        ]);

        var options4 = {
          title: 'Chess opening moves',
          width: 900,
          height: 300,
          legend: { position: 'none' },
          chart: { title: 'Numero de documentos entregados'},
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Numero de alumnos que han entregado el documento'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('espedepar'));
        chart.draw(data4, options4);
      };
    </script>
      <?php include("../inc/footer2.php"); ?>
    </body>
  </html>
  <?php
    ob_end_flush();
  ?>