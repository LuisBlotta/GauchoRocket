	<header>
		<nav class="navbar navbar-expand-md bg-dark navbar-dark">
			<!-- Logo -->
			<a class="logo" href="gauchorocket"><img src="public/img/logo-b.png"></a>

			<!-- Search 	
			<section class="buscador">		
			<form class="form-buscador" action="#" method="get">
				<input class="form-control mr-sm-2" type="text" placeholder="Buscar">
				<button class="btn btn-info" type="submit"><img src="public/img/search.png"></button>
			</form>	
			</section>-->		

			<!-- Toggler/collapsibe Button -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>

			<!-- Navbar links -->
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="gauchorocket">Inicio</a>
					</li>
                    <?php
                    if (!empty($_SESSION['usuario'])) {
                        include_once("modelo/modelo_info_usuario.php");
                        $datos_usuario=getInfoUsuario();
                        echo"<li class='nav-item'>
                                <a class='nav-link' href='consultar_reservas'>Reservas</a>
                            </li>
                            <li class='nav-item'>
                                 <div class='dropdown'>
                                  <a class='nav-link dropdown-toggle' data-toggle='dropdown'>
                                    Mis Datos
                                  </a>
                                  <div class='dropdown-menu'>
                                       <p class='dropdown-header'>Nick</p>
                                       <p class='dropdown-item-text'>".$datos_usuario['nick']."</p>
                                       <p class='dropdown-header'>Nombre</p>
                                       <p class='dropdown-item-text'>".$datos_usuario['nombre']."</p>
                                       <p class='dropdown-header'>E-mail</p>
                                       <p class='dropdown-item-text'>".$datos_usuario['mail']."</p>
                                       <p class='dropdown-header'>Nivel</p>
                                       <p class='dropdown-item-text'>".$datos_usuario['fk_nivel']."</p>
                                  </div>
                                </div> 
                            </li>";
                    }
                    if (!empty($_SESSION['admin'])) {
                       echo "<li class='nav-item'>
                                <a class='nav-link' href='form_reportes'>Administración</a>
                            </li>";
                    }
                    ?>
                    <li class="nav-item item-sesion">
						<?php include("boton-sesion.php") ?>
					</li>
				</ul>				
			</div>
		</nav>
	</header>