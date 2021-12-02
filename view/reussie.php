<?php $title = "INSEA Inscription Réussie" ?>

<?php ob_start(); ?>
    <link href="styles/indexview.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,300;1,400&display=swap" rel="stylesheet">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
        <div class="royaume">
            <img src="styles/images/royaume-du-maroc.png" alt="logo" class="r_logo">
            <p class="h2"> Ministère de l'Éducation Nationale, de la Formatio
                professionnelle, de l'Enseignement Supérieur
                et de la Recherche Scientifique</p>
        </div>
        <div class="hcp">
            <img src="styles/images/HCP.png" alt="logo" class="h_logo">
        </div>
        <div class="container">
            <div class="div1">
                <div class="div2">
                    <img src="styles/images/confirmation-rv.png " alt="logo" class="logo anim">
                    <h1 class="h1">Félicitation! Votre inscription à été confirmée</h1>
                    <div class="div_butt">
                        <a href="index" class=" button">Page d'acceuil</a>
                    </div>
                </div>
            </div>
        </div>
        <?php $content = ob_get_clean(); ?>
 



<?php require('template.php'); ?>