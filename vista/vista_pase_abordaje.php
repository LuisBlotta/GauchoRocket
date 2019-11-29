<?php
include ("condicional_sesion.php");
	$qr=getQR();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pase de Abordaje</title>
    <?php// include("head.php"); ?>
</head>
<body>
	<?php echo '<img src="'.$qr.'" /><hr/>'; ?>

</body>
</html>