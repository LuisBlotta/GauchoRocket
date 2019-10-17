<!DOCTYPE html>
<html>
<head>
	<title>Resultado de la Búsqueda</title>
	<?php include("head.php"); ?>
</head>
<body>
	<?php include("header.php"); ?>
	<main>
		<h2>Resultado de la Búsqueda</h2>
		<table class="table">
				<tr>
					<th>Fecha de partida</th>
					<th>Lugar de origen</th>
					<th>Destino</th>					
				</tr>
				<?php
					if(isset($_POST['buscar'])) {						
						include("buscar_vuelos.php");
					}else{
						include("mostrar_vuelos.php");	
					}
					foreach ($vuelos as $vuelo){				
						echo "<tr>
						<td>" . $vuelo['fecha_ida'] . "</td>										
						<td>" . $vuelo['origen'] . "</td>
						<td>" . $vuelo['destino'] . "</td>				
						</tr>";
					}
				?>
			</table>
		</main>		

</body>
</html>