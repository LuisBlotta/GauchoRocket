	<footer>
		<section class="navbar bg-dark">
			<ul class="grupo">
				<li>Blotta, Luis</li>	
				<li>Visser, Ana Micaela</li>
			</ul>
			
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="gauchorocket">Inicio</a>
				</li>
                <?php
                if (!empty($_SESSION['usuario'])) {
                    echo"<li class='nav-item'>
                                <a class='nav-link' href='consultar_reservas'>Reservas</a>
                            </li>";
                }
                if (!empty($_SESSION['admin'])) {
                    echo "<li class='nav-item'>
                                <a class='nav-link' href='form_reportes'>Administración</a>
                            </li>";
                }
                ?>
				<li class="nav-item btn-sesion">					
					<?php include("boton-sesion.php") ?>
				</li>
			</ul>

			<article class="redes">
				<a class="a-redes" href="https://www.instagram.com/"><img src="public/img/ig.png"></a>
				<a class="a-redes" href="https://www.twitter.com/"><img src="public/img/tw.png"></a>				
				<a class="a-redes" href="https://www.facebook.com/"><img src="public/img/fb2.png"></a>
			</article>
		</section>
	</footer>