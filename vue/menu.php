<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5 border-bottom">
    <div class="container">
        <a href="index.php" class="navbar-brand">Note de frais</a>
            <div class="navbar-nav ms-auto">
            <?php
                        // Si l'utilisateur est connecté, on affiche l'icone profil et le bouton deconnexion    
                        if(isset($_SESSION['connect'])){ ?>
                            <div class="dropdown">
                                <li class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown">
                                    <img id="profil" src="vue/images/profil.png" alt="Icone Profil">
                                </li>
                                <ul class="dropdown-menu">
                                    <li><a href="index.php?ctl=utilisateur&action=profil" class="nav-item nav-link">Profil</a></li>
                                    <li><a href="index.php?ctl=utilisateur&action=deConnect" class="nav-item nav-link">Déconnexion</a></li>
                                </ul>
                            </div>
                        <?php } else { ?>
                            <a href="index.php?ctl=utilisateur&action=formConnect" class="nav-item nav-link"><button class="btn btn-outline-primary">Connexion</button></a>
                        <?php } 
                        ?>
            </div>
    </div>
</nav>

<?php
if ($utilisateur['statut'] == '1') {  //On vérifie si l'utilisateur est un admin ou pas

// EN TEST 

if(isset($_SESSION['connect']) && !isset($_GET['action'])) {

    include 'model/dbUtilisateur.php';
    
    $result = DbUtilisateur::getInfoUser($_SESSION['email']);
    $id_utilisateur = $result['id_utilisateur'];
    $infoNoteDeFrais = DbUtilisateur::getNoteDeFrais($id_utilisateur);


    ?>
    <h1>Coucou, t'es admin</h1>


    <div class="container text-center pt-2">

        <h1 class="pb-5">Bienvenue <?php echo ucfirst($result['prenom']); echo ' '.ucfirst($result['nom']) ?></h1>

        <h2 class="pb-5">Vos notes de frais</h2>

        <?php

            if(count($infoNoteDeFrais)== 0) { ?>

                <p class="pt-5 fs-5">Pas de note de frais</p>

            <?php } else { 
                
                //$infoLigneFc = DbUtilisateur::getLigneFc($infoNoteDeFrais['id_note']); ?>
                
                <div class="row">


                    <?php
                     
                    foreach($infoNoteDeFrais as $DonneesInfoNoteDeFrais) {
                        
                        $infoLigneFc = DbUtilisateur::getLigneFc($DonneesInfoNoteDeFrais['id_note']);
                        $infoLigneKm = DbUtilisateur::getLigneFk($DonneesInfoNoteDeFrais['id_note']);
                        
                        ?>





                        <div class="col-4">

                            <div class="card">

                                <div class="card-body">

                                <h5 class="card-title p-2"><?php  echo $DonneesInfoNoteDeFrais['mission'] ?></h5>

                                <table class="table table-borderless table-bordered">
                                    <tr>
                                        <th>Libellé</th>
                                        <th>Montant</th>
                                        <th>Statut</th>
                                    </tr>
                                    <tr>
                                                <?php

                                                $total = 0;

                                                foreach($infoLigneFc as $DonneesInfoLigneFc) {
                                                    

                                                    ?>


                                                    <tr>
                                                        <td><?php echo $DonneesInfoLigneFc['libelle'] ?></td>
                                                        <td><?php echo $DonneesInfoLigneFc['montant_fc']; $total += $DonneesInfoLigneFc['montant_fc']; ?></td>
                                                        
                                                        <td>
                                                            <?php 
                                                                if ($DonneesInfoLigneFc['statut'] == 0) {
                                                                    echo '<p class="text-warning fw-bold">En attente</p>'; } 
                                                                else if ($DonneesInfoLigneFc['statut'] == 1) { 
                                                                    echo '<p class="text-success fw-bold">Validé</p>'; }
                                                                    
                                                                else {
                                                                    echo '<p class="text-danger fw-bold">Refusé</p>';
                                                                }
                                                            ?>

                                                    </tr>

                                                <?php } ?>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Sous total<b>
                                        </td>
                                        <td colspan="2" class="text-center">
                                            <?php echo $total; ?>
                                        </td>   
                                    </tr>
                                </table>


                                <table class="table table-borderless table-bordered">
                                    <tr>
                                        <th>Nombre de kilomètres</th>
                                        <th>Indémnités kilomètriques</th>
                                    </tr>
                                    <tr>
                                        <?php

                                            foreach($infoLigneKm as $DonneesInfoLigneKm) {
                                                ?>

                                                
                                                <td><?php echo $DonneesInfoLigneKm['kilometre'] ?></td>
                                                <td><?php echo $DonneesInfoLigneKm['montant'] ?> € </td>
                                                

                                        <?php } ?>
                                    </tr>
                                </table>

                                <div class="border p-2 mb-3">
                                    <b>Total à rembourser : <?php echo $DonneesInfoNoteDeFrais['montant'] ?> €</b>
                                </div>

                                <div class="p-2 border fw-bold text-warning fs-5 text-center">
                                    En attente
                                </div>

                                </div>
                            </div>
                        </div>


                     <?php }?>
    

                </div>
            <?php  } ?>




        <a href="index.php?ctl=utilisateur&action=formNoteFrais"><button class="btn btn-outline-secondary mt-5">Créer une note de frais</button></a>


    </div>


<?php } }else{
    // EN TEST 

if(isset($_SESSION['connect']) && !isset($_GET['action'])) {

    include 'model/dbUtilisateur.php';
    
    $result = DbUtilisateur::getInfoUser($_SESSION['email']);
    $id_utilisateur = $result['id_utilisateur'];
    $infoNoteDeFrais = DbUtilisateur::getNoteDeFrais($id_utilisateur);


    ?>



    <div class="container text-center pt-2">

        <h1 class="pb-5">Bienvenue <?php echo ucfirst($result['prenom']); echo ' '.ucfirst($result['nom']) ?></h1>

        <h2 class="pb-5">Vos notes de frais</h2>

        <?php

            if(count($infoNoteDeFrais)== 0) { ?>

                <p class="pt-5 fs-5">Pas de note de frais</p>

            <?php } else { 
                
                //$infoLigneFc = DbUtilisateur::getLigneFc($infoNoteDeFrais['id_note']); ?>
                
                <div class="row">


                    <?php
                     
                    foreach($infoNoteDeFrais as $DonneesInfoNoteDeFrais) {
                        
                        $infoLigneFc = DbUtilisateur::getLigneFc($DonneesInfoNoteDeFrais['id_note']);
                        $infoLigneKm = DbUtilisateur::getLigneFk($DonneesInfoNoteDeFrais['id_note']);
                        
                        ?>





                        <div class="col-4">

                            <div class="card">

                                <div class="card-body">

                                <h5 class="card-title p-2"><?php  echo $DonneesInfoNoteDeFrais['mission'] ?></h5>

                                <table class="table table-borderless table-bordered">
                                    <tr>
                                        <th>Libellé</th>
                                        <th>Montant</th>
                                        <th>Statut</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                                <?php

                                                $total = 0;

                                                foreach($infoLigneFc as $DonneesInfoLigneFc) {
                                                    

                                                    ?>


                                                    <tr>
                                                        <td><?php echo $DonneesInfoLigneFc['libelle'] ?></td>
                                                        <td><?php echo $DonneesInfoLigneFc['montant_fc']; $total += $DonneesInfoLigneFc['montant_fc']; ?></td>
                                                        
                                                        <td>
                                                            <?php 
                                                                if ($DonneesInfoLigneFc['statut'] == 0) {
                                                                    echo '<p class="text-warning fw-bold">En attente</p>'; } 
                                                                else if ($DonneesInfoLigneFc['statut'] == 1) { 
                                                                    echo '<p class="text-success fw-bold">Validé</p>'; }
                                                                    
                                                                else {
                                                                    echo '<p class="text-danger fw-bold">Refusé</p>';
                                                                }
                                                            ?>
                                                        <td>
                                                            <a href="index.php?ctl=utilisateur&action=supprimerLigneFc&idLigneFc=<?php echo $DonneesInfoLigneFc['id_fc'] ?>"><img src="vue\images\trash.png" alt="supprimer" height="20" style="padding-right:10px;"></a>
                                                            <a data-bs-toggle="modal" data-bs-target="#exampleModal1"><img src="vue\images\crayon.png" alt="modifier" height="20"></a>
                                                        </td>
                                                    </tr>

                                                    <!-- Le Pop-up qui s'affiche sur le clic du bouton ci-dessus -->
                                                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header mb-3">
                                                            <h5 class="modal-title" id="exampleModalLabel">Modification</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <!-- Formulaire dans le pop up, elle redirige vers le controller utilisateur et l'action ajoutVehicule -->
                                                        <form action="index.php?ctl=utilisateur&action=modifierLigneFc&idLigneFc=<?php echo $DonneesInfoLigneFc['id_fc']?>" method="post">

                                                            <div class="container w-75">
                                                                <div class="mb-3">
                                                                    <input type="text" class="form-control" name="libelle" placeholder="Libellé" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <input type="text" class="form-control" name="montant" placeholder="Montant" required>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fermer</button>
                                                                    <button type="submit" class="btn btn-outline-success">Ajouter</button>
                                                                </div>
                                                            </div>

                                                        </form>

                                                        </div>
                                                    </div>
                                                    </div>

                                    

                                                <?php } ?>
                                                
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Sous total<b>
                                        </td>
                                        <td colspan="2" class="text-center">
                                            <?php echo $total; ?>
                                        </td>   
                                    </tr>
                                </table>


                                <table class="table table-borderless table-bordered">
                                    <tr>
                                        <th>Nombre de kilomètres</th>
                                        <th>Indémnités kilomètriques</th>
                                    </tr>
                                    <tr>
                                        <?php

                                            foreach($infoLigneKm as $DonneesInfoLigneKm) {
                                                ?>

                                                
                                                <td><?php echo $DonneesInfoLigneKm['kilometre'] ?></td>
                                                <td><?php echo $DonneesInfoLigneKm['montant'] ?> € </td>
                                                

                                        <?php } ?>
                                    </tr>
                                </table>

                                <div class="border p-2 mb-3">
                                    <b>Total à rembourser : <?php echo $DonneesInfoNoteDeFrais['montant'] ?> €</b>
                                </div>

                                <div class="p-2 border fw-bold text-warning fs-5 text-center">
                                    En attente
                                </div>

                                </div>
                            </div>
                        </div>


                     <?php }?>
    

                </div>
            <?php  } ?>




        <a href="index.php?ctl=utilisateur&action=formNoteFrais"><button class="btn btn-outline-secondary mt-5">Créer une note de frais</button></a>


    </div>


<?php }

?>
}

?>


