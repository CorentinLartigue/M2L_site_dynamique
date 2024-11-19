<div id="conteneur">
	
	<header>
		<?php include 'vue/haut.php' ;?>
	</header>
	
	

	<main>
        <div class='gauche'>
			<aside>
				<nav>
					<?php  include 'vue/club/vueGaucheClub.php' ;?> 
				</nav>
			</aside>
			<form action="index.php" method="post" id="formuClub" class="formuClub">
            <?php
                if ($contexte === "EditClub") {
                    echo '<input type="submit" name="ClubAjouter" id="ClubAjouter" value="Ajouter" class="bouton-ajouter"> ';
                }
            ?>
            </form>  
		</div>
		<div class='droite'>			
			<?php include 'vue/club/vueDroiteClubConsult.php' ;?> 
		</div>
	</main>

	

	<footer>
		<?php  include 'vue/bas.php' ;?> 
	</footer>
	
</div>