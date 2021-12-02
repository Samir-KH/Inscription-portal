<?php
    function db(){
        $base = mysqli_connect("localhost","root","","insea_inscription");
        mysqli_set_charset($base,'utf8');    
        return $base;

    }
    function filieres(){
        $d_base = db();
        $reponse = $d_base->query("SELECT * FROM filiere");
        return $reponse;
    }
    function cycles(){
        $d_base = db();
        $reponse = $d_base->query("SELECT * FROM cycle");
        return $reponse;
    }
    function is_exist($matricule){
        return true; //cette instruction sera supprimée
        $d_base = db();
        $reponse = $d_base->query("SELECT matricule FROM etudiant");
        while($donnees = mysqli_fetch_array($reponse)){
            if ($matricule == $donnees['matricule']){
                return true ;
            }
        }
        return false;
    }
    function niveau_cycle($cycle){
        $d_base = db();
        //avertissement nous sommes besoin d'une requete preparée!!!!!!!
        $reponse = $d_base->query("SELECT Nmax  FROM cycle WHERE id=".$cycle);
        return mysqli_fetch_array($reponse);
    }
    function get_name($table,$id){
        $d_base = db();
        //avertissement nous sommes besoin d'une requete preparée!!!!!!!
        $reponse = $d_base->query("SELECT ".$table." FROM ".$table." WHERE id=".$id);
        return mysqli_fetch_array($reponse)[$table];
    }

