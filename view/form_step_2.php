<?php $title = "INSEA - Etape 1" ?>

<?php ob_start(); ?>
    <link href="styles/form_step_2.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,300;1,400&display=swap" rel="stylesheet">
    <link href="styles/progress.css" rel="stylesheet">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
    <?php 
        $step = 2;
        require("view/progress.php");   
    ?>
    <div class="box">
            <div class="h">
                <img src="styles/images/INSEA_logo.png" alt="logo" class="logo">
                <h1 class="h1">Inscription</h1>
            </div>
            <h2 class="h_sous">Complétez le formulaire</h2> 
            <form action="index?action=sign_in_etape3" method="POST">

                <div class="inputdiv">
                    <div class="input_div">
                        <input name="matricule" type="text" class="input_ds" autocomplete="off" required value="<?=$matricule?>">
                        <label for="matricule" class="label_ds">Matricule</label>
                    </div>
                    <div class="input_div">
                        <input name="lieu" type="text" class="input_ds" autocomplete="off" required value="<?=$lieu?>">
                        <label for="lieu" class="label_ds">Lieu de naissence</label>
                    </div>
                    <div>
                        <label class="lab">Date de naissence</label><br>
                        <select name="jour" class="selec">
                            <option value="Jour">Jour</option>
                            <?php
                                for( $i=1; $i<=31; $i++){
                                $select = "";
                                if ( $i == $jour )
                                    $select = "selected";
                                echo ' <option value="'.$i.'" '.$select.'  >'.$i.'</option>';
                                }
                            ?>
                            
                        </select>
                        <select name="mois" class="selec">
                            <option value="Mois">Mois</option>
                            <?php
                                for( $i=1; $i<=12; $i++){
                                $select = "";
                                if ( $i == $mois )
                                    $select = "selected";
                                echo ' <option value="'.$i.'" '.$select.'  >'.$i.'</option>';
                                }
                            ?>
                        </select>
                        <select name="annee" class="selec">
                            <option value="Annee">Année</option>
                            <?php
                                for( $i=1990; $i<=2003; $i++){
                                $select = "";
                                if ( $i == $annee )
                                    $select = "selected";
                                echo ' <option value="'.$i.'" '.$select.'  >'.$i.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div>
                        <p class="lab">Sexe</p>
                        <input name="sexe" type="radio" class="" required value="Homme" id="Homme"  <?php if($sexe == 'Homme') echo "checked";?>  >
                        <label for="Homme" class="">Homme</label>
                        <input name="sexe" type="radio" class="" required value="Femme" id="Femme" <?php if($sexe == 'Femme') echo "checked";?> >
                        <label for="Femme" class="">Femme</label>
                    </div>
                    <p class="not_found"><span >🛑</span> Ce compte n'existe pas </p>
                </div>
                <div class="bottomBox">
                    <a href="index?action=start_sign_in" class="R_butt">Retour</a>
                    <input type="submit" class="button Suivant" value="Suivant">
                </div>
            </form>
        </div>
    </div>        


<?php $content = ob_get_clean(); ?>
 

<?php require('template.php'); ?>