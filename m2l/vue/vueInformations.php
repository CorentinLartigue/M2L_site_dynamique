<div class="conteneur">
    <header>
        <?php include 'haut.php' ;?>
    </header>
    <main>
        <div class='informations'>
            <h1><span>Vos informations : </span></h1>
            <?php
            $formulaireInfos->afficherFormulaire();
            ?>
        </div>
    </main>
    <footer>
        <?php include 'bas.php' ;?>
    </footer>
</div>