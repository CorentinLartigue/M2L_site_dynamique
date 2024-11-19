<div class="conteneur">
    <header>
        <?php include 'haut.php'; ?>
    </header>
    <main>
        <div class='gauche'>
            <div class="menu-vertical">
                <h3>Formations disponibles :</h3>
                <ul>
                    <?php echo $leMenuFormations; ?>
                </ul>
            </div>
            <div class="menu-vertical">
                <?php
                if (!empty($inscriptions)) {
                    echo '<h3>Formations auxquelles vous êtes inscrit :</h3>';
                    echo '<ul>';
                    foreach ($inscriptions as $inscription) {
                        echo '<li><a href="?details=' . $inscription->getIdForma() . '">' . $inscription->getIntitule() . '</a></li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p>Vous n\'êtes inscrit à aucune formation pour le moment.</p>';
                }
                ?>
            </div>
        </div>
        <div class='droite'>
            <?php
            if (isset($_GET['details'])) {
                $formationId = $_GET['details'];
                $formation = formationDAO::getFormationById($formationId);

                if ($formation) {
                    echo '<div id="details-formation">';
                    echo '<h2>Détails de la formation</h2>';
                    echo '<p>Nom : ' . $formation->getIntitule() . '</p>';
                    echo '<p>Descriptif : ' . $formation->getDescriptif() . '</p>';

                    $idUser = $_SESSION['idUser'];
                    $etatInscription = formationDAO::getEtatInscription($idUser, $formationId);

                    echo '<p>Etat de votre inscription : ' . $etatInscription . '</p>';

                    echo '<form method="post" action="index.php">';
                    echo '<input type="hidden" name="formationId" value="' . $formation->getIdForma() . '">';
                    echo '<input type="submit" name="submitDesinscription" value="Se désinscrire">';
                    echo '</form>';
                } else {
                    echo '<p>Formation non trouvée.</p>';
                }
            } else {

                include 'vue/formation/formationDroite.php';
            }
            ?>
            <div id="messageInscription">
                <?php echo $message; ?>
            </div>
        </div>
    </main>
    <footer>
        <?php include 'bas.php'; ?>
    </footer>
</div>