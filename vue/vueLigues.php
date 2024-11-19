<div id="conteneur">

    <header>
        <?php include 'vue/haut.php' ;?>
    </header>



    <main>
        <div class='gauche'>
            <aside>
                <nav>
                    <?php  include 'vue/ligue/vueGaucheLigue.php' ;?>
                </nav>
            </aside>
            <form action="index.php" method="post" id="formuLigue" class="formuLigue">
            <?php
                if ($contexte === "EditLigue") {
                    echo '<input type="submit" name="LigueAjouter" id="LigueAjouter" value="Ajouter" class="bouton-ajouter"> ';
                }
            ?>
            </form>        
        </div>
        <div class='droite'>
            <?php include 'vue/ligue/vueDroiteLigueConsult.php' ;
                if(isset($_SESSION['clubsDeLaLigue'])){
                    echo "<h2>Les clubs affiliés  :</h2>";
                    echo "<ul>";
                    foreach ($_SESSION['clubsDeLaLigue'] as $club){
                        echo "<li><strong>{$club->getNomClub()}</strong> - {$club->getAdresseClub()}</li>";

                    }
                    echo "</ul>";
                }
            ?>
        </div>
    </main>

    

    <footer>
        <?php  include 'vue/bas.php' ;?>
    </footer>

</div>