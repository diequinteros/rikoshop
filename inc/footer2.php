<footer class="page-footer blue darken-1">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">RikoShop</h5>
                <p class="grey-text text-lighten-4">Siguenos en nuestras redes sociales:</p>
                <?php
                  $sql = "SELECT * FROM redes ORDER BY id_red";
                  $params = null;
                  $data = Database::getRows($sql, $params);
                  $tabla = "";
                  foreach($data as $row){
                    $tabla .= "<li><a class='grey-text text-lighten-3' target='blank' href='$row[url]'>$row[red]</a></li>";
                  }
                  print($tabla);
                ?>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Mas información</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Quienes somos</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Mision</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Vision</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Valores</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Equipo de trabajo</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
              RikoShop 2016
            </div>
          </div>
</footer>