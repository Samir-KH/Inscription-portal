<?php $title = "INSEA - Error" ?>

<?php ob_start(); ?>
    <link href="styles/error.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,300;1,400&display=swap" rel="stylesheet">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
        <div class="container">
            <div class="div1">
                <div class="div2">
                    <img src="styles/images/ERROR.png" alt="logo" class="logo">
                    <h1>Désolé, le serveur a rencontré quelques problèmes.</h2>
                    <h2 >Impossible de terminer la procédure d'inscription .</h1>
                    <h3>Vérifier:</h3>    
                    <ul class="probleme_div">
                        <?php foreach($verifie as $i){
                            ?>
                            <li class="error"><?=$i?></li>
                        <?php
                        }
                        ?>
                    </ul>
                    <div class="div_but">
                        <a href="<?=$direction?>" class=" button"><?=$nom_direction?></a>
                    </div>
                </div>
            </div>
        </div>


<?php $content = ob_get_clean(); ?>
 

<?php require('template.php'); ?>