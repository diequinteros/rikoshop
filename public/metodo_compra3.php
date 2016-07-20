<!DOCTYPE html>
  <html>
    <head>
      <?php include 'inc/styles.php' ?>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    </head>
    <body class="purple lighten-5">
    <?php include 'inc/menu.php' ?>
      <!-- Fin de nav -->
      <h1> Shopping card <i class="material-icons md-48">shopping_cart</i> </h1>
      <div class="container">
          <!-- Inicio carta -->
          <div class="card">
              <!-- Inicio tabla -->
            <table>
                <thead>
                    <tr>
                        <th data-field="product">Producto</th>
                        <th data-field="product-text"></th>
                        <th data-field="price">Precio</th>
                        <th data-field="quantity">Cantidad</th>
                        <th data-field="line_total">Total</th>
                        <th data-field="options">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img class="responsive img" width="150" src="img/tarjetas/nuevo3.png"></td>
                        <td>Bateria externa</td>
                        <td>$9.99</td>
                        <td>1</td>
                        <td>$9.99</td>
                        <td><a><i class="material-icons">close</i></a></td>
                    </tr>
                </tbody>
            </table>
            <!-- Fin tabla -->
            <div class="divider"></div>
            <!-- Fila -->
            <div class="row">
                <div class="col s6 l4 offset-s6 offset-l8">
                    Subtotal: $9.99
                    <br>
                    Envio: $0.00
                    <div class="divider"></div>
                    <h4>Total: $9.99</h4>
                </div>
            </div>
            <!-- Fin fila -->
            <div class="divider"></div>
            <div id="fila-metodo-compra" class="row">
                <div class="col s6 l4 offset-s6 offset-l8"> 
                    <a class="waves-effect waves-light btn"><i class="material-icons right">attach_money</i>Pagar</a>
                </div>        
            </div>
          </div>
          <!-- Fin carta -->
      </div>
      </body>
        <?php include 'inc/footer.php' ?>
  </html>