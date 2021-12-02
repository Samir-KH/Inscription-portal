<?php $title = "INSEA Inscription Réussie" ?>

<?php ob_start(); ?>
    <link href="styles/show.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,300;1,400&display=swap" rel="stylesheet">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="container">
            <div class="div1">
                <div class="paper">
                    <div class="hcp">
                        <img src="styles/images/HCP.png" alt="logo" class="h_logo">
                    </div>
                    <img src="styles/images/INSEA_logo.png" alt="logo" class="logo">
                    <div class="royaume">
                        <img src="styles/images/royaume-du-maroc.png" alt="logo" class="r_logo">
                        <p class="h2"> Ministère de l'Éducation Nationale, de la Formation
                        professionnelle, de l'Enseignement Supérieur
                        et de la Recherche Scientifique</p>
                    </div>
                    <h1 class="h1">Formulaire d'inscription</h1>
                    <div class='Etape'>
                        <img src="<?=$photo?>" alt="photo" class="photo">
                        <div class='npa'>
                            <p><span >Nom:</span> <?=$nom?></p>
                            <p><span >Prenom:</span> <?=$prenom?></p>
                            <p><span >Adresse-email: </span><?=$email?></p>
                        </div>
                    </div>
                    <div class='Etape'>
                            <p><span >Matricule:</span> <?=$matricule?></p>
                            <p><span >Lieu de naissance:</span> <?=$lieu_naissance?></p>
                            <p><span >Date de naissance:</span>  <?=$date_naissance?></p>
                            <p><span >Sexe:</span> <?=$sexe?></p>
                    </div>
                    <div class='Etape'>
                        <p><span >Cycle:</span> <?=$cycle?></p>
                        <p><span >Filière:</span> <?=$filiere?></p>
                        <?php $years = array("Première année","deuxième année","Toisième année","quatrième année");?>
                        <p><span >Niveau:</span> <?=$years[$niveau-1]?></p>
                    </div>
                    <div class='Etape'>
                        <a href="<?=$attest?>" class=" R_butt" target='_blank'>Attestation de réussite: <?=$type?></a>
                        <a href="<?=$cin?>" class=" R_butt" target='_blank'>Cin</a>
                        <a href="<?=$baccalaureat?>" class=" R_butt" target='_blank'>Baccalaureat</a>
                    </div>
                    <div class='Etape'>
                        <ul class='averti'>
                            <li>Après l'enregistrement de vote données, un email de confirmation sera envoyée à
                                 la boite email que vous avez fournite</li>
                            <li>vous aurez dix minuntes pour confirmer votre inscription</li> 
                            <li>Au cas ou vous voulez modifier vos données, ne confirmez pas l'inscription et 
                                    attendez dix minutes puis commencez de nouveau,les anciennes données seront supprimées 
                                    automatiquement</li>
                            <li>Après la confirmation vous ne pouvez plus modifier vos données sur cette
                                 platforme</li>
                        </ul>
                        <div class="div_butt">
                            <form action="index?action=confirme_email" method="POST">
                                <input id='accept' type="checkbox" name="accept">
                                <label for="accept" class='accept_class'> je déclare d'avoir  lu et accepté les conditions </label>
                                <div>
                                 <a href="index?action=start_sign_in" class=" R_butt2">Editer</a>
                                 <input href="#" type="submit" class=" button" value='Enregister'>
                                </div>
                            </form>
                            
                        </div> 
                    </div>
                </div>
            </div>
        </div>
<?php $content = ob_get_clean(); ?>
 



<?php require('template.php'); ?>