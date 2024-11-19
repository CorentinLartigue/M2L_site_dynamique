<div class="conteneur">
    <header>
        <?php include 'haut.php' ;?>
    </header>
    <main>
        <div class='informations'>
            <h1><span>Vos contrats : </span></h1>
            <?php
            $formulaireContrats->afficherFormulaire();
            ?>
        </div>
    </main>
    <footer>
        <?php include 'bas.php' ;?>
    </footer>
</div>