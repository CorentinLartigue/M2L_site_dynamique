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
            <div class="menu-vertical1">
                <h3>Liste des utilisateurs :</h3>
                <ul>
                    <?php
                    $utilisateurs = utilisateurDAO::getUtilisateurs();

                    foreach ($utilisateurs as $utilisateur) {
                        echo '<li><a href="?user=' . $utilisateur->getIdUser() . '">' . $utilisateur->getNom() ."  ". $utilisateur->getPrenom() .'</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class='droite'>
            <?php
            if (isset($_GET['user'])) {

                $idUser = $_GET['user'];
                $inscriptionsUtilisateur = inscriptionDAO::getInscriptionsByUser($idUser);

                if (!empty($inscriptionsUtilisateur)) {
                    echo '<h2>Inscriptions de l\'utilisateur :</h2>';
                    echo '<ul>';
                    foreach ($inscriptionsUtilisateur as $inscription) {
                        echo '<li>' . $inscription->getIntitule() . ' - État : ' . $inscription->getEtatInscription() . '</li>';
                        // ...
                        echo '<form method="post" action="">';
                        echo '<input type="hidden" name="formation_id" value="' . $inscription->getIdForma() . '">';
                        echo '<select name="etat_inscription_' . $inscription->getIdForma() . '">';
                        echo '<option value="Accepté" ' . ($inscription->getEtatInscription() === 'Accepté' ? 'selected' : '') . '>Accepté</option>';
                        echo '<option value="Refusé" ' . ($inscription->getEtatInscription() === 'Refusé' ? 'selected' : '') . '>Refusé</option>';
                        echo '</select>';
                        echo '<input type="submit" name="modifier_etat" value="Valider">';
                        echo '</form>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p>Cet utilisateur n\'est inscrit à aucune formation pour le moment.</p>';
                }
            } else {

                include 'vue/gererformation/gererFormationDroite.php';
            }
            ?>
        </div>
    </main>
    <footer>
        <?php include 'bas.php'; ?>
    </footer>
</div>
