<?php
class SignManager{

    private function db(){
        $base = new PDO("mysql:host=localhost;dbname=inscription;charset=utf8",'root','');
        return $base;
    }

    public function filieres(){
        $d_base = $this->db();
        $reponse = $d_base->query("SELECT * FROM filiere");
        return $reponse;
    }
    public function cycles(){
        $d_base = $this->db();
        $reponse = $d_base->query("SELECT * FROM cycle");
        return $reponse;
    }
    public function niveau_cycle($cycle){
        $d_base = $this->db();
        $reponse =  $d_base->prepare("SELECT Nmax  FROM cycle WHERE id= :myid");
        $reponse->execute(array('myid'=>$cycle));
        return $reponse->fetch();
    }
    public function get_name_filiere($id){
        $d_base = $this->db();
        $reponse = $d_base->prepare("SELECT filiere FROM filiere WHERE id =:id");
        $reponse->execute(array(
            'id'=>$id
        ));
        return $reponse->fetch()['filiere'];
    }
    public function get_name_cycle($id){
        $d_base = $this->db();
        $reponse = $d_base->prepare("SELECT cycle FROM cycle WHERE id =:id");
        $reponse->execute(array(
            'id'=>$id
        ));
        return $reponse->fetch()['cycle'];
    }
    public function matriculeExists($matricule){
        $d_base = $this->db();
        $reponse = $d_base->prepare("SELECT * FROM etudiant WHERE matricule = :matr");
        $reponse->execute(array(
            'matr'=>$matricule
        ));
        $dta = $reponse->fetch();
        if ($dta == false)
            return false;
        if ($dta['matricule'] ==$email){
            return  true;
        }
        return false;
    }
    public function emailExists($email){
        $d_base = $this->db();
        $reponse = $d_base->prepare("SELECT * FROM etudiant WHERE  email= :email");
        $reponse->execute(array(
            'email'=>$email
        ));
        $dta = $reponse->fetch();
        if ($dta == false)
            return false;
        if ($dta['email'] ==$email){
            return  true;
        }
        return false;
    }
    public function signUp($array){
        $d_base = $this->db();
        $query = $d_base->prepare("INSERT INTO `etudiant` (`nom`, `prenom`,`email`,`matricule`, `lieu_de_naissence`,
        `date_de_naissence`, `sexe`, `cycle`, `filiere`, `niveau`,
         `type`, `date_inscription`, `confirmation_email`) VALUES(:nom,:prenom,:email,:matricule,:lieu_de_naissence,:date_de_naissence,
         :sexe,:cycle,:filiere,:niveau,:tpe,NOW(),:id_confirmation)");
        $query->execute(array(
            'nom'=> $array["nom"],
            'prenom'=> $array["prenom"],
            'email'=> $array["email"],
            'matricule'=> $array["matricule"],
            'lieu_de_naissence'=> $array["lieu"],
            'date_de_naissence'=> $array["annee"].'-'.$array["mois"].'-'.$array["jour"],
            'sexe'=> $array["sexe"],
            'cycle'=> $array["cycle"],
            'filiere'=> $array["filiere"],
            'niveau'=> $array["niveau"],
            'tpe'=> $array["type"],
            'id_confirmation'=>$array["id_confirmation"]
        ));
    }	

    public function confirme($id_confirmation){
        $d_base = $this->db();
        $query = $d_base->prepare("SELECT matricule FROM etudiant  WHERE confirmation_email=:id_confirmation");
        $query->execute(array(
            'id_confirmation'=>$id_confirmation
        ));
        if ($query->fetch()){
            $query = $d_base->prepare("UPDATE etudiant  SET confirmation_email='oui' WHERE confirmation_email=:id_confirmation ");
            $query->execute(array(
                'id_confirmation'=>$id_confirmation
            ));
            return true;  
        }
        return false;
    }
    public function cycle_exist($value){
        $d_base = $this->db();
        $reponse = $d_base->prepare("SELECT * FROM cycle WHERE  id= :vlue");
        $reponse->execute(array(
            'vlue'=>$value
        ));
        $dta = $reponse->fetch();
        if ($dta == false)
            return false;
        if ($dta['id'] ==$value){
            return  true;
        }
        return false;

    }
    public function filiere_exist($value){
        $d_base = $this->db();
        $reponse = $d_base->prepare("SELECT * FROM filiere WHERE  id= :vlue");
        $reponse->execute(array(
            'vlue'=>$value
        ));
        $dta = $reponse->fetch();
        if ($dta == false)
            return false;
        if ($dta['id'] ==$value){
            return  true;
        }
        return false;

    }
	public function clean_non_confirmed(){
        $d_base = $this->db();
        $reponse = $d_base->query("DELETE FROM etudiant WHERE  NOW()>=DATE_ADD(date_inscription,INTERVAL 10 MINUTE) AND confirmation_email!='oui' ");

    }
   
}