<?php
session_start();

require_once'controller/Controller.php';
$controller = new Controller();

if(!empty($_GET)){
    extract($_GET);
    if(isset($a)){
        switch($a){
            case 'connection':
                require 'view/connection.php';
                break;
            case 'signIn':
                $controller->signIn();
                break;
            case 'signUp':
                $controller->signUp();
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
