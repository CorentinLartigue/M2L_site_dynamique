<div class="conteneur">
	<header>
		<?php include 'haut.php' ;?>
	</header>
	<main>
		<div class="contentConnexion">
			<div class='connexion'>
				<div class='titre'>Veuillez vous identifier</div>
				<?php 
					$formulaireConnexion->afficherFormulaire();
				?>
			</div>
		</div>
	</main>
	<footer>
		<?php include 'bas.php' ;?>
	</footer>
</div>
