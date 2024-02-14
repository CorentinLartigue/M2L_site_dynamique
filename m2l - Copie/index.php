<?php
require_once 'lib/autoLoader.php';


session_start();



?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<title>Maison des Ligues de Lorraine</title>
		<style type="text/css">
			@import url(styles/m2l.css);
		</style>
	
	</head>
	<body >
		<?php
			require_once 'controleur/controleurPrincipal.php';
		?>

	</body>
</html>
