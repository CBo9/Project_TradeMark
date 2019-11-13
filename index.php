<?php
session_start();

if(!empty($_GET)){
    extract($_GET);
    if(isset($a)){
        switch($a){
            case 'connection':
                require 'view/connection.php';
                break;
            case 'signUp':
                require 'view/inscription.php';
                break;
            case 'signOut':
                $controller->deconnexion();
                break;
            case 'gestion':
                $controller->affichage();
                break;
            case 'inscrire':
                $controller->inscription();
                break;
            case 'modifier':
                $controller->modification($id);
                break;
            case 'supprimer':
                $controller->suppression($id);
                break;
            case 'connecter':
                $controller->connexion();
                break;
            default:
                require 'view/error404.php';
                break;
        }
    }else{
        require 'view/error404.php';
    }
}else{
    require 'view/home.php';
}
