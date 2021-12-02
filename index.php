<?php
session_start();
require('controller/controller.php');

try{
    if( isset($_GET['action']) ){
        if ( $_GET['action'] == "start_sign_in" ){
            form_step_1();
        }
        if ( $_GET['action'] == "sign_in_etape2" ){
            form_step_2();
        }
        if ( $_GET['action'] == "sign_in_etape3" ){
            form_step_3();
        }
        if ( $_GET['action'] == "sign_in_etape4" ){
            form_step_4();
        }
        if ( $_GET['action'] == "show" ){
            page_show();
        }
        if ( $_GET['action'] == "confirme_email" ){
            page_email();
            session_destroy();
        }
        if ( $_GET['action'] == "confirm" ){
            page_confirme();
        }
        

    }
    else{
        session_destroy();
        page_index();
    }

}
catch( Exception $e){

    if ($e->getMessage()=='session_error'){
        page_error(0);
    }
    if ($e->getMessage()=='etape_error'){
        page_error(1);
    }
    if ($e->getMessage()=='date_error'){
        page_error(2);
    }
    if ($e->getMessage()=='matricule_error'){
        page_error(3);
    }
    if ($e->getMessage()=='email_error'){
        page_error(4);
    }
    if ($e->getMessage()=='type_error'){
        page_error(5);
    }
    if ($e->getMessage()=='niveau_error'){
        page_error(6);
    }
    if ($e->getMessage()=='file_error'){
        page_error(7);
    }
    if ($e->getMessage()=='size_error'){
        page_error(8);
    }
    if ($e->getMessage()=='exthension_error'){
        page_error(9);
    }
    if ($e->getMessage()=='accept_error'){
        page_error(10);
    }
    if ($e->getMessage()=='id_confirme_error'){
        page_error(11);
    }
    if ($e->getMessage()=='sexe_error'){
        page_error(12);
    }
    if ($e->getMessage()=='valueFLCY_error'){
        page_error(13);
    }
    if ($e->getMessage()=='send_error'){
        page_error(14);
    }
}