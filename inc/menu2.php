<?php
$menu = "";
session_start();
if(isset($_SESSION['tipo'])){
	if($_SESSION['tipo'] == 1){
		$menu .= "<div class='navbar-fixed'>
				<nav>
					<div class='nav-wrapper blue darken-1'>
						<a id='Logo' href='http://localhost/Rikoshop/admin/index.php' class='brand-logo'>( ͡° ͜ʖ ͡°)</a>
						<a href='#' data-activates='mobile-demo' class='button-collapse'><i class='material-icons'>menu</i></a>
						<ul class='right hide-on-med-and-down'>
							<li><a href='http://localhost/Rikoshop/admin/index.php'><i class='material-icons left'>home</i>Inicio</a></li>
							<li><a href='http://localhost/Rikoshop/public/profile.php'><i class='material-icons left'>account_circle</i>".$_SESSION['nombre_usuario']."</a></li>
							<li><a href='http://localhost/Rikoshop/public/logout.php'><i class='material-icons left'>power_settings_new</i>Cerrar Sesion</a></li>
						</ul>
						<ul class='side-nav' id='mobile-demo'>
							<li><a href='http://localhost/Rikoshop/admin/index.php'><i class='material-icons left'>home</i>Inicio</a></li>
							<li><a href='http://localhost/Rikoshop/public/profile.php'><i class='material-icons left'>account_circle</i>".$_SESSION['nombre_usuario']."</a></li>
							<li><a href='http://localhost/Rikoshop/public/logout.php'><i class='material-icons left'>power_settings_new</i>Cerrar Sesion</a></li>
							<footer align='center'>
								<small>
									<p id='Cr'>Copyright ©</p>
								</small>
							</footer>
						</ul>
					</div>
				</nav>
			</div>";
	}
	if($_SESSION['tipo'] == 2){
		$menu .= "<div class='navbar-fixed'>
				<nav>
					<div class='nav-wrapper blue darken-1'>
						<a id='Logo' href='http://localhost/Rikoshop/public/index.php' class='brand-logo'>( ͡° ͜ʖ ͡°)</a>
						<a href='#' data-activates='mobile-demo' class='button-collapse'><i class='material-icons'>menu</i></a>
						<ul class='right hide-on-med-and-down'>
							<li><a href='http://localhost/Rikoshop/public/index.php'><i class='material-icons left'>home</i>Inicio</a></li>
							<li><a href='http://localhost/Rikoshop/public/menucat.php'><i class='material-icons left'>local_grocery_store</i>Categorías</a></li>
							<li><a href='http://localhost/Rikoshop/public/profile.php'><i class='material-icons left'>account_circle</i>".$_SESSION['nombre_usuario']."</a></li>
							<li><a href='http://localhost/Rikoshop/public/logout.php'><i class='material-icons left'>power_settings_new</i>Cerrar Sesion</a></li>
						</ul>
						<ul class='side-nav' id='mobile-demo'>
							<li><a href='http://localhost/Rikoshop/public/index.php'><i class='material-icons left'>home</i>Inicio</a></li>
							<li><a href='http://localhost/Rikoshop/public/menucat.php'><i class='material-icons left'>local_grocery_store</i>Categorías</a></li>
							<li><a href='http://localhost/Rikoshop/public/profile.php'><i class='material-icons left'>account_circle</i>".$_SESSION['nombre_usuario']."</a></li>
							<li><a href='http://localhost/Rikoshop/public/logout.php'><i class='material-icons left'>power_settings_new</i>Cerrar Sesion</a></li>
							<footer align='center'>
								<small>
									<p id='Cr'>Copyright ©</p>
								</small>
							</footer>
						</ul>
					</div>
				</nav>
			</div>";
	}
}
else{
	$menu .= "<div class='navbar-fixed'>
				<nav>
					<div class='nav-wrapper blue darken-1'>
						<a id='Logo' href='https://localhost/Rikoshop/public/index.php' class='brand-logo'>( ͡° ͜ʖ ͡°)</a>
						<a href='#' data-activates='mobile-demo' class='button-collapse'><i class='material-icons'>menu</i></a>
						<ul class='right hide-on-med-and-down'>
							<li><a href='https://localhost/Rikoshop/public/index.php'><i class='material-icons left'>home</i>Inicio</a></li>
							<li><a href='https://localhost/Rikoshop/public/menucat.php'><i class='material-icons left'>local_grocery_store</i>Categorías</a></li>
							<li><a href='https://localhost/Rikoshop/public/registro.php'><i class='material-icons left'>group_add</i>Registrate</a></li>
							<li><a href='https://localhost/Rikoshop/public/login.php'><i class='material-icons left'>account_circle</i>Iniciar Sesion</a></li>
						</ul>
						<ul class='side-nav' id='mobile-demo'>
							<li><a href='https://localhost/Rikoshop/public/index.php'><i class='material-icons left'>home</i>Inicio</a></li>
							<li><a href='https://localhost/Rikoshop/public/menucat.php'><i class='material-icons left'>local_grocery_store</i>Categorías</a></li>
							<li><a href='https://localhost/Rikoshop/public/registro.php'><i class='material-icons left'>group_add</i>Registrate</a></li>
							<li><a href='https://localhost/Rikoshop/public/login.php'><i class='material-icons left'>account_circle</i>Iniciar Sesion</a></li>
							<footer align='center'>
								<small>
									<p id='Cr'>Copyright ©</p>
								</small>
							</footer>
						</ul>
					</div>
				</nav>
			</div>";
}
print($menu);
?>