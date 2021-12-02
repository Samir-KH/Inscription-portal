<?php
    require_once('model/SignManager.php');
    function page_index(){
        if ($directory = opendir('tmp')){
            while( false !==($file_tmp = readdir($directory)) ){
                if ($file_tmp!='.' AND $file_tmp!='..'){
                    unlink('tmp/'.$file_tmp);
                }
            }
        }
        $SingM = new SignManager();
        $SingM->clean_non_confirmed();
        require('view/indexview.php');  
    }
    function form_step_1(){
        $_SESSION['etat'] = 1;
        $nom= NULL;
        $prenom=NULL;
        $email=NULL;

        if (isset($_SESSION["nom"])){
            $nom = $_SESSION["nom"];
        }
        if (isset($_SESSION["prenom"])){
            $prenom = $_SESSION["prenom"];
        }
        if (isset($_SESSION["email"])){
            $email = $_SESSION["email"];
        }
        require('view/form_step_1.php');
    }
    function form_step_2(){
        $SingM = new SignManager();
        if (!isset($_SESSION['etat'])){
            throw new Exception('session_error');
        }
        

        if(isset($_POST["nom"]) AND isset($_POST["prenom"]) AND isset($_POST["email"])){
            $_SESSION["nom"] = htmlspecialchars($_POST["nom"]);
            $_SESSION["prenom"] = htmlspecialchars($_POST["prenom"]);
            if ( $SingM->emailExists($_POST["email"])){
                throw new Exception('email_error');
            }
            $_SESSION["email"] = htmlspecialchars($_POST["email"]);
            
            
        }
        if( !isset( $_SESSION["nom"])  OR !isset( $_SESSION["prenom"]) ){
            throw new Exception('etape_error');
            //echo '<div style="posistion:absolute;z-index:100;">ok<div>';
            //echo '<div style="posistion:absolute;z-index:100;">'.$_SESSION["nom"].'<div>';
        }
        $matricule = NULL;
        $lieu = NULL;
        $jour = NULL;
        $annee = NULL;
        $mois = NULL;
        $sexe = NULL;
        if (isset($_SESSION["lieu"])){
            $lieu = $_SESSION["lieu"];
        }
        if (isset($_SESSION["matricule"])){
            $matricule = $_SESSION["matricule"];
        }
        if (isset($_SESSION["jour"])){
            $jour = $_SESSION["jour"];
        }
        if (isset($_SESSION["mois"])){
            $mois = $_SESSION["mois"];
        }
        if (isset($_SESSION["annee"])){
            $annee = $_SESSION["annee"];
        }
        if (isset($_SESSION["sexe"])){
            $sexe = $_SESSION["sexe"];
        }
        require('view/form_step_2.php');
    }
    function form_step_3(){
        $SingM = new SignManager();
        if (!isset($_SESSION['etat'])){
            throw new Exception('session_error');
        }
        $ERROR = false;
        if(isset($_POST["lieu"]) AND isset($_POST["matricule"]) AND isset($_POST["jour"]) AND isset($_POST["mois"]) AND isset($_POST["annee"])AND isset($_POST["sexe"]) ){
            $_SESSION["lieu"] = htmlspecialchars($_POST["lieu"]);
            if (in_array($_POST["sexe"],array('Homme','Femme'))){
                $_SESSION["sexe"] = htmlspecialchars($_POST["sexe"]);
            }
            else{
                $ERROR = 'sexe_error';
            }
            
            if ( !$SingM->matriculeExists($_POST["matricule"])){
                $_SESSION["matricule"] = htmlspecialchars($_POST["matricule"]);
            }
            else{
                $ERROR = 'matricule_error';
            }
            if($_POST["jour"]!="Jour" AND $_POST["mois"]!="Mois" AND $_POST["annee"] !="Annee"){
                if (checkdate($_POST["mois"],$_POST["jour"],$_POST["annee"])){
                    if ( 1990 <= $_POST["annee"] AND $_POST["annee"] <=2003){
                        $_SESSION["jour"] = htmlspecialchars($_POST["jour"]);
                        $_SESSION["mois"] = htmlspecialchars($_POST["mois"]); 
                        $_SESSION["annee"] = htmlspecialchars($_POST["annee"]); 
                    }
                    else{
                        $ERROR = 'date_error';
                    }
                }
                else{
                    $ERROR = 'date_error';
                }
            }
            else {
                $ERROR = 'date_error';
            }
            if($ERROR!=false){
                throw new Exception($ERROR);
            }
            
        }
        if(!isset($_SESSION["lieu"]) OR !isset($_SESSION["matricule"]) OR !isset($_SESSION["jour"]) OR !isset($_SESSION["mois"]) OR !isset($_SESSION["annee"]) OR !isset($_SESSION["sexe"])){
            throw new Exception('etape_error');
        }
        $filieres = $SingM->filieres();
        $cycles = $SingM->cycles();
        $cycle = NULL;
        $filiere = NULL;
        $niveau = NULL ;
        if (isset($_SESSION["cycle"])){
            $cycle = $_SESSION["cycle"];
        }
        if (isset($_SESSION["filiere"])){
            $filiere = $_SESSION["filiere"];
        }
        if (isset($_SESSION["niveau"])){
            $niveau = $_SESSION["niveau"] ;
        }

        require('view/form_step_3.php');
    }
    function form_step_4(){
        if (!isset($_SESSION['etat'])){
            throw new Exception('session_error');
        }
        
        $SingM = new SignManager();
        if (isset($_POST["cycle"]) AND isset($_POST["niveau"]) AND isset($_POST["filiere"])){
            if (!$SingM->filiere_exist($_POST["filiere"]) OR !$SingM->filiere_exist($_POST["cycle"]) ){
                throw new Exception('valueFLCY_error');
            }
            $_SESSION["cycle"] = htmlspecialchars($_POST["cycle"]);
            $_SESSION["filiere"] = htmlspecialchars($_POST["filiere"]);
            $niveau_cycle = $SingM->niveau_cycle( $_SESSION["cycle"]);
            if ( $_POST["niveau"] > $niveau_cycle["Nmax"]  OR $_POST["niveau"] < 0 ){
                throw new Exception('niveau_error'); 
            } 
            $_SESSION["niveau"] = htmlspecialchars($_POST["niveau"]);
        }
        if (!isset($_SESSION["cycle"]) OR !isset($_SESSION["niveau"]) OR !isset($_SESSION["filiere"])){
            throw new Exception('etape_error');
        }
        $valide = false;
        if( isset($_SESSION['photo']) AND isset($_SESSION['baccalaureat']) AND isset($_SESSION['attestation']) AND isset($_SESSION['cin'])){
            $valide = true;
        }
        $type = NULL;
        if (isset($_SESSION["type"])){
            $type = $_SESSION["type"];
        }
        require('view/form_step_4.php');
    }
    //'files_uploaded/'.$file.'/'
    function upload_manager($file,$extension){
        if (isset($_SESSION[ $file ])){
            return true;
        }
        if( isset($_FILES[$file]) AND $_FILES[$file]['error'] == 0){
            if ($_FILES[$file]['size']<=4000000){
                $infosfichier = pathinfo($_FILES[$file]['name']);
                $extension_upload = $infosfichier['extension'];
                if ( in_array($extension_upload,$extension)){
                    $path = 'tmp/'.$file.$_SESSION['matricule'].'.'.$extension_upload;
                    move_uploaded_file($_FILES[$file]['tmp_name'],$path);
                    $_SESSION[ $file ] = htmlspecialchars($path);
                    
                }
                else {
                    throw new Exception('exthension_error');
                }
            }
            else {
                throw new Exception('size_error');
            }
        }
        else{
            throw new Exception('file_error');
        }

    }
    function page_show(){
        if (!isset($_SESSION['etat'])){
            throw new Exception('session_error');
        }
        $types = array('CNC','DEUGS','Licence');
        if (isset($_POST["type"]) ){
                $_SESSION["type"] = htmlspecialchars($_POST["type"]);
        }
        if (!isset($_SESSION["type"]) OR !in_array($_SESSION['type'],$types) ){
            throw new Exception('type_error');
        }
        if (isset($_SESSION["nom"]) AND isset($_SESSION["prenom"])AND isset($_SESSION["email"])
        AND isset($_SESSION["lieu"]) AND isset($_SESSION["matricule"])
        AND isset($_SESSION["sexe"]) AND isset($_SESSION["jour"]) AND isset($_SESSION["mois"]) AND isset($_SESSION["annee"]) 
        AND isset($_SESSION["cycle"]) AND isset($_SESSION["filiere"]) AND isset($_SESSION["niveau"])  ){
            upload_manager('photo',array('jpg','png'));
            upload_manager('baccalaureat',array('pdf'));
            upload_manager('attestation',array('pdf'));
            upload_manager('cin',array('pdf'));
            $nom = $_SESSION["nom"];
            $prenom = $_SESSION["prenom"];
            $email = $_SESSION["email"];
            $lieu_naissance = $_SESSION["lieu"];
            $matricule = $_SESSION["matricule"];
            $sexe = $_SESSION["sexe"];
            $date_naissance = (string)$_SESSION["jour"]."-".(string)$_SESSION["mois"]."-".(string)$_SESSION["annee"];
            $SingM = new SignManager();
            $cycle = $SingM->get_name_cycle($_SESSION["cycle"]);
            $filiere = $SingM->get_name_filiere($_SESSION["filiere"]);
            $niveau = $_SESSION["niveau"] ;
            $photo = $_SESSION[ 'photo' ];       
            $attest = $_SESSION[ 'attestation' ];
            $type = $_SESSION["type"];
            $cin = $_SESSION[ 'cin' ];
            $baccalaureat = $_SESSION[ 'baccalaureat' ];
        }
        else{
            throw new Exception('etape_error');
        }
        require('view/show.php');
    }
    function save($file){
        $infosfichier = pathinfo($_SESSION[$file]);
        $extension_upload = $infosfichier['extension'];
        $path = 'files_uploaded/'.$file.'/'.$file.'_'.$_SESSION['matricule'].'.'.$extension_upload;
        rename($_SESSION[$file],$path);
    }
    function page_email(){
        if (!isset($_SESSION['etat'])){
            throw new Exception('session_error');
            
        }
        if (isset($_POST['accept'])){
            $_SESSION['accept']= $_POST['accept'];
        }
        if (!isset($_SESSION['accept'] )){
            throw new Exception('accept_error');
        }
        if (isset($_SESSION["nom"]) AND isset($_SESSION["prenom"])AND isset($_SESSION["email"])
        AND isset($_SESSION["lieu"]) AND isset($_SESSION["matricule"])
        AND isset($_SESSION["sexe"]) AND isset($_SESSION["jour"]) AND isset($_SESSION["mois"]) 
        AND isset($_SESSION["annee"]) 
        AND isset($_SESSION["cycle"]) AND isset($_SESSION["filiere"]) AND isset($_SESSION["niveau"])
        AND isset($_SESSION["type"]) AND isset($_SESSION['photo']) AND isset($_SESSION['baccalaureat'])
        AND isset($_SESSION['attestation'])
        AND isset($_SESSION['cin'])){

            $_SESSION['id_confirmation'] = md5($_SESSION['matricule']+(String)random_int(10,1000));
            require_once "mailer/mailer.php";
            if(!SendMail($_SESSION["email"],htmlspecialchars($_SESSION['id_confirmation'])) ){
                throw new Exception('send_error');
            }
            $SingM = new SignManager();
            $SingM->signUp($_SESSION);
            //chois de renvoier §§§§§§§§§!!!!!!!!!!!!!!!!!!!!!!
            //email envoi
            save('photo') ;
            save('baccalaureat');
            save('attestation');
            save('cin');
        }
        else{
            throw new Exception('etape_error');
        }
        require('view/envoi.php');
    }
    function page_confirme(){
        $SingM = new SignManager();
        if (!isset($_GET['id_confirme']) OR  !$SingM->confirme($_GET['id_confirme'])){
                    throw new Exception('id_confirme_error');
        }
        require('view/reussie.php');
    }

    function page_error($numbre){
        if ($numbre == 0){
            $verifie = array("le sereur n'est pas en compte que vous avez commencé la procédure d'inscription,accédez à la page d'accueil et recommencez",
            'vous êtes inactive sur le site depuis long top,recommencez à zéro');
            $direction = 'index';
            $nom_direction = "page d'accueil";
            require('view/error.php');
        }
        if ($numbre == 1){
            $verifie = array("l'une d'es étapes précédentes n'est pas validée","recommencez depuis la première et vérifiée l'une après l'autre");
            $direction = 'index?action=start_sign_in';
            $nom_direction = "Etape 1";
            require('view/error.php');
        }
        if ($numbre == 2){
            $verifie = array("il faut choisir une date parmis les options données","choisissez une date valide !");
            $direction = 'index?action=sign_in_etape2';
            $nom_direction = "Retour";
            require('view/error.php');
        }
        if ($numbre == 3){
            $verifie = array("le matricule donné existe déjà","si vous êtes déjà inscrit, vous ne pouvez pas modifier vous donneés sur cette platforme!");
            $direction = 'index?action=sign_in_etape2';
            $nom_direction = "Retour";
            require('view/error.php');
        }
        if ($numbre == 4){
            $verifie = array("l'email est érroné","ou l'email donné est déjà utilisé");
            $direction = 'index?action=start_sign_in';
            $nom_direction = "Retour";
            require('view/error.php');
        }
        if ($numbre == 5){
            $verifie = array("il faut choisir un type parmis les options données", "choisissez un type valide !");
            $direction = 'index?action=sign_in_etape4';
            $nom_direction = "Retour";
            require('view/error.php');
        }
        if ($numbre == 6){
            $verifie = array("le niveau choisit n'est pas compatible avec votre cycle, il faut le modifier",'ou valeur incompatible');
            $direction = 'index?action=sign_in_etape3';
            $nom_direction = "Retour";
            require('view/error.php');
        }
        if ($numbre == 7){
            $verifie = array("les documment ne sont pas recevés par le serveur","une erreur est survenue pendant l'envoi des documments veuillez réssayer");
            $direction = 'index?action=sign_in_etape4';
            $nom_direction = "Retour";
            require('view/error.php');
        }
        if ($numbre == 8){
            $verifie = array("le fichier dépasse le size recommendé");
            $direction = 'index?action=sign_in_etape4';
            $nom_direction = "Retour";
            require('view/error.php');
        }
        if ($numbre == 9){
            $verifie = array("le type de fichier est incompatible avec le type demandé");
            $direction = 'index?action=sign_in_etape4';
            $nom_direction = "Retour";
            require('view/error.php');
        }
        if ($numbre == 10){
            $verifie = array("vous n'avez pas accepter les conditions");
            $direction = 'index?action=show';
            $nom_direction = "Retour";
            require('view/error.php');
        }
        if ($numbre == 11){
            $verifie = array("erreur pendant la confirmation veulliez ressayer","id n'existe pas");
            $direction = 'index';
            $nom_direction = "page d'acceuil";
            require('view/error.php');
        }
        if ($numbre == 12){
            $verifie = array("une valeur de sexe incompatible !");
            $direction = 'index?action=sign_in_etape2';
            $nom_direction = "Retour";
            require('view/error.php');
        }
        if ($numbre == 13){
            $verifie = array("une valeur de filiere incompatible !",'ou valeur de cycle incompatible');
            $direction = 'index?action=sign_in_etape2';
            $nom_direction = "Retour";
            require('view/error.php');
        }
        if ($numbre == 14){
            $verifie = array("erreur pendant l'envoi de l'email",'verifiez votre connexion internet');
            $direction = 'index?action=show';
            $nom_direction = "Retour";
            require('view/error.php');
        }
    }
    



    

