<?php $title = "INSEA - Etape 3" ?>

<?php ob_start(); ?>
    <link href="styles/form_step_3.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,300;1,400&display=swap" rel="stylesheet">
    <link href="styles/progress.css" rel="stylesheet">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
    <?php 
        $step = 3;
        require("view/progress.php");   
    ?>
        <div class="box">
            <div class="h">
                <img src="styles/images/INSEA_logo.png" alt="logo" class="logo">
                <h1 class="h1">Inscription</h1>
            </div>
            <h2 class="h_sous">Complétez le formulaire</h2> 
            <form action="index?action=sign_in_etape4" method="POST">

                <div class="inputdiv">
                    <div>
                        <label class="lab">Cycle</label><br>
                        <select name="cycle" class="input_div selec2">
                            <?php   
                                while($donnees = $cycles->fetch()){
                                    ?>
                                    <option value="<?= $donnees['id'] ?>" <?php if($cycle==$donnees['id'])echo 'selected'; ?>> <?= $donnees['cycle'] ?> </option>
                                    <?php
                                    }
                                $cycles->closeCursor();
                            ?>                   
                        </select>
                    </div>
                    <div>
                        <label class="lab">Filière</label><br>
                        <select name="filiere" class="input_div selec2">
                            <?php   while($donnees = $filieres->fetch()){
                                    ?>
                                    <option value="<?= $donnees['id'] ?>" <?php if($filiere==$donnees['id'])echo 'selected'; ?>> <?= $donnees['filiere'] ?> </option>
                                    <?php
                                    }
                                    $filieres->closeCursor()
                            ?>    
                        </select>
                    </div>
                    <div>
                        <label class="lab">Niveau</label><br>
                        <select name="niveau" class="input_div selec2">
                        <?php $years = array("Première année","deuxième année","Toisième année","quatrième année");?>
                        <?php
                            for( $i=0 ; $i<4 ;$i++){
                            ?>
                            <option value="<?= $i+1 ?>" <?php if($niveau-1 ==$i)echo 'selected'; ?> ><?= $years[$i] ?></option>
                            <?php 
                            }
                        ?>

                        </select>
                    </div>
                    <p class="not_found"><span >🛑</span> Ce compte n'existe pas </p>
                </div>
                <div class="bottomBox">
                    <a href="index?action=sign_in_etape2" class="R_butt">Retour</a>
                    <input type="submit" class="button Suivant" value="Suivant">
                </div>
            </form>
        </div>


<?php $content = ob_get_clean(); ?>
 

<?php require('template.php'); ?>