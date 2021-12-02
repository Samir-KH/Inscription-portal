<?php $title = "INSEA - Etape 1" ?>

<?php ob_start(); ?>
    <link href="styles/form_step_1.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,300;1,400&display=swap" rel="stylesheet">
    <link href="styles/progress.css" rel="stylesheet">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
    <?php 
        $step = 1;
        require("progress.php");   
    ?>
    <div class="box">
        <div class="h">
            <img src="styles/images/INSEA_logo.png" alt="logo" class="logo">
            <h1 class="h1">Inscription</h1>
        </div>
        <h2 class="h_sous">Veuillez remplir le formulaire</h2> 
        <p class="p_sous">Institut national de statistique et d'économie appliquée inscription pour l'année 2021/2020</p>
        <form action="index?action=sign_in_etape2" method="POST">
            <div class="inputdiv">
                <div class="input_div">
                    <input name="nom" type="text" class="input_ds"   value="<?= $nom ?>"  autocomplete="off" required>
                    <label for="nom" class="label_ds">Nom</label>
                </div>
                
                <div class="input_div">
                    <input name="prenom" type="text" class="input_ds"  value="<?= $prenom ?>" autocomplete="off"  required>
                    <label for="prenom" class="label_ds">Prénom</label>
                </div>
                <div class="input_div">
                    <input name="email" type="text" class="input_ds"  value="<?= $email ?>" required>
                    <label for="email" class="label_ds">E-mail</label>
                </div>
                <p class="not_found"><span >🛑</span> Ce compte n'existe pas </p>
            </div>
            <div class="bottomBox">
                    <a href="index.php" class="R_butt">Annuler</a>
                    <input type="submit" class="button Suivant" value="Suivant">
            </div>
        </form>
    </div>        


<?php $content = ob_get_clean(); ?>
 

<?php require('template.php'); ?>