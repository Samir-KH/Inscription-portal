<?php $title = "INSEA - Etape 4" ?>

<?php ob_start(); ?>
    <link href="styles/form_step_4.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,300;1,400&display=swap" rel="stylesheet">
    <link href="styles/progress.css" rel="stylesheet">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
    <?php 
        $step = 4;
        require("view/progress.php");   
    ?>
        <div class="box">
            <div class="h">
                <img src="styles/images/INSEA_logo.png" alt="logo" class="logo">
                <h1 class="h1">Inscription</h1>
            </div>
            <h2 class="h_sous">importez les documments nécessaires</h2>
            <p class="valide"><?php if($valide) echo "vous pouvez conserver les fichier déjà utilisé en appliquant sur valider";?></p> 
            <form action="index?action=show" method="POST" enctype="multipart/form-data">
                <div class="inputdiv">
                    <div class="input_div">
                        <div  class="lab">Photo<span class="info">(.jpg ne depasse pas 4 Mo)</span></div>
                        <div class="input_ds">
                            <label for="photo" class="button-upload"><div>+</div></label>
                            <input name="photo" type="file" id="photo" class="file"  <?php if(!$valide) echo "required";?>>  
                        </div>
                    </div>
                    <div class="input_div">
                        <div  class="lab">Copie du Baccalauréat<span class="info">(.pdf ne depasse pas 4 Mo)</span></div>
                        <div class="input_ds">
                            <label for="baccalaureat" class="button-upload"><div>+</div></label>
                            <input name="baccalaureat" type="file" id="baccalaureat" class="file" <?php if(!$valide) echo "required";?> >  
                        </div>
                    </div>
                    <div class="input_div">
                        <div  class="lab">Copie de la CIN <span class="info">(.pdf ne depasse pas 4 Mo)</span></div>
                        <div class="input_ds">
                            <label for="cin" class="button-upload"><div>+</div></label>
                            <input name="cin" type="file" id="cin" class="file" <?php if(!$valide) echo "required";?>>  
                        </div>
                    </div>
                    <div class="input_div">
                        <div  class="lab">Attestation de réussite <span class="info">(.pdf ne depasse pas 4 Mo)</span></div>
                        <div class="input_ds">
                            <label for="attestation" class="button-upload"><div>+</div></label>
                            <input name="attestation" type="file" id="attestation" class="file" <?php if(!$valide) echo "required";?>>
                            <?php $types = array('CNC','DEUGS','Licence'); ?>
                            <select name="type" class="type_att">
                                <option value="type">Type</option>
                                <?php 
                                foreach ($types as  $tp) {
                                ?>
                                <option value="<?= $tp ?>" <?php if($type == $tp) echo 'selected' ?> ><?= $tp ?></option>
                                <?php
                                }
                                ?>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="bottomBox">
                    <a href="index?action=sign_in_etape3" class="R_butt">Retour</a>
                    <input type="submit" class="button Suivant" value="Terminer">
                </div>
            </form>
        </div>       


<?php $content = ob_get_clean(); ?>
 

<?php require('template.php'); ?>